<?php include ROOT.'/views/pattern/header_main.php'; ?>
<?php include ROOT.'/views/pattern/menu_main.php';  ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="features_items">
                        <h2 class="title text-center">Категории</h2>
                            <?php foreach($categoryProduct as $product): ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="quantity" id="quantity"><?php echo Cart::getQuantity($product['id']);?></div>
                                            <img src="/images/<?php echo $product['id']; ?>.jpg" />
                                            <h2 id="price_sell"><?php echo $product['price_sell']; ?> сом </h2>
                                            <p><?php echo $product['name']; ?><?php if($product['convert'] >1 ) echo '(<span id="'.$product['id'].'" class="convert">'.$product['price_sell'] * $product['convert'].' сом</span>)'; ?> </p>
                                            <div class="cart_order" id="<?php echo $product['id']; ?>">
						                        <button type="button" class="btn btn-danger" id="minus"><i class="fa fa-minus"></i></button>                                                              
						                        <button type="button" class="btn btn-info" id="add_to_cart">Добавить</button>                                                              
						                        <button type="button" class="btn btn-danger" id="plus"><i class="fa fa-plus"></i></button>                                                              
					                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include(ROOT.'/views/pattern/footer_main.php'); ?>
<script>
    $(function(){
        $('.quantity').each(function(){
            var num = parseInt($(this).text());
            if(num != 0){
                $(this).css('backgroundColor','red').show();
            }
        });
        $('.cart_order button').click(function(){
            var id = $(this).parent().attr('id');
            var quantity = $(this).parent().siblings('.quantity');
            var convert = parseInt($('span#'+id).text());
            var price = 0;
            var count = parseInt(quantity.text());
            if(isNaN(convert)){
                price = $(this).parent().siblings('#price_sell').text();
            } else {
                price = convert;
            }
            if(this.id == "plus"){
                count = ++count;
                quantity.text(count);
                quantity.fadeIn();
            } else if(this.id == "minus"){
                if(count != 0){
                    count = --count;
                    quantity.text(count);
                } else if(count == 0 || count >= 0){
                    quantity.fadeOut();
                }
            } else {
               var total = count * parseFloat(price);
               if(count != 0){
                $.ajax({
                    url:"/cart/ajax",
                    method:"POST",
                    data:{
                        id:id,
                        count:count,
                        total:total
                    },
                    success:function(data){
                        $('#cart').text(data+' сом');
                        quantity.css('backgroundColor','red');
                    }
                });
              }
            }
        });
    });
</script>