<?php 
class AdminProductController{
    public function actionIndex(){
        $categoriesList = array();
        $categoriesList = Category::getAdminCategoriesList();
        $productsList = array();
        $productsList = Product::getProductsList();
        require_once(ROOT.'/views/admin_product/index.php');
        return true;
    }
    public function actionCreate(){
        $categoriesList = array();
        $categoriesList = Category::getAdminCategoriesList();
        $manufacturList = array();
        $manufacturList = Brand::getAdminBrandList();
        $sellersList = array();
        $sellersList = Category::getSellersList();
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['price_buy'] = $_POST['price_buy'];
            $options['price_sell'] = $_POST['price_sell'];
            $options['measure'] = $_POST['measure'];
            $options['id_manufactur'] = $_POST['id_manufactur'];
            $options['seller_id'] = $_POST['seller_id'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['convert_t'] = $_POST['convert_t'];
            $options['status'] = $_POST['status'];
            
            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = Product::createProduct($options);
                header("Location: /admin/product");
            }
        }
        require_once(ROOT.'/views/admin_product/create.php');
        return true;
    }
    public function actionUpdate($id){
        $categoriesList = array();
        $categoriesList = Category::getAdminCategoriesList();
        $sellersList = array();
        $sellersList = Category::getSellersList();
        $manufacturList = array();
        $manufacturList = Brand::getAdminBrandList();
        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['price_buy'] = $_POST['price_buy'];
            $options['price_sell'] = $_POST['price_sell'];
            $options['measure'] = $_POST['measure'];
            $options['id_manufactur'] = $_POST['id_manufactur'];
            $options['seller_id'] = $_POST['seller_id'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['convert_t'] = $_POST['convert_t'];
            $options['status'] = $_POST['status'];
            
            if (Product::updateProductById($id, $options)) {
                header("Location: /admin/product");
            }
        }
        
        require_once(ROOT.'/views/admin_product/update.php');
        return true;
    }
    public function actionDelete($id){
        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);
            header("Location: /admin/product");
        }

        require_once(ROOT .'/views/admin_product/delete.php');
        return true;
    }
}