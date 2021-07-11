<?php include(ROOT.'/views/pattern/header_admin.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Добавления нового товара</li>
                </ol>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название товара</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Цена покупки</p>
                        <input type="text" name="price_buy" placeholder="" value="">

                        <p>Цена продажи</p>
                        <input type="text" name="price_sell" placeholder="" value="">
                        
                        <p>Единица измерения</p>
                        <select name="measure">
                            <option value="0" selected="selected">Нет</option>
                            <option value="1">Шт.</option>
                            <option value="2">Блок</option>
                            <option value="3">Упаков.</option>
                            <option value="4">Короб.</option>
                            <option value="5">Рулон</option>
                            <option value="6">Кассета</option>
                        </select>
                        <br/><br/>
                        
                        <p>Поставщик</p>
                        <select name="seller_id">
                            <?php if (is_array($sellersList)): ?>
                                <?php foreach ($sellersList as $sellers): ?>
                                    <option value="<?php echo $sellers['id']; ?>">
                                        <?php echo $sellers['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>
                        <p>Конвертация</p>
                          <select name="convert_t">
                            <option value="1" selected="selected">Нет конвертации</option>
                            <?php for($i = 1; $i < 50; $i++): ?>
                            <option value="<?= $i ; ?>"><?= $i; ?> к одному!</option>
                            <?php endfor; ?>
                         </select>
                        <br/><br/>
   
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыт</option>
                        </select>
                        <br/><br/>
                        
                        <p>Изображение товара</p>
                        <input type="file" name="image" placeholder="" value="">

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        <br/><br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include(ROOT.'/views/pattern/footer_main.php'); ?>