<?php

class Item{
    public static function getItems($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM product WHERE category_id = :id ORDER BY sort_order";
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll();
    }
    public static function getItemCategoryList(){
        $db = Db::getConnection();
        $sql = "SELECT * FROM category ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $catList = array();
        while($row = $result->fetch()){
            $catList[$row['id']]['id'] = $row['id'];
            $catList[$row['id']]['name'] = $row['name'];
        }
        return $catList;
    }
    public static function updatePrice($id, $number, $identifier){
        $db = Db::getConnection();
        $sql = "UPDATE product SET $id = :number WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$identifier, PDO::PARAM_INT);
        $result->bindParam(':number',$number, PDO::PARAM_INT);
        $result->execute();
        return $number;
    }
    public static function getOrderNumber($id){
        $db = Db::getConnection();
        $sql = "SELECT COUNT(sort_order) AS number FROM product WHERE category_id = $id ";
        $result = $db->query($sql);
        $result->execute();
        $number = $result->fetch();
        return $number['number'];
    } 
}