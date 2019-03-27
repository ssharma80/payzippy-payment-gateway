<!-- HEADER
   ================================================== -->
<div class="row">
   <div class="four columns">
      <div class="logo">
         <a href="<?=site_url('/')?>"><img src="<?=  base_url()?>gocart/themes/default/assets/images/logo.png" alt=""/></a>
      </div>
   </div>
   <div class="eight columns noleftmarg">
      <nav id="nav-wrap">
         <ul class="nav-bar sf-menu">
            <li class="current">
               <a href="<?=site_url('/')?>">Home</a>
            </li>
            <li>
               <a href="#">Products</a>
               <ul>
                  <li><a href="<?=site_url('electronics')?>">Electronics</a></li>
                  <li><a href="<?=site_url('computers')?>">Computers</a></li>
                  <li><a href="<?=site_url('/')?>">Demo Links</a></li>
               </ul>
            </li>
            <li>
               <a href="#">Services</a>
               <ul>
                  <li><a href="<?=site_url('content/site/webdesign')?>">Web Design</a></li>
                  <li><a href="<?=site_url('content/site/apps')?>">Android Apps</a></li>
                  <li><a href="<?=site_url('content/site/devrecov')?>">Hard Disk Recovery</a></li>
               </ul>
            </li>
            <li>
               <a href="#">Geeky Projects</a>
               <ul>
                  <li><a href="<?=site_url('content/site/bartpe')?>">BartPE Plugins</a></li>
                  <li><a href="<?=site_url('/')?>">Bootable ISO's</a></li>
                  <li><a href="<?=site_url('/')?>">OBD Scanner</a></li>
                  <li><a href="<?=site_url('/')?>">BlueAnt X5 Headset Mods</a></li>
               </ul>
            </li>
            <li>
               <a href="<?=site_url('content/site/contact')?>">Contact Us</a>
            </li>
            <?php if($this->Customer_model->is_logged_in(false, false)):?>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('account');?> <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('secure/my_account');?>"><i class="fa fa-user"></i>   <?php echo lang('my_account')?></a></li>
                        <li><a href="<?php echo site_url('secure/my_downloads');?>"><i class="fa fa-download"></i>   <?php echo lang('my_downloads')?></a></li>
                        <li><a href="<?php echo site_url('secure/logout');?>"><i class="fa fa-power-off"></i>   <?php echo lang('logout');?></a></li>
                     </ul>
                  </li>
                  <?php else: ?>
                  <li><a href="<?php echo site_url('secure/login');?>"><?php echo lang('login');?></a></li>
                  <?php endif; ?>
         </ul>
      </nav>
   </div>
</div>
<div class="clear"></div>