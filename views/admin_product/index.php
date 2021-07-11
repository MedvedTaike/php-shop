<?php include ROOT .'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <br/>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление товарами</li>
                </ol>
            </div>
            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>
            <h4>Список товаров</h4>
            <br/>
            <table class="table-bordered table-striped table">

                <tr>
                    <th width="2%">Сорт.</th>
                    <th>Наименование</th>
                    <th>Пост.</th>
                    <th>Brand</th>
                    <th>Buy </th>
                    <th>Sell </th>
                    <th>Ед.изм.</th>               
                    <th>Конв.</th>
                    <th width="2%">Ред.</th>
                    <th width="2%">Удал.</th>
                </tr>
                <?php foreach($categoriesList as $category): ?>
                <tr>
                    <td colspan="8" class="<?php if($category['status'] == 0): echo "highlight_st"; endif; ?>"><h4><?php echo $category['name']; ?></h4></td>
                </tr>
                
                <?php foreach ($productsList as $product): ?>
                <?php if($product['category_id']==$category['id']): ?>
                    <tr class="<?php if($product['status'] == 0): echo "highlight_st"; endif; ?>">
                        <td><?php echo $product['sort_order']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['seller_name']; ?></td>
                        <td><?php echo $product['brand']; ?></td>
                        <td><?php echo $product['price_buy']; ?></td>  
                        <td><?php echo $product['price_sell']; ?></td>  
                        <td><?php echo Product::getMeasureText($product['measure']); ?></td>  
                        <td><?php echo Product::getConvertText($product['convert_t']); ?></td>
                        <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>