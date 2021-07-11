<?php include ROOT.'/views/pattern/header_print.php'; ?>
<div class="container">
    <div class="col-sm-12">
    <?php foreach($ordersList as $orders): ?>
    <div class="print">
    <p class="center margin_top">Накладная № <?php echo $orders['id']; ?></p>
        <p>Торговая точка : <span class="uc"><?php echo $orders['magazin'];?></span> / Телефон : <?php echo $orders['phone']; ?> / Имя клиента: <?php echo $orders['name']; ?> /</p>
        <p>Адрес: <?php echo $orders['address']; ?></p>  
    <p>Дата принятия заказа : <?php echo $orders['date']; ?><span class="date">Дата отправки заказа: <?php echo $orders['date_off']; ?> </span></p>
    <table>
        <tr>
          <th width="3%" class="center">№</th>
          <th class="center">Наименование</th>
          <th width="10%" class="center">Ед.изм</th>
          <th width="10%" class="center">Кол-во</th>
          <th width="10%" class="center">Цена</th>
          <th width="10%" class="center">Сумма</th>
        </tr>
        <?php $order = Order::getOrderedProducts($orders['id']); ?>
        <?php $product = json_decode($order{'products'},true); ?>
        <?php $i = 1; $summa = 0; ?>
        <?php $ids = array_keys($product); ?>
        <?php $items = Cart::getProductsInCart($ids); ?>
        <?php foreach($items as $products): ?>
        <tr>
            <td class="center"><?php echo $i; $i++ ; ?></td>
            <td class="left"><?php echo $products['name']; ?></td>
            <td class="center"><?php echo Product::getMeasureText($products['measure']); ?></td>
            <td class="center"><?php echo $product[$products['id']] ; ?></td>
            <td class="right"><?php echo $products['price_sell'] * $products['convert']; ?></td>
            <td class="right"><?php echo $itog = ($product[$products['id']] * $products['price_sell']) * $products['convert']; ?></td>
            <?php $summa += $itog; ?>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td colspan="4" class="right">Общая сумма за товары  </td>
            <td class="right"><strong><?php echo $summa; ?></strong></td>
        </tr>
    </table>
    <div>
        <p>Итого к оплате : <span class="upper"><?php echo Letter::propis($summa) ;?></span></p>
        <p class="margin_bottom">Получил товар: ____________ Доставил товар : ___________ </p>
    </div>
    </div>
    <div class="print">
        <p class="center margin_top">Накладная № <?php echo $orders['id']; ?></p>
        <p>Торговая точка : <span class="uc"><?php echo $orders['magazin'];?></span> Имя клиента: <?php echo $orders['name']; ?> /</p>
        <p>Адрес: <?php echo $orders['address']; ?></p>
        <table>
            <tr>
              <th width="3%" class="center">№</th>
              <th class="center">Наименование</th>
              <th width="10%" class="center">Ед.изм</th>
              <th width="10%" class="center">Цена</th>
              <th width="10%" class="center">Сумма</th>
            </tr>
            <?php $order = Order::getOrderedProducts($orders['id']); ?>
            <?php $product = json_decode($order{'products'},true); ?>
            <?php $i = 1; $summa = 0; ?>
            <?php $ids = array_keys($product); ?>
            <?php $items = Cart::getProductsInCart($ids); ?>
            <?php foreach($items as $products): ?>
            <tr>
                <td class="center"><?php echo $i; $i++ ; ?></td>
                <td class="left"><?php echo $products['name'].'_____'. $product[$products['id']]; ?></td>
                <td class="center"><?php echo Product::getMeasureText($products['measure']); ?></td>
                <td class="right"><?php echo $products['price_sell'] * $products['convert']; ?></td>
                <td class="right"><?php echo $itog = ($product[$products['id']] * $products['price_sell']) * $products['convert']; ?></td>
                <?php $summa += $itog; ?>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td colspan="3" class="right">Общая сумма за товары  </td>
                <td class="right"><strong><?php echo $summa; ?></strong></td>
            </tr>
        </table>
        <br>
        <br>
        <hr>
    </div>
    <?php endforeach; ?>
    </div>
</div>