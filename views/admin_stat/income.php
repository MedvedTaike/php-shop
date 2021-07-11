<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Статистика по датам</li>
                </ol>
            </div>
            <h4>Статистика по времени</h4>
            <br/>
            <table class="table-bordered table-striped table">
                <tr>
                    <th width="2%">№</th>
                    <th>Дата</th>
                    <th width="20%">Кол. заказов</th>
                    <th width="10%">Buy</th>
                    <th width="10%">Sell</th>
                    <th width="10%">Разница</th>
                    <th width="10%"></th>
                </tr>
                <?php $i = 1; $diff = 0; $countOrder = 0; $totalBuy = 0; $total_sell= 0; ?>
                <?php foreach($income as $incomes): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $incomes['date']; ?></td>
                        <td><?php echo $number = $incomes['number']; ?></td>
                        <td><?php echo $buy = $incomes['buy']; ?></td>
                        <td><?php echo $sell = $incomes['sell']; ?></td>
                        <td><?php echo $itog = ($incomes['sell'] - $incomes['buy']); ?></td>
                        <td><a href="/admin/stat/date/<?php echo $incomes['date']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <?php $countOrder += $number; $totalBuy += $buy; $total_sell += $sell; $diff += $itog; ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>Общие данные</td>
                    <td><?php echo $countOrder; ?></td>
                    <td><?php echo $totalBuy; ?></td>
                    <td><?php echo $total_sell; ?></td>
                    <td><?php echo $diff; ?></td>
                </tr>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

