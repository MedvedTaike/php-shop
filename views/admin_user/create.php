<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/user">Управление клиентами</a></li>
                    <li class="active">Добавить нового клиента</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
              <h4>Добавить новый магазин</h4>
                <div class="login-form">
                    <form action="#" method="post">
                        
                        <p>Имя магазина</p>
                        <input type="text" name="magazin_name" placeholder="" value="" required>

                        <p>Адрес</p>
                        <input type="text" name="address" placeholder="" value="" required>
                        
                        <p>День заказа</p>
                        <select name="weekday">
                            <option value="1" selected="selected">Понедельник</option>
                            <option value="2">Вторник</option>
                            <option value="3">Среда</option>
                            <option value="4">Четверг</option>
                            <option value="5">Пятница</option>
                            <option value="6">Суббота</option>
                            <option value="7">Воскресенье</option>
                        </select>
                        <br>
                        <br>

                        <p>Телефон</p>
                        <input type="text" name="phone" placeholder="" value="" required>
                        <br>
                        <p>Район</p>
                        <select name="region_id">
                            <?php if (is_array($regionList)): ?>
                                <?php foreach ($regionList as $region): ?>
                                    <option value="<?php echo $region['id']; ?>">
                                        <?php echo $region['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br>
                        <p>Имя клиента</p>
                        <input type="text" name="name" placeholder="" value="" required>
                        
                        <p>Пароль</p>
                        <input type="text" name="password" placeholder="" value="" required>
                    
                        <br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

