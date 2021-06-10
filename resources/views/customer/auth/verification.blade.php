<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Verify Email</title>
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
                    <h4>Verify Email</h4>
                    <hr>
                    
                        @csrf
                        <div class="results">
                        @if(!empty($success))
                                <div class="alert alert-success">
                                {{$success}}
                                        </div>
                            @endif
                            <div>
                            <a href="">Resend Verification email</a>
                            </div>
                                
                        </div>
                        
                </div>
            </div>
        </div>
    </body>
</html>