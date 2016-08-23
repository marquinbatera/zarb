<!-- Content Start -->
<div id="contentWrapper">
	<div class="page-title title-1">
		<div class="container">
			<div class="row">
				<div class="cell-12">
					<h1 class="fx" data-animate="fadeInLeft">Alterar <span>Senha</span></h1>
					<div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
						<a href="<?php echo base_url();?>">Home</a><span class="line-separate">/</span><a href="#">Alterar Senha</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="padd-top-50">
		<div class="container">
			<div class="row">
				<?php if(!empty($message)){ ?>
					<div class="box info-box fx" data-animate="fadeInLeft" style="color: #000000 !important;">
						<a class="close-box" href="#"><i class="fa fa-times"></i></a>
						<?php echo $message;?>
					</div>
				<?php } ?>
				
				<div class="cell-7 contact-form fx" data-animate="fadeInLeft">
				<?php echo form_open(base_url('auth/reset_password/' . $code));?>
					<?php echo form_input($user_id);?>
					<?php echo form_hidden($csrf); ?>

					<h3 class="block-head"><?php echo lang('reset_password_heading');?></h3>
					<mark id="message"></mark>
					
					<div class="form-input">
						<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
						<?php echo form_input($new_password);?>
					</div>

					<div class="form-input">
						<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
						<?php echo form_input($new_password_confirm);?>
					</div>

					<div class="form-input">
						<input type="submit" class="btn btn-large main-bg" id="btnSubmit" value="Password Update">
					</div>
				
				<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>