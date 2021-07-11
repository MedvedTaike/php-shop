<?php

class CategoryController{
    public function actionIndex($id_cat){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $categoryProduct = array();
        $categoryProduct = Product::getProductsByCategory($id_cat);
        require_once(ROOT.'/views/category/index.php');
        return true;
    }
    public function actionManufactur($id_man){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $manProduct = array();
        $manProduct = Product::getProductsByManufactur($id_man);
        require_once(ROOT.'/views/category/manufactur.php');
        return true;
    }
    public function actionManList($id_man){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $manProduct = array();
        $manProduct = Product::getProductsByManufactur($id_man);
        require_once(ROOT.'/views/category/man-list.php');
        return true;
    }
    public function actionCatList($id_cat){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $catProduct = array();
        $catProduct = Product::getProductsByCategory($id_cat);
        require_once(ROOT.'/views/category/cat-list.php');
        return true;
    }
    
}