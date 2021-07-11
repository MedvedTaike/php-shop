<?php

class Seller{
    public static function sellerPasswordCheck($password){
        if(strlen($password) <= 3 ){
            return true;
        } return false;
    }
    public static function checkSellerData($phone,$password){
        $db = Db::getConnection();
        $sql = 'SELECT id FROM seller WHERE phone = :phone AND pass = :password ';
        $result = $db->prepare($sql);
        $result->bindParam(':phone', $phone, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $admin = $result->fetch();
        if($admin['id']){
            return $admin['id'];
        }return false;
    }
    public static function sellerAuth($id){
        if(!isset($_SESSION['postav'])){
            $_SESSION['postav'] = $id;
        }
    }
    public static function isPostav(){
        if(isset($_SESSION['postav'])){
            return true;
        }return false;
    }
    public static function sellerLogout(){
        if(isset($_SESSION['postav']))
        {
            unset($_SESSION['postav']);
            return true;
        }
        return false;
    }
    public static function getSellerById($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM seller WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
}