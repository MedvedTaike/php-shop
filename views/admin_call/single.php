<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/weekday/<?php echo $orders['0']['day']; ?>">Управление звонками</a></li>
                    <li class="active">Заказы магазина</li>
                </ol>
            </div>
            <h4>Все заказы магазина: <?php echo $orders['0']['name']; ?></h4>
            <br/>
            <p>Имя клиента : <?php echo $user['name']; ?></p>
            <p>Телефоны : <b><?php echo $user['phone']; ?></b></p>
            <form action="#" method="post">
                <p>Действия</p>
                  <select name="call_status" style="max-width:30%">
                      <option value="0" <?php if ($user['call_status'] == 0) echo ' selected="selected"'; ?>>Позвонить</option>
                      <option value="1" <?php if ($user['call_status'] == 1) echo ' selected="selected"'; ?>>Заказал</option>
                      <option value="2" <?php if ($user['call_status'] == 2) echo ' selected="selected"'; ?>>Не заказал</option>
                      <option value="3" <?php if ($user['call_status'] == 3) echo ' selected="selected"'; ?>>Не ответил</option>
                  </select>
                <br>
                <br>
                <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                <br>
                <br>
            </form>
            <table class="table-bordered table-striped table">
                <?php foreach($orders as $order): ?>
                <tr>
                    <td colspan="6"><?php echo $order['date']; ?></td>
                </tr>
                <tr>
                    <th width="2%">№</th>
                    <th>Наименование</th>
                    <th width="15%">Количество</th>
                    <th width="15%">Buy</th>
                    <th width="10%">Sell</th>
                    <th width="10%">Итог</th>
                </tr>
                <?php $i = 1; $summa = 0; ?>
                <?php $products = json_decode($order['products'],true); ?>
                <?php foreach($products as $id => $quantity): ?>
                <?php $product = Product::getProductById($id); ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $product['price_buy']; ?></td>
                        <td><?php echo $product['price_sell']; ?></td>
                        <td><?php echo $itog = $product['price_sell'] * $quantity; ?></td>
                        <?php $summa += $itog; ?>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="4">Общий итог :</td>
                        <td><?php echo $summa; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

