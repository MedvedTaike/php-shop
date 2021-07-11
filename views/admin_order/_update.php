<?php include ROOT . '/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Редактировать заказ</li>
                </ol>
            </div>
            <div class="col-sm-9 col-sm-offset-2">
              <h4>Редактировать заказ #<?php echo $id; ?></h4>
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Магазин</p>
                        <input type="text" name="magazin_name" placeholder="" value="<?php echo $order['name']; ?>">

                        <p>Дата оформления заказа</p>
                        <input type="text" name="date" placeholder="" value="<?php echo $order['date']; ?>">

                        <p>Статус</p>
                        <select name="status">
                            <option value="0" <?php if ($order['status'] == 0) echo ' selected="selected"'; ?>>Новый заказ</option>
                            <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>Обработанный заказ</option>
                        </select>
                        <br>
                        <br>
                        <table class="table-admin-medium table-bordered table-striped table">
                            <tr>
                                <th>№</th>
                                <th>Наименование товара</th>
                                <th>Количество</th>
                                <th>Buy</th>
                                <th>Sell</th>
                            </tr>
                        <?php $i = 1; $total_buy = 0; $total_sell = 0; ?>
                        <?php foreach($products as $id => $quantity): ?>
                        <?php $product = Product::getProductById($id); ?>
                            <tr>
                                <td><?php echo $i; $i++; ?></td>
                                <td><input type="text" value="<?php echo $product['name']; ?>" /> </td>
                                <td><input class="dobavit_input" type="text" size="2" name="number[<?php echo $product['id']; ?>]" value="<?php echo $quantity; ?>"></td>
                                <td><input type="text" value="<?php echo $itog_buy = $product['price_buy']* $quantity; ?>" ></td>
                                <td><input type="text" value="<?php echo $itog_sell = $product['price_sell']* $quantity; ?>" ></td>
                                <?php $total_buy += $itog_buy ; $total_sell += $itog_sell; ?>
                            </tr>
                        <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td colspan="2">Итоговая сумма</td>
                                <td><input type="text" name="total_buy" value="<?php echo $total_buy; ?>" /></td>
                                <td><input type="text" name="total_sell" value="<?php echo $total_sell; ?>" /></td>
                            </tr>
                        </table>
                        <input type="submit" name="submit_1" class="btn btn-default" value="Обновить">
                        <input type="submit" name="submit_2" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

