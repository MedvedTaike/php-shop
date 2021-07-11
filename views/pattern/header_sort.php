<?php if(!User::isAdmin()): ?>
<?php header("Location:/");?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOODA.biz.kg Company</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
	<link href="/template/css/responsive.css" rel="stylesheet">   
	<link href="/template/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head>  
<body>     
      <div class="page-wrapper">
            <header id="header">
                <div class="header_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="contactinfo">
                                </div>
                            </div>
                            <div class="col-sm-6 offset-col-sm-3">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="/category/1" class="no_background"><i class="fa fa-sign-out "></i>На сайт</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </header>
      </div>
<section class="push_top_more">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="/admin/">Админ панель</a></li>
                        <li><a href="/admin/item/<?php echo $id; ?>">Управление товарами</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <button class="save btn btn-success">Сохранить сортировку</button>
        <br><br>
    </div>
</section>