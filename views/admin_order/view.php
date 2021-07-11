<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <?php if($order['party'] != 0): ?>
                    <li><a href="/admin/party/view/<?= $order['party']; ?>"> Партия №<?php echo $order['party']; ?></a></li>
                    <?php endif; ?>
                    <li class="active">Просмотр заказа</li>
                </ol>
            </div>
            <h4>Просмотр заказа №<?php echo $order['id']; ?></h4>
            <h5>Информация о заказе</h5>
            <table class="table-admin-small table-bordered table-striped table">
                <tr>
                    <td>Номер заказа</td>
                    <td><?php echo $order['id']; ?></td>
                </tr>
                <tr>
                    <td>Магазин</td>
                    <td><?php echo $order['name']; ?></td>
                </tr>
                <tr>
                    <td>Телефон клиента</td>
                    <td><?php echo $order['phone']; ?></td>
                </tr>
                <tr>
                    <td><b>Статус заказа</b></td>
                    <td><?php echo Order::getStatusText($order['status']); ?></td>
                </tr>
                <tr>
                    <td><b>Дата заказа</b></td>
                    <td><?php echo $order['date']; ?></td>
                </tr>
            </table>

            <h5>Товары в заказе</h5>

            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>№</th>
                    <th>Имя товара</th>
                    <th>Ед. изм.</th>
                    <th>Цена за ед.</th>
                    <th>Количество</th>
                    <th>Итог</th>
                </tr>
                <?php $i = 1; $summa = 0; ?>
                <?php foreach ($products as $id =>$quantity): ?>
                <?php $product = Product::getProductById($id); ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo Product::getMeasureText($product['measure']); ?></td>
                        <td><?php echo $product['price_sell'] * $product['convert_t']; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $itog = ($quantity * $product['price_sell']) * $product['convert_t']; ?></td>
                        <?php $summa += $itog; ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td colspan="4">Общая сумма</td>
                    <td><?php echo $summa ;?></td>
                </tr>
            </table>
        </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

