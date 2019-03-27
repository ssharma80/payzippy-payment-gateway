<div class="row">
	<div class="span3">
		<label><?php echo lang('enabled');?></label>
		<select name="enabled" class="span3">
			<option value="1" <?php echo((bool)$settings['enabled'])?' selected="selected"':'';?>><?php echo lang('enabled');?></option>
			<option value="0" <?php echo((bool)$settings['enabled'])?'':' selected="selected"';?>><?php echo lang('disabled');?></option>
		</select>
	</div>
</div>
<!--<div class="row">
	<div class="span3">
		<label><?php // echo lang('mode');?></label>
		<select name="mode" class="span3">
			<option value="test" <?php // echo($settings['mode']=='test')?'selected="selected"':'';?>><?php // echo lang('test_mode');?></option>
			<option value="production" <?php // echo($settings['mode']!='production')?'':'selected="selected"';?>><?php // echo lang('production');?></option>
		</select>
	</div>
</div>-->
<div class="row">
	<div class="span3">
		<label><?php echo lang('mode') ?></label>
		<?php
			echo form_input('mode', $settings['mode']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('MERCHANT_ID') ?></label>
		<?php
			echo form_input('MERCHANT_ID', $settings['MERCHANT_ID']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('SECRET_KEY') ?></label>
		<?php
			echo form_input('SECRET_KEY', $settings['SECRET_KEY']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('TRANSACTION_TYPE') ?></label>
		<?php
			echo form_input('TRANSACTION_TYPE', $settings['TRANSACTION_TYPE']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('CURRENCY') ?></label>
		<?php
			echo form_input('CURRENCY', $settings['CURRENCY']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('UI_MODE') ?></label>
		<?php
			echo form_input('UI_MODE', $settings['UI_MODE']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('HASH_METHOD') ?></label>
		<?php
			echo form_input('HASH_METHOD', $settings['HASH_METHOD']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('MERCHANT_KEY_ID') ?></label>
		<?php
			echo form_input('MERCHANT_KEY_ID', $settings['MERCHANT_KEY_ID']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('CALLBACK_URL') ?></label>
		<?php
			echo form_input('CALLBACK_URL', $settings['CALLBACK_URL']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('API_BASE') ?></label>
		<?php
			echo form_input('API_BASE', $settings['API_BASE']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('API_CHARGING') ?></label>
		<?php
			echo form_input('API_CHARGING', $settings['API_CHARGING']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('API_QUERY') ?></label>
		<?php
			echo form_input('API_QUERY', $settings['API_QUERY']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('API_REFUND') ?></label>
		<?php
			echo form_input('API_REFUND', $settings['API_REFUND']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('API_VERSION') ?></label>
		<?php
			echo form_input('API_VERSION', $settings['API_VERSION']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('VERIFY_SSL_CERTS') ?></label>
		<?php
			echo form_input('VERIFY_SSL_CERTS', $settings['VERIFY_SSL_CERTS']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('RETRY_ON_SALE_FAILURE') ?></label>
		<?php
			echo form_input('RETRY_ON_SALE_FAILURE', $settings['RETRY_ON_SALE_FAILURE']);
		?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label><?php echo lang('RETRY_ON_REFUND_FAILURE') ?></label>
		<?php
			echo form_input('RETRY_ON_REFUND_FAILURE', $settings['RETRY_ON_REFUND_FAILURE']);
		?>
	</div>
</div>