
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="{assets_url}css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="{assets_url}css/bootstrap-responsive.css" rel="stylesheet">
    <script src="{assets_url}js/jquery-1.8.1.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="{base_url}assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{assets_url}ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{assets_url}ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{assets_url}ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="{assets_url}ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="{assets_url}ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="{base_url}">Guest Home</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <?php
                $tmn = '';
                foreach($top_menu as $tm){
                    // class="active"
                    $model = $tm['model'].'/';
                    if($model == '/'){
                        $model = '';
                    }
                    $tmn .= '<li><a href="'.base_index().$model.$tm['method'].'">'.$tm['lang_method'].'</a></li>'."\n";
                }
                print($tmn);
                ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      {konten}

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="{assets_url}js/bootstrap.js"></script>

  </body>
</html>
