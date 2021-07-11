<?php

class Product{
    public static function getMainProducts(){
        $db = Db::getConnection();
        $sql = "SELECT id FROM product WHERE status = '1' AND category_id IN(SELECT id FROM category WHERE status = '1') ";
        $result = $db->query($sql);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i] = $row['id'];
            $i++;
        }
        return $array;
    }
    public static function getRandomProducts(){
        $array = self::getMainProducts();
        shuffle($array);
        $arr = array();
        for($i = 1; $i <= 12; $i++){
            $arr[$i] = $array[$i];
        }
        $idString = implode(',',$arr);
        $db = Db::getConnection();
        $sql = "SELECT id,name,price_sell FROM product WHERE id IN($idString) ORDER BY sort_order ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = array();
        $i = 0;
        while($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price_sell'] = $row['price_sell'];
            $i++;
        }
        return $products;
        
    }
    public static function getProductsByCategory($id){
        $db = Db::getConnection();
        $sql = $sql = "SELECT id,price_sell,name,convert_t FROM product WHERE category_id = :category_id AND status = '1' ORDER BY sort_order";
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $id,PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['price_sell'] = $row['price_sell'];
            $array[$i]['name'] = $row['name'];
            $array[$i]['convert'] = $row['convert_t'];
            $i++;
        }
        return $array;
    }
    public static function getProductsByManufactur($id){
        $db = Db::getConnection();
        $sql = $sql = "SELECT id,price_sell,name FROM product WHERE id_manufactur = :id AND status = '1' ORDER BY sort_order";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id,PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        $i = 0;
        while($row = $result->fetch()){
            $array[$i]['id'] = $row['id'];
            $array[$i]['price_sell'] = $row['price_sell'];
            $array[$i]['name'] = $row['name'];
            $i++;
        }
        return $array;
    }
    public static function getProductById($id){
            $db = Db::getConnection();
            $sql = 'SELECT * FROM product WHERE id = :id ';
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
    }
    public static function getMeasureText($measure){
          switch($measure){
            case '0': return false;break;
            case '1': return 'Шт.';break;
            case '2': return 'Блок.';break;
            case '3': return 'Упаков.';break;
            case '4': return 'Короб.';break;
            case '5': return 'Рулон';break;
            case '6': return 'Кассета';break;
        }
    }
    public static function getPricesById($id){
        $db = Db::getConnection();
        $sql = "SELECT price_sell,price_buy FROM product WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    public static function getProductsList(){
        $products = array();
        $db = Db::getConnection();
        $sql = 'SELECT product.*, seller.name AS seller_name,manufactur.name AS brand FROM product, seller, manufactur WHERE product.seller_id = seller.id AND product.id_manufactur = manufactur.id ORDER BY product.sort_order ';
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        while($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['seller_name'] = $row['seller_name'];
            $products[$i]['price_buy'] = $row['price_buy'];
            $products[$i]['price_sell'] = $row['price_sell'];
            $products[$i]['measure'] = $row['measure'];
            $products[$i]['brand'] = $row['brand'];
            $products[$i]['sort_order'] = $row['sort_order'];
            $products[$i]['status'] = $row['status'];
            $products[$i]['convert_t'] = $row['convert_t'];
            $i++;
        }
        return $products;
    }
    public static function getConvertText($text){
        if($text != 1)
        {
            return $text.'/1';
        }
        return '';
    }
    public static function createProduct($options){
        $db = Db::getConnection();

        $sql = 'INSERT INTO product '
                . '(name, category_id, price_buy,price_sell, measure, seller_id, sort_order,convert_t, status )'
                . 'VALUES '
                . '(:name, :category_id, :price_buy, :price_sell, :measure, :seller_id, :sort_order,:convert_t, :status )';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':price_buy', $options['price_buy'], PDO::PARAM_INT);
        $result->bindParam(':price_sell', $options['price_sell'], PDO::PARAM_INT);
        $result->bindParam(':seller_id', $options['seller_id'], PDO::PARAM_INT);
        $result->bindParam(':measure', $options['measure'], PDO::PARAM_INT);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':convert_t', $options['convert_t'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    public static function updateProductById($id ,$options){
        $db = Db::getConnection();
        $sql = "UPDATE product SET 
                name = :name, 
                category_id = :category_id, 
                seller_id = :seller_id,
                measure = :measure,
                convert_t = :convert_t,
                status = :status
            WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':seller_id', $options['seller_id'], PDO::PARAM_INT);
        $result->bindParam(':measure', $options['measure'], PDO::PARAM_INT);
        $result->bindParam(':convert_t', $options['convert_t'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
    public static function deleteProductById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM product WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getSellerText($text){
        $output = '';
        if(stristr($text,'/')){
            $output = stristr($text,'/',true);
        } else{
            $output = $text;
        }
        return $output;
    }
    public static function getProductInArray($array){
        $idsString = implode(',', $array);
        $db = Db::getConnection();
        $sql = "SELECT id,name,sort_order,seller_id,convert_t,price_buy,price_sell FROM product WHERE id IN($idsString) ORDER BY category_id,name ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = array();
        while($row = $result->fetch()){
            $products[$row['id']]['id'] = $row['id'];
            $products[$row['id']]['name'] = $row['name'];
            $products[$row['id']]['sort_order'] = $row['sort_order'];
            $products[$row['id']]['seller_id'] = $row['seller_id'];
            $products[$row['id']]['convert_t'] = $row['convert_t'];
            $products[$row['id']]['price_buy'] = $row['price_buy'];
            $products[$row['id']]['price_sell'] = $row['price_sell'];
        }
        return $products;
    }
    public static function getProductsByIds($arr)
    {
        $idsString = implode(',', $arr);
        $db = Db::getConnection();
        $sql = "SELECT id,name,seller_id,convert_t,price_sell,price_buy FROM product WHERE id IN($idsString) ORDER BY category_id,name ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $products = array();
        while($row = $result->fetch()){
            $products[$row['id']]['id'] = $row['id'];
            $products[$row['id']]['seller_id'] = $row['seller_id'];
            $products[$row['id']]['name'] = $row['name'];
            $products[$row['id']]['convert_t'] = $row['convert_t'];
            $products[$row['id']]['price_buy'] = $row['price_buy'];
            $products[$row['id']]['price_sell'] = $row['price_sell'];
            $products[$row['id']]['count'] = 0;
        }
        return $products;
    }
}