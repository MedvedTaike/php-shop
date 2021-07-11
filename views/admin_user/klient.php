<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/user">Управление клиентами</a></li>
                    <li class="active">Просмотр заказов клиента</li>
                </ol>
            </div>
            <div class="col-sm-9">
                <table class="table-bordered  table-striped table">
                    <tr>
                        <th>№</th>
                        <th>Имя магазина</th>
                        <th>Дата заказов</th>
                        <th>Сумма покупки зак.</th>
                        <th>Сумма продажи зак.</th>
                        <th width="6%"></th>
                    </tr>
                    <?php $i = 1; $total_buy = 0 ; $total_sell = 0; ?>
                    <?php foreach($ordersList as $orders): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $orders['name']; ?></td>
                        <td><?php echo $orders['order_date']; ?></td>
                        <td><?php echo $itog_buy = $orders['summ_buy']; ?> сом</td>
                        <td><?php echo $itog_sell = $orders['summ_sell']; ?> сом</td>
                        <td><a href="/admin/order/view/<?php echo $orders['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <?php $total_buy += $itog_buy; $total_sell += $itog_sell ?>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="2">Общая сумма</td>
                        <td><?php echo $total_buy; ?> сом</td>
                        <td><?php echo $total_sell; ?> сом</td>
                    </tr>
                </table> 
            </div>
        </div>
    </div>
</section>
<?php include(ROOT.'/views/pattern/footer_main.php'); ?>