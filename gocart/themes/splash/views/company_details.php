<div id="wrapper">

    <div id="content">
            <?php $this->load->view('header_menu'); ?>   
                        
       <div class="sliderbg ">
                                        <div class="pages_container">
                                        <h2 class="page_title"><?php echo $page_title?></h2>
                                        <ul class="listing_detailed">                                          
						
						<!-- This need a function for users add in -->
						
							<ol>
								<li><a href="#">SEG Network</a></li>								
							</ol>													
						    
						    <ol>
								<li>
									<a href="tel:0165247163">0165247163</a>
								</li>								
							</ol>                                    
						 
						 	<ol>
								<li>
									<!--a href="#">3-3A / NB Plaza, 3000 Jalan Baru, 13700 Perai, Pulau Pinang</a-->								
									<a style="cursor: pointer;" onclick="myNavFunc()">3-3A / NB Plaza, 3000 Jalan Baru, 13700 Perai, Pulau Pinang</a>								
								</li>								
							</ol>                         						 						 						 	
						 
						 	<ol>
						 		More Details
								<div class="toogle_wrap radius8">
										<div class="trigger_point"><a href="#">Company Details</a></div>
										<div class="toggle_container_point">
										<ul class="listing_detailed">                                          						
											<ol>
												<li><p>Red Merchants</p>
													</hr>
													<p>Digitize your Customer loyalty Program & Simply using your phone to Collect Point & Redeem Voucher / Gifts</p>
												</li>								
											</ol>
										</ul>                                            
				                    </div>
				                </div>
							</ol>                         
						</ul>   
	                                            
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
