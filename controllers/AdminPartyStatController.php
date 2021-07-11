<?php

class AdminPartyStatController{
    
    public function actionIndex()
    {
        $parts = Party::getAllParty();
        require_once(ROOT.'/views/party_stat/index.php');
        return true;
    }
    public function actionOrders($id)
    {
        $parts = Party::getPartyOrders($id);
        require_once(ROOT.'/views/party_stat/orders.php');
        return true;
    }
}