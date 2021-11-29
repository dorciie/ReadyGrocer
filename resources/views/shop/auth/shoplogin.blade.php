<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ReadyGrocer</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logodef.png')}}">
        <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{asset('bootstrap-3.4.1-dist/bootstrap-3.4.1-dist/css/bootstrap.min.css')}}"> --}}
    </head>
    <body style="background-color: #eee">
        <br>
        {{-- <div class="ms-auto text-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop login</li>
                </ol>
            </nav>
        </div> --}}
        <br>
        <div class="container-fluid">       
            <div class="row"  style="justify-content: center;">
                <div class="card col-md-5 shadow rounded">
                    <br> 
                    <div style="text-align: center;">
                        {{-- <h3><a href="/">LOGO</a></h3> --}}
                        <a href="/"> <img src="{{asset('assets/images/default.png')}}" alt="homepage" class="light-logo" width="370" height="100" /></a>
                    </div>
                    <div ><br> 
                        <h3 class="text-center">Shop Login</h3><hr>
                        <form action="{{route('shop.auth.check')}}" method="post">
                            @csrf
                            <div class="results">
                                @if(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {!!Session::get('fail')!!}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col p-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border border-secondary" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="{{ old('email') }}"> 
                                    </div>
                                    <span class="text-danger">@error('email'){{ $message }} @enderror</span><br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                        </div>
                                        <input id="myInput" type="password" class="form-control form-control-lg border border-secondary" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" >
                                    </div><h6></h6>
                                    &nbsp&nbsp&nbsp&nbsp<input type="checkbox" onclick="myFunction()">&nbspShow Password<br>
                                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-4">
                                    <div class="form-group">
                                        <div>
                                            <button class="btn btn-info">
                                                <a style="color:white;" href="{{url('shop/shopforgot_password')}}"><i class="fa fa-lock me-1"></i>Forgot Password?</a>
                                            </button>
                                            <button type="submit" class="btn btn-success float-end text-white">Login</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-info">
                                        <a style="color:white;" href="{{route('registerShop')}}">Create a new Account</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction() {
              var x = document.getElementById("myInput");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            </script>
            <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
            <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>

{{-- <!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Shop Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logoRG.png')}}">
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 

</head>
<body>
    <div class="container bg-dark">
        <div style=" text-align: center;">
            <br>
            <h3><a href="/"><i class="mdi mdi-home"></i>&nbspHome</a></h3>
        </div> 
        <!-- Preloader - style you can find in spinners.css -->
        {{-- <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>  
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center pt-3 pb-3">
                        <span class="db"><img src="{{asset('assets/images/logo.png')}}" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form action="{{route('shop.auth.check')}}" method="post">
                        @csrf
                        <div class="results">
                            @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>
                            @endif
                            @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{Session::get('fail')}}
                                </div>
                            @endif
                        </div>
                        <div class="row pb-4">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" value="{{ old('email') }}">
                                    
                                </div>
                                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" >
                                    
                                </div>
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3">
                                        <button class="btn btn-info">
                                            <a style="color:white;" href="{{url('shop/shopforgot_password')}}"><i class="fa fa-lock me-1"></i>Forgot Password?</a>
                                        </button>
                                        <button type="submit" class="btn btn-success float-end text-white">Login</button>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-info">
                                    <a style="color:white;" href="{{route('registerShop')}}">Create a new Account</a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html> --}}