<?php 

class AdminController{
    public function actionIndex(){
        $regionList = array();
        $regionList = Region::getRegionList();
        require_once(ROOT.'/views/admin/index.php');
        return true;
    }
    public function actionLogout(){
        User::logoutAdmin();
        return true;
    }
    public function actionRegion($id){
        if(!isset($_SESSION['region'])){
            $_SESSION['region'] = $id;
            $_SESSION['klients'] = User::getUserByRegion($id);
        } else{
            $_SESSION['region'] = $id;
            $_SESSION['klients'] = User::getUserByRegion($id);
        }
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
}