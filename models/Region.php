<?php 
class Region{
    public static function getRegionList(){
        $db = Db::getConnection();
        $sql = "SELECT * FROM region ORDER BY id ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 1;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['name'] = $row['name'];
            $array[$i]['desc'] = $row['description'];
            $i++;
        }
        return $array;
    }
    public static function checkRegion(){
        if(isset($_SESSION['region'])){
            return $_SESSION['region'];
        }
    }
    public static function checkActiveKlients(){
        if(isset($_SESSION['klients'])){
            return true;
        }return false;
    }
    public static function getNumber(){
        $db = Db::getConnection();
        $sql = "SELECT COUNT(id) AS number, region_id FROM user WHERE 1 GROUP BY region_id ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $number = array();
        while($row = $result->fetch()){
            $number[$row['region_id']] = $row['number'];
        }
        return $number;
    }
    public static function createRegion($name, $desc){
        $db = Db::getConnection();
        $sql = 'INSERT INTO region (name, description) VALUES (:name, :desc) ';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':desc', $desc, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function getRegionById($id){
        $db = Db::getConnection();
        $sql = "SELECT * FROM region WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public static function updateRegionById($id, $name, $desc){
        $db = Db::getConnection();
        $sql = "UPDATE region SET 
                name = :name,  
                description = :desc
                WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':desc', $desc, PDO::PARAM_STR);
        return $result->execute();
    }
}