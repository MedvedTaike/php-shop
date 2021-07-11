<?php include ROOT.'/views/pattern/header_print.php' ; ?>
<div class="container">
    <?php foreach($sellers as $seller): ?>
    <div class="print">
        <p class="margin_top_seller">Имя поставщика :<?php echo $seller['name'];?><span class="date">Дата: <?php echo Order::getDateOff(); ?></span></p>
        <table>
            <tr>
                <th width="2%" class="center">№</th>
                <th width="58%" class="left">Товар</th>
                <th width="40%" class="left">Количество</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach($final as $product): ?>
            <?php if($seller['id'] == $product['seller_id']): ?>
            <tr>
                <td class="center"><?php echo $i; $i++; ?></td>
                <td class="left"><?php echo Product::getSellerText($product['name']); ?> </td>
                <td class="left"><?php echo ($product['convert_t'] * $product['count']) ; ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endforeach; ?>
</div>
