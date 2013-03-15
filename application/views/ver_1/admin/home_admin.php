<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{title}</title>

    <!-- Bootstrap framework -->
    <link rel="stylesheet" href="{assets_url}bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{assets_url}bootstrap/css/bootstrap-responsive.min.css" />
    <!-- jQuery UI theme -->
    <link rel="stylesheet" href="{assets_url}lib/jquery-ui/css/Aristo/Aristo.css" />
    <!-- tooltips-->
    <link rel="stylesheet" href="{assets_url}lib/jBreadcrumbs/css/BreadCrumb.css" />
    <!-- tooltips-->
    <link rel="stylesheet" href="{assets_url}lib/qtip2/jquery.qtip.min.css" />
    <!-- colorbox -->
    <link rel="stylesheet" href="{assets_url}lib/colorbox/colorbox.css" />
    <!-- code prettify -->
    <link rel="stylesheet" href="{assets_url}lib/google-code-prettify/prettify.css" />
    <!-- sticky notifications -->
    <link rel="stylesheet" href="{assets_url}lib/sticky/sticky.css" />
    <!-- aditional icons -->
    <link rel="stylesheet" href="{assets_url}img/splashy/splashy.css" />
    <!-- flags -->
    <link rel="stylesheet" href="{assets_url}img/flags/flags.css" />
    <!-- datatables -->
    <link rel="stylesheet" href="{assets_url}lib/datatables/extras/TableTools/media/css/TableTools.css">


    <!-- main styles -->
    <link rel="stylesheet" href="{assets_url}css/style.css" />
    <!-- theme color-->
    <link rel="stylesheet" href="{assets_url}css/blue.css" id="link_theme" />

    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

    <!-- favicon -->
    <link rel="shortcut icon" href="{assets_url}favicon.ico" />

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{assets_url}css/ie.css" />
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="{assets_url}js/ie/html5.js"></script>
    <script src="{assets_url}js/ie/respond.min.js"></script>
    <script src="{assets_url}lib/flot/excanvas.min.js"></script>
    <![endif]-->
    <script>
        //* hide all elements & show preloader
        //document.documentElement.className += 'jse';
    </script>
</head>
<body>
<!--<div id="loading_layer" style="display:none"><img src="{assets_url}img/ajax_loader.gif" alt="" /></div>-->


<div id="maincontainer" class="clearfix">
<header>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="{base_index}admin"><i class="icon-home icon-white"></i> Sistem Admin <span class="sml_t">1.0</span></a>
            <ul class="nav user_menu pull-right">
                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                <li class="dropdown">
                    <?php $k_name = 'Admin'; if(isset($data_user['nama'])){$k_name = $data_user['nama'];} ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{assets_url}img/user_avatar.png" alt="" class="user_avatar" /><?php echo $k_name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{base_index}admin/karyawan/profile">Edit Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{base_index}admin/user/logout">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav" id="mobile-nav">
                <?php
                $tmn = '';
                foreach($top_menu as $tm){
                    // class="active"
                    $model = $tm['model'].'/';
                    if($model == '/'){
                        $model = '';
                    }
                    $tmn .= '<li><a href="'.base_index().'admin/'.$model.$tm['method'].'">'.$tm['lang_method'].'</a></li>'."\n";
                }
                print($tmn);
                ?>
                <!--
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-white"></i> Components <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?uid=1&amp;page=alerts_btns">Alerts & Buttons</a></li>
                        <li><a href="index.php?uid=1&amp;page=icons">Icons</a></li>
                        <li><a href="index.php?uid=1&amp;page=notifications">Notifications</a></li>
                        <li><a href="index.php?uid=1&amp;page=tables">Tables</a></li>
                        <li><a href="index.php?uid=1&amp;page=tables_more">Tables (more examples)</a></li>
                        <li><a href="index.php?uid=1&amp;page=tabs_accordion">Tabs & Accordion</a></li>
                        <li><a href="index.php?uid=1&amp;page=tooltips">Tooltips, Popovers</a></li>
                        <li><a href="index.php?uid=1&amp;page=typography">Typography</a></li>
                        <li><a href="index.php?uid=1&amp;page=widgets">Widget boxes</a></li>
                        <li class="dropdown">
                            <a href="#">Sub menu <b class="caret-right"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Sub menu 1.1</a></li>
                                <li><a href="#">Sub menu 1.2</a></li>
                                <li><a href="#">Sub menu 1.3</a></li>
                                <li>
                                    <a href="#">Sub menu 1.4 <b class="caret-right"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Sub menu 1.4.1</a></li>
                                        <li><a href="#">Sub menu 1.4.2</a></li>
                                        <li><a href="#">Sub menu 1.4.3</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
-->

                <li>
                </li>
            </ul>
        </div>
    </div>
</div>



</header>






<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            {konten}
        </div>
    </div>
</div>



<script src="{assets_url}js/jquery.min.js"></script>
<script src="{assets_url}js/jquery-migrate.min.js"></script>
<script src="{assets_url}lib/jquery-ui/jquery-ui-1.10.0.custom.min.js"></script>
<!-- touch events for jquery ui-->
<script src="{assets_url}js/forms/jquery.ui.touch-punch.min.js"></script>
<!-- easing plugin -->
<script src="{assets_url}js/jquery.easing.1.3.min.js"></script>
<!-- smart resize event -->
<script src="{assets_url}js/jquery.debouncedresize.min.js"></script>
<!-- js cookie plugin -->
<script src="{assets_url}js/jquery_cookie_min.js"></script>
<!-- main bootstrap js -->
<script src="{assets_url}bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap plugins -->
<script src="{assets_url}js/bootstrap.plugins.min.js"></script>
<!-- code prettifier -->
<script src="{assets_url}lib/google-code-prettify/prettify.min.js"></script>
<!-- sticky messages -->
<script src="{assets_url}lib/sticky/sticky.min.js"></script>
<!-- tooltips -->
<script src="{assets_url}lib/qtip2/jquery.qtip.min.js"></script>
<!-- lightbox -->
<script src="{assets_url}lib/colorbox/jquery.colorbox.min.js"></script>
<!-- jBreadcrumbs -->
<script src="{assets_url}lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
<!-- hidden elements width/height -->
<script src="{assets_url}js/jquery.actual.min.js"></script>
<!-- scroll -->
<script src="{assets_url}lib/antiscroll/antiscroll.min.js"></script>
<script src="{assets_url}lib/antiscroll/jquery-mousewheel.js"></script>
<!-- fix for ios orientation change -->
<script src="{assets_url}js/ios-orientationchange-fix.js"></script>
<!-- to top -->
<script src="{assets_url}lib/UItoTop/jquery.ui.totop.min.js"></script>
<!-- mobile nav -->
<script src="{assets_url}js/selectNav.js"></script>

<!-- common functions -->
<script src="{assets_url}js/gebo_common.js"></script>



<script>
    $(document).ready(function() {
        //* jQuery.browser.mobile (http://detectmobilebrowser.com/)
        //* jQuery.browser.mobile will be true if the browser is a mobile device
        (function(a){jQuery.browser.mobile=/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
        //replace themeforest iframe
        if(jQuery.browser.mobile) {
            if (top !== self) top.location.href = self.location.href;
        }
        //* show all elements & remove preloader
        //setTimeout('$("html").removeClass("js")',1000);

    });
</script>


</div>					</body>
</html>
