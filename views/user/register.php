<?php include ROOT.'/views/pattern/header_main.php'; ?>
<?php include ROOT.'/views/pattern/menu_register.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
             <?php if ($result): ?>
                    <p class="margin_top_extreme">Вы зарегистрированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                  <?php endif; ?>
                  <div class="signup-form">
                    <h2>Регистрация на сайте</h2>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Имя клиента" value=""/>
                        <input type="text" name="address" placeholder="Адрес магазина" value=""/>
                        <input type="text" name="magazin_name" placeholder="Имя магазина" value=""/>
                        <input type="text" name="phone" placeholder="Телефон" value=""/>
                        <input type="password" name="password" placeholder="Пароль" value=""/>
                        <input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
                    </form>
                  </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php include ROOT.'/views/pattern/footer_main.php'; ?>