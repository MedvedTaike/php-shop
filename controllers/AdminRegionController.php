<?php

class AdminRegionController{
    public function actionIndex(){
        $number = Region::getNumber();
        $regList = Region::getRegionList();
        require_once(ROOT.'/views/admin_region/index.php');
        return true;
    }
    public function actionCreate(){
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            Region::createRegion($name, $desc);
            header("Location: /admin/region");
        }
        require_once(ROOT.'/views/admin_region/create.php');
        return true;
    }
    public function actionUpdate($id){
        $region = Region::getRegionById($id);
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $desc = $_POST['desc'];
            Region::updateRegionById($id, $name, $desc);
            header("Location: /admin/region");
        }
        require_once(ROOT.'/views/admin_region/update.php');
        return true;
    }
}