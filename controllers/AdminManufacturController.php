<?php

class AdminManufacturController{
    public function actionIndex(){
        $manList = array();
        $manList = Brand::getBrandList();
        require_once(ROOT.'/views/admin_manufactur/index.php');
        return true;
    }
    public function actionCreate(){
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $errors = false;
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }
            if ($errors == false) {
                Brand::createBrand($name, $sortOrder, $status);
                header("Location: /admin/manufactur");
            }
        }
        require_once(ROOT.'/views/admin_manufactur/create.php');
        return true;
    }
    public function actionUpdate($id){
        $brand = Brand::getBrandById($id);
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            Brand::updateBrandById($id, $name, $sortOrder, $status);
            header("Location: /admin/manufactur");
        }
        require_once(ROOT.'/views/admin_manufactur/update.php');
        return true;
    }
    public function actionDelete($id){
        if (isset($_POST['submit'])) {
            Brand::deleteBrandById($id);
            header("Location: /admin/manufactur");
        }
        require_once(ROOT . '/views/admin_manufactur/delete.php');
        return true;
    }
}