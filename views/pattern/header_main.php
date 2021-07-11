<?php if(!User::isAdmin()): ?>
<?php header("Location:/");?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SOODA.biz.kg Company</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
	<link href="/template/css/responsive.css" rel="stylesheet">   
	<link href="/template/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head>

<body>
	<header id="header">
		<div class="header_top fixed shadow">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0772 09 20 08</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@sooda.biz.kg</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
                        <div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                                <?php if(User::isGuest()): ?>
                                <li><a href="/admin/"> АДМИН</a></li>
                                <li><a href="/cart/"><i class="fa fa-shopping-cart"></i> Корзина <span id="cart"><?php echo Cart::getTotal(); ?> сом</span></a></li>
								<li><a href="/user/register/"><i class="fa fa-user"></i> Регистрация</a></li>
                                <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                <?php else: ?>
                                <li><a href="#"><?php echo User::getUserName(); ?></a></li>
                                <li><a href="/admin/"> АДМИН</a></li>
                                <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
								<li><a href="/cart/"><i class="fa fa-shopping-cart"></i> Корзина<span id="cart"><?php echo Cart::getTotal(); ?> сом</span></a></li>
                                <?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
    