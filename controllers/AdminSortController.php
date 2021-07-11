<?php

class AdminSortController{
    public function actionList($id){
        $item = Item::getItems($id);
        require_once(ROOT.'/views/admin_sort/list.php');
        return true;
    }
    public function actionAjax(){
        $db = Db::getConnection();
        $array = array();
        if(isset($_POST['item'])){
            $array = $_POST['item'];
            $order = 1;
            foreach($array as $item ){
                $sql = "UPDATE product SET sort_order = $order WHERE id = $item ";
                $result = $db->prepare($sql);
                $result->execute();
                $order++;
            }
        }
    }
    public function actionPhoto($id){
        $item = Item::getItems($id);
        require_once(ROOT.'/views/admin_sort/photo.php');
        return true;
    }
}