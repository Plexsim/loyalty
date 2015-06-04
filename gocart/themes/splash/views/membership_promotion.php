
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>
				
				<?php echo (count($vouchers) < 1)?'<p>'.lang('no_vouchers').'</p>':''?>
				<?php foreach ($vouchers as $voucher):?>
				
				<div class="portfolio_item radius8">
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo base_url($voucher->image)?>"
							class="swipebox" title="<?php echo $voucher->name?>"><img
							src="<?php echo base_url($voucher->image)?>" alt="" title="" border="0" /> </a>
												
						<div class="controls">
								<input type="button" value="<?php echo lang('click_button');?>" name="click_button" href="javascript: void(0);" onclick="javascript: add_voucher('<?php echo $voucher->id ?>', '<?php echo $customer_id ?>');"  class="form_submit radius4 red red_borderbottom"/>
						</div>																								
					</div>
					<div class="portfolio_details">
						<p><?php echo $voucher->name ?>( <?php echo $voucher->code ?> )</p>
						<p><?php echo $voucher->desc ?></p>						
						<a rel="gallery-2" href="<?php echo base_url($voucher->image)?>"
							class="swipebox view_details" title="Webdesign work">view details</a>
					</div>
				</div>
				
				<?php endforeach; ?>
				
				<div class="clearfix"></div>
				<div class="scrolltop radius20">
					<a
						onClick="jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );"
						href="javascript:void(0);"><img
						src="<?php echo theme_img('/icons/top.png') ?>" alt="Go on top"
						title="Go on top" /> </a>
				</div>
			</div>
			<!--End of page container-->
		</div>
	</div>



</div>
<script type="text/javascript">
//function to generate invoice full report
function add_voucher(voucherID, customerID)
{
	$('.loading').fadeIn('slow');
	//console.log('voucherID: ' + voucherID + 'customerID: ' + customerID);
	
	$.post("<?php echo site_url('cart/add_voucher'); ?>", {
		voucher_id : voucherID,
		customer_id : customerID,		
		},
		function(data) {
		    $('.loading').fadeOut('slow');		   
		    if(data == 1){
		    	alert('Added Successful');
		    }else{
		    	alert('You have got it!');
		    }	 		    
		});		
}
</script>
