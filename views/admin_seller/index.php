<?php include ROOT.'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление поставщиками</li>
                </ol>
            </div>
            <a href="/admin/seller/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить поставщика</a> 
            <h4>Список поставщиков</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>№</th>
                    <th>ID поставщика</th>
                    <th>Имя поставщика</th>
                    <th>Адрес поставщика</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($sellersList as $sellers): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $sellers['id']; ?></td>
                        <td><?php echo $sellers['name']; ?></td>
                        <td><?php echo $sellers['address']; ?></td>
                        <td><?php echo $sellers['phone']; ?></td>
                        <td><?php echo Category::getStatusText($sellers['status']); ?></td>  
                        <td><a href="/admin/seller/update/<?php echo $sellers['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/seller/delete/<?php echo $sellers['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

