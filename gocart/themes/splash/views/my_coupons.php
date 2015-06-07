
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>

				<?php echo (count($coupons) < 1)?'<p>'.lang('no_coupons').'</p>':''?>
				<?php foreach ($coupons as $coupon):?>
				
				<div class="portfolio_item radius8">
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo base_url($coupon->image)?>"
							class="swipebox" title="<?php echo $coupon->name?>"><img
							src="<?php echo base_url($coupon->image)?>" alt="" title="" border="0" /> </a>
												
						
					</div>
					<div class="portfolio_details">
						<p><?php echo $coupon->name ?>( <?php echo $coupon->code ?> )</p>
						<p><?php echo $coupon->desc ?></p>						
						<a rel="gallery-2" href="<?php echo base_url($coupon->image)?>"
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

