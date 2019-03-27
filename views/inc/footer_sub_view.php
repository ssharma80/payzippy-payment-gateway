<!-- FOOOTER 
================================================== -->
<div id="footer">
	<footer class="row">
	<p class="back-top floatright">
		<a href="#top"><span></span></a>
	</p>
	<div class="four columns">
            <ul>
                <li><a href="<?=site_url('content/site/about')?>">About Us</a></li>
                <li><a href="<?=site_url('content/site/privacypol')?>">Privacy Policy</a></li>
                <li><a href="<?=site_url('content/site/termsandcond')?>">Terms &AMP; Conditions</a></li>
            </ul>
	</div>
	<div class="four columns">
		<h1>GET SOCIAL</h1>
		<div class="social facebook">
			<a href="http://www.facebook.com/geared.geeks"></a>
		</div>
		<div class="social twitter">
			<a href="https://twitter.com/GearedGeeks"></a>
		</div>
<!--		<div class="social deviantart">
			<a href="#"></a>
		</div>
		<div class="social flickr">
			<a href="#"></a>
		</div>
		<div class="social dribbble">
			<a href="#"></a>
		</div>-->
	</div>
	<div class="four columns">
		<h1 class="newsmargin">NEWSLETTER</h1>
		<div class="row collapse newsletter floatright">
                    <form id="add_newsletter_form" method="post" action="<?=site_url('content/site/add_newsletter')?>">
			<div class="ten mobile-three columns">
				<input type="text" name="email" class="nomargin" placeholder="Enter your e-mail address...">
			</div>
			<div class="two mobile-one columns">
				<a href="#" id="submit_letter" class="postfix button expand">GO</a>
      			</div>
                    </form>
		</div>
                <div id="image-loader-newsletter">
                    <img src="<?=base_url()?>public/img/ajax-loader.gif" alt="processing" />
                </div>
                
	</div>
        <div class="row">
            <div class="five columns offset-by-eight">
            
            <div id="add-newsletter-warning" class="alert-box alert hide" style="color: #FFF;"></div>
            <div id="add-newsletter-success" class="alert-box success hide " style="color: #FFF;">Thanks for subscribing to our newsletter !</div>
        </div>
        
	</footer>
</div>
<div class="copyright">
	<div class="row">
		<div class="six columns">
			 &copy;<span class="small"> Copyright <?=date('Y')?> <?=WEBSITE?></span>
		</div>
		<div class="six columns">
			<span class="small floatright"> powered by the GearedGeeks ideology</span>
		</div>
	</div>
</div>