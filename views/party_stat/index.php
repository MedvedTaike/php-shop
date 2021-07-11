<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Статистика партии</li>
                </ol>
            </div>
            <h4>Статистика заказов</h4>
            <br/>
            <table class="table-bordered table-striped table">
                <tr>
                    <th width="8%">№</th>
                    <th>Дата</th>
                    <th width="20%">Кол. заказов</th>
                    <th width="10%">Buy</th>
                    <th width="10%">Sell</th>
                    <th width="10%">Разница</th>
                    <th width="4%"></th>
                </tr>
                <?php $diff = 0; $total_order = 0; $total_buy = 0; $total_sell= 0; ?>
                <?php foreach($parts as $party): ?>
                <?php $ids = implode(',',$party['orders']); ?>
                    <tr>
                        <td><?php echo ' № '.$party['id']; ?></td>
                        <td><?= $party['date']; ?></td>
                        <td><?php echo $order =  count($party['orders']); ?></td>
                        <td class="right"><?php $buy = Party::getTotalBuy($ids); echo number_format($buy, 2, '.', ' '); ?></td>
                        <td class="right"><?php $sell = Party::getTotalSell($ids); echo number_format($sell, 2, '.', ' '); ?></td>
                        <td class="right"><?php $tot = $sell- $buy; echo number_format($tot,2,'.',' '); ?></td>
                        <td><a href="/party/orders/<?= $party['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <?php $total_order += $order ; $diff += $tot ; $total_buy += $buy ; $total_sell += $sell ; ?> 
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>Общие данные</td>
                    <td><?= $total_order; ?></td>
                    <td class="right"><?= number_format($total_buy , 2, '.', ' '); ?></td>
                    <td class="right"><?= number_format($total_sell , 2, '.', ' '); ?></td>
                    <td class="right"><?= number_format($diff , 2, '.', ' '); ?></td>
                    <td></td>
                </tr>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

