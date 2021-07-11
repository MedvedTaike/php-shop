<?php

class Party{
    
    public static function getAllParty()
    {
        $db = Db::getConnection();
        $sql = "SELECT id,order_id, date FROM party ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $party = array();
        $i = 1;
        while($row = $result->fetch())
        {
            $party[$i]['id'] = $row['id'];
            $party[$i]['orders'] = explode(',',json_decode($row['order_id']));
            $party[$i]['date'] = $row['date'];
            $i++;
        }
        return $party;
    }  
    public static function getTotalBuy($ids)
    {
        $db = Db::getConnection();
        $sql = "SELECT SUM(total_buy) AS buy FROM product_order WHERE id IN($ids) ";
        $result = $db->query($sql);
        $result->execute();
        $return = $result->fetch();
        return $return['buy'] ;
    }
    public static function getTotalSell($ids)
    {
        $db = Db::getConnection();
        $sql = "SELECT SUM(total_sell) AS sell FROM product_order WHERE id IN($ids) ";
        $result = $db->query($sql);
        $result->execute();
        $return = $result->fetch();
        return $return['sell'] ;
    }
    public static function getPartyOrders($id){
        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS name, pr.date_on AS date,pr.date_off AS date_off, pr.total_buy AS total_buy, pr.total_sell AS total_sell, pr.id AS id, pr.status AS status "
            . "FROM user AS us , product_order AS pr "
            . "WHERE us.id = pr.user_id AND pr.party_id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['date'] = $row['date'];
            $list[$i]['date_off'] = $row['date_off'];
            $list[$i]['total_buy'] = $row['total_buy'];
            $list[$i]['total_sell'] = $row['total_sell'];
            $list[$i]['status'] = $row['status'];
            $i++;
        }
        return $list;
    }
}