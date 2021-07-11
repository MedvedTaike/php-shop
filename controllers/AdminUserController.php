<?php

class AdminUserController{
    public function actionIndex(){
        $usersList = User::getUsersList();
        require_once(ROOT.'/views/admin_user/index.php');
        return true;
    }
    public function actionCreate(){
        $regionList = array();
        $regionList = Region::getRegionList();
        if(isset($_POST['submit'])) {
            $options['magazin_name'] = $_POST['magazin_name'];
            $options['address'] = $_POST['address'];
            $options['weekday'] = $_POST['weekday'];
            $options['region_id'] = $_POST['region_id'];
            $options['phone'] = $_POST['phone'];
            $options['name'] = $_POST['name'];
            $options['password'] = $_POST['password'];
            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                User::createUser($options);
                header("Location: /admin/user");
            }
        }
        require_once(ROOT.'/views/admin_user/create.php');
        return true;
    }
    public function actionUpdate($id){
        $regionList = array();
        $regionList = Region::getRegionList();
        $userUpdate = array();
        $userUpdate = User::getUserById($id);
        if(isset($_POST['submit'])){
            $options['magazin_name'] = $_POST['magazin_name'];
            $options['address'] = $_POST['address'];
            $options['weekday'] = $_POST['weekday'];
            $options['region_id'] = $_POST['region_id'];
            $options['phone'] = $_POST['phone'];
            $options['name'] = $_POST['name'];
            $options['status'] = $_POST['status'];
            $options['password'] = $_POST['password'];
            if(User::updateUserById($id, $options)){
                header("Location: /admin/user");
            }
        }
        require_once(ROOT.'/views/admin_user/update.php');
        return true;
    }
    public function actionLogin($id){
        User::auth($id);        
        if(isset($_SESSION['klients'])){
            unset($_SESSION['klients'][$id]);
        }
        header("Location:/cart");
    }
    public function actionKlient($id){
        $ordersList = array();
        $ordersList = Order::getKlientOrders($id);
        require_once(ROOT.'/views/admin_user/klient.php');
        return true;
    }
    public function actionDelete($id){
        if(isset($_SESSION['klients'])){
            unset($_SESSION['klients'][$id]);
        }
        header("Location:/cart");
        return true;
    }
}