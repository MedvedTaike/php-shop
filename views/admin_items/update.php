<?php include ROOT .'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/item/<?php echo $product['category_id']; ?>">Управление товарами</a></li>
                    <li class="active">Редактировать товар</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <h4>Редактировать товар №<?php echo $id; ?></h4>
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>">
                        <br><br>
                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" 
                                        <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br><br>
                        <p>Единица измерения</p>
                        <select name="measure">
                            <option value="0" <?php if ($product['measure'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                            <option value="1" <?php if ($product['measure'] == 1) echo ' selected="selected"'; ?>>Шт.</option>
                            <option value="2" <?php if ($product['measure'] == 2) echo ' selected="selected"'; ?>>Блок</option>
                            <option value="3" <?php if ($product['measure'] == 3) echo ' selected="selected"'; ?>>Упаков. </option>
                            <option value="4" <?php if ($product['measure'] == 4) echo ' selected="selected"'; ?>>Короб. </option>
                            <option value="5" <?php if ($product['measure'] == 5) echo ' selected="selected"'; ?>>Рулон </option>
                            <option value="6" <?php if ($product['measure'] == 6) echo ' selected="selected"'; ?>>Кассета</option>
                        </select>
                         <br><br>
                         <p>Поставщик</p>
                        <select name="seller_id">
                            <?php if (is_array($sellersList)): ?>
                                <?php foreach ($sellersList as $sellers): ?>
                                    <option value="<?php echo $sellers['id']; ?>" 
                                        <?php if ($product['seller_id'] == $sellers['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $sellers['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br/><br/>
                        
                        <p>Конвертация</p>
                        <select name="convert_t">
                            <option value="<?= $product['convert_t']; ?>" selected="selected"><?php if($product['convert_t'] > 1): echo $product['convert_t'].'/1'; else : echo 'Нет'; endif; ?></option>
                            <?php for($i = 1; $i <= 50; $i++): ?>
                            <option value="<?= $i ; ?>"><?= $i.' к одному';?></option>
                            <?php endfor; ?>
                        </select>
                        <br/><br/>
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                        </select> 
                        <br/><br/>
                        <p>Изображение товара</p>
                        <img src="<?php echo Image::getImage($product['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="">
                        <br/><br/>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/pattern/footer_main.php'; ?>

