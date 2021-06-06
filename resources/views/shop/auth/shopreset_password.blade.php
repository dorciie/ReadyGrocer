<!DOCTYPE html>
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
                    {{-- ni amik method from controller - web.php --}}
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
</html>