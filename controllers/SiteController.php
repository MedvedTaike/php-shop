<?php

class SiteController{
    public function actionIndex(){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $productsList = array();
        $productsList = Product::getRandomProducts();
        require_once(ROOT.'/views/site/index.php');
        return true;
    }
    public function actionEnter(){
        $phone = '';
        $password = '';
        $errors = false;
        if(isset($_POST['submit'])){
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            if(!User::checkPhone($phone)){
                $errors[] = 'Неправильные данные';
            }
            if(!User::adminPasswordCheck($password)){
                $errors[] = 'Неправильные данные';
            }
            $adminId = User::checkAdminData($phone,$password);
            if($adminId == false){
                $errors[] = 'Неправильные данные для входа';
            } else {
                User::adminAuth($adminId);
                header("Location: /admin/");
            }
        }
        require_once(ROOT.'/views/site/enter.php');
        return true;
    }
}