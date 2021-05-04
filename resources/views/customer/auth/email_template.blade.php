<h1>Hello {{$customer->name}}</h1>
<p>
    Please click the password reset button to reset your password
    <a href="{{url('customer/reset_password/'.$customer->email)}}">Reset password</a>
</p>