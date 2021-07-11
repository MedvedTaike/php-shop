<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/calling">Управление звонками</a></li>
                </ol>
            </div>
            <h4>Список магазинов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th width="2%">№</th>
                    <th width="10%">Магазин</th>
                    <th>Адрес магазина</th>
                    <th width="10%">Статус</th>
                    <th width="10%">Имя</th>
                    <th width="10%">Телефоны</th>
                    <th width="4%"></th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($usersByDay as $user): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $user['magazin_name']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo User::getCallStatusText($user['call_status']); ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td><a href="/admin/single/call/<?php echo $user['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

