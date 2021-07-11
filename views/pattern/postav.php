<?php if(!User::isAdmin() && !Seller::isPostav()): ?>
<?php header("Location:/postav/nazira");?>
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
                            <div class="col-sm-6 offset-col-sm-3">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><p class="seller_name" id="<?= $postav['id']; ?>"> <?php echo $postav['name']; ?></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </header>
      </div>
