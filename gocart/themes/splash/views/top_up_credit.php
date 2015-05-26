<div id="wrapper">

	    <div id="content">
	            <?php $this->load->view('header_menu'); ?>   
	                        
	       <div class="sliderbg ">
	       
	       		 <?php echo form_open('cart/top_up_credit', 'class="form-horizontal"'); ?>
	             <div class="pages_container">
		             <h2 class="page_title"><?php echo $page_title?></h2>
		             		             
		            <?php $this->load->view('error_message'); ?>   
		             		             
		             <!-- This is Branch retrieve from Database -->
		             <div class="control-group">
							 <label class="control-label" for="staff_branch"><?php echo lang('staff_branch');?></label>
				             <div class="controls">
								<input type="text" name="staff_branch" value="<?php echo set_value('staff_branch') ?>" class="form_input radius4 required"/>							
							 </div>
		             </div>
		             
		             <div class="control-group">
		             	 <label class="control-label" for="staff_username"><?php echo lang('staff_username');?></label>
			             <div class="controls">
							<input type="text" name="staff_username" class="form_input radius4 required"/>							
						 </div>
	            	 </div>
	            	 
	            	 
	            	<div class="control-group">
		             	 <label class="control-label" for="staff_password"><?php echo lang('staff_password');?></label>
		            	<div class="controls">
							<input type="password" name="staff_password" class="form_input radius4 required"/>							
						</div>
	            	</div>
	            	            	
	            	<hr/>
	            	            	
	            	<div class="control-group">
		             	 <label class="control-label" for="customer_name"><?php echo lang('customer_name');?></label>            	
		            	<div class="controls">
							<!--input type="text" name="customer_name" value="<?php echo set_value('customer_name') ?>" class="form_input radius4 required"/-->	
							<b><?php echo $customer['name']?></b>						
						 </div>
					 </div>
					 
					 <div class="control-group">
		             	 <label class="control-label" for="customer_topup_value"><?php echo lang('customer_cost');?></label>            	
		            	<div class="controls">
							<input type="text" name="customer_cost" value="<?php echo set_value('customer_cost') ?>" class="form_input radius4 required"/>							
						 </div>
					 </div>
					 
					 <div class="control-group">
		             	 <label class="control-label" for="customer_topup_value"><?php echo lang('customer_topup_value');?></label>            	
		            	<div class="controls">
							<input type="text" name="customer_topup_value" value="<?php echo set_value('customer_topup_value') ?>"   class="form_input radius4 required"/>							
						 </div>
					 </div>
					 
					 <div class="control-group">
		             	 <label class="control-label" for="customer_topup_value"><?php echo lang('remark');?></label>            	
		            	 <div class="controls">
							<textarea name="topup_remark" class="form_input radius4" id="topup_remark"><?php echo set_value('topup_remark') ?></textarea>
						 </div>
					 </div>
					 
					 
					 				
					<input type="hidden" value="submitted" name="submitted"/>
					<input type="hidden" value="<?php echo $customer_id ?>" name="customer_id"/>
					 
					<div class="control-group">
							<label class="control-label" for="submit"></label>
							<div class="controls">
								<input type="submit" value="<?php echo lang('submit');?>" name="submit" class="form_submit radius4 red red_borderbottom"/>
							</div>
					</div>
	         	</div>
	         	</form>
	    </div>
	</div> 
</div>