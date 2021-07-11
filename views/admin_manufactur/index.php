<?php include ROOT.'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление брендами</li>
                </ol>
            </div>
            <a href="/admin/manufactur/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить бренд</a> 
            <h4>Список брендов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID бренд</th>
                    <th>Название бренда</th>
                    <th>Порядковый номер</th>
                    <th>Статус</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                <?php foreach ($manList as $brand): ?>
                    <tr>
                        <td><?php echo $brand['id']; ?></td>
                        <td><?php echo $brand['name']; ?></td>
                        <td><?php echo $brand['sort_order']; ?></td>
                        <td><?php echo Category::getStatusText($brand['status']); ?></td>  
                        <td><a href="/admin/manufactur/update/<?php echo $brand['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/manufactur/delete/<?php echo $brand['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

