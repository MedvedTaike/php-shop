<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/stat/user">Статистика магазины</a></li>
                    <li class="active">Заказы магазина</li>
                </ol>
            </div>
            <h4>Все заказы магазина: <?php echo $orders['0']['name']; ?></h4>

            <br/>

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

