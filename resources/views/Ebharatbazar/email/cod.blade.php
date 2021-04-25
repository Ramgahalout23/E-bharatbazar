<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirmation Email</title>
</head>
<body>
    <div style="border-top-left-radius: 3px; border-top-right-radius: 3px; padding: 10px 15px; background-color: #428bca; border-color: #428bca; color: #fff" class="v1panel-heading">
        You Have Mail Recieved from E-Bharatbazar Website
         </div>
         
    <table>
       
    <tr><td>Hello,{{$name}}</td></tr> 
    <tr> <td>Thank you for shopping with us. Your Order Details are follows</td> </tr>
    <tr><td><h1>Order No : {{$order}}</h1></td>  </tr>
    </table>   
    <table width="100%" cellpadding="5" cellspacing="5" border="1px">
       
            <tr>
                <td>Product Name</td>
                <td>Product Code</td>
                <td>Size</td>
                <td>Color</td>
                <td>Quantity</td>
                <td>Unit Price</td>
                <td>Total Price</td>
            </tr>
   @foreach($productDetail['orders'] as $prod)
            <tr>
                <td>{{$prod['product_name']}}</td>
                <td>{{$prod['product_code']}}</td>
                <td>{{$prod['product_size']}}</td>
                <td>{{$prod['product_color']}}</td>
                <td>{{$prod['product_qty']}}</td>
                <td>Rs.{{$prod['product_price']}}</td>
                
                <?php
                $total_price =0;
                $total_price = ($prod['product_qty'])*($prod['product_price']);
                ?>
                <td>
                    Rs.{{$total_price}}
                </td>
            </tr>
          @endforeach
            <tr>
                <td colspan="6" align="right"><strong>Shipping Charges (+)</strong></td>  <td>  Rs.{{$productDetail['shipping_charges']}}</td>
            </tr>
            <tr>
                <td colspan="6" align="right"><strong>Coupon Discount (-) </strong></td>  <td>Rs.{{$productDetail['coupon_amount']}}</td>
            </tr>
            <tr>
                <td colspan="6" align="right"><strong>Grand Total</td>  </strong><td>Rs. {{$productDetail['grand_total']}}</td>
            </tr>
    </table>
    <h4>Yours Billing & Shipping Address are as follows</h4> <br>
       
       <div class="billto" style="width:50%;float:left">
        <b>Billing Address</b> <br><br>
           <strong>Name : </strong>{{$userDetails['name']}}<br>
           <strong>Address : </strong>{{$userDetails['address']}}<br>
           <strong>City : </strong>{{$userDetails['city']}}<br>
           <strong>Country : </strong>{{$userDetails['country']}}<br>
           <strong>Mobile : </strong>{{$userDetails['mobile']}} <br>
       </div>
       
       <div class="shipto" style="width:50%;float: right;">
        <b>Shipping Address</b> <br><br>
        <strong>Name : </strong>{{$userDetails['name']}}<br>
           <strong>Address : </strong>{{$userDetails['address']}}<br>
           <strong>City : </strong>{{$userDetails['city']}}<br>
           <strong>Country : </strong>{{$userDetails['country']}}<br>
           <strong>Mobile : </strong>{{$userDetails['mobile']}} <br>
    </div><br><br><br><br>

   <div>
   <br>
    <p>Note : If you need any query regarding this email plz feel free to contact us <a href="mailto:info@Ebharatbazar.com">info@Ebharatbazar.com</a></p>
    <br>
    <b>Regards</b> <br>
    E-Bharatbazar Team
   </div>
</body>
</html>