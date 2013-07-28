<?php
/** INDEX.PHP
 *
 * Home Page for Patient Proxy
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */


// INCLUDES
require_once('includes/header.php');



?>

<div class="topsection">
	<div class="imageandcaption">
		<img class="featured" src="<?php echo $RELADDRESS; ?>images/pages/mainhero_en.jpg" alt="A female doctor showing an older male patient something on a tablet" title="Informed Healthcare" />
	</div>
			<!-- floaty feedback link <a id="floating_link" href="https://www.patientproxy.com/info/feedback/">Feedback</a> -->
	<div class="text">

		<h4>The most secure and accessible way to create your health proxy and living will.<div class="helpbox">
		<!--<span class="learnmore"><img src="<?php echo $RELADDRESS; ?>images/learn_more.png" /></span>-->
		<span class="help">?</span>
		<span class="helptext">A health proxy is someone you designate to make health care decisions for you when you are not able. A living will is instructions to your care providers, proxy, and family about the kind of care you desire.</span>
		</div></h4>
		
		<h2>Patient Proxy generates the legal expression of your health wishes.</h2>

		<div class="start_form">
		
		<a href="<?php echo $RELADDRESS . 'form/map/'; ?>" title="" class="nextbutton"><span class="innertext index">GET STARTED</span></a>


		</div>
		<h3 style="float:right;"></h3>
		<!--<div class="helpbox"><span class="help">?</span><span class="helptext start"><img src="images/pages/graph.jpg" alt="" title="" /></span></div>-->
		
		<div class="centericons">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_facebook"></a>
				<a class="addthis_button_twitter"></a>
				<a class="addthis_button_email"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<!-- AddThis Button END -->
		</div>
		
	</div>
	
</div>
<hr class="thin" />
<div class="threecolumn">
	<div class="column first">
		<img src="<?php echo $RELADDRESS; ?>images/startpage/wholelife.jpg" title="Live Your Life On Your Terms" alt="Picture of older man looking in charge" width="200px" height="200px" />
		<p>Live your whole life on your terms.</p>
	</div>
	<div class="line"></div>
	<div class="column middle">
		<img src="<?php echo $RELADDRESS; ?>images/startpage/communicate.jpg" title="Communicate Your Wishes" alt="Picture of several happy elderly people" width="200px" height="200px" />
		<p>When we are at our most vulnerable, we need to advise our loved ones and care givers with advanced directives.</p>
	</div>
	<div class="line"></div>
	<div class="column last">
		<img src="<?php echo $RELADDRESS; ?>images/startpage/fingerprint.jpg" title="Secure" alt="Picture of fingerprint" width="200px" height="200px" />
		<p>Patient Proxy does not record any of your personal data. That means 100% privacy.</p>
	</div>
</div>


<?php


// END PAGE
require_once('includes/footer.php');

?>