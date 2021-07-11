<?php

class Order{
    public static function save($userId,$total_sell,$total_buy, $products){
            
        $db = Db::getConnection();
        $sql = 'INSERT INTO product_order (user_id,total_sell,total_buy, products) '
                . 'VALUES (:user_id,:total_sell,:total_buy, :products)';

        $products = json_encode($products);
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':total_sell', $total_sell, PDO::PARAM_INT);
        $result->bindParam(':total_buy', $total_buy, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }
    public static function getKlientOrders($id){
        $db = Db::getConnection();
        $sql = "SELECT user.magazin_name AS name, DATE(product_order.date_on) AS order_date, product_order.total_buy AS summ_buy,product_order.id AS id, product_order.total_sell AS summ_sell "
            . "FROM product_order, user "
            . "WHERE user.id = :id AND product_order.user_id = :id "
            . "ORDER BY product_order.date_on ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['order_date'] = $row['order_date'];
            $list[$i]['summ_buy'] = $row['summ_buy'];
            $list[$i]['summ_sell'] = $row['summ_sell'];
            $i++;
        }
        return $list;
    }
    public static function getOrdersList(){
        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS name, pr.date_on AS date,pr.date_off AS date_off, pr.total_buy AS total_buy, pr.total_sell AS total_sell, pr.id AS id, pr.status AS status "
            . "FROM user AS us , product_order AS pr "
            . "WHERE us.id = pr.user_id AND pr.status ='0' AND pr.party_id = '0' ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['date'] = $row['date'];
            $list[$i]['date_off'] = $row['date_off'];
            $list[$i]['total_buy'] = $row['total_buy'];
            $list[$i]['total_sell'] = $row['total_sell'];
            $list[$i]['status'] = $row['status'];
            $i++;
        }
        return $list;
    }
    public static function getPrintOrders($id){
        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS magazin, us.name AS name, us.address AS address, us.phone AS phone, pr.id AS id,pr.date_on AS date, pr.date_off AS date_off "
            . "FROM user AS us , product_order AS pr "
            . "WHERE us.id = pr.user_id AND pr.status ='0' AND pr.party_id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['magazin'] = $row['magazin'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['address'] = $row['address'];
            $list[$i]['phone'] = $row['phone'];
            $list[$i]['date'] = $row['date'];
            $list[$i]['date_off'] = $row['date_off'];
            $i++;
        }
        return $list;
    }
    public static function getOrderedProducts($id){
        $db = Db::getConnection();
        $sql = "SELECT products FROM product_order WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_INT);
        $result->execute();
        $products = $result->fetch();
        return $products;
    }
    public static function getStatusText($status){
        switch ($status) {
            case '0': return 'Актив.'; break;
            case '1': return 'Неактив.'; break;
        }
    }
    public static function getOrderById($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT pr.id AS id, us.magazin_name AS name, us.phone AS phone, pr.status AS status, pr.products AS products ,pr.date_on AS date, pr.party_id AS party "
            . "FROM user AS us, product_order AS pr "
            . "WHERE pr.id = :id AND us.id = pr.user_id ";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }
    public static function updateOrderById($id, $products, $total_buy, $total_sell, $status){
        $db = Db::getConnection();
        $products = json_encode($products);
        $sql = 'UPDATE product_order SET 
                 products = :products,
                 total_buy = :total_buy,
                 total_sell = :total_sell,
                 status = :status
                 WHERE id = :id ';
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_INT);
        $result->bindParam(':products',$products, PDO::PARAM_STR);
        $result->bindParam(':total_buy',$total_buy, PDO::PARAM_INT);
        $result->bindParam(':total_sell',$total_sell, PDO::PARAM_INT);
        $result->bindParam(':status',$status, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function deleteOrderById($id){
        $db = Db::getConnection();
        $sql = 'DELETE FROM product_order WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getAllOrderedProducts($status = 0){
        $orderedProductsList = array();
        $db = Db::getConnection();
        $sql = 'SELECT id , products FROM product_order WHERE status ='.$status ;
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $result->fetch()){
            $orderedProductsList[$row['id']] = json_decode($row['products'],true);
        }
        return $orderedProductsList;
    }
    public static function getOrdersListDriver($id){
        $list = array();
        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS point, us.address AS address, us.phone AS phone, us.name AS name, pr.total_sell AS total "
            .  "FROM user AS us, product_order AS pr "
            .  "WHERE  pr.user_id = us.id AND pr.status ='0' AND pr.party_id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['point'] = $row['point'];
            $list[$i]['address'] = $row['address'];
            $list[$i]['phone'] = $row['phone'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['total'] = $row['total'];
            $i++;
        }
        return $list;
    }
    public static function updateOrders($id){
        $db = Db::getConnection();
        $sql = 'UPDATE product_order , party SET
               product_order.status = "1" ,
               party.status = "1"
               WHERE product_order.party_id = :id
               AND party.id = :id ';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function updateDateOff($id){
        $db = Db::getConnection();
        $sql = "UPDATE product_order SET date_off = CURRENT_DATE WHERE status = '0' AND party_id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getDateOff(){
        $db = Db::getConnection();
        $sql = "SELECT date_off FROM product_order WHERE status = '0' LIMIT 1 ";
        $result = $db->query($sql);
        $result->execute();
        $date = $result->fetch();
        return $date[0];
        
    }
    public static function getOrdersByDate($year,$month,$day){

        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS name, pr.date_on AS date,pr.date_off AS date_off, pr.total_buy AS total_buy, pr.total_sell AS total_sell, pr.id AS id, pr.status AS status "
            . "FROM user AS us , product_order AS pr "
            . "WHERE YEAR(pr.date_on) = :year AND MONTH(pr.date_on) = :month AND DAY(pr.date_on) = :day AND pr.user_id = us.id ";
        $result = $db->prepare($sql);
        $result->bindParam(':year', $year, PDO::PARAM_INT);
        $result->bindParam(':month', $month, PDO::PARAM_INT);
        $result->bindParam(':day', $day, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['date'] = $row['date'];
            $list[$i]['date_off'] = $row['date_off'];
            $list[$i]['total_buy'] = $row['total_buy'];
            $list[$i]['total_sell'] = $row['total_sell'];
            $list[$i]['status'] = $row['status'];
            $i++;
        }
        return $list;
    }
    public static function checkUserOrder($id){
        $db = Db::getConnection();
        $sql = "SELECT id FROM product_order WHERE user_id = :id AND status = '0' ";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();
        $final = $result->fetch();
        if($final['id']){
            return false;
        }return true;
    }
    public static function createParty($out)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO party(order_id) VALUES(:order_id) ";
        $result = $db->prepare($sql);
        $result->bindParam(':order_id',$out, PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }
    public static function getActiveParty()
    {
        $db = Db::getConnection();
        $sql = "SELECT id,order_id, date FROM party WHERE status = '0' ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $party = array();
        $i = 1;
        while($row = $result->fetch())
        {
            $party[$i]['id'] = $row['id'];
            $party[$i]['orders'] = explode(',',json_decode($row['order_id']));
            $party[$i]['date'] = $row['date'];
            $i++;
        }
        return $party;
    }   
    public static function getCurrentMonthParty()
    {
        $db = Db::getConnection();
        $sql = "SELECT id,order_id, date FROM party ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $party = array();
        $i = 1;
        while($row = $result->fetch())
        {
            $party[$i]['id'] = $row['id'];
            $party[$i]['orders'] = explode(',',json_decode($row['order_id']));
            $party[$i]['date'] = $row['date'];
            $i++;
        }
        return $party;
    }
    public static function getPartyOrders($id){
        $db = Db::getConnection();
        $sql = "SELECT us.magazin_name AS name, pr.date_on AS date,pr.date_off AS date_off, pr.total_buy AS total_buy, pr.total_sell AS total_sell, pr.id AS id, pr.status AS status "
            . "FROM user AS us , product_order AS pr "
            . "WHERE us.id = pr.user_id AND pr.status ='0' AND pr.party_id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $list = array();
        $i = 0;
        while($row = $result->fetch()){
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['date'] = $row['date'];
            $list[$i]['date_off'] = $row['date_off'];
            $list[$i]['total_buy'] = $row['total_buy'];
            $list[$i]['total_sell'] = $row['total_sell'];
            $list[$i]['status'] = $row['status'];
            $i++;
        }
        return $list;
    }
    public static function getProducts($id)
    {
        $products = array();
        $db = Db::getConnection();
        $sql = "SELECT products FROM product_order WHERE status = '0' AND party_id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = $result->fetchAll();
        return $products;
    }
    public static function getPartyItems($id)
    { 
        $products = array();
        $db = Db::getConnection();
        $sql = "SELECT order_id FROM party WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $products = $result->fetch();
        $products = explode(',',json_decode($products['order_id']));
        return $products; 
    }
    public static function updateParty($items, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE party SET order_id = :order_id WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':order_id', $items, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function updateOrderPartyId($id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE product_order SET party_id = '0' WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function updateOrderPartyIds($partyId,$ids)
    {
        $db = Db::getConnection();
        $sql = "UPDATE product_order SET party_id = :id WHERE id IN($ids) ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $partyId, PDO::PARAM_INT);
        return $result->execute();

    }
    public static function updateOrderItem($id, $update,$buy, $sell,$status)
    {
        $db = Db::getConnection();
        $sql = "UPDATE product_order SET 
                products = :products ,
                total_buy = :buy,
                total_sell = :sell,
                status = :status
                WHERE id = :id " ;
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':buy', $buy, PDO::PARAM_INT);
        $result->bindParam(':sell', $sell, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':products', $update, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function processProducts($id)
    {
        $product = self::getProducts($id);
         $products = array();
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
        return $final;
    }
    public static function getAjaxOutput($id, $seller)
    {
        $product = self::processProducts($id);
        $out  = '';
        $out .= '<h4 id="'.$id.'">Партия №'.$id.'</h4>';
        $out .= '<table class="table-bordered table-striped table">';
        $out .= '<tr>
                    <th width="2%">№</th>
                    <th>Наименование</th>
                    <th width="10%">Количество</th>
                    <th width="10%">Цена</th>
                    <th width="10%">Сумма</th>
                    <th width="10%"></th>
                    <th width="10%"></th>
                </tr>';
        $i = 1;
        foreach($product as $item)
        {
            if($item['seller_id'] == $seller)
            {
                $out .= '<tr>
                            <td class="center">'.$i.'</td>
                            <td class="left">'.Product::getSellerText($item['name']).'</td>
                            <td id="quantity">'.$item['convert_t'] * $item['count'].'</td>
                            <td><input type="text" size="3" id="price_buy" data-id="'.$item['id'].'" value="" /></td>
                            <td id="summ"></td>
                            <td><input type="checkbox" class="add_party" value="'.$item['id'].'" /></td>
                            <td><input type="button" class="btn btn-danger delete_item" id="'.$item['id'].'" value="Удалить"></td>
                        </tr>';
                $i++;
            } else {
                
            }  
        }
        $out .=  '<tr>
                    <td colspan="4" class="right">Общая сумма за товары</td>
                    <td id="total"></td>
                    <td></td>
                    <td></td>
                </tr>';
        $out .= '</table>';
        $out .= '<input type="button" class="btn btn-success save_items" id="'.$seller.'" value="Сохранить">';
        return $out;
    }
    public static function getConvert($item)
    {
        if($item['convert_t'] >1 ) 
        {
            return $item['name'].'(<span id="'.$item['id'].'" class="convert">'.$item['price_sell'] * $item['convert_t'].' сом</span>)';
        }
        return $item['name'];
    }
    public static function changeSeller($seller,$id)
    {
        $db = Db::getConnection();
        $sql = '';
        if($seller == 12)
        {
            $sql = "UPDATE product SET seller_id = '2' WHERE id = :id ";
        } else 
        {
            $sql = "UPDATE product SET seller_id = '1' WHERE id = :id ";
        }
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function changePrice($id, $price)
    {
        $db = Db::getConnection();
        $sql = "UPDATE product SET price_buy = :price WHERE id = :id ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':price', $price, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function insertPostav($seller_id, $party_id, $items)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO postav(seller_id, party_id, items) VALUES(:seller_id, :party_id, :items) ";
        $result = $db->prepare($sql);
        $result->bindParam(':seller_id',$seller_id, PDO::PARAM_INT);
        $result->bindParam(':party_id',$party_id, PDO::PARAM_INT);
        $result->bindParam(':items',$items, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function checkParty($party_id, $seller_id)
    {
        $db = Db::getConnection();
        $sql = "SELECT id FROM postav WHERE seller_id = :seller_id AND party_id = :party_id ";
        $result = $db->prepare($sql);
        $result->bindParam(':seller_id', $seller_id, PDO::PARAM_INT);
        $result->bindParam(':party_id', $party_id, PDO::PARAM_INT);
        $result->execute();
        $test = $result->fetch();
        if($test)
        {
            return true;
        } 
        return false;
    }
    public static function getPostavItem($party_id, $seller_id)
    {
        $db = Db::getConnection();
        $sql = "SELECT items FROM postav WHERE seller_id = :seller_id AND party_id = :party_id ";
        $result = $db->prepare($sql);
        $result->bindParam(':seller_id', $seller_id, PDO::PARAM_INT);
        $result->bindParam(':party_id', $party_id, PDO::PARAM_INT);
        $result->execute();
        $test = $result->fetch();
        $json = json_decode($test['items'],true);
        return $json;
    }
    public static function getUploadItem($party_id, $seller_id)
    {
        $products = self::getPostavItem($party_id, $seller_id);
        $out  = '';
        $out .= '<h4>Партия №'.$party_id.'</h4>';
        $out .= '<table class="table-bordered table-striped table">';
        $out .= '<tr>
                    <th width="2%">№</th>
                    <th>Наименование</th>
                    <th width="15%">Количество</th>
                    <th width="15%">Цена</th>
                    <th width="15%">Сумма</th>
                </tr>';
        $i = 1;
        $total = 0;
        foreach($products as $key => $value)
        {
            $final = Product::getProductById($key);
            $out .= '<tr>
                       <td> '.$i.'</td>
                       <td> '.Product::getSellerText($final['name']).'</td>
                       <td> '.$value['quant'].'</td>
                       <td> '.$value['price'].' сом </td>
                       <td> '.$summ = ($value['quant'] * $value['price']).' сом</td>
                    </tr>';
            $i++;
            $total += $summ ; 
        }
        $out .= '<tr>
                   <td colspan="4"class="right">Общая сумма за товары</td>
                   <td> '.$total.' сом</td>
                </tr>
                </table>';
            
        return $out;
    }
    
}