<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Удалить категорию</li>
                </ol>
            </div>


            <h4>Удалить категорию №<?php echo $id; ?></h4>


            <p>Вы действительно хотите удалить эту категорию?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

