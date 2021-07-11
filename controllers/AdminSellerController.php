<?php 
class AdminSellerController{
    public function actionIndex(){
        $sellersList = array();
        $sellersList = Category::getSellersList();
        require_once(ROOT.'/views/admin_seller/index.php');
        return true;
    }
    public function actionUpdate($id){
        $seller = array();
        $seller = Category::getSellerById($id);
        $name = '';
        $address = '';
        $phone_1 = '';
        $status = '';
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone_1 = $_POST['phone'];
            $status = $_POST['status'];
            $result = Category::updateSellerById($id,$name,$address,$phone_1,$status);
            if($result){
               header("Location:/admin/seller");
            }
        }
        require_once(ROOT.'/views/admin_seller/update.php');                                             
        return true;
    }
    public function actionCreate(){
        $name = '';
        $address = '';
        $phone_1 = '';
        $status = '';
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone_1 = $_POST['phone'];
            $status = $_POST['status'];
            $errors = false;
            $result = Category::saveSeller($name, $address, $phone_1, $status);
            if($result){
              header("Location:/admin/seller");
            }
        }
        require_once(ROOT.'/views/admin_seller/create.php');
        return true;
    }
    public function actionDelete($id){
        if(isset($_POST['submit'])){
            Category::deleteSellerById($id);
            header("Location:/admin/seller");
        }
        require_once(ROOT.'/views/admin_seller/delete.php');
        return true;
    }
    
}