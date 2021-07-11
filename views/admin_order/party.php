<?php include (ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Сортировка заказов</a></li>
                    <li class="active">Активные партии заказов</li>
                </ol>
            </div>
            <?php if(empty($party)): ?>
            <h4>Активных партий нет !!!</h4>
            <?php else : ?>
            <h3>Активные партии</h3>
            <table class="table-bordered  table-striped table">
                <tr>
                    <th>Номер </th>
                    <th>Дата </th>
                    <th>Количество </th>
                    <th> </th>
                </tr>
                <?php foreach($party as $order): ?>
                <tr>
                    <td>Партия №<?php echo $order['id']; ?></td>
                    <td><?php echo $order['date']; ?></td>
                    <td><?php echo count($order['orders']); ?> активных заказов </td>
                    <td width="3%"><a href="/admin/party/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>