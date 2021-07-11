<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Статистика по магазинам</li>
                </ol>
            </div>
            <h4>Список магазинов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th width="2%">№</th>
                    <th width="18%">Магазин</th>
                    <th>Адрес магазина</th>
                    <th width="8%">Заказов</th>
                    <th width="8%">Сумма</th>
                    <th width="4%"></th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($usersStatList as $user): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo $user['number']; ?></td>
                        <td><?php echo $user['sell']; ?></td>
                        <td><a href="/admin/stat/single/<?php echo $user['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

