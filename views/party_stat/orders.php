<?php include (ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">          
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/party/stat">Статистика заказов</a></li>
                    <li class="active">Просмотр заказов партии № <?php echo $id; ?></li>
                </ol>
            </div>
            <h4>Список заказов партии №<span id="party"><?php echo $id; ?></span></h4>
            <table class="table-bordered  table-striped table">
                <tr>
                    <th>№</th>
                    <th width="45%">Магазин</th>
                    <th>Дата заказа</th>
                    <th>Дата отправки</th>
                    <th>Buy</th>
                    <th>Sell</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
                <?php $i = 1; $total_buy = 0; $total_sell = 0; ?>
                <?php foreach ($parts as $order): ?>
                    <tr>
                        <td><?=  $i; $i++; ?></td>
                        <td><?=  $order['name']; ?></td>
                        <td><?=  $order['date']; ?></td>
                        <td><?=  $order['date_off']; ?></td>
                        <td class="right"><?=  number_format($order['total_buy'], 2 ,'.', ' '); ?></td>
                        <td class="right"><?=  number_format($order['total_sell'], 2 ,'.', ' '); ?></td>
                        <td><?=  Order::getStatusText($order['status']); ?></td>    
                        <td><a href="/admin/order/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <?php $total_buy += $order['total_buy']; $total_sell += $order['total_sell']; ?>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="3">Общая сумма :</td>
                        <td class="right"><?= number_format($total_buy,2,'.',' '); ?></td>
                        <td class="right"><?= number_format($total_sell,2,'.',' '); ?></td>
                        <td colspan="4"></td>
                    </tr>
            </table>
        </div>
    </div>
</section>
<br><br>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>
