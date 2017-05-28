<?php 
session_start();
if(isset($_GET['Register']) && $_GET['Register'] === "successful" ){
  echo "<h2 class='text-success'>Your Registration Was Successful</h2><hr>";
}


//var_export($_SESSION);
?>


<form  method="POST" action="https://voguepay.com/pay/">
<p>To Complete Your Registration And Be Able To log in to your dashboard, You are to pay the sum of &#8358;5,000.00 Only.</p>
<h3 class='text-dark'> Please Choose A Payment Method To Get Started </h3>
<label> <input type="radio" name="payment_method" value="debit_card" id="debit_card"> Payment Via Debit Card </label>
<label> <input type="radio" name="payment_method" value="bank_payment" id="bank_payment"> Payment To The Bank </label>

<div id="payment_info">
<div class="well bg-info" style="border-radius:0px">
<h3 class="text-royal">Bank Payment Instructions</h3>
<p>Please The Sum Of &#8358;5,000 To The Account Details Below: </p>
<p>Account Name : RIQUEZZA </p>
<p>Account Number: 0098338482 </p>
<p>Bank Name: GTB </p>
<small class="text-info"><p>After Payment Send Payment Details To : payments@riquezza.com</p></small>
</div>
</div>

<!--  6539-0051817 -->

<input type='hidden' name='v_merchant_id' value='demo' />
<input type='hidden' name='merchant_ref' value='<?php echo rand(630039939,9993030).'|'.$_SESSION['cur_donator'];?>' />
<input type='hidden' name='memo' value=' RIQUEZZA Registration Donation Payment' />

<input type='hidden' name='notify_url' value='<?php echo home_url('login');?>' />
<input type='hidden' name='success_url' value='<?php echo home_url('login');?>' />
<input type='hidden' name='fail_url' value='<?php echo home_url('login');?>' />
<input type='hidden' name='meta' value='<?php $_SESSION['cur_donator'];?>' />


<input type='hidden' name='cur' value='NGN' />

<input type='hidden' name='total' value='5000' />

<div class='form-group' style="padding-top:20px;padding-bottom:60px;margin-left:-20px!important">
    <div class="col-md-6">
         <input type="submit" class="form-control" name="proceed_payment" id="payment" value="Proceed To Payment" >
    </div>
   
</div>

</form>


