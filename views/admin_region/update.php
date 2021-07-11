<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/region">Управление районами</a></li>
                    <li class="active">Редактировать район</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
              <h4>Редактировать район <?php echo $region['name']; ?></h4>
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Название</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $region['name']; ?>">

                        <p>Описание</p>
                        <input type="text" name="desc" placeholder="" value="<?php echo $region['description']; ?>">
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

