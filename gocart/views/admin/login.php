<?php include('login_header.php'); ?>

<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <!--h1 class="logo-name">Red Merchant</h1-->

            <img src="<?php echo base_url('assets/img/logo.png');?>" >
            
            </div>
            <h3>Welcome to Red Merchant</h3>
            <p>Login in</p>
            <?php echo form_open($this->config->item('admin_folder').'/login') ?>
                <div class="form-group">
                    <label for="username"><?php echo lang('username');?></label>
                    <?php echo form_input(array('name'=>'username', 'class'=>'form-control', 'placeholder="Username"')); ?>                                        
                </div>
                <div class="form-group">
                	<label for="password"><?php echo lang('password');?></label>
                    <?php echo form_password(array('name'=>'password', 'class'=>'form-control', 'placeholder="Password"')); ?>                                        
                </div>
                
                <input class="btn btn-primary block full-width m-b" type="submit" value="<?php echo lang('login');?>"/>

                 <input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
        		 <input type="hidden" value="submitted" name="submitted"/>
                
                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            <?php echo  form_close(); ?>
            <p class="m-t"> <small>Red Merchant &copy; 2015</small> </p>
        </div>
</div>
    
    

<?php include('login_footer.php'); ?>