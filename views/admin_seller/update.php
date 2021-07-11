<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/seller">Управление поставщиками</a></li>
                    <li class="active">Редактировать поставщика</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
              <h4>Редактировать поставщика "<?php echo $seller['name']; ?>"</h4>
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Имя поставщика</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $seller['name']; ?>">

                        <p>Адрес поставщика</p>
                        <input type="text" name="address" placeholder="" value="<?php echo $seller['address']; ?>">
                        
                        <p>Телефон</p>
                        <input type="text" name="phone" placeholder="" value="<?php echo $seller['phone']; ?>">
                        
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($seller['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($seller['status'] == 0) echo ' selected="selected"'; ?>>Скрыта</option>
                        </select>

                        <br><br>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

