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
                        <h3 class="text-center">Reset password</h3><hr>
                        {{-- <h4>{{$shopOwner->email}}</h4> --}}
                        <form action="{{ url('shop/shopreset_password/'.$shopOwner->email) }}" method="post">
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
                            <div class="row pb-2">
                                <div class="col p-4">
                                    <div class="form-group" hidden>
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$shopOwner->email}}">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white h-100" id="basic-addon1"><i class="mdi mdi-key"></i></span>
                                        </div>
                                        <input id="myInput1" type="password" class="form-control form-control-lg border border-secondary" name="password" placeholder="Enter password">
                                        {{-- <input type="text" class="form-control form-control-lg border border-secondary" name="email" placeholder="Enter Email" aria-label="Email" aria-describedby="basic-addon1" value="{{ old('email') }}"> --}}
                                    </div><h6></h6>
                                    &nbsp&nbsp&nbsp&nbsp<input type="checkbox" onclick="myFunction1()">&nbspShow Password<br>
                                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white h-100" id="basic-addon1"><i class="mdi mdi-key-change"></i></span>
                                        </div>
                                        {{-- <input type="text" class="form-control form-control-lg border border-secondary" name="email" placeholder="Enter Email" aria-label="Email" aria-describedby="basic-addon1" value="{{ old('email') }}">    --}}
                                        <input id="myInput2" type="password" class="form-control form-control-lg border border-secondary" name="password_confirm" placeholder="Confirm password"> 
                                    </div><h6></h6>
                                    &nbsp&nbsp&nbsp&nbsp<input type="checkbox" onclick="myFunction2()">&nbspShow Password<br>
                                    <span class="text-danger">@error('password_confirm'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-4">
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-success float-end text-white">Reset Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myFunction1() {
              var x = document.getElementById("myInput1");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
            </script>
            <script>
                function myFunction2() {
                var x = document.getElementById("myInput2");
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
        <title>Reset password</title>
        <link rel="stylesheet" href="{{asset('bootstrap-3.4.1-dist/bootstrap-3.4.1-dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h4>Reset Password</h4>
                    <h4>{{$shopOwner->email}}</h4>
                    <hr>
                    {{-- ni amik method from controller - web.php 
                    <form action="{{ url('shop/shopreset_password/'.$shopOwner->email) }}" method="post">
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
                        <div class="form-group" hidden>
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{{$shopOwner->email}}">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirm" placeholder="Enter password">
                            <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Reset Password</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> --}}