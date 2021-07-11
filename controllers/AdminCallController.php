<?php 
class AdminCallController{
    public function actionIndex(){
        require_once(ROOT.'/views/admin_call/index.php');
        return true;
    }
    public function actionDay($day){
        $usersByDay = array();
        $usersByDay = User::getUsersByDay($day);
        require_once(ROOT.'/views/admin_call/calling.php');
        return true;
    }
    public function actionSingle($id){
        $orders = array();
        $orders = Stat::getOrdersForView($id);
        $user = array();
        $user = User::getUserById($id);
        if(isset($_POST['submit'])){
            $callStatus = $_POST['call_status'];
            User::updateCallStatus($id,$callStatus);
        }
        require_once(ROOT.'/views/admin_call/single.php');
        return true;
    }
}