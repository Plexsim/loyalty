<h2><?php echo lang('add_credit_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('topup_amount');?></th>
			<th><?php echo lang('credit');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_in = 0;
			
			foreach($credits_in as $credit):
				$total_amount_in += $credit->in;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $credit->created; ?></td>
			<td><?php echo  $credit->cost; ?></td>
			<td><?php echo $credit->in; ?></a></td>
			<td>-</a></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td><b><?php echo $total_amount_in ?></b></td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2><?php echo lang('deduct_credit_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('topup_amount');?></th>
			<th><?php echo lang('credit');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_out = 0;
			foreach($credits_out as $credit):
				$total_amount_out += $credit->out;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $credit->created; ?></td>
			<td><?php echo  $credit->cost; ?></td>
			<td><?php echo $credit->out; ?></a></td>
			<td>-</td>
		</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td><b><?php echo lang('total') ?></b></td>
			<td>
				<b><?php echo $total_amount_out ?></b>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2><?php echo lang('add_point_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			
			<th><?php echo lang('point');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_in = 0;
			
			foreach($points_in as $point):
				$total_amount_in += $point->point;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $point->created; ?></td>
			
			<td><?php echo $point->point; ?></a></td>
			<td>-</a></td>
		</tr>
		<?php endforeach;?>
		<tr>
			
			<td><b><?php echo lang('total') ?></b></td>
			<td><b><?php echo $total_amount_in ?></b></td>
			<td></td>
		</tr>
	</tbody>
</table>

<h2><?php echo lang('deduct_point_trx') ?></h2>
<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			
			<th><?php echo lang('point');?></th>
			<th><?php echo lang('branch');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_out = 0;
			foreach($points_out as $point):
				$total_amount_out += $point->depoint;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $point->created; ?></td>
			
			<td><?php echo $point->depoint; ?></a></td>
			<td>-</td>
		</tr>
		<?php endforeach;?>
		<tr>
			
			<td><b><?php echo lang('total') ?></b></td>
			<td>
				<b><?php echo $total_amount_out ?></b>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>