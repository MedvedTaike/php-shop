<?php 

class Cart{
    public static function clear(){
        if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
        unset($_SESSION['total']);
        }
    }
    public static function getProductsInCart($ids){
        $db = Db::getConnection();
        $idsString = implode(',', $ids);
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString) ORDER BY category_id,name";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $i = 0;
        $products = array();
        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['measure'] = $row['measure'];
            $products[$i]['price_sell'] = $row['price_sell'];
            $products[$i]['price_buy'] = $row['price_buy'];
            $products[$i]['convert'] = $row['convert_t'];
            $i++;
        }
        return $products;
    }
    public static function getProducts(){
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart'];
        }
    }
    public static function getTotal(){
        $total = 0;
        if(isset($_SESSION['total'])){
            foreach($_SESSION['total'] as $id => $count){
                $total += $count;
            }
        }
        return $total;
    }
    public static function getQuantity($id){
        $number = 0;
        if(isset($_SESSION['cart'])){
            if(array_key_exists($id, $_SESSION['cart'])){
                $number = $_SESSION['cart'][$id];
            }
        }
        return $number;
    } 
}