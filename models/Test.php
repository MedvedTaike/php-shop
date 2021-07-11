<?php

//class Test{
//    
//    public static function getQuantity($id){
//        $number = 0;
//        if(isset($_SESSION['cart'])){
//            if(array_key_exists($id, $_SESSION['cart'])){
//                $number = $_SESSION['cart'][$id];
//            }
//        }
//        return $number;
//    } 
//    public static function getTotal(){
//        $total = 0;
//        if(isset($_SESSION['total'])){
//            foreach($_SESSION['total'] as $id => $count){
//                $total += $count;
//            }
//        }
//        return $total;
//    }
//    public static function getProducts(){
//        if(isset($_SESSION['cart'])){
//            return $_SESSION['cart'];
//        }
//    }
//    public static function getProductsInCart($ids){
//        $db = Db::getConnection();
//        $idsString = implode(',', $ids);
//        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString) ORDER BY category_id,name";
//        $result = $db->query($sql);
//        $result->setFetchMode(PDO::FETCH_ASSOC);
//        $i = 0;
//        $products = [];
//        while($row = $result->fetch()) {
//            $products[$i]['id'] = $row['id'];
//            $products[$i]['name'] = $row['name'];
//            $products[$i]['measure'] = $row['measure'];
//            $products[$i]['price_sell'] = $row['price_sell'];
//            $i++;
//        }
//        return $products;
//    }
//}

//class Test{
////    public static function getProducts(){
////        $orderedProductsList = array();
////        $db = Db::getConnection();
////        $sql = 'SELECT id , products FROM product_order WHERE status = "0" ' ;
////        $result = $db->query($sql);
////        $result->setFetchMode(PDO::FETCH_ASSOC);
////        while($row = $result->fetch()){
////            $orderedProductsList[$row['id']] = json_decode($row['products'],true);
////        }
////        return $orderedProductsList;   
////    }
//    public static function getProducts()
//    {
//        $products = [];
//        $db = Db::getConnection();
//        $sql = "SELECT products FROM product_order WHERE status = '0' ";
//        $result = $db->query($sql);
//        $result->setFetchMode(PDO::FETCH_ASSOC);
//        $products = $result->fetchAll();
//        return $products;
//    }
//    public static function getProductsByIds($arr)
//    {
//        $idsString = implode(',', $arr);
//        $db = Db::getConnection();
//        $sql = "SELECT id,name FROM product WHERE id IN($idsString) ORDER BY category_id,name ";
//        $result = $db->query($sql);
//        $result->setFetchMode(PDO::FETCH_ASSOC);
//        $products = array();
//        while($row = $result->fetch()){
//            $products[$row['id']]['id'] = $row['id'];
//            $products[$row['id']]['name'] = $row['name'];
//            $products[$row['id']]['count'] = 0;
//        }
//        return $products;
//    }
//    public static function getString($num)
//    {
//        $massiv = require(ROOT.'/views/admin_test/massiv.php');
//        $out = '';
//        $length = strlen($num);
//        switch($length)
//        {
//            case '1': return $out = $massiv[$length][$num];
//                break;
//            case '2': if(is_array($massiv[$length][substr($num,0,1)]))
//            {
//                $out = $massiv[2][1][substr($num,1,1)];
//            }
//                else
//                {
//                    $out .= $massiv[$length][substr($num,0,1)];
//                    $out .= ' '.$massiv[1][substr($num,1,1)];
//                }
//                return $out;
//                break;
//            case '3': 
//        }
//        return $out;
//    }
//}
class Test{
    public static $massiv = [];
    public static $length = '';
    
    public static function getString($num){
        self::$massiv = require(ROOT.'/views/admin_test/massiv.php');
        self::$length = strlen($num);
        switch(self::$length)
        {
            case '1': return self::edinica($num);
                break;
            case '2': return self::switchTen($num);
                break;
            case '3': return self::hundred($num);
                break;
            case '4': return self::thousend($num);
                break;            
            case '5': return self::tenThousend($num);
                break;
            case '6': return self::hunThousend($num);
                break;
            case '7': return self::million($num);
                break;
        }
    }
    public static function edinica($num)
    {
        $out = '';
        return $out = self::$massiv[1][$num];
    }
    public static function switchTen($num)
    {
        if(is_array(self::$massiv[2][substr($num,0,1)]))
        {
            return self::tenArr($num);
        }
        else
        {
            return self::ten($num);
        }
    }
    public static function tenArr($num)
    {  
        $out = '';
        return $out = self::$massiv[2][1][substr($num,1,1)];
    }
    public static function ten($num)
    {
        $out = '';
        $out .= self::$massiv[2][substr($num,0,1)];
        $out .= self::edinica(substr($num,1,1));
        return $out;
    }
    public static function hundred($num)
    {
        $out = '';
        $out .= self::$massiv[3][substr($num,0,1)];
        $out .= self::switchTen(substr($num,1,2));
        return $out;
    }
    public static function thousend($num)
    { 
        $out = '';
        $out .= self::$massiv[4][substr($num,0,1)];
        $out .= self::hundred(substr($num,1,3));
        return $out;
    }    
    public static function tenThousend($num)
    {
        $out = '';
        if(substr($num,0,1)== 1)
        {
            $out = self::$massiv[2][1][substr($num,1,1)].' тысяч ';
            $out .= self::hundred(substr($num, 2,3));
            return $out;
        }
        else 
        {
            $out = self::$massiv[2][substr($num,0,1)];
            $out .= self::thousend(substr($num, 1, 4));
            return $out;
        }
    }
    public static function hunThousend($num)
    {
        $out = '';
        $out = self::$massiv[3][substr($num,0,1)];
        $out .= self::tenThousend(substr($num, 1, 5));
        return $out;
    }
    public static function million($num)
    {
        $out = '';
        if(substr($num, 1,5) == 00000 )
        {
            $out = self::$massiv[5][substr($num,0,1)];
            $out .= self::edinica(substr($num, 6, 1));
        }
        elseif(substr($num, 1,4) == 0000)
        {
            $out = self::$massiv[5][substr($num,0,1)];
            $out .= self::switchTen(substr($num, 5, 2));
        }
        elseif(substr($num, 1,3) == 000)
        {
            $out = self::$massiv[5][substr($num,0,1)];
            $out .= self::hundred(substr($num, 4, 3));
        }
        elseif(substr($num, 1,2) == 00)
        {
            $out = self::$massiv[5][substr($num,0,1)];
            $out .= self::thousend(substr($num, 3, 4));
        }
        elseif(substr($num, 1,1) == 0)
        {
            $out = self::$massiv[5][substr($num,0,1)];
            $out .= self::tenThousend(substr($num, 2, 5));
        }
        else
        {
            $out = self::$massiv[5][substr($num,0,1)];
            $out .= self::hunThousend(substr($num, 1, 6));
        }
        return $out;
    }
}