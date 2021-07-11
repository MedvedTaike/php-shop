<?php

class AdminNaziraController{
    public function actionIndex(){
        $phone = '';
        $password = '';
        $errors = false;
        if(isset($_POST['submit'])){
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            if(!User::checkPhone($phone)){
                $errors[] = 'Неправильные данные';
            }
            if(!Seller::sellerPasswordCheck($password)){
                $errors[] = 'Неправильные данные';
            }
            $sellerId = Seller::checkSellerData($phone,$password);
            if($sellerId == false){
                $errors[] = 'Неправильные данные для входа';
            } else {
                Seller::sellerAuth($sellerId);
                header("Location: /postav/nazira/view");
            }
        }
        require(ROOT.'/views/admin_nazira/index.php');
        return true;
    }
    public function actionView(){
        $orderProduct = array();
        $orderProduct = Order::getAllOrderedProducts();
        $sellerProduct = array();
        foreach($orderProduct as $idOrder){
            foreach($idOrder as $id => $quantity){
                if(empty($sellerProduct)){
                    $sellerProduct[$id] = $quantity;
                } else {
                    if(array_key_exists($id, $sellerProduct)){
                        $sellerProduct[$id] += $quantity;
                    } else {
                        $sellerProduct[$id] = $quantity;
                    }
                }
            
            }
        }
        $productsArray = array_keys($sellerProduct);
        $products = Product::getProductInArray($productsArray);
        foreach($sellerProduct as $id => $count){
            if(array_key_exists($id,$products)){
                $products[$id]['count'] = $count;
            }
        }
        require(ROOT.'/views/admin_nazira/view.php');
        return true;
    }
    public function actionAjax(){
        if($_POST['id']){
            $id = $_POST['id'];
            $price = $_POST['price'];
            $db = Db::getConnection();
            $sql = "UPDATE product SET price_buy = :buy WHERE id =:id ";
            $result = $db->prepare($sql);
            $result->bindParam(':buy', $price , PDO::PARAM_INT);
            $result->bindParam(':id', $id , PDO::PARAM_INT);
            return $result->execute();
        }
        
    }
    public function actionChange(){
        if($_POST['id']){
            $id = $_POST['id'];
            $db = Db::getConnection();
            $sql = "UPDATE product SET seller_id = '1' WHERE id = :id ";
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id , PDO::PARAM_INT);
            return $result->execute();
        }
    }
    public function actionLogout(){
        Seller::sellerLogout();
        return true;
    }
}