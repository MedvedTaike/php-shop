<section class="push_top_more">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="/index/">Главная</a></li>
							<li class="dropdown"><a href="#">Товары по категориям<i class="fa fa-angle-down"></i></a>
                                   <ul role="menu" class="sub-menu">
                                       <?php foreach($catList as $category): ?>
                                       <li><a href="/category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li> 
                                       <?php endforeach; ?>
                                   </ul>
                               </li>
                            <li><a href="/list/category/1">Список товаров</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<form action="#" class="searchform">
				           <input type="text" placeholder="Поиск товара" />
				           <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
				       </form>
				</div>
			</div>
		</div>
    </section>