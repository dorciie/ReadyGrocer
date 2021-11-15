<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="">

        <title>ReadyGrocer</title>
        
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logodef.png')}}">
        <link href="{{ asset('mainPage/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ asset('mainPage/css/style.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
    </head>
    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <!-- HEADER =============================-->
        <header class="item header margin-top-0">
        <div class="wrapper">
            <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    {{-- <a href="/" class="navbar-brand brand"> LOGO </a> --}}
                    <a href="/"> <img src="{{asset('assets/images/default.png')}}" alt="homepage" class="light-logo" width="200" height="50" /></a>
                </div>
                <div id="navbar-collapse-02" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        {{-- <li class="propClone"><a href="/">Home</a></li> --}}
                        <li class="propClone"><a href="{{ url('/shop/shoplogin') }}">Login as Shop owner</a></li>
                        <li class="propClone"><a href="{{ url('/customer/custLogin') }}">Login as Customer</a></li>
                    </ul>
                    
                    {{-- @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                    @endif --}}
                </div>
            </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="text-homeimage">
                            <div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
                                 Increase Digital Sales
                            </div>
                            <div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.3s">
                                 Get better experience
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </header>
        
        
        <!-- STEPS =============================-->
        <div class="item content">
            <div class="container toparea">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="col editContent">
                            <span class="numberstep"><i class="fa fa-shopping-cart"></i></span>
                            <h3 class="numbertext">Save Your Time</h3>
                            <p>
                                 Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                            </p>
                        </div>
                        <!-- /.col-md-4 -->
                    </div>
                    <!-- /.col-md-4 col -->
                    <div class="col-md-4 editContent">
                        <div class="col">
                            <span class="numberstep"><i class="fa fa-check-square-o"></i></span>
                            <h3 class="numbertext">Delivery your grocery</h3>
                            <p>
                                 Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                            </p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.col-md-4 col -->
                    <div class="col-md-4 editContent">
                        <div class="col">
                            <span class="numberstep"><i class="fa fa-calendar-check-o "></i></span>
                            <h3 class="numbertext">Planning what to buy</h3>
                            <p>
                                 Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- FOOTER =============================-->
        <div class="footer text-center">
            <div class="container">
                <div class="row">
                    <p class="footernote">
                         Smart Grocery Management System
                    </p>
                </div>
            </div>
        </div>
        
        <!-- SCRIPTS =============================-->
        <script src="{{ asset('mainPage/js/jquery-.js') }}"></script>
        <script src="{{ asset('mainPage/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('mainPage/js/anim.js') }}"></script>
        <script>
        //----HOVER CAPTION---//	  
        jQuery(document).ready(function ($) {
            $('.fadeshop').hover(
                function(){
                    $(this).find('.captionshop').fadeIn(150);
                },
                function(){
                    $(this).find('.captionshop').fadeOut(150);
                }
            );
        });
        </script>
        </body>
</html>


