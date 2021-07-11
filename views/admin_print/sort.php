<?php include ROOT.'/views/pattern/header_sorter.php'; ?>
<div class="container">
    <div class="col-sm-12">
        <?php foreach($ordersList as $orders): ?>
            <div class="print">
                <p class="center margin_top">Накладная № <?php echo $orders['id']; ?></p>
                <p>Торговая точка : <span class="uc"><?php echo $orders['magazin'];?></span></p>
                <p>Адрес: <?php echo $orders['address']; ?></p>
                <table>
                    <tr>
                        <th class="center">Наименование</th>
                        <th width="10%" class="center">Ед.изм</th>
                    </tr>
                    <?php $order = Order::getOrderedProducts($orders['id']); ?>
                    <?php $product = json_decode($order{'products'},true); ?>
                    <?php foreach($product as $id => $quantity): ?>
                    <?php $products = Product::getProductById($id); ?>
                    <tr>
                        <td class="left"><?php echo Product::getSellerText($products['name']).'___'.($quantity * $products['convert_t']) ;?></td>
                        <td class="center"><?php echo Product::getMeasureText($products['measure']);?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>  
        <?php endforeach; ?>
    </div>
</div>