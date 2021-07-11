<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Статистика по товарам</li>
                </ol>
            </div>
            <h4>Список товаров по покупаемости</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th width="2%">№</th>
                    <th>Наименование</th>
                    <th width="12%">Количество</th>
                    <th width="12%">Buy</th>
                    <th width="12%">Sell</th>
                    <th width="12%">Разница</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($products as $id => $quantity): ?>
                <?php $product = Product::getProductById($id) ; ?>
                    <tr>
                        <td><?php echo $i;$i++; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $buy = ($product['price_buy'] * $quantity); ?></td>
                        <td><?php echo $sell = ($product['price_sell'] * $quantity); ?></td>
                        <td><?php echo $diff = $sell - $buy; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

