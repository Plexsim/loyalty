<div id="wrapper">

	    <div id="content">
	            <?php $this->load->view('header_menu'); ?>   
	                        
	       <div class="sliderbg ">
	             <div class="pages_container">
	             <h2 class="page_title"><?php echo $page_title?></h2>
	             <p>
	                 <div class="label_instruction">
	                 	<img src="<?php echo base_url($image_card)?>" alt="member-card" class="image-card" style="width:450px; height:auto" />
	                 </div>                       
	             </p>
	             <center><p>E - Member Card, easier carrier and never lost it.</p></center>
	             <p>
	             	<a href="<?php echo site_url('top_up_credit_qrcode')?>" class="button_12 green green_borderbottom radius4">Top Up</a>  <a href="<?php echo site_url('consumption_qrcode')?>" class="button_12 blue blue_borderbottom radius4">Consumption</a>
	             </p>
				 <div class="clearfix"></div>	             
	             
	            <a href="<?php echo site_url('membership_promotion') ?>">
	            <div class="toogle_wrap radius8">
	                <div class="go_next_page">Membership Promotion</div>	            
            	</div>
            	</a>
            	
            	<!--a href="#">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">Membership Privilege</div>	            
            	</div>
            	</a-->
            	
            	<a href="<?php echo site_url('news') ?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">News</div>	            
            	</div>
            	</a>
            	
	            <a href="<?php echo site_url('secure/my_account')?>">
	            <div class="toogle_wrap radius8">
	                <div class="go_next_page">Personal Detail</div>	            
            	</div>
	            </a>
	            
	            <a href="<?php echo site_url('member_center')?>">
	            <div class="toogle_wrap radius8">
	                <div class="go_next_page">Membership Card Detail</div>	            
            	</div>
            	</a>
            	
            	<a href="<?php echo site_url('company_details')?>">
            	<div class="toogle_wrap radius8">
	                <div class="go_next_page">Company Detail</div>	            
            	</div>
            	</a>
            	
	         </div>
	    </div>
	</div> 
</div>