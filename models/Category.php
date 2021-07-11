<?php

class Category{
    public static function getCategoryList(){
        $db = Db::getConnection();
        $sql = "SELECT id,name FROM category WHERE status = '1' ORDER BY sort_order ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['name'] = $row['name'];
            $i++;
        }
        return $array;
    }
    public static function getManufacturList(){
        $db = Db::getConnection();
        $sql = "SELECT id,name FROM manufactur WHERE status = '1' AND id > '1' ORDER BY sort_order ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['name'] = $row['name'];
            $i++;
        }
        return $array;
    }
    public static function getAdminCategoriesList(){
        $db = Db::getConnection();
        $sql = 'SELECT id,name,status,sort_order FROM category WHERE 1 ';
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $categoryList = array();
        $i = 0;
        while($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['status'] = $row['status'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $i++;
        }
        return $categoryList;
    }
    public static function getSellersList(){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM seller WHERE 1 ';
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $sellersList = array();
        $i = 0;
        while($row = $result->fetch()){
            $sellersList[$i]['id'] = $row['id'];
            $sellersList[$i]['name'] = $row['name'];
            $sellersList[$i]['address'] = $row['address'];
            $sellersList[$i]['phone'] = $row['phone'];
            $sellersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $sellersList;
    }
    public static function getStatusText($status){
        switch ($status) {
            case '1': return 'Отображается'; break;
            case '0': return 'Скрыта'; break;
        }
    }
    public static function createCategory($name, $sortOrder, $status){
        $db = Db::getConnection();
        $sql = 'INSERT INTO category (name, sort_order, status) '
         . 'VALUES (:name, :sort_order, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getCategoryById($id){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM category WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    public static function updateCategoryById($id, $name, $sortOrder, $status){
        $db = Db::getConnection();
        $sql = "UPDATE category SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
                WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function deleteCategoryById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM category WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function saveSeller($name, $address, $phone_1, $status){
        $db = Db::getConnection();
        $sql = 'INSERT INTO seller (name,address,phone,status) '
            . 'VALUES (:name, :address, :phone, :status )';
        $result = $db->prepare($sql);
        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':address',$address,PDO::PARAM_STR);
        $result->bindParam(':phone',$phone_1,PDO::PARAM_INT);
        $result->bindParam(':status',$status,PDO::PARAM_STR);
        return $result->execute();
    }
    public static function getSellerById($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM seller WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public static function updateSellerById($id, $name, $address, $phone_1, $status){
        $db = Db::getConnection();
        $sql = "UPDATE seller SET name=:name, address=:address, phone = :phone, status= :status "
            . "WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':name',$name,PDO::PARAM_STR);
        $result->bindParam(':address',$address,PDO::PARAM_STR);
        $result->bindParam(':phone',$phone_1,PDO::PARAM_INT);
        $result->bindParam(':status',$status,PDO::PARAM_STR);
        return $result->execute();
    }
    public static function deleteSellerById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM seller WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    
    }
}