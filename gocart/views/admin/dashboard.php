
<div class="row">
	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Manage Branch</h5>
			</div>
			<div class="ibox-content">
				<a href="add_branch.php" class="btn btn-w-m btn-danger">Add</a> <a
					href="branch.php" class="btn btn-w-m btn-info">View </a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Prepaid</h5>
			</div>
			<div class="ibox-content">
				<a href="prepaid.php" class="btn btn-w-m btn-danger">Add</a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Manage Card</h5>
			</div>
			<div class="ibox-content">
				<a href="mg_card.php" class="btn btn-w-m btn-info">View</a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Check Point</h5>
			</div>
			<div class="ibox-content">
				<a href="check_point.php" class="btn btn-w-m btn-info">Search</a>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Manage Redemption</h5>
			</div>
			<div class="ibox-content">
				<a href="add_redemption.php" class="btn btn-w-m btn-danger">Add</a>
				<a href="mg_redemption.php" class="btn btn-w-m btn-info">View </a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Gift Redepmtion</h5>
			</div>
			<div class="ibox-content">
				<a href="giftredempt.php" class="btn btn-w-m btn-danger">Add</a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Credit</h5>
			</div>
			<div class="ibox-content">
				<a href="credit.php" class="btn btn-w-m btn-danger">Add</a>
			</div>
		</div>
	</div>

	<div class="col-lg-3">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Report</h5>
			</div>
			<div class="ibox-content">
				<a href="report.php" class="btn btn-w-m btn-info">View</a>
			</div>
		</div>
	</div>
</div>



<div class="row white-bg">
	<div class="ibox-title">
		<h5>
			<?php echo lang('recent_customers') ?>
		</h5>

	</div>

	<div class="full-height-scroll">
		<div class="table-responsive">
			<table class="table table-striped table-hover">

				<tbody>

					<?php foreach ($customers as $customer):?>
					<tr>
						<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
						<td><a data-toggle="tab" href="#contact-1" class="client-link"><?php echo  $customer->name; ?>
						</a></td>

						<td class="contact-type"><i class="fa fa-envelope"> </i></td>
						<td><a href="mailto:<?php echo  $customer->email;?>"><?php echo  $customer->email; ?>
						</a></td>

						<td><?php if($customer->active == 1)
						{
							echo '<td class="client-status"><span class="label label-primary">'.lang('yes').'</span></td>';
						}
						else
						{
							echo '<td class="client-status"><span class="label label-danger">'.lang('no').'</span></td>';
						}
						?>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</div>













<div class="row">
	<div class="span12" style="text-align:center;">
		<a class="btn btn-large" href="<?php echo site_url(config_item('admin_folder').'/customers');?>"><?php echo lang('view_all_customers');?></a>
	</div>
</div>