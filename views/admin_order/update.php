<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="active">Редактировать заказ</li>
                </ol>
            </div>
            <div class="col-sm-9">
                <h4>Редактировать заказ #<?php echo $id; ?></h4>
                <p>Магазин: <?php echo $order['name']; ?></p>

                <p>Дата оформления заказа : <?php echo $order['date']; ?></p>
                
            <br>
            
             <form action="#" method="post">
                 <input type="submit" name="submit" class="btn btn-success" value="Сохранить">
                 <a href="/category/1" class="btn btn-success"> Добавить товар</a>
                 <p></p>
                 <?php if($order['party'] == 0): ?>
                <p>Статус</p>
                <select name="status">
                    <option value="0" <?php if ($order['status'] == 0) echo ' selected="selected"'; ?>>Новый заказ</option>
                    <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>Обработанный заказ</option>
                </select>
                 <?php endif; ?>
            </form> 
                <br>
                <br>
            </div>
            <div class="col-sm-12">
                <table class="table-bordered table-striped table">
                    <tr>
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Кол.</th>
                        <th>Buy</th>
                        <th>Sell</th> 
                        <th>Сумма</th>
                        <th></th>
                    </tr>
                    <?php $i = 1; $buy = 0; $sell = 0; ?>
                    <?php foreach($items as $item): ?>
                    <tr id="<?php echo $item['id']; ?>">
                        <td width="2%"><?php echo $i; $i++; ?></td>
                        <td><?php echo $item['name']; ?><?php if($item['convert_t'] >1 ) echo '(<span id="'.$item['id'].'" class="convert">'.$item['price_sell'] * $item['convert_t'].' сом</span>)'; ?></td>
                        <td width="7%"><input type="text" size="3" id="quant" value="<?php echo $products[$item['id']]; ?>" /></td>
                        <td id="buy" width ="7%"><?php echo $item['price_buy']; ?></td>
                        <td id="sell" width="7%"><?php echo $item['price_sell'];  ?></td>
                        <td id="summ" width="7%">
                            <?php if($item['convert_t'] >1 ) : ?>
                            <?php echo (($item['price_sell'] * $products[$item['id']]) * $item['convert_t']); ?> 
                            <?php else : echo $item['price_sell'] * $products[$item['id']] ; ?>
                            <?php endif; ?>
                        </td>
                        <td width="4%"><a href="#" id="<?php echo $item['id']; ?>"><i class="fa fa-times"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5"> Общая сумма за товары</td>
                        <td colspan="2" id="total"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>
<script>
    $(function(){
        countSumm();
        $(document).on('change','#quant', function(){
            var parent = $(this).parents('tr');
            var id = parent.attr('id');
            var convert = parseInt($('span#'+id).text());
            var sell = 0;
            var quant = $(this).val();
            if(isNaN(convert)){
                sell = parseInt(parent.find('#sell').text());
            } else {
                sell = convert;
            }
            var summ = parent.find('#summ');
            summ.text(quant * sell);
            $.ajax({
                url:'/admin/order/change',
                method:'POST',
                data:{id:id, quant:quant},
                success:function(){
                    location.reload();
                }
            });
        });
        $('td a').click(function(i){
            i.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                 url:'/admin/order/remove',
                method:'POST',
                data:{id:id},
                success:function(){
                    location.reload();
                }
            });
        });
        function countSumm()
        {
            var total = 0;
            $('td#summ').each(function(){
                var num = parseInt($(this).text());
                total += num;
            }); 
            $('#total').text(total);
        }
    });
</script>