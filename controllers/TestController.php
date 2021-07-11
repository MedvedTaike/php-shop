<?php

//class TestController{
//    public function actionAjax(){
//        $total = 0;
//        if($_POST['id']){
//            if(!isset($_SESSION['cart'])){
//                $_SESSION['cart'][$_POST['id']] = $_POST['count'];
//                $_SESSION['total'][$_POST['id']] = $_POST['total'];
//            } else {
//                $_SESSION['cart'][$_POST['id']] = $_POST['count'];
//                $_SESSION['total'][$_POST['id']] = $_POST['total'];
//            }
//            foreach($_SESSION['total'] as $id => $count){
//                $total += $count;
//            }
//        }
//        echo $total;
//    }
//    public function actionDelete($id){
//        if(array_key_exists($id, $_SESSION['cart'])){
//            unset($_SESSION['cart'][$id]);
//            unset($_SESSION['total'][$id]);
//        }
//        header("Location:/cart/second/");
//    }
//}

class TestController{
    
}