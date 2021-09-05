<html>
<head>
    <title>ReadyGrocer</title>
</head>
<body>
    <h3>Dear {{$custOrder->name}}!</h3>
    <p>Please be prepared, your grocery order at <strong>{{$custOrder->shopName}}</strong> will be arriving soon.</p>
    <p>The total amount of your order: <strong>RM {{$custOrder->total_payment}}</strong></p>
    <p>Payment type: <strong>{{$custOrder->payment}}</strong></p>
    <div class="form-group row">
        <p style="font-size: 14px;" class="col-sm-4" style="font-size: 18px;">List of item bought: </p>
        <p style="font-size: 14px;" class="col-sm-8" style="font-size: 18px;">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Brand</th>
                            <th>Quantity</th>
                            <th>Price per unit</th>
                            <th>Total price</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center;">
                        @foreach($listItem as $order)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$order->item_name}} </td>
                                <td> {{$order->item_brand}} </td>
                                <td> {{$order->item_quantity}} </td>
                                @if($order->item_endPromo == NULL)
                                    <td> RM{{$order->item_price}} </td>
                                @endif
                                @if($order->item_endPromo != NULL)
                                    <td> RM{{$order->offer_price}} </td>
                                @endif
                                <td> RM{{$order->total_price}} </td>
                            </tr>    
                        @endforeach        
                    </tbody>
                </table>
            </div>
        </p>
    </div>
    <p>Thank you and have a nice day ahead!</p>
    <br>
    <p>Thanks & Regards,</p>
    <p class="signature">ReadyGrocer</p>
</body>
</html>