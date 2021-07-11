<?php include ROOT.'/views/pattern/header_admin.php'; ?>
<section>
    <div class="container">
        <div class="row">
            <br/>
            <h4>Добрый день, администратор!</h4>
            <br/>
            <p>Вам доступны такие возможности:</p>
            <br/>
            <ul>
                <li class="ad_min"><a href="/admin/item/1">Управление товарами</a></li>
                <li class="ad_min"><a href="/admin/category">Управление категориями</a></li>
                <li class="ad_min"><a href="/admin/order">Управление заказами</a></li>
                <li class="ad_min"><a href="/admin/user">Управление клиентами </a></li>
                <li class="ad_min"><a href="/admin/seller">Управление поставщиками </a></li>
                <li class="ad_min"><a href="/admin/region">Управление регионами </a></li>
<!--                <li class="ad_min"><a href="/admin/calling">Управление звонками </a></li>-->
                <li class="ad_min"><a href="/party/stat">Статистика заказов</a></li>
                <li class="ad_min"><a href="/admin/stat/items">Статистика товары </a></li>
                <li class="ad_min"><a href="/admin/stat/user">Статистика магазины </a></li>
                <li class="ad_min"><a href="#">Статистика расходы </a></li>
                <li class="ad_min"><a href="#">Статистика водители </a></li>
                <li class="ad_min"><a href="#">Статистика поставщики </a></li>
            </ul>
            <br/>            
            <p>Выбрать район для работы: </p>
                <ul>
                <?php foreach($regionList as $region): ?>
                    <li class="ad_min <?php if($region['id'] == $_SESSION['region']): echo 'sup_active'; endif; ?> ?>">
                        <a href="/admin/region/<?php echo $region['id']; ?>">
                            <?php echo $region['name']; ?>
                        </a>
                    </li> 
                <?php endforeach; ?>
                </ul>
            
        </div>
    </div>
</section>
<?php include(ROOT.'/views/pattern/footer_main.php'); ?>