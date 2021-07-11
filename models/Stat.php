<?php

class Stat{
    public static function getUsersStatList(){
        $db = Db::getConnection();
        $sql = "SELECT SUM(floor(pr.total_sell)) AS sell, COUNT(pr.id) AS number, us.magazin_name AS name, us.address AS address, pr.user_id  AS id "
            . "FROM product_order AS pr, user AS us "
            . "WHERE pr.user_id = us.id GROUP BY pr.user_id "
            . "ORDER BY sell DESC ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['address'] = $row['address'];
            $list[$i]['number'] = $row['number'];
            $list[$i]['sell'] = $row['sell'];
            $i++;
        }
        return $list;
    }
    public static function getOrdersForView($id){
        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS name,DATE(pr.date_on) AS date,pr.products AS products, us.weekday AS day "
            . "FROM product_order AS pr, user AS us "
            . "WHERE pr.user_id = :id AND pr.user_id = us.id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['name'] = $row['name'];
            $list[$i]['date'] = $row['date'];
            $list[$i]['day'] = $row['day'];
            $list[$i]['products'] = $row['products'];
            $i++;
        }
        return $list;
        
    }
    public static function getIncomesList(){
        $db = Db::getConnection();
        $sql = "SELECT COUNT(id) AS number, SUM(floor(total_buy)) AS buy, SUM(floor(total_sell)) AS sell, DATE(date_on) AS date "
            . "FROM product_order GROUP BY date ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['number'] = $row['number'];
            $list[$i]['buy'] = $row['buy'];
            $list[$i]['sell'] = $row['sell'];
            $list[$i]['date'] = $row['date'];
            $i++;
        }
        return $list;
    }
    public static function getProductsStat(){
        $db = Db::getConnection();
        $sql = "SELECT id,products FROM product_order ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $items = array();
        while($row = $result->fetch()){
            $items[$row['id']] = json_decode($row['products'],true);
        }
        return $items;
    }
}