<?php
/** SCHOLARSHIP.PHP
 *
 * Form to obtain a patient proxy scholarship
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */
?>


 <div id="questionblock">
	<span class="questiontext">Scholarship</span>
	<p class="afford">Patient Proxy is committed to removing all barriers to people to express their health care wishes. No matter the language, no matter the cost, people have a right to express themselves. Every dollar helps Patient Proxy stay the most accessible way for people to create their advanced directive.</p>
	
	<form action="<?php echo $RELADDRESS . 'form/' . $us_state_name . '/done/'; ?>" method="POST" id="scholarship-form">
		
	<fieldset class="form_set scholarship"> 
		<ul class="form_ul"> 
			<li class="text_li">
				<span class="form_label required_field"><label for="fullname">Full Name *</label></span>
				<span class="form_field required_field"><input class="required" id="fullname" name="fullname" type="text"></span><br /> 
			</li>
			<li class="text_li">
				<span class="form_label required_field"><label for="birthdate">Birthdate *</label></span>
				<span class="form_field required_field"><input class="required" id="birthdate" name="birthdate" type="text"></span><br /> 
			</li>
			<li class="text_li">
				<span class="form_label required_field"><label for="phone">Phone *</label></span>
				<span class="form_field required_field"><input class="required" id="phone" name="phone" type="text"></span><br /> 
			</li>
			<li class="text_li">
				<span class="form_label required_field"><label for="address">Address *</label></span>
				<span class="form_field required_field"><textarea class="required halfwidth" id="address" name="address"></textarea></span><br /> 
			</li>
			<li class="text_li">
				<span class="form_label required_field"><label for="emailaddress">Email Address *</label></span>
				<span class="form_field required_field"><input class="required" id="emailaddress" name="emailaddress" type="text"></span><br /> 
			</li>
			<li class="justtext_li">
				<span class="justtext">* Denotes required field.</span>
			</li>
		</ul>
	</fieldset>
		<input type="hidden" name="payment_accepted" value="submitted" />
		<button type="submit" class="submit-button nextbutton">CONTINUE</button>
		<a href="<?php echo $back_page_address; ?>" title="" class="backbutton">BACK</a>
	</form>
	
</div><!-- close of payment -->
