<?php include ROOT.'/views/pattern/header_main.php'; ?>
<?php include ROOT.'/views/pattern/menu_main.php'; ?>
<section class="push_from_top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if(isset($_SESSION['cart'])): ?>
                <form action="#" method="post">
                    <table class="table-bordered table-striped table">
                        <tr>
                            <th>№</th>
                            <th>Наименование товара</th>
                            <th>Ед.изм.</th>
                            <th>Кол-во</th>
                            <th>Цена за ед.</th>
                            <th>Сумма</th>
                            <th>Удалить</th>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td><?php echo $i; $i++; ?></td>
                            <td><?php echo $product['name'] ;?></td>
                            <td><?php echo Product::getMeasureText($product['measure']); ?></td>
                            <td><?php echo $cart[$product['id']]; ?></td>
                            <td><?php echo $product['price_sell']; ?> сом</td>
                            <td><?php echo($product['price_sell'] * $cart[$product['id']]); ?> сом</td>
                            <td><a href="/cart/delete/<?php echo $product['id']; ?>"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td colspan="4">Итого за товары </td>
                            <td colspan="2" id="cart"><?php echo Test::getTotal(); ?> сом</td>
                        </tr>
                    </table>
                <?php if(!User::isGuest()): ?>
                <a class="btn btn-default checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"></i> Оформить заказ</a>
                <?php endif; ?>
                </form>
                <br>
                <?php if(User::isGuest() && Region::checkActiveKlients()): ?>
                <section class="users_for_choose">
                    <table class="table-bordered table-striped table">
                        <tr>
                            <th width="4%">№</th>
                            <th>Магазин</th>
                            <th width="20%">Клиент</th>
                            <th width="15%">Телефон</th>
                            <th width="15%">Войти</th>    
                            <th width="15%">Не заказал</th> 
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach($userList as $user): ?>
                        <tr>
                            <td><?php echo $i; $i++; ?></td>
                            <td><?php echo $user['magazin_name']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['phone']; ?></td>
                            <td class="sign_in_font"><a href="/admin/user/login/<?php echo $user['id']; ?>" title="К заказам"><i class="fa fa-sign-out"></i></a></td>
                            <td class="sign_in_font"><a href="/admin/user/delete/<?php echo $user['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </section>
                <?php elseif(!Region::checkActiveKlients()): echo "<h4>Далбан районду танда !!!</h4>"; ?>
                <?php endif; ?>
                <br>
                <?php else: ?>
                <p>Вы не выбрали товаров !</p> 
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php include ROOT.'/views/pattern/footer_cart.php'; ?>
