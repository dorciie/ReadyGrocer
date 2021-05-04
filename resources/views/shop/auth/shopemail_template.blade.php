<h1>Hello {{$shopOwner->name}}</h1>
<p>
    Please click the password reset button to reset your password
    <a href="{{url('shop/shopreset_password/'.$shopOwner->email)}}">Reset password</a>
</p>