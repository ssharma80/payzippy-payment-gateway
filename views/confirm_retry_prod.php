<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
                <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/custom.css"/>		
	</head>

	<body>
		
		<nav class="navbar">
			<div class="container">
				<div class="navbar-right">
                                    <div class="container minicart">
                                        <br/>
                                        <!--<div class="row">-->
                                            <div id ="store" class="span6 offset5"
                                                <a class="navbar-brand" href="#"><h1>Retry Payment Request</h1></a>
                                            </div>
                                            <!--</div>-->
                                    </div>
                                        
				</div>
                            
			</div>
		</nav>
		<div class="bigcart span3"></div>
		<div class="container text-center">
                    <!--<div id ="retry_form">----------------Dynamic-------</div>-->
			<div id="head-retry" class="col-md-7 col-sm-12">
				
				<!--<h1>Retry Payment Request</h1>-->
				<p>
                                    <h3>Sorry ! Your previous payment was unsuccessfull at the Payzippy gateway.</h3>
                                    <strong>We can try once again to complete the payment, would you like to try again ? 
                                        (Don't worry your card will not be charged twice)</strong>
				</p>
			</div>
			
			<!--<div id="table-retry" class="col-md-7 col-sm-12 text-left">-->
			<div id="table-retry" class="table-striped">
				<ul>
					<li class="row">
						<span class="itemName">Payment Transaction ID</span>
						<span class="price"><?=$resp_data['merchant_transaction_id']?></span>
					</li>
					<li class="row">
						<span class="itemName">Payment Currency</span>
						<span class="price"><?=$resp_data['transaction_currency']?></span>
					</li>
					<li class="row">
						<span class="itemName">Payment Amount</span>
						<span class="price"><?=$resp_data['transaction_amount']/100?></span>
					</li>
					<li class="row">
						<span class="itemName">Payment Status</span>
						<span class="price"><?=$resp_data['transaction_status']?></span>
					</li>
					<li class="row">
						<span class="itemName">Payment Gateway Response</span>
						<span class="price"><?=$resp_data['transaction_response_message']?></span>
					</li>
				</ul>
			</div>
			<hr class="soften">
			<div id="button-retry" class="btn-group">
				<button id = "confirm_retry" class="btn btn-success" type="submit">Retry</button>
				<button id = "cancel_retry" class="btn btn-danger">Cancel</button>
			</div>    
		</div>
		
		<div id="footer">
		<div class="container">
                    <div class="pull-right">&copy; <?=date('Y')?></div>
                    <div class="pull-left"><?=WEBSITE?></div>
		</div>
		</div>
		<!-- JavaScript includes -->
		
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 
		<script src="<?=base_url()?>public/js/bootstrap.min.js"></script>
	</body>
</html>
<script type="text/javascript">
    $('#confirm_retry').click(function(evt) {
        window.location.href = '//' + <?=WEBSITE?> + '/checkout/place_order';
    });
    $('#cancel_retry').click(function(evt) {
        // at a later stage we may need to destroy the session variables.
        window.location.href = '//' + <?=WEBSITE?> + '/pz_reset_sess';
    });
</script>