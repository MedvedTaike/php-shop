<?php

class AdminItemController{
    public function actionIndex($id){
        $items = Item::getItems($id);
        $catList = Item::getItemCategoryList();
        require_once ROOT.'/views/admin_items/index.php';
        return true;
    }
    public function actionAjax(){
        $price = 0;
        if($_POST['id']){
            $id = $_POST['id'];
            $number = $_POST['number'];
            $identifier = $_POST['identifier'];
            $price = Item::updatePrice($id, $number, $identifier);
        }
        echo $price;
    }
    public function actionCreate(){
        $categoriesList = array();
        $categoriesList = Category::getAdminCategoriesList();
        $sellersList = array();
        $sellersList = Category::getSellersList();
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['price_buy'] = $_POST['price_buy'];
            $options['price_sell'] = $_POST['price_sell'];
            $options['measure'] = $_POST['measure'];
            $options['seller_id'] = $_POST['seller_id'];
            $options['convert_t'] = $_POST['convert_t'];
            $options['status'] = $_POST['status'];
            $options['sort_order'] = Item::getOrderNumber($_POST['category_id']);
            
            $id = Product::createProduct($options);
            if($id){
                if (is_uploaded_file($_FILES["image"]["tmp_name"])){
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/images/{$id}_trial.jpg");
                    $src = $_SERVER['DOCUMENT_ROOT']."/images/{$id}_trial.jpg";
                    Image::resizeImage($id, $src);
                }
            }
            header("Location: /admin/item/{$_POST['category_id']}");
        }
        require_once ROOT.'/views/admin_items/create.php';
        return true;
    }
    public function actionUpdate($id){
        $categoriesList = array();
        $categoriesList = Category::getAdminCategoriesList();
        $sellersList = array();
        $sellersList = Category::getSellersList();
        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['measure'] = $_POST['measure'];
            $options['seller_id'] = $_POST['seller_id'];
            $options['convert_t'] = $_POST['convert_t'];
            $options['status'] = $_POST['status'];
            
            if (Product::updateProductById($id, $options)) {
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/images/{$id}_trial.jpg");
                    $src = $_SERVER['DOCUMENT_ROOT']."/images/{$id}_trial.jpg";
                    Image::resizeImage($id, $src);
                } 
                header("Location: /admin/item/{$_POST['category_id']}");
            }
        }
        require_once ROOT.'/views/admin_items/update.php';
        return true;
    }
}