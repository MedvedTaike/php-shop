<?php include (ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">          
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Сортировка заказов</li>
                </ol>
            </div>
            <h4>Список заказов</h4>
            <table class="table-bordered  table-striped table">
                <tr>
                    <th>№</th>
                    <th width="45%">Магазин</th>
                    <th>Дата заказа</th>
                    <th>Дата отправки</th>
                    <th>Buy</th>
                    <th>Sell</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php $i = 1; $total_buy = 0; $total_sell = 0; ?>
                <?php foreach ($ordersList as $order): ?>
                    <tr id="<?php echo $order['id']; ?>">
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['date_off']; ?></td>
                        <td><?php echo $order['total_buy']; ?></td>
                        <td><?php echo $order['total_sell']; ?></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>    
                        <td><a href="/admin/order/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                        <td><a href="/admin/order/update/<?php echo $order['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/order/delete/<?php echo $order['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        <td><input type="checkbox" name="client_id[]" class="add_party" value="<?php echo $order['id']; ?>" /></td>
                        <?php $total_buy += $order['total_buy']; $total_sell += $order['total_sell']; ?>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td colspan="3">Общая сумма :</td>
                        <td><?php echo $total_buy; ?></td>
                        <td><?php echo $total_sell; ?></td>
                        <td colspan="4"></td>
                    </tr>
            </table>
            <div align="center">
                <button type="button" name="btn_add_party" id="btn_add_party" class="btn btn-success">Создать партию</button>
                <a href="/admin/order/party" class="btn btn-success"> Управление заказами</a>
                <?php if(!empty($party)): ?>
                <select id="party_id" class="inline_select">
                    <option value="0" selected="selected">Партияны танда</option>
                    <?php foreach($party as $part_id): ?>
                    <option value="<?php echo $part_id['id']; ?>" >               
                        Номер партии : №<?php echo $part_id['id'].' Дата партии :'. $part_id['date']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
            </div>
            <br><br>
        </div>
    </div>
</section>
<?php include ROOT . '/views/pattern/footer_main.php'; ?>
<script>
    $(function(){
        $('#btn_add_party').click(function(){
            if(confirm('Создать партию ?')){
                var id = [];
                $(':checkbox:checked').each(function(i){
                    id[i] = $(this).val();
                });
                if(id.length === 0){
                    alert('Заказды танда');
                } else {
                    $.ajax({
                        url:'/admin/order/ajax',
                        method:'POST',
                        data:{id:id},
                        success:function(){
                            location.reload();
                        }
                    });
                }
            }
        });
        $(document).on('change','#party_id',function(){
            var party_id = $(this).val();
            var id = [];
            $(':checkbox:checked').each(function(i){
                    id[i] = $(this).val();
            });
            if(id.length === 0){
                alert('Заказды танда');
                location.reload();
            } else {
                $.ajax({
                    url:'/admin/order/add',
                    method: 'POST',
                    data: {id:id,party_id:party_id},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
    });
</script>

