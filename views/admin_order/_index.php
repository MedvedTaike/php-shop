<?php include (ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">          
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление заказами</li>
                </ol>
            </div>
            <h4>Список заказов</h4>
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
                    <th></th>
                    <th></th>
                </tr>
                <?php $i = 1; $total_buy = 0; $total_sell = 0; ?>
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['date_off']; ?></td>
                        <td><?php echo $order['total_buy']; ?></td>
                        <td><?php echo $order['total_sell']; ?></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>    
                        <td><a href="/admin/order/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/order/update/<?php echo $order['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/order/delete/<?php echo $order['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        <?php $total_buy += $order['total_buy']; $total_sell += $order['total_sell']; ?>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="3">Общая сумма :</td>
                        <td><?php echo $total_buy; ?></td>
                        <td><?php echo $total_sell; ?></td>
                        <td colspan="4"></td>
                    </tr>
            </table>
            <a href="/admin/print/view" class="btn btn-default back"> Накладные</a>
            <a href="/admin/print/seller" class="btn btn-default back"> Накл. поставщик</a>
            <a href="/admin/print/driver" class="btn btn-default back"> Накл. водитель</a>
<!--            <a href="/admin/print/sort" class="btn btn-default back"> Сорт.</a>-->
            <a href="/admin/print/deliver" class="btn btn-default back"> Дата отправки</a>
            <a href="/admin/print/clear" class="btn btn-default back"> Обновить заказы</a>
            <a href="/nazira" class="btn btn-default back"> Назира эже</a>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>

