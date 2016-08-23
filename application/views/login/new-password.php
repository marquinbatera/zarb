<div class="sign-in">
    <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="row">
                  <div class="col-md-12">
                        <img src="<?php echo base_url();?>assets/img/logo-client.png" alt="" class="logo-client"/>
                        <?php if(!empty($_SESSION['mensagem'])){ ?>
                          <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?> alert-dismissible classe_alerta" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?php echo $this->session->flashdata('mensagem'); ?></strong>
                          </div>
                        <?php } ?>
                        <div class="well">
                            <h3 class="form-signin-heading">New Password</h3>
                            
                            <?php echo form_open(base_url('auth/reset_password/' . $code));?>
                            <?php echo form_input($user_id);?>
                            <?php echo form_hidden($csrf); ?>
                              <div class="form-group">
                                <!-- <input type="email" class="form-control" placeholder="Email or mobile phone number" value="<?php echo $new_password;?>" required autofocus> -->
                                <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
                                <?php echo form_input($new_password);?>
                              </div>
                              <div class="form-group">
                                <!-- <input type="email" class="form-control" placeholder="Email or mobile phone number" required autofocus> -->
                                <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                                <?php echo form_input($new_password_confirm);?>
                              </div>
                              <div class="form-group no-margin">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
                              </div>
                            <?php echo form_close();?>
                         </div>
                       
                        <p class="text-center"><a href="<?php echo base_url('home/index'); ?>">Sign In</a><!--  |  <a href="#">Request account</a>--></p>
                         <hr>
                  </div>
                </div>
              <div class="row">
                  <div class="col-md-12 text-center">
                        <img src="<?php echo base_url();?>assets/img/logo-powered-deliverymates.svg" alt="" class="logo-powered"/>
                        <p class="copyright">© Copyrright 2016 - OTL Software</p>
                  </div>
              </div>
          </div>
      </div>
    </div> <!-- /container -->
</div>
