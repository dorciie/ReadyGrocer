<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Profile Page</title>
        <link rel="stylesheet" href="{{asset('bootstrap-3.4.1-dist/bootstrap-3.4.1-dist/css/bootstrap.min.css')}}">
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top:45px">
                <div class="col-md-6 col-md-offset-3">
                    <h4>Profile page</h4>
                    <hr>
                    <table class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Logout</th>
                        </thead>
                        <tbody>
                            <td>{{$LoggedShopInfo->name}}</td>
                            <td>{{$LoggedShopInfo->email}}</td>
                            <td><a href="shoplogout">Logout</a></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>