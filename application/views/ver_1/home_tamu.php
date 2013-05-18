<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- styles -->
    <link href="{assets_url}css/bootstrap.css" rel="stylesheet">
    <link href="{assets_url}css/bootstrap-responsive.css" rel="stylesheet">
    <link href="{assets_url}css/docs.css" rel="stylesheet">
    <link href="{assets_url}js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="stylesheet" href="{assets_url}css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    	<link rel="stylesheet" type="text/css" href="{assets_url}css/ie.css" />
    <![endif]-->
    <!-- fav and touch icons -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <link rel="shortcut icon" href="{assets_url}ico/favicon.ico">
    <link rel="apple-touch-icon" href="{assets_url}ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{assets_url}ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{assets_url}ico/apple-touch-icon-114x114.png">
    <!--GOOGLE FONTS- ->
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700,400italic,700italic|Doppio+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Bowlby+One+SC' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Days+One|Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Exo:800' rel='stylesheet' type='text/css'>
    <!--/GOOGLE FONTS-->
    <script>var assets_url = '{assets_url}'; base_index = '<?php echo base_index(); ?>';</script>
</head>
<body>
<!--TOP-->
<div class="top_line"></div>
<div class="panel hidden-phone">
    <div id="map">
    </div>
</div>
<!--/TOP-->
<!--HEADER-->
<header>
    <div class="container">
        <div class="row hidden-phone">
            <img class="flip" src="{assets_url}img/panel.jpg" style="float: right;"/><span class="header_social">Follow us on <span class="badge"><a href="#">Twitter</a></span> and <span class="badge"><a href="#">Facebook</a></span></span>
        </div>
        <div class="row">
            <div class="span4 logo">
                <a href="index.html"><img src="{assets_url}img/logo.png" alt="logo" style="margin-bottom:7px; margin-top:7px;" /></a>
            </div>
            <div class="span8">
                <nav id="main-nav">
                    <ul id="menu">
                        <?php
                        function set_menu($menu){
                            $tmn = '';
                            foreach($menu as $tm){
                                // class="active"
                                $model = $tm['model'].'/';
                                if($model == '/'){
                                    $model = '';
                                }
                                $str = '<li><a href="'.base_index().''.$model.$tm['method'].'">'.$tm['lang_method'].'</a>';
                                if(count($tm['child']) > 0){
                                    $str .= '<ul>';
                                    $str .= set_menu($tm['child']);
                                    $str .= '</ul>';
                                }
                                $str .= '</li>';
                                $tmn .= $str;
                            }

                            return $tmn;
                        }
                        print(set_menu($top_menu));


                        ?>
                    </ul>
                </nav><!-- end #main-nav -->
            </div>
        </div>
    </div>
</header>
<!--/HEADER-->
<!--SLIDER AREA-->
{slider}
<!--/SLIDER AREA-->
<!--MAIN CONTENT AREA-->
<div class="container inner_content">
    <div class="row">

        <!--Sidebar-->
        {sidebar}
        <!--/Sidebar-->
        <!--Page contetn-->
        {konten}
        <!--/Page contetn-->

    </div>
</div>
<!--/MAIN CONTENT AREA-->
<!--TWITTER AREA-->
<div class="twitter-block">
    <div class="container">
        <div class="row">
            <div class="span3 header">
                <h5><span class="colored">///</span> Our Twitter Feed</h5>
                <p>Find out what's happening, right now, with the people and organizations you care about.</p>
            </div>
            <div class="span9">
                <div class="well">
                    <img class="twit_img" src="{assets_url}img/twitter.png" alt="Visit link" />
                    <div id="jstwitter" class="clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/TWITTER AREA-->
<!--FOOTER-->
<footer>
    <div class="container">
        <div class="row">
            <div class="span3">
                <img src="{assets_url}img/logo-footer.png" alt="logo" style="margin-bottom:7px; margin-top:7px;" />
                <hr class="visible-phone">
            </div>
            <div class="span3">
                <h5><span class="colored">///</span> Valera Company</h5>
                <p>Valera is designed to help people of all skill levels designer or developer, huge nerd or early beginner. Use it as a complete kit or use to start something more complex.</p>
                <hr class="visible-phone">
            </div>
            <div class="span3 flickr">
                <h5><span class="colored">///</span> Contact info</h5>
                <span><strong class="colored"> Aress:</strong> 123456 Street Name, Los Angeles</span>
                <hr class=" hidden-phone"><br class="visible-phone">
                <span><strong class="colored">Phone:</strong> (1800) 765-4321</span>
                <hr class="visible-phone">
            </div>
            <div class="span3 soc_icons">
                <h5><span class="colored">///</span> Stay in touch</h5>
                <span>Find out what's happening:</span>
                <hr>
                <a href="#"><div class="icon_t"></div></a>
                <a href="#"><div class="icon_facebook"></div></a>
                <a href="#"><div class="icon_dribbble"></div></a>
                <a href="#"><div class="icon_google"></div></a>
                <a href="#"><div class="icon_in"></div></a>
                <a href="#"><div class="icon_flickr"></div></a>
            </div>
        </div>
    </div>
</footer>
<!--/FOOTER-->
<!--BOTTOM LINE-->
<div class="bottom-block">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <span>Copyright 2012 Valera - Company. Design by <span class="undercolored"><a href="#">OrangeIde</a></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/BOTTOM LINE-->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>-->
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script src="{assets_url}js/google-code-prettify/prettify.js"></script>
<script src="{assets_url}js/bootstrap-transition.js"></script>
<script src="{assets_url}js/bootstrap-alert.js"></script>
<script src="{assets_url}js/bootstrap-modal.js"></script>
<script src="{assets_url}js/bootstrap-dropdown.js"></script>
<script src="{assets_url}js/bootstrap-scrollspy.js"></script>
<script src="{assets_url}js/bootstrap-tab.js"></script>
<script src="{assets_url}js/bootstrap-tooltip.js"></script>
<script src="{assets_url}js/bootstrap-popover.js"></script>
<script src="{assets_url}js/bootstrap-button.js"></script>
<script src="{assets_url}js/bootstrap-collapse.js"></script>
<script src="{assets_url}js/bootstrap-carousel.js"></script>
<script src="{assets_url}js/bootstrap-typeahead.js"></script>
<script src="{assets_url}js/jquery.easing.1.3.js"></script>
<script src="{assets_url}js/jquery.slabtext.min.js"></script>
<script src="{assets_url}js/jquery.flexslider-min.js"></script>
<script src="{assets_url}js/superfish-menu/superfish.js"></script>
<script src="{assets_url}js/plugin.js"></script>
<script src="{assets_url}js/jquery.prettyPhoto.js"></script>
<script src="{assets_url}js/twitter.js"></script>
<!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="{assets_url}js/jquery.gmap.min.js"></script>-->
<script src="{assets_url}js/jquery.preloader.js"></script>
<script src="{assets_url}js/custom.js"></script>
<script type="text/javascript">var runFancy = false;</script>
<!--[if IE]>
<script type="text/javascript">
    runFancy = false;
</script>
<![endif]-->
<script type="text/javascript">
    if (runFancy) {
        jQuery.noConflict()(function($){
            $(".view").preloader();
            $(".flexslider").preloader();
        });
    }
</script>
</body>
</html>