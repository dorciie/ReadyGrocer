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
        <br><br>
        <div class="container-fluid">       
            <div class="row"  style="justify-content: center;">
                <div class="card col-md-5 shadow rounded">
                    <br>
                    <div style="text-align: center;">
                        {{-- <h3><a href="/">LOGO</a></h3> --}}
                        <a href="/"> <img src="{{asset('assets/images/default.png')}}" alt="homepage" class="light-logo" width="370" height="100" /></a>
                    </div> 
                    <div ><br> 
                        <h3 class="text-center">Forgot Password</h3><hr>
                        <form action="{{url('customer/forgot_password')}}" method="post">
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="mdi mdi-email"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border border-secondary" name="email" placeholder="Enter Email" aria-label="Email" aria-describedby="basic-addon1" value="{{ old('email') }}">
                                    </div>
                                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-4">
                                    <div class="form-group">
                                        <div>
                                            <button class="btn btn-info">
                                                <a style="color:white;" href="{{ url('customer/custLogin') }}"><i class="mdi mdi-login"></i> Back to Login</a>
                                            </button>
                                            <button type="submit" class="btn btn-success float-end text-white">Send Email</button>
                                        </div>
                                    </div>
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
</html>


{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" href="{{asset('bootstrap-3.4.1-dist/bootstrap-3.4.1-dist/css/bootstrap.min.css')}}">
    </head>
    <body>
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h4>Forgot Password</h4>
                    <hr>
                    <form action="{{url('customer/forgot_password')}}" method="post">
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
                            <input type="text" class="form-control" name="email" placeholder="Enter email">
                            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html> --}}