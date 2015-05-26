<div id="wrapper">

	    <div id="content">
	            <div class="no-print"><?php $this->load->view('header_menu'); ?>   </div>
	                        
	       <div class="sliderbg">
	             <div class="pages_container">
	             <h2 class="page_title"><?php echo $page_title?></h2>	             	             
	             
	             <a href="#" onclick="javascript: print_receipt();" class="button_12 orange orange_borderbottom radius4 no-print"><?php echo lang('print_receipt')?></a>
	             <div class="clearfix"></div>
	             <h3 class="print-display"><?php echo lang('receipt')?> </h3>
	             	             	             
            	 <h3 class="no-print"><?php echo lang('topup_credit_info')?> </h3>
            	 <blockquote><span><b><?php echo lang('top_up_date');?> : </b></span> <span><?php echo $credit_info['created']?></span></blockquote>
            	 <blockquote><span><b><?php echo lang('staff_branch');?> : </b></span> <span><?php echo $credit_info['branch']?></span></blockquote>
            	 <!--blockquote><span><b><?php echo lang('staff_name');?> : </b></span> <span><?php echo $credit_info['staff_id']?></span></blockquote-->
            	 <blockquote><span><b><?php echo lang('customer_name');?> : </b></span> <span><?php echo $credit_info['customer_name']?></span></blockquote>
            	 <blockquote><span><b><?php echo lang('customer_cost');?> : </b></span> <span><?php echo $credit_info['cost']?></span></blockquote>
            	 <blockquote><span><b><?php echo lang('customer_topup_value');?> : </b></span> <span><?php echo $credit_info['in']?></span></blockquote>
            	         
            	         
            	 <div class="label_instruction no-print">
					<a href="<?php echo site_url('top_up_credit'); ?>"><?php echo lang('return_to_topup_credit');?></a>
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