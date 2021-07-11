<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Обновить заказы</li>
                </ol>
            </div>
            <p>Вы действительно хотите обновить все новые заказы?</p>
            <form method="post">
                <input type="submit" name="submit" class="btn btn-warning" value="Отправлено ?" />
            </form>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>

