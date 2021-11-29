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
                        <h3 class="text-center">Customer Login</h3><hr>
                        <form action="{{route('auth.check')}}" method="post">
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
                                                <a style="color:white;" href="{{url('customer/forgot_password')}}"><i class="fa fa-lock me-1"></i>Forgot Password?</a>
                                            </button>
                                            <button type="submit" class="btn btn-success float-end text-white">Login</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-info">
                                        <a style="color:white;" href="{{route('register.create')}}">Create a new Account</a>
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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logoRG.png')}}">

        <link rel="stylesheet" href="{{asset('bootstrap-3.4.1-dist/bootstrap-3.4.1-dist/css/bootstrap.min.css')}}">
    </head>
    <body>
        <br><br>
        <div style=" text-align: center;">
            <h3><a href="/">Home</a></h3>
        </div>
        <br><br>
        <div class="container">
            
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h4>Customer Login</h4>
                    <hr>
                    <form action="{{route('auth.check')}}" method="post">
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
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label class="label-agree-term">
                                <a href="{{url('customer/forgot_password')}}">Forgot Password</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </div>
                        <br>
                        <a href="{{route('register.create')}}">Create a new Account</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> --}}