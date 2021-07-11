<?php 
class AdminPrintController{
    public function actionView($id){
        $ordersList = Order::getPrintOrders($id);
        require(ROOT.'/views/admin_print/view.php');
        return true;
    }
    public function actionSeller($id){
        $products = array();
        $product = Order::getProducts($id);
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
        $final = Product::getProductsByIds(array_keys($products));
        foreach($final as $id )
        {
            $final[$id['id']]['count'] = $products[$id['id']];
        }
        $sellers = Category::getSellersList();
        
        require_once(ROOT.'/views/admin_print/seller.php');
        return true;
    }
    public function actionDriver($id){
        $ordersList = Order::getOrdersListDriver($id);
        require_once(ROOT.'/views/admin_print/driver.php');
        return true;
    }
    public function actionClear($id){
        if(isset($_POST['submit'])){
            Order::updateOrders($id);
            header("Location:/admin/order/party");
        }
        require_once(ROOT.'/views/admin_print/clear.php');
        return true;
    }
    public function actionDeliver($id){
        $result = Order::updateDateOff($id);
        if($result){
            header("Location: /admin/party/view/$id");
        }
        return true;
    }
    public function actionSort(){
        $ordersList = Order::getPrintOrders();
        require(ROOT.'/views/admin_print/sort.php');
        return true;
    }
    public function actionAjax()
    {
        if($_POST['id'])
        {
            $items = Order::getPartyItems($_POST['party']);
            foreach($items as $key => $value)
            {
                if($value === $_POST['id'])
                {
                    unset($items[$key]);
                    break;
                } 
            }
            $output = json_encode(implode($items,','));
            Order::updateParty($output,$_POST['party']);
            if(Order::updateOrderPartyId($_POST['id']))
            {
                return true;
            }
            return false;
        }
    }
}