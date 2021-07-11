<?php

class AdminPartyController{
    public function actionView($id){
        $ordersList = Order::getPartyOrders($id);
        require_once(ROOT.'/views/admin_order/party_view.php');
        return true;
    }
}