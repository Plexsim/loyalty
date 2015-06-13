<div id="wrapper">

	    <div id="content">
	            <div class="no-print"><?php $this->load->view('header_menu'); ?>   </div>
	                        
	       <div class="sliderbg">
	             <div class="pages_container">
	             <h2 class="page_title"><?php echo $page_title?></h2>	             	             
	             
	             <a href="javascript: void(0)" onclick="javascript: print_receipt();" class="no-print"><?php echo lang('print_receipt')?></a>
	             <div class="clearfix"></div>
	            
	             <div class="print-display" style="text-align:center;">
	             <h4><?php echo $company[0]['company_name'] ?></h4>
	            	<h5><?php echo $company[0]['ssm'] ?></h5>
	            	<h5><?php echo $company[0]['address'] ?></h5>
	             	<h3 class="print-display"><?php echo lang('receipt')?> </h3>
	             </div>
	             	             	             
            	 <h3 class="no-print"><?php echo lang('topup_credit_info')?> </h3>
            	 <blockquote><span><b><?php echo lang('top_up_date');?> : </b></span> <span><?php echo $info['created']?></span></blockquote>
            	 <blockquote><span><b><?php echo lang('staff_branch');?> : </b></span> <span><?php echo (isset($admin['branch_name']) && !empty($admin['branch_name'])) ? $admin['branch_name'] : '-'?></span></blockquote>
            	 <!--blockquote><span><b><?php echo lang('staff_name');?> : </b></span> <span><?php echo $info['staff_id']?></span></blockquote-->
            	 <blockquote><span><b><?php echo lang('customer_name');?> : </b></span> <span><?php echo $info['customer_name']?></span></blockquote>
            	 
            	 <?php if($payment == 'Credit'):?>
            	 	<blockquote><span><b><?php echo lang('total_consume');?> : </b></span> <span><?php echo $info['out']?></span></blockquote>
            	 <?php else:?>
            	 	<blockquote><span><b><?php echo lang('total_consume');?> : </b></span> <span><?php echo $info['depoint']?></span></blockquote>            	 	
            	 <?php endif;?>            	             	 
            	         
            	 <blockquote><span><b><?php echo lang('remark');?> : </b></span> <span><?php echo $info['remark']?></span></blockquote>        
            	         
            	 <!--div class="label_instruction no-print">
					<a href="<?php echo site_url('consumption_qrcode'); ?>"><?php echo lang('return_to_consumption');?></a>
				 </div-->
				 
				 <br/><br/><br/><br/>
				 <div class="print-display" style="text-align:center;">
				  		
				  		<?php echo lang('customer_sign')?>
	             		<br/><br/><br/><br/> <br/><br/><br/><br/>
	             		---------------------------
	             </div>
            	 
            	 <div class="print-display" style="text-align:center;">
				  		 <br/><br/><br/><br/>
				  		<?php echo lang('staff_sign')?>
	             		<br/><br/><br/><br/> <br/><br/><br/><br/>
	             		---------------------------
	             </div> 
            	             	 
	         	</div>
	       </div>
	</div> 
</div>

<script>

//function to generate invoice full report
function print_receipt()
{
	window.print();
}
</script>