

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>403</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- page specific plugin styles -->
   
    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.default.css') }}" />
    
    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->
    <!--[if !IE]> -->
    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

    <!-- <![endif]-->

    <!--[if IE]>
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <![endif]-->


</head>

<body class="no-skin">

<div class="main-container ace-save-state" id="main-container">
    <div class="main-content">
        <div class="main-content-inner">
                <div class="page-content">

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->

                            <div class="error-container">
                                <div class="well">
                                    <h1 class="grey lighter smaller">
                                                <span class="blue bigger-125">
                                                    <i class="ace-icon fa fa-sitemap"></i>
                                                    403
                                                </span>

                                    </h1>

                                    <hr />
                                    <h3 class="lighter smaller">您没有权限</h3>



                                    <hr />
                                    <div class="space"></div>

                                    <div class="center">
                                        <a href="javascript:history.back()" class="btn btn-grey">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            Go Back
                                        </a>

                                    </div>
                                </div>
                            </div>

                            <!-- PAGE CONTENT ENDS -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->

            
        </div>
    </div>
</div><!-- /.main-container -->


    <!-- basic scripts -->

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="{{ asset('assets/js/excanvas.min.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sparkline.index.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookies.js') }}"></script>

    <!-- ace scripts -->
    <script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('assets/js/ace.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>

