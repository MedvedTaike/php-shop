<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление звонками</li>
                </ol>
            </div>
            <h4>Список магазинов по дням</h4>
            <div class="row">
                <a href="/admin/weekday/1" class="btn btn-default">Понедельник</a>
                <a href="/admin/weekday/2" class="btn btn-default">Вторник</a>
                <a href="/admin/weekday/3" class="btn btn-default">Среда</a>
                <a href="/admin/weekday/4" class="btn btn-default">Четверг</a>
                <a href="/admin/weekday/5" class="btn btn-default">Пятница</a>
                <a href="/admin/weekday/6" class="btn btn-default">Суббота</a>
                <a href="/admin/weekday/7" class="btn btn-default">Воскресенье</a>
            </div>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>

