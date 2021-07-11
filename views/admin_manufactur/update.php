<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/manufactur">Управление брендами</a></li>
                    <li class="active">Редактировать бренд</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
              <h4>Редактировать бренд "<?php echo $brand['name']; ?>"</h4>
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Название</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $brand['name']; ?>">

                        <p>Порядковый номер</p>
                        <input type="text" name="sort_order" placeholder="" value="<?php echo $brand['sort_order']; ?>">
                        
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($brand['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($brand['status'] == 0) echo ' selected="selected"'; ?>>Скрыта</option>
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

