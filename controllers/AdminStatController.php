<?php

class AdminStatController{
    public function actionIndex(){
        $usersStatList = array();
        $usersStatList = Stat::getUsersStatList();
        require_once(ROOT.'/views/admin_stat/index.php');
        return true;
    }
    public function actionSingle($id){
        $orders = array();
        $orders = Stat::getOrdersForView($id);
        require_once(ROOT.'/views/admin_stat/single.php');
        return true;
    }
    public function actionIncome(){
        $income = array();
        $income = Stat::getIncomesList();
        require_once(ROOT.'/views/admin_stat/income.php');
        return true;
    }
    public function actionItems(){
        $productsStat = array();
        $productsStat = Stat::getProductsStat();
        $products = '';
        foreach($productsStat as $idOrder){
            foreach($idOrder as $id => $quantity){
                if(empty($products)){
                    $products[$id] = $quantity;
                } else {
                    if(array_key_exists($id,$products)){
                        $products[$id] += $quantity;
                    } else {
                        $products[$id] = $quantity;
                    }
                }
            }
        }
        arsort($products);
        require_once(ROOT.'/views/admin_stat/items.php');
        return true;
    }
    public static function actionTime($date){
        var_dump($date);
        $segments = explode('-',$date);
        $year = array_shift($segments);
        $month = array_shift($segments);
        $day = array_shift($segments);
        $ordersList = array();
        $ordersList = Order::getOrdersByDate($year,$month,$day);
        require(ROOT.'/views/admin_stat/order_by_date.php');
        return true;
    }
}