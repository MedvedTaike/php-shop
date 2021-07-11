<?php

class User{
    public static function checkName($name){
        if(strlen($name) >= 2){
            return true;
        } return false;
    }
    public static function checkPhone($phone)
    {
        if (strlen($phone) == 10) {
            return true;
        }
        return false;
    }
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    public static function checkPhoneExists($phone_1)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM user WHERE phone = :phone ';
        $result = $db->prepare($sql);
        $result->bindParam(':phone', $phone_1, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }
    public static function register($name,$address, $magazin_name, $phone_1, $password){
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (name, address, magazin_name, phone, password) '
                . 'VALUES (:name, :address, :magazin_name, :phone, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->bindParam(':magazin_name', $magazin_name, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone_1, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function checkUserData($phone_1, $password){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user WHERE phone = :phone AND password = :password';
        $result = $db->prepare($sql);
        $result->bindParam(':phone', $phone_1, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();
        $user = $result->fetch();
        if ($user){
            return $user['id'];
        }return false; 
    }
    public static function auth($id){
        if(!isset($_SESSION['user'])){
            $_SESSION['user'] = $id;
        }
    }
    public static function isGuest(){
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
    public static function checkLogged(){
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }
    public static function logout(){
        unset($_SESSION['user']);
        header("Location:/category/1");
    }
    public static function getUsersList(){
        $db = Db::getConnection();
        $sql = "SELECT us.id AS id, us.name AS name, us.magazin_name AS magazin, us.address AS address, us.phone AS phone, reg.name AS region "
            . "FROM user AS us, region AS reg "
            . "WHERE us.role='user' AND reg.id = us.region_id ORDER BY us.region_id,us.magazin_name ";
        $result = $db->query($sql);
        $usersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $usersList[$i]['id'] = $row['id'];
            $usersList[$i]['name'] = $row['name'];
            $usersList[$i]['magazin'] = $row['magazin'];
            $usersList[$i]['address'] = $row['address'];
            $usersList[$i]['region'] = $row['region'];
            $usersList[$i]['phone'] = $row['phone'];
            $i++;
        }
        return $usersList;
    }
    public static function getStatusText($text){
        switch($text){
            case '1': return 'Отображается' ; break;
            case '0': return 'Скрыт' ; break;
        }
    }
    public static function createUser($options){
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (magazin_name, address,weekday, region_id, phone, name, password) '
                . 'VALUES (:magazin_name, :address, :weekday, :region_id, :phone, :name, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':magazin_name', $options['magazin_name'], PDO::PARAM_STR);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
        $result->bindParam(':weekday', $options['weekday'], PDO::PARAM_INT);
        $result->bindParam(':region_id', $options['region_id'], PDO::PARAM_INT);
        $result->bindParam(':phone', $options['phone'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':password', $options['password'], PDO::PARAM_STR);
        return $result->execute();
    }
    public static function getUserById($id){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }
    public static function updateUserById($id,$options){
        $db = Db::getConnection();
        $sql = 'UPDATE user SET 
            magazin_name=:magazin_name,
            address = :address,
            weekday = :weekday,
            region_id = :region_id,
            phone = :phone,
            name = :name,
            password = :password,
            status = :status '
            . 'WHERE id = :id ';
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_STR);
        $result->bindParam(':magazin_name', $options['magazin_name'], PDO::PARAM_STR);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
        $result->bindParam(':weekday', $options['weekday'], PDO::PARAM_INT);
        $result->bindParam(':region_id', $options['region_id'], PDO::PARAM_INT);
        $result->bindParam(':phone', $options['phone'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':password', $options['password'], PDO::PARAM_STR);
        return $result->execute(); 
    }
    public static function adminPasswordCheck($password){
        if(strlen($password) === 10){
            return true;
        }return false;
    }
    public static function checkAdminData($phone, $password){
        $db = Db::getConnection();
        $sql = 'SELECT address FROM user WHERE phone = :phone AND password = :password ';
        $result = $db->prepare($sql);
        $result->bindParam(':phone', $phone, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $admin = $result->fetch();
        if($admin){
            return $admin['address'];
        }return false;
    }
    public static function adminAuth($id){
        if(!isset($_SESSION['admin'])){
            $_SESSION['admin'] = $id;
        }
    }
    public static function isAdmin(){
        if(isset($_SESSION['admin'])){
            return true;
        }return false;
    }
    public static function logoutAdmin(){
        unset($_SESSION['admin']);
        unset($_SESSION['region']);
        unset($_SESSION['klients']);
        header("Location:/");
    }
    public static function getDayText($day){
        switch($day){
            case '1': return 'Понедельник' ; break;
            case '2': return 'Вторник' ; break;
            case '3': return 'Среда' ; break;
            case '4': return 'Четверг' ; break;
            case '5': return 'Пятница' ; break;
            case '6': return 'Суббота' ; break;
            case '7': return 'Воскресенье' ; break;
        }
    }
    public static function getUsersByDay($day){
        $db = Db::getConnection();
        $sql = 'SELECT id,magazin_name,name,phone,address,call_status FROM user WHERE weekday = :day AND role="user" ';
        $result = $db->prepare($sql);
        $result->bindparam(':day',$day,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $usersByDay = array();
        $i = 0;
        while($row = $result->fetch()){
            $usersByDay[$i]['id'] = $row['id'];
            $usersByDay[$i]['name'] = $row['name'];
            $usersByDay[$i]['magazin_name'] = $row['magazin_name'];
            $usersByDay[$i]['phone'] = $row['phone'];
            $usersByDay[$i]['call_status'] = $row['call_status'];
            $usersByDay[$i]['address'] = $row['address'];
            $i++;
        }
        return $usersByDay;
    }
    public static function updateCallStatus($id,$call_status){
        $db = Db::getConnection();
        $sql = "UPDATE user SET call_status = :call_status WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':call_status',$call_status,PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getCallStatusText($text){
        switch($text){
            case '0': return 'Позвонить'; break;
            case '1': return 'Заказал'; break;
            case '2': return 'Не заказал'; break;
            case '3': return 'Не ответил'; break;
        }
    }
    public static function getUserName(){
        $id = self::checkLogged();
        $db = Db::getConnection();
        $sql = 'SELECT magazin_name FROM user WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $name = $result->fetch();
        return $name['magazin_name'];
    }
    public static function getUserByRegion($id){
        $db = Db::getConnection();
        $sql = "SELECT id,name,magazin_name,phone,address FROM user WHERE region_id = :id ORDER BY magazin_name ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $array = array();
        while($row = $result->fetch()){
            $array[$row['id']]['id'] = $row['id'];
            $array[$row['id']]['name'] = $row['name'];
            $array[$row['id']]['phone'] = $row['phone'];
            $array[$row['id']]['address'] = $row['address'];
            $array[$row['id']]['magazin_name'] = $row['magazin_name'];
        }
        return $array;
    }
}