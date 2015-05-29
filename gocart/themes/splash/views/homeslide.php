<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>

		<div class="sliderbg ">
			<div class="pages_container">
				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>			
				
				  <!-- SlidesJS Required: Start Slides -->
				  <!-- The container is used to define the width of the slideshow -->
				  <div class="container">
				    <div id="slides">
				      <img src="<?php echo theme_img('banner0.jpg')?>" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
				      <img src="<?php echo theme_img('banner1.jpg')?>" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
				      <img src="<?php echo theme_img('banner2.jpg')?>" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
				      <img src="<?php echo theme_img('banner3.jpg')?>" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
				    </div>
				  </div>
				  <!-- End SlidesJS Required: Start Slides -->
				
				<a href="<?php echo site_url('my_card') ?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">My Membership Card</div>	            
            	</div>
            	</a>
            	
            	<a href="tel:0165247163">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">0165247163</div>	            
            	</div>
            	</a>
				
				<a style="cursor: pointer;" onclick="myNavFunc()">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">3-3A / NB Plaza, 3000 Jalan Baru, 13700 Perai, Pulau Pinang</div>	            
            	</div>
            	</a>
            	
            	<a href="<?php echo site_url('company_details')?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">More Details</div>	            
            	</div>
            	</a>
				
			</div>
		</div>
	</div>
</div>

<script>
function myNavFunc(){
    // If it's an iPhone..
    if( (navigator.platform.indexOf("iPhone") != -1) 
        || (navigator.platform.indexOf("iPod") != -1)
        || (navigator.platform.indexOf("iPad") != -1))
         window.open("maps:https://goo.gl/maps/iEZ5l");
    else
         window.open("https://goo.gl/maps/iEZ5l");
}
</script>
