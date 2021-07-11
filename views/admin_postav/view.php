<?php require(ROOT.'/views/pattern/postav.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
				<div class="left-sidebar">
				    <h2>Заказы</h2>
				    <div class="brands-name">
				       <ul class="nav nav-pills nav-stacked">
                           <?php if(!empty($party)): ?>
                           <?php foreach($party as $order ): ?>
                            <li id="<?= $order['id']; ?>">
                                 <a href="#" <?php if(Order::checkParty($order['id'], $id)) : echo 'style="color:green"'; endif; ?>>
                                 <span class="pull-right">(<?= count($order['orders']); ?>)</span>
                                 <?= ' № '.$order['id'].' / '.$order['date']; ?>
                                 </a>
                            </li>
                           <?php endforeach; ?>
                           <?php endif; ?>
				       </ul>
				    </div>
				</div>
            </div>
            <div class="col-sm-9 main_table">
            </div>
        </div>
    </div>
</section>
<?php if(User::isAdmin()): ?>
<?php include ROOT.'/views/pattern/footer_main.php'; ?>
<?php else : include ROOT.'/views/pattern/footer_postav.php'; ?>
<?php endif; ?>
<script>
    $(function(){
        var cart = {};
        $(document).on('change','#price_buy',changeItem);
        $(document).on('click','.delete_item',deleteItem);
        
        $('a').click(function(){
            var id = $(this).parent().attr('id');
            var seller_id = $('.seller_name').attr('id');
            if($(this).attr('style'))
                {
                    $.ajax({
                        url:'/postav/upload',
                        method:'POST',
                        data: {id:id,seller:seller_id},
                        success:function(data){
                            uploadItem(data);
                        }
                    });
                }
            else
            {
                $.ajax({
                    url:'/postav/ajax',
                    method:'POST',
                    data: {id:id,seller:seller_id},
                    success:function(data){
                        loadGoods(data);
                    }
                });
            }
        });

        function loadGoods(data)
        {
            $('.main_table').html(data); 
        }
        function changeItem()
        {
            var price = parseFloat($(this).val());
            var id = $(this).attr('data-id');
            var quant = parseInt($(this).parent().siblings('#quantity').text());
            var summ = $(this).parent().siblings('#summ');
            summ.text(price * quant);
            cart[id] = {quant,price};
            $.ajax({
                url:'/postav/price',
                method:'POST',
                data:{id:id,price:price},
                success:function(){
                    changeSumm();
                    console.log(cart);
                }
            });   
        }
        function changeSumm()
        {
            var total = 0;
            $('td#summ').each(function(){
                var num = parseFloat($(this).text());
                if(isNaN(num))
                    {
                        num = 0;
                    } else {
                        total += num;
                    }
            });
            $('#total').text(total);
        }
        function deleteItem()
        {
            var row = $(this).parents('tr');
            var id = $(this).attr('id');
            var seller_id = $('.seller_name').attr('id'); 
            $.ajax({
                url:'/postav/change',
                method:'POST',
                data:{id:id,seller:seller_id},
                success:function(){
                    row.remove();
                    delete cart[id];
                }
            });      
        }
        $(document).on('click','.add_party',function(){
            var row = $(this).parents('tr');
            row.toggleClass('hidden_row');
        });
        $(document).on('click', '.save_items', function(){
            var seller_id = $(this).attr('id');
            var party_id = $('h4').attr('id');
            if($.isEmptyObject(cart))
                {
                    alert('Введите цену !');
                } else {
                    $.ajax({
                        url:'/postav/save',
                        method:'POST',
                        data:{seller_id:seller_id, party_id:party_id, items:cart},
                        success:function(){
                             location.reload();
                        }
                    });
                }
        });
        function uploadItem(data)
        {
            $('.main_table').html(data); 
        }
        
    });
</script>


