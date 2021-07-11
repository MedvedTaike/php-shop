<?php
class AdminOrderController{
    public $updateId ;
    public function actionIndex(){
        $ordersList = Order::getOrdersList();
        $party = Order::getActiveParty();
        require_once(ROOT.'/views/admin_order/index.php');
        return true;
    }
    public function actionView($id){
        $order = Order::getOrderById($id);
        $products = json_decode($order['products'],true);
        require_once(ROOT.'/views/admin_order/view.php');
        return true;
    }
    public function actionUpdate($id){
        $_SESSION['id'] = $id;
        $order = Order::getOrderById($id);
        if(!isset($_SESSION['update']))
        {
            $_SESSION['update'] = json_decode($order['products'],true);
        }
        $products = $_SESSION['update'];
        $items = Product::getProductInArray(array_keys($products));
        $buy = 0;
        $sell = 0;
        if(isset($_POST['submit']))
        {
            foreach($_SESSION['update'] as $id => $count)
            {
                if($items[$id]['convert_t'] > 1)
                {
                    $buy += ($items[$id]['price_buy'] * $count) * $items[$id]['convert_t'];
                    $sell += ($items[$id]['price_sell'] * $count) * $items[$id]['convert_t'];
                }
                else 
                {
                    $buy += $items[$id]['price_buy'] * $count;
                    $sell += $items[$id]['price_sell'] * $count;
                }
                
            }
            $update = json_encode($_SESSION['update']);
            $status = 0;
            if(isset($_POST['status']))
            {
                $status = $_POST['status'];
            } 
            $result = Order::updateOrderItem($_SESSION['id'], $update,$buy,$sell,$status);
            
            if($result)
            {
                unset($_SESSION['update']);
                unset($_SESSION['id']);
                header("Location:/admin/order");
            }
        }
        require_once(ROOT.'/views/admin_order/update.php');
        return true;
    }
    public function actionDelete($id){
        if (isset($_POST['submit'])) {
            Order::deleteOrderById($id);
            header("Location: /admin/order");
        }
        require_once(ROOT.'/views/admin_order/delete.php');
        return true;
    }
    public function actionAjax(){
        if($_POST['id'])
        {
            $out = json_encode(implode(',',$_POST['id']));
            $id = Order::createParty($out);
            if($id)
            {
                $ids = implode(',',$_POST['id']);
                $db = Db::getConnection();
                $sql = "UPDATE product_order SET party_id = $id WHERE id IN($ids) ";
                $result = $db->query($sql);
                if($result->execute())
                {
                    return true;
                }
                return false;
            }
        }
    }
    public function actionParty(){
        $party = Order::getActiveParty();
        require_once(ROOT.'/views/admin_order/party.php');
        return true;
    }
    public function actionAdd(){
        if($_POST['id'])
        {
 
            $items = Order::getPartyItems($_POST['party_id']);
            $add = implode(',',$items);
            $idPost = implode(',',$_POST['id']);
            $ids = '"'.$idPost.','.$add.'"';
            Order::updateParty($ids,$_POST['party_id']);
            Order::updateOrderPartyIds($_POST['party_id'],$idPost);
        }
    }
    public function actionChange(){
        if($_POST['id'])
        {
            $_SESSION['update'][$_POST['id']] = $_POST['quant'];
        }
    }
    public function actionAddition(){
        $id = $_SESSION['id'];
        if(isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $key => $value)
            {
                $_SESSION['update'][$key] = $value;
            }
            Cart::clear();
        }
        header("Location:/admin/order/update/$id");
    }
    public function actionRemove(){
        if($_POST['id'])
        {
            unset($_SESSION['update'][$_POST['id']]);
        }
    }
}