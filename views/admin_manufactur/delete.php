<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/manufactur">Управление брендами</a></li>
                    <li class="active">Удалить бренд</li>
                </ol>
            </div>


            <h4>Удалить бренд №<?php echo $id; ?></h4>


            <p>Вы действительно хотите удалить этот бренд?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>