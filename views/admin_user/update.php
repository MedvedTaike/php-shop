<?php include ROOT.'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/user">Управление клиентами</a></li>
                    <li class="active">Редактировать клиента</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
              <h4>Редактировать клиента</h4>
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Магазин</p>
                        <input type="text" name="magazin_name" placeholder="" value="<?php echo $userUpdate['magazin_name']; ?>" required >

                        <p>Адрес</p>
                        <input type="text" name="address" placeholder="" value="<?php echo $userUpdate['address']; ?>"  required >
                        
                        <p>День заказа</p>
                        <select name="weekday">
                            <option value="1" <?php if($userUpdate['weekday'] == 1) echo ' selected="selected"'; ?>>Понедельник</option>
                            <option value="2" <?php if($userUpdate['weekday'] == 2) echo ' selected="selected"'; ?>>Вторник</option>
                            <option value="3" <?php if($userUpdate['weekday'] == 3) echo ' selected="selected"'; ?>>Среда</option>
                            <option value="4" <?php if($userUpdate['weekday'] == 4) echo ' selected="selected"'; ?>>Четверг</option>
                            <option value="5" <?php if($userUpdate['weekday'] == 5) echo ' selected="selected"'; ?>>Пятница</option>
                            <option value="6" <?php if($userUpdate['weekday'] == 6) echo ' selected="selected"'; ?>>Суббота</option>
                            <option value="7" <?php if($userUpdate['weekday'] == 7) echo ' selected="selected"'; ?>>Воскресенье</option>
                        </select>
                        <br><br>

                        <p>Телефон</p>
                        <input type="text" name="phone" placeholder="" value="<?php echo $userUpdate['phone']; ?>" required >
                        <br>
                        <p>Район</p>
                        <select name="region_id">
                            <?php if (is_array($regionList)): ?>
                                <?php foreach ($regionList as $region): ?>
                                    <option value="<?php echo $region['id']; ?>" 
                                        <?php if ($userUpdate['region_id'] == $region['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $region['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br>
                        <p>Имя клиента</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $userUpdate['name']; ?>" required>
                        
                        <p>Пароль</p>
                        <input type="text" name="password" placeholder="" value="<?php echo $userUpdate['password']; ?>" required>
                        
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if($userUpdate['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if($userUpdate['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                        </select>
                    
                        <br/><br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

