<?php include ROOT.'/views/pattern/header_main.php'; ?>
<?php include ROOT.'/views/pattern/menu_main.php'; ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="features_items">
                        <h2 class="title text-center">Товары по брендам</h2>
                            <?php foreach($manProduct as $product): ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/images/<?php echo $product['id']; ?>.jpg" />
                                            <h2><?php echo $product['price_sell']; ?> сом</h2>
                                            <p><?php echo $product['name']; ?></p>
                                            <div class="cart_buttonchik">
						                        <input type="button" class="plus" value="+">
						                        <input class="dobavit_input" type="text" size="2" >
						                        <input type="button" class="minus" value="-">                                                               
					                        </div>
                                            <input type="button" class="add_on_tovar" value="Добавить" id="<?php echo $product['id']; ?>">
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
<?php include ROOT.'/views/pattern/footer_main.php'; ?>