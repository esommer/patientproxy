<?php
/** VOUCHER_PAYMENT.PHP
 *
 * Content of purchase page for pre-paid vouchers
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */

// PREPARE VARS
$form_action = '';
$back_button_href = '';

// BUILD VARS
$form_action = $RELADDRESS . 'vouchers/thanks/';
$back_button_href = $RELADDRESS . 'vouchers/legal/';

?>

<!-- PAYMENT HANDLING JAVASCRIPT -->
<script type="text/javascript">
	// STRIPE
	function stripeResponseHandler(status, response) {
		if (response.error) {
			// re-enable the submit button
			$('.submit-button').removeAttr("disabled");
			// show the errors on the form
			$(".payment-errors").html(response.error.message);
		} else {
			var form$ = $("#payment-form");
			// token contains id, last4, and card type
			var token = response['id'];
			// insert the token into the form so it gets submitted to the server
			form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
			if ( $('form#payment-form').hasClass('bulk') ) {
				var chargeAmount = $('input[name=boxsize]:checked').attr('value') * 100;
				}
			else {
				var chargeAmount = $('#slider').slider( "option", "value" ) * 100;
				}
			form$.append("<input type='hidden' name='chargeAmount' value='" + chargeAmount + "' />");
			// and submit
			form$.get(0).submit();
		}
	}
	
	// GENERAL
	$(document).ready(function() {
		
		// GET AMOUNT OF CARDS
		$('.radio-option').click(function() {
			var boxPrice = $(this).children('input[name=boxsize]').attr('value');
			$('#amountcards').val( "$" + boxPrice );
		});
		
		// GET AMOUNT OF CARDS
		/*$('input[name=boxsize]').click(function() {
			alert('hello');
			var boxPrice = $(this).attr('value');
			$('#amountcards').val( "$" + boxPrice );
		});*/
		
		// STRIPE FORM
		$("#payment-form").submit(function(event) {
			var voucherEntered = $('input[name=vouchercode]').val();
			if ( !voucherEntered ) {
				// disable the submit button to prevent repeated clicks
				$('.submit-button').attr("disabled", "disabled");
				if ( $(this).hasClass('bulk') ) {
					var chargeAmount = $('input[name=boxsize]:checked').attr('value') * 100;
					}
				else {
					var enteredAmount = $('#slider').slider( "option", "value" ) * 100;
					if ( enteredAmount >= 1800 ) {
						var chargeAmount = enteredAmount;
						}
					else {
						var chargeAmount = 1800;
						}
					}
				// createToken returns immediately - the supplied callback submits the form if there are no errors
				Stripe.createToken({
					name: $('.card-name').val(),
					number: $('.card-number').val(),
					cvc: $('.card-cvc').val(),
					exp_month: $('.card-expiry-month').val(),
					exp_year: $('.card-expiry-year').val()
				}, chargeAmount, stripeResponseHandler);
				return false; // submit from callback
				}
		});
	});
	
	Stripe.setPublishableKey('pk_zHjJ8JnUiYhjCb8w0A7g6zw0LcrAA');
</script>

<div id="payment">
	<div id="stripeform">
		
		<?php 
			if ( isset($error_message) && !empty($error_message) ) {
				echo '<span class="payment-errors">' . $error_message . '</span>';
			}
		?>
		<!-- to display errors returned by createToken -->
		<span class="payment-errors"></span>
		
		<form action="<?php echo $form_action; ?>"	method="POST" class="bulk" id="payment-form">
			<fieldset id="bulkcards" class="radio_set">
			<legend>Select the number of voucher cards you would like:</legend>
			<!--<ul>
			<li class="radio-option">
				<input type="radio" name="boxsize" value="1" id="num10" class="styled" />
				<label for="num10">10 = Free Trial ($1 postage)</label>
			</li>
			<li class="radio-option">
				<input type="radio" name="boxsize" value="250" id="num25" class="styled" />
				<label for="num25">25 = $250 ($10/ea)</label>
			</li>
			<li class="radio-option">
				<input type="radio" name="boxsize" value="450" id="num50" class="styled" />
				<label for="num50">50 = $450 ($9/ea)</label>
			</li>
			<li class="radio-option">
				<input type="radio" name="boxsize" value="750" id="num100" class="styled" />
				<label for="num100">100 = $750 ($7/ea)</label>
			</li>
			<li class="radio-option">
				<input type="radio" name="boxsize" value="1000" id="num250" class="styled" />
				<label for="num250">250 = $1000 ($4/ea)</label>
			</li>
			</ul>-->
			</fieldset>
			
			<div class="sliderlabel">
				<label for="amountcards">Total</label>
				<input type="text" maxlength="5" id="amountcards" disabled="disabled" />
			</div>
			
			<div class="form-row">
				<label>Cardholder Name</label>
				<input type="text" size="40" autocomplete="off" class="card-name" />
			</div>
			
			<div class="form-row">
				<label>Card Number</label>
				<input type="text" size="20" maxlength="20" autocomplete="off" class="card-number" />
			</div>
			
			<div class="form-row">
				<label>CVC</label>
				<input type="text" size="4" maxlength="4" autocomplete="off" class="card-cvc" />
			</div>
			
			<div class="form-row">
				<label>Expiration</label>
				<input type="text" size="2" maxlength="2" class="card-expiry-month"/>
				<span> / </span>
				<input type="text" size="4" maxlength="4" class="card-expiry-year"/>
				<span>( MM / YYYY )</span>
			</div>
			
			<div class="form-row">
				<label>Email Address</label>
				<input type="text" name="emailaddress" />
			</div>
			
			<div class="form-row">
				<label>Mailing Address</label>
				<textarea name="mailingaddress" class="halfwidth"></textarea>
			</div>

		<input type="hidden" name="coming_from" value="paid" />
		<button type="submit" name="direction" value="forward" class="nextbutton">CONTINUE</button>
		<a href="<?php echo $back_button_href; ?>" title="" class="backbutton">BACK</a>
	
		</form>
	</div> <!-- close of div#stripeform -->
</div> <!-- close of div#payment -->

<?php

// CLEAR VARS
$form_action = '';
$back_button_href = '';

?>
