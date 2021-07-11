<?php include ROOT.'/views/pattern/header_main.php'; ?>
<?php include ROOT.'/views/pattern/slider.php'; ?>
<?php include ROOT.'/views/pattern/menu_main.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if($result): ?>
                <p>Ваш заказ оформлен</p>
                <?php else: ?>
                <p>Ваш заказ не формлен свяжитесь с администратором</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php include ROOT.'/views/pattern/footer_main.php'; ?>