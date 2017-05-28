<div class="col-md-8 col-md-offset-2" >

<div class="panel panel-default">
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item"><div style="width:100px;height:100px;border-radius:50%;background-color:gray;"></div><span style='float:right;margin-top:-50px'> <?php echo $data['user_login'] ;?> Welcome To Your Dashboard</br>Current Level: <span class='badge'>Level <?php echo $data['user_level'] ?></span></span></li>
            <li class="list-group-item">Your E-wallet Amount : &#8358;<?php echo $data['user_amt'];?> </li>
            <li class="list-group-item"><a href="javascript:void" class='btn btn-info btn-block'>Withdrawl Wallet Amount</a></li>
            <li class="list-group-item"><a href="javascript:void" class='btn btn-primary btn-block'>Contact Support</a></li>
        </ul>
    </div>
</div>
</div>

