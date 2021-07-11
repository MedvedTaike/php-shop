<?php

class AdminTestController{
    public function actionIndex(){
        $option['sort_order'] = $this->getNumber();
        echo $option['sort_order'];
        require_once ROOT.'/views/admin_test/test.php';
        return true;
    }
    public function getNumber(){
        $db = Db::getConnection();
        $sql = "SELECT COUNT(sort_order) AS number FROM product WHERE category_id = 1 ";
        $result = $db->query($sql);
        $result->execute();
        $number = $result->fetch();
        $itog = ($number['number'] + 1);
        return $itog;
    }
    public function actionSeller(){
        $products = array();
        $product = Test::getProducts();
        foreach($product as $key => $value)
        {
            foreach(json_decode($value['products'], true) as $id => $count)
            {
                if(empty($products))
                {
                    $products[$id] = $count;
                } 
                else 
                {
                    if(array_key_exists($id, $products))
                    {
                        $products[$id] += $count;
                    } 
                    else 
                    {
                        $products[$id] = $count;
                    }
                }
            }
        }
        $final = Test::getProductsByIds(array_keys($products));
        foreach($final as $id )
        {
            $final[$id['id']]['count'] = $products[$id['id']];
        }
        require_once(ROOT.'/views/admin_test/seller.php');
        return true;
    }
    public static function actionNumber()
    {
        $number = 9952114;
        $result = Test::getString($number);
        echo $result;

        require_once(ROOT.'/views/admin_test/number.php');
        return true;
    }
}