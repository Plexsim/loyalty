
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>

				<div class="portfolio_item radius8">
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo theme_img('owl5.jpg')?>"
							class="swipebox" title="Webdesign work"><img
							src="<?php echo theme_img('owl5.jpg')?>" alt="" title="" border="0" /> </a>
						
						
						<div class="controls">
								<input type="button" value="<?php echo lang('click_button');?>" name="click_button" href="#" class="form_submit radius4 red red_borderbottom"/>
						</div>																		
						
					</div>
					<div class="portfolio_details">
						<h4>News</h4>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy tex</p>
						
						<a rel="gallery-2" href="<?php echo theme_img('owl5.jpg')?>"
							class="swipebox view_details" title="Webdesign work">view details</a>
					</div>
				</div>
				
				<div class="portfolio_item radius8">
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo theme_img('owl6.jpg')?>"
							class="swipebox" title="Webdesign work"><img
							src="<?php echo theme_img('owl6.jpg')?>" alt="" title="" border="0" /> </a>
							
							<div class="controls">
								<input type="button" value="<?php echo lang('click_button');?>" name="click_button" href="#" class="form_submit radius4 red red_borderbottom"/>
							</div>
					</div>
					<div class="portfolio_details">
						<h4>Collection Requirements</h4>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy tex</p>
						<a rel="gallery-2" href="<?php echo theme_img('owl6.jpg')?>"
							class="swipebox view_details" title="Webdesign work">view details</a>
					</div>
				</div>
				<div class="portfolio_item radius8">
					<div class="portfolio_image">
						<a rel="gallery-1" href="<?php echo theme_img('owl7.jpg')?>"
							class="swipebox" title="Webdesign work"><img
							src="<?php echo theme_img('owl7.jpg')?>" alt="" title="" border="0" /> </a>
							
							<div class="controls">
								<input type="button" value="<?php echo lang('click_button');?>" name="click_button" href="#" class="form_submit radius4 red red_borderbottom"/>
							</div>
					</div>
					<div class="portfolio_details">
						<h4>Collection Requirements</h4>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy tex</p>
						<a rel="gallery-2" href="<?php echo theme_img('owl7.jpg')?>"
							class="swipebox view_details" title="Webdesign work">view details</a>
					</div>
				</div>

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

