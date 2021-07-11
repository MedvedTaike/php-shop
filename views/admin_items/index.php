<?php include ROOT .'/views/pattern/header_admin.php'; ?>
<?php include ROOT.'/views/pattern/menu_item.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="title_center">
                <h4><?php echo $catList[$id]['name']; ?></h4>
            </div>
            <table class="table-bordered table-striped table">
                <tr>
                    <th width="2%">Сорт.</th>
                    <th>Наименование</th>
                    <th>Buy </th>
                    <th>Sell </th>
                    <th>Ед.изм.</th>               
                    <th>Конв.</th>
                    <th width="2%">Ред.</th>
                </tr>
                <?php foreach($items as $product): ?>
                <tr class="<?php if($product['status'] == 0): echo "highlight_st"; endif; ?>">
                    <td><?php echo $product['sort_order']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><input type="text" size="3" id="price_buy" data-id="<?php echo $product['id']; ?>" value="<?php echo $product['price_buy']; ?>" /></td>
                    <td><input type="text" size="3" id="price_sell" data-id="<?php echo $product['id']; ?>" value="<?php echo $product['price_sell']; ?>" /></td>
                    <td><?php echo Product::getMeasureText($product['measure']); ?></td>  
                    <td><?php echo Product::getConvertText($product['convert_t']); ?></td>
                    <td><a href="/admin/item/update/<?php echo $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>
<?php include(ROOT.'/views/pattern/footer_cart.php'); ?>
<script>
    $(function(){
        $(document).on('change',':input', function(){
            var number = $(this).val();
            var id = $(this).attr('id');
            var identifier = $(this).attr('data-id');
            $.ajax({
                url:'/admin/item/ajax/',
                method:'POST',
                data:{
                    number:number,
                    id:id,
                    identifier:identifier
                },
                success:function(data){
                    alert('Новая цена '+data);
                }
            });
        });
    });
</script>