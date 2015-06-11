
<div class="row">
	<div class="col-sm-10">
		<h2><?php echo lang('account_info') ?></h2>	
	</div>
	<div class="col-sm-2">
		<a href="#" onclick="javascript: print_content();" class="btn btn-danger no-print"><?php echo lang('print_content')?></a>
	</div>
</div>

<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan=2><?php echo lang('card')?>: <?php echo $customer['card']?> </td>
	</tr>
	<tr>
		<td colspan=2><?php echo lang('name')?>: <?php echo $customer['name']?></td>		
	</tr>
	<tr>
		<td colspan=2><?php echo lang('credit_balance')?>: <?php echo (isset($credit_balance['credit_amt']) && !empty($credit_balance['credit_amt'])) ? $credit_balance['credit_amt'] : '0.00'; ?> </td>		
	</tr>
	<tr>
		<td colspan=2><?php echo lang('point_balance')?>: <?php echo (isset($point_balance['point_amt']) && !empty($point_balance['point_amt'])) ? $point_balance['point_amt'] : '0.00'; ?></td>
	</tr>
</table>

<table class="table table-striped table-hover" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<?php /*<th>ID</th> uncomment this if you want it*/ ?>
			<th><?php echo lang('date_transaction');?></th>
			<th><?php echo lang('debit');?></th>
			<th><?php echo lang('credit');?></th>
			<th><?php echo lang('balance');?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$total_amount_in = 0;
			$total_amount_out = 0;
			$balance = 0;
			foreach($credits as $credit):
				$total_amount_in += $credit->in;
				$total_amount_out += $credit->out;
				$balance += $credit->in;
				$balance -= $credit->out;
		?>
		<tr>
			<?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
			<td><?php echo  $credit->created; ?></td>
			<td><?php echo  $credit->in; ?></td>
			<td><?php echo $credit->out; ?></a></td>
			<td><?php echo $balance ?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			
			<td style="text-align:right"><b><?php echo lang('total') ?></b></td>
			<td><b><?php echo $total_amount_in ?></b></td>
			<td><b><?php echo $total_amount_out ?></b></td>
			<td></td>
		</tr>
	</tbody>
</table>