<section class="push_top_more">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="/admin/">Админ панель</a></li>
                        <li><a href="/admin/sort/list/<?php echo $id; ?>">Сорт. списком</a></li>
                        <li><a href="/admin/sort/photo/<?php echo $id; ?>">Сорт. фото</a></li>
                        <li class="dropdown"><a href="#">Категории товаров<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <?php foreach($catList as $cat): ?>
                                <?php if($cat['id'] != $id): ?>
                                <li><a href="/admin/item/<?php echo $cat['id']; ?>">
                                    <?php echo $cat['name']; ?>
                                    </a>
                                </li> 
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="/admin/item/create" class="btn btn-default add_button"><i class="fa fa-plus"></i> Добавить товар</a>
    </div>
</section>