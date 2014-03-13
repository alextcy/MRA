<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$headTitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset='utf-8'> 
    
    <!-- Le styles -->
    <!-- Bootstrap -->
    <link href="/templates/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/templates/css/main.css" rel="stylesheet" media="screen">
    <?php /*<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,600,600italic,400|Open+Sans+Condensed:300,700|Fjalla+One' rel='stylesheet' type='text/css'>*/?>

    <script src="/templates/js/jquery-min.js"></script>
    <script src="/templates/js/bootstrap.min.js"></script>
    <script src="/templates/js/main.js"></script>
    
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      
    </style>
    <?php /*<link href="/templates/css/bootstrap-responsive.css" rel="stylesheet">*/ ?>
        
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="/">Mra</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <?php /*Logged in as <a href="#" class="navbar-link">Username</a>*/ ?>
            </p>
            <ul class="nav">
              <?php /*<li class="active"><a href="#">Home</a></li>*/ ?>
              <?php /*<li><a href="#about">About</a></li>*/ ?>
              <?php /*<li><a href="#contact">Contact</a></li>*/ ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <?php /* <div class="container-fluid">*/?>
    <div class="container">    
      <div class="row-fluid">

        <?php /*  
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              
              <li class="nav-header">Темы</li>
              
              <li><a href="/subjects">Дерево тематик</a></li>
              <li><a href="/files">Файлы шаблонов</a></li>
              <li class="nav-header">Домены</li>
              <li><a href="/domains">Список доменов</a></li>
              <li><a href="/generator">Генератор доменов</a></li>
              <li><a href="/domains/redirect">Редирект доменов</a></li>
              <li class="nav-header">Регистраторы</li>
              <li><a href="/registrars">Список регистраторов</a></li>
              

              <li class="active"><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        */ ?>

        <div class="span12">

            
            <?=$content?>
            
          
          <?php /*
          <div class="row-fluid">
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          */ ?>
          

        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Mra 2013</p>
      </footer>

    </div><!--/.fluid-container-->

    
  </body>
</html>