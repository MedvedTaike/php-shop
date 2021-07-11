<?php 
class CartController{
    public function actionIndex(){
        if(isset($_SESSION['klients'])){
            $userList = $_SESSION['klients'];
        } 
        $catList = Category::getCategoryList();
        $cart = Cart::getProducts();
        if($cart){
            $ids = array_keys($cart);
            $products = Cart::getProductsInCart($ids);
        }
        require_once ROOT.'/views/cart/index.php';
        return true;
    }
    public function actionAjax(){
        $total = 0;
        if($_POST['id']){
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'][$_POST['id']] = $_POST['count'];
                $_SESSION['total'][$_POST['id']] = $_POST['total'];
            } else {
                $_SESSION['cart'][$_POST['id']] = $_POST['count'];
                $_SESSION['total'][$_POST['id']] = $_POST['total'];
            }
            foreach($_SESSION['total'] as $id => $count){
                $total += $count;
            }
        }
        echo $total;
    }
    public function actionDelete($id){
        if(array_key_exists($id, $_SESSION['cart'])){
            unset($_SESSION['cart'][$id]);
            unset($_SESSION['total'][$id]);
            if(empty($_SESSION['cart'])){
                unset($_SESSION['cart']);
                unset($_SESSION['total']);
            }
        }
        header("Location:/cart/");
    }
    public function actionCheckout(){
        $catList = Category::getCategoryList();
        $productsInCart = $_SESSION['cart'];
        $total_sell = 0;
        $total_buy = 0;
        $cart = Cart::getProducts();
        if($cart){
            $ids = array_keys($cart);
            $products = Cart::getProductsInCart($ids);
        }
        foreach($products as $product){
            if($product['convert'] > 1)
            {
                $total_sell += ($product['price_sell'] * $product['convert']) * $cart[$product['id']]; 
                $total_buy += ($product['price_buy'] * $product['convert']) * $cart[$product['id']];
            } else {
                $total_sell += ($product['price_sell'] * $cart[$product['id']]); 
                $total_buy += ($product['price_buy'] * $cart[$product['id']]); 
            }
            
        }

        if(!User::isGuest()){
            $userId = User::checkLogged();
        }
        $result = Order::save($userId,$total_sell,$total_buy, $productsInCart);
        if($result){
            Cart::clear();
            User::logout();
        }
        require_once(ROOT.'/views/cart/checkout.php');
        return true;
    }
}