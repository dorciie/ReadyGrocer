<!DOCTYPE html>
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
                                    {!!Session::get('fail')!!}
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
</html>