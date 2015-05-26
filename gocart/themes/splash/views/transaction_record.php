
<div id="wrapper">

	<div id="content">
		<?php $this->load->view('header_menu'); ?>


		<div class="sliderbg">
			<div class="pages_container">

				<h2 class="page_title">
					<?php echo $page_title?>
				</h2>

				<table id="trx_record" width="100%" height="auto" cellspacing=2>
					<tr>
						<th style="text-align: left;"><?php echo lang('date')?></th>
						<th style="text-align: right;"><?php echo lang('in')?></th>
						<th style="text-align: right;"><?php echo lang('out')?></th>
					</tr>
															
					<tr >
						<td>03-05-2015</td>
						<td style="text-align: right;">100</td>
						<td style="text-align: right;">50</td>
					</tr>
					
					<tr>
						<td>05-05-2015</td>
						<td style="text-align: right;">0</td>
						<td style="text-align: right;">2000</td>
					</tr>
					
					<tr>
						
						<td style="text-align: right;"><b>Total</b></td>
						<td style="text-align: right;"><b>100</b></td>
						<td style="text-align: right;"><b>2050</b></td>
					</tr>
					
				</table>
				
				

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

