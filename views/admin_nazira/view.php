<?php require(ROOT.'/views/admin_nazira/admin_nazira.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <br><br>
            <table class="table-bordered table-striped table">
                <tr>
                    <th width="2%">№</th>
                    <th>Наименование</th>
                    <th width="10%">Количество</th>
                    <th width="10%">Цена</th>
                    <th width="10%">Сумма</th>
                    <th width="10%">Нет товара</th>
                </tr>
                <?php if($products): ?>
                <?php $i = 1; ?>
                <?php foreach($products as $product): ?>
                <?php if($product['seller_id'] == 3): ?>
                <tr>
                    <td class="center"><?php echo $i; $i++; ?></td>
                    <td class="left"><?php echo Product::getSellerText($product['name']); ?> </td>
                    <td id="quantity"><?php echo ($product['convert_t'] * $product['count']) ; ?></td>
                    <td><input type="text" size="3" id="price_buy" data-id="<?php echo $product['id']; ?>" value="" /></td>
                    <td class="summ"></td>
                    <td><input type="button" class="btn btn-danger delete_item" id="<?php echo $product['id']; ?>" value="Удалить"></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="right">Общая сумма за товары</td>
                    <td id="total"></td>
                    <td></td>
                </tr>
                <?php else : ?>
                <h1>Нет товаров на заказ !</h1>
                <?php endif; ?>
            </table>
        </div>
    </div>
</section>
<?php include ROOT.'/views/admin_nazira/footer.php'; ?>
<script>
$(function(){
    var total = 0;
    $(document).on('change','#price_buy' , function(){
        var id = $(this).attr('data-id');
        var price = $(this).val();
        var quantity = parseInt($(this).parent().siblings('#quantity').text());
        var itog = $(this).parent().siblings('.summ');
        var summ = price * quantity;
        $.ajax({
            url:"/postav/nazira/ajax",
            method:"POST",
            data:{
                id:id,
                price:price
            },
            success:function(data){
                itog.text(summ); 
            }
        });
    });
    $('.delete_item').click(function(){
        var id = $(this).attr('id');
        var tr = $(this).parents('tr');
        $.ajax({
            url:"/postav/nazira/change",
            method:"POST",
            data: {id:id},
            success:function(){
                tr.fadeOut('slowly');
            }
        });
    });
});
</script>
