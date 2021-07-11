<?php

class Brand{
    public static function getBrandList(){
        $db = Db::getConnection();
        $sql = "SELECT * FROM manufactur WHERE 1 ORDER BY sort_order ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['name'] = $row['name'];
            $array[$i]['status'] = $row['status'];
            $array[$i]['sort_order'] = $row['sort_order'];
            $i++;
        }
        return $array;
    }
    public static function createBrand($name,$sortOrder,$status){
        $db = Db::getConnection();
        $sql = "INSERT INTO manufactur(name, status, sort_order) VALUES(:name, :status, :sort_order)";
        $result = $db->prepare($sql);
        $result->bindParam(':name',$name, PDO::PARAM_STR);
        $result->bindParam(':status',$status, PDO::PARAM_INT);
        $result->bindParam(':sort_order',$sortOrder, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getBrandById($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM manufactur WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public static function updateBrandById($id,$name,$sortOrder,$status){
        $db = Db::getConnection();
        $sql = "UPDATE manufactur SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
                WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function deleteBrandById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM manufactur WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getAdminBrandList(){
        $db = Db::getConnection();
        $sql = "SELECT * FROM manufactur WHERE status = '1' ORDER BY sort_order ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['name'] = $row['name'];
            $array[$i]['status'] = $row['status'];
            $i++;
        }
        return $array;
    }
}