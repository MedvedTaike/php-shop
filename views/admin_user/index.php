<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление клиентами</li>
                </ol>
            </div>
            <a href="/admin/user/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить клиента</a>
            
            <h4>Список клиентов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>№</th>
                    <th>Магазин</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>Имя клиента</th>
                    <th>Район</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($usersList as $user): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $user['magazin']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['region']; ?></td>
                        <td><a href="/admin/user/klient/<?php echo $user['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/user/update/<?php echo $user['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

