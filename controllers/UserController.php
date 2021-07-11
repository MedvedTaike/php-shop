<?php 
class UserController{
    public function actionRegister(){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $productsList = array();
        $result = false;
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $address = $_POST['address'];
            $magazin_name = $_POST['magazin_name'];
            $phone_1 = $_POST['phone'];
            $password = $_POST['password'];
            $errors = false;
            if(!User::checkName($name)){
                $errors[] = 'Неправильное имя';
            }
            if(!User::checkPhone($phone_1)){
                $errors[] = 'Неправильный телефон';
            }
            if(!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if(User::checkPhoneExists($phone_1)) {
                $errors[] = 'Такой телефон уже используется';
            }
            if($errors == false){
                $result = User::register($name,$address, $magazin_name, $phone_1, $password);
            }
        }
        require_once(ROOT.'/views/user/register.php');
        return true;
    }
    public function actionLogin(){
        $catList = array();
        $catList = Category::getCategoryList();
        $manList = array();
        $manList = Category::getManufacturList();
        $productsList = array();
        if (isset($_POST['submit'])) {
            $phone_1 = $_POST['phone'];
            $password = $_POST['password'];
            $errors = false;
            if (!User::checkPhone($phone_1)) {
                $errors[] = 'Неправильный телефон';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            $userId = User::checkUserData($phone_1, $password);

            if ($userId == false) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                header("Location:/");
            }
        }
        require_once(ROOT.'/views/user/login.php');
        return true;
    }
    public function actionLogout(){
        unset($_SESSION["user"]);
        header("Location:/admin/");
    }
}