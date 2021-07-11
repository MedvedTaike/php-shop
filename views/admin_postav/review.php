<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Поставщики</li>
                </ol>
            </div>
            <div class="col-sm-6 pull-left">
                <ul>
                    <?php foreach($sellers as $seller): ?>
                    <li><a href="/postav/view/<?= $seller['id']; ?>" class="btn btn-success"> <?= $seller['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>