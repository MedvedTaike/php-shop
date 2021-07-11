<?php include ROOT.'/views/pattern/header_main.php'; ?>
<?php include ROOT.'/views/pattern/menu_list.php'; ?>
<section class="push_from_top">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <table class="table-bordered table-striped table">
                    <tr>
                        <th width="4%">№</th>
                        <th width="60%">Имя товара</th>
                        <th>Цена</th>
                        <th>Кол-во</th>
                        <th>Добавить</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach($catProduct as $product): ?>
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td ><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price_sell']; ?> сом.</td>
                        <td>
                        <div class="cart_buttonchik">
						    <input type="button" class="plus" value="+">
						    <input class="dobavit_input" type="text" size="2">
						    <input type="button" class="minus" value="-">                                                               
					    </div>
                        </td>
                        <td><input type="button" class="add_on_tovar table_alignment" value="Добавить" id="<?php echo $product['id']; ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include ROOT.'/views/pattern/footer_main.php'; ?>