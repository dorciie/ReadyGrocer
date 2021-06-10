{{-- <h1>Dear {{$customer->name}}!</h1>
<p>
    Your grocery order at --shop_name-- is on the way. 
    The total amount of your order: RM500.00
</p> --}}

<html>
<head>
    <title>ReadyGrocer</title>
</head>
<body>
    <h1>Dear {{$customer->name}}!</h1>
    <p>Please be preapred, your grocery order at --shop_name-- is on the way. The estimated time of arrival for your groceries is within 15 to 30 minutes. </p>
    <p>The total amount of your order: RM500.00</p>
    <br><br>
    <p>Thank you and have a nice day ahead! :)</p>
</body>
</html>