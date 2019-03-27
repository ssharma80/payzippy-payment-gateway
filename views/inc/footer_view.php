<!-- JAVASCRIPTS 
================================================== -->
<!-- Javascript files placed here for faster loading -->
<?php
// common
echo '<script src="'.base_url().'public/js/foundation.min.js"'.'></script>';
echo '<script src="'.base_url().'public/js/jquery.cycle.js"'.'></script>';
echo '<script src="'.base_url().'public/js/app.js"'.'></script>';
echo '<script src="'.base_url().'public/js/modernizr.foundation.js"'.'></script>';
echo '<script src="'.base_url().'public/js/slidepanel.js"'.'></script>';
echo '<script src="'.base_url().'public/js/scrolltotop.js"'.'></script>';
echo '<script src="'.base_url().'public/js/hoverIntent.js"'.'></script>';
echo '<script src="'.base_url().'public/js/superfish.js"'.'></script>';
echo '<script src="'.base_url().'public/js/responsivemenu.js"'.'></script>';
echo '<script src="'.base_url().'public/js/newsletter.js"'.'></script>';
echo "\n";

switch($this->router->method) {
    case 'site':
        echo '<script src="'.base_url().'public/js/jquery.carouFredSel-6.0.5-packed.js"'.'></script>';
        echo '<script src="'.base_url().'public/js/jquery.easing.1.3.js"'.'></script>';
        echo '<script src="'.base_url().'public/js/elasticslideshow.js"'.'></script>';
        echo "\n";
        break;
    
    case 'contact':
        echo '<script src="'.base_url().'public/js/contact.js"'.'></script>';
        echo "\n";
        break;
    
    case 'getquote':
        echo '<script src="'.base_url().'public/js/getquote.js"'.'></script>';
        echo "\n";
        break;
    
    case 'apps':
        echo '<script src="'.base_url().'public/js/elasticslideshow.js"'.'></script>';
        echo '<script src="'.base_url().'public/js/androidapps.js"'.'></script>';
        echo "\n";
        break;
    
    case 'bartpe':
        echo '<script src="'.base_url().'public/js/jquery.isotope.min.js"'.'></script>';
        echo "\n";
        echo '<script src="'.base_url().'public/js/jquery.prettyPhoto.js"'.'></script>';
        echo "\n";
        echo '<script src="'.base_url().'public/js/custom.js"'.'></script>';
        echo "\n";
        echo '<script src="'.base_url().'public/js/contact.js"'.'></script>';
        echo "\n";
        break;
    
    case 'devrecov':
        echo '<script src="'.base_url().'public/js/devrecov.js"'.'></script>';
        echo "\n";
        break;
    
    case 'devrecov_form':
        echo '<script src="'.base_url().'public/js/jquery.datetimepicker.js"'.'></script>';
        echo '<script src="'.base_url().'public/js/devrecov_form.js"'.'></script>';
        echo "\n";
        break;
    
    case 'webdesign':
        echo '<script src="'.base_url().'public/js/jquery.carouFredSel-6.0.5-packed.js"'.'></script>';
        echo '<script src="'.base_url().'public/js/jquery.tweet.js"'.'></script>';
        echo '<script src="'.base_url().'public/js/twitterusername.js"'.'></script>';
        echo "\n";
        break;
    
}

echo "\n";
?>
<!--
For integration using RIDIRECT mode, create a new HTML form, with hidden elements.
Set its "action" attribute to $charging_object["url"].
Create hidden input elements for every key, value pair in $charging_object["params"].
-->
<form method="POST" action="<?php echo $charging_object["url"]?>" id="payzippyForm">
    <?php
    foreach($charging_object["params"] as $key => $value) {
        echo "<input type='hidden' name='{$key}' value='$value'>";
    }
    ?>
</form>
<script>
    document.getElementById("payzippyForm").submit();
</script>

</body>
</html>