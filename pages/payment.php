<?php
/** PAYMENT.PHP
 *
 * Content of purchase page for health proxy document
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */

?>
<!-- PAYMENT HANDLING JAVASCRIPT -->
<script type="text/javascript">
	Stripe.setPublishableKey('pk_zHjJ8JnUiYhjCb8w0A7g6zw0LcrAA');
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

	$(document).ready(function() {
		$("span.help").click(function(){
    		$(this).siblings("span.helptext").toggle();
    	});
    	$('input[name=boxsize]').click(function() {
			var boxPrice = $(this).attr('value');
			$('#amountcards').val( "$" + boxPrice );
		});
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
		$('#slider').slider({
			value: 36,
			min: 18,
			max: 100,
			slide: function( event, ui ) {
				$('#amount').val( "$" + ui.value );
			}
		});
		$('#amount').val( "$" + $('#slider').slider('value') );
	});
</script>


<div id="payment">
	<div id="stripeform">
		<h2>Confirm Price and Payment Method</h2>
		<p class="afford">Patient Proxy is committed to removing all barriers to people to express their health care wishes. No matter the language, no matter the cost, people have a right to express themselves. Every dollar helps Patient Proxy stay the most accessible way for people to create their advanced directive.</p>
		
		<div class="errors">	
			<!-- to display errors returned by createToken -->
			<span class="payment-errors">
			<?php 
				if ( isset ( $cleared ) && $cleared == 'no' ) {
					echo 'This voucher has already been used.';
					}
				else if ( isset ( $cleared ) && ( $cleared == 'error' || $cleared == 'invalid' ) ) {
					echo 'Invalid voucher code.';
					}
			?>
			</span>
		</div>
		
		<form action="<?php echo $RELADDRESS . 'form/' . $us_state_name . '/done/'; ?>" method="POST" id="payment-form">
			
			<div id="voucherbox">Have a voucher code?<br /> Enter it here:<input type="text" name="vouchercode" maxlength="5" /></div>
			
			<ul id="slidernumbers">
				<li class="start">$18</li>
				<li class="on">$36</li>
				<li class="last">$100</li>
			</ul>
			
			<div id="slider">
			</div>
			
			<div class="sliderlabel">
				<label for="amount">Total</label>
				<input type="text" maxlength="4" id="amount" disabled="disabled" />
				<script type="text/javascript">
					/*var amount = new liveValidation('amount', { validMessage: "", onlyOnBlur: true });
					amount.add(Validate.Numericality, { minimum: 18, maximum: 100 } );*/
				</script>
				
			</div>
		<div id="inputdata">
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
				<p>Providing your email address will sign you up for a free renewal once a year for the next three years.</p>
				</div>
			</div>
		</div><!-- close of #inputdata -->	
			<input type="hidden" name="coming_from" value="paid" />
			<button type="submit" class="submit-button nextbutton">CONTINUE</button>
			<a href="<?php echo $back_page_address; ?>" title="" class="backbutton">BACK</a>
		</form>
		
		
		<div class="scholarshipcopy">
		<hr class="thin" />
		<p>The world of advanced care planning is growing, but it is not growing the same for all. If you feel you cannot afford the minimum suggested price of $18, please view our <a href="<?php echo $RELADDRESS . 'form/' . $us_state_name . '/scholarship/'; ?>" title="Scholarship">scholarship page</a> to register your personal information and your proxy will be on the house.</p>
		<p>We are currently translating the site into Spanish and introducing the Clinical Voucher program so primary care physicians and other professionals can provide Patient Proxies to their patients for free.</p>
	</div><!-- close of stripeform -->
</div><!-- close of payment -->

