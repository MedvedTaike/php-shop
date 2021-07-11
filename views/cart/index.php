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
                            <td><?php echo $product['name'] ;?><?php if($product['convert'] >1 ) echo '(<span id="'.$product['id'].'" class="convert">'.$product['price_sell'] * $product['convert'].' сом</span>)'; ?></td>
                            <td><?php echo Product::getMeasureText($product['measure']); ?></td>
                            <td><input type="text" size="3" value="<?php echo $cart[$product['id']]; ?>" id="quantity" data="<?php echo $product['id']; ?>"/> </td>
                            <td id="price"><?php echo $product['price_sell']; ?> сом</td>
                            <td id="summ">
                                <?php if($product['convert'] >1 ): ?>
                                <?php echo(($product['price_sell'] * $cart[$product['id']]) * $product['convert']); ?> 
                                <?php else : echo $product['price_sell'] * $cart[$product['id']];?>
                                <?php endif; ?>
                                сом
                            </td>
                            <td><a href="/cart/delete/<?php echo $product['id']; ?>"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td colspan="4">Итого за товары </td>
                            <td colspan="2"><span id="cart_total"><?php echo Cart::getTotal(); ?> сом</span></td>
                        </tr>
                    </table>
                <?php if(isset($_SESSION['update'])): ?>
                <a href="/admin/order/addition" class="btn btn-success"> Добавить товар к существующему заказу</a>
                <br><br>
                <?php endif; ?>
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
                            <th>Адрес</th>
                            <th width="15%">Клиент</th>
                            <th width="10%">Телефон</th>
                            <th width="5%">Go</th>    
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach($userList as $user): ?>
                        <tr>
                            <td><?php echo $i; $i++; ?></td>
                            <td><?php echo $user['magazin_name']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['phone']; ?></td>
                            <td class="sign_in_font"><a href="/admin/user/login/<?php echo $user['id']; ?>" title="К заказам"><i class="fa fa-sign-out"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </section>
                <?php elseif(!Region::checkActiveKlients()): ?>
                <?php echo '<h3>Далбан районду танда !!! Бир айтканды угасынбы деги ? Ыя И...!!!<h3>'; ?>
                <br>
                <?php endif; ?>
                <?php else: ?>
                <p>Вы не выбрали товаров !</p> 
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php include ROOT.'/views/pattern/footer_cart.php'; ?>
<script>
$(function(){
    $(document).on('keyup','#quantity', function(){
        var id = $(this).attr('data');
        var quant = $(this).val();
        var convert = parseInt($('span#'+id).text());
        var price = 0;
        if(isNaN(convert)){
            price = parseFloat($(this).parents('tr').find('#price').text()); 
        } else {
            price = convert;
        }
        var summ = $(this).parents('tr').find('#summ');
        var total = quant * price;
        summ.text(total + ' сом');
        $.ajax({
            url:'/cart/ajax/',
            method:'POST',
            data:{
                id:id,
                count:quant,
                total:total
            },
            success:function(data){
                $('#cart').text(data+' сом');
                $('#cart_total').text(data+' сом');
            }
        });
    });
});
</script>
