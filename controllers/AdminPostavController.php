<?php 

class AdminPostavController{
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
                header("Location: /postav/view/$sellerId");
            }
        }
        require ROOT.'/views/admin_postav/index.php';
        return true;
    }
    public function actionView($id)
    {
        $party = Order::getActiveParty();
        $postav = Seller::getSellerById($id);
        require ROOT.'/views/admin_postav/view.php';
        return true;
    }
    public function actionAjax()
    {    
        if($_POST['id'])
        { 
            $product = Order::getAjaxOutput($_POST['id'],$_POST['seller']);
            echo $product;
        }
    }
    public function actionReview()
    {
        $sellers = Category::getSellersList();
        require ROOT.'/views/admin_postav/review.php';
        return true;
    }
    public function actionChange()
    {
        if($_POST['id'])
        {
            Order::changeSeller($_POST['seller'],$_POST['id']);
            return true;
        }
        return false;
    }
    public function actionPrice()
    {
        if($_POST['id'])
        {
            Order::changePrice($_POST['id'],$_POST['price']);
            return true;
        }
        return false;
    }
    public function actionSave()
    { 
        if(!empty($_POST['items']))
        {
            $items = json_encode($_POST['items']);
            Order::insertPostav($_POST['seller_id'],$_POST['party_id'], $items);
            return true;
        } 
    }
    public function actionUpload()
    {
        if($_POST['id'])
        {
            $product = Order::getUploadItem($_POST['id'], $_POST['seller']);
            print_r($product);
        }
    }
    public function actionLogout()
    {
        if(Seller::sellerLogout())
        {
            header("Location:/postav");
        }
        
    }
}