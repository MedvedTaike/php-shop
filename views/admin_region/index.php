<?php include ROOT.'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление регионами</li>
                </ol>
            </div>
            <a href="/admin/region/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить регион</a> 
            <h4>Список регионов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th width="10%">ID региона</th>
                    <th>Имя региона</th>
                    <th>Описание региона</th>
                    <th width="20%">Количество магазинов</th>
                    <th width="10%">Ред.</th>
                </tr>
                <?php foreach ($regList as $region): ?>
                    <tr>
                        <td><?php echo $region['id']; ?></td>
                        <td><?php echo $region['name']; ?></td>
                        <td><?php echo $region['desc']; ?></td>
                        <td><?php echo $number[$region['id']]; ?></td> 
                        <td><a href="/admin/region/update/<?php echo $region['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>