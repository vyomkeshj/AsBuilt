<?php
namespace PHPMaker2019\ASbuiltProject;
?>
<?php if ($CustomerTable->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_CustomerTablemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($CustomerTable->CustomerID->Visible) { // CustomerID ?>
		<tr id="r_CustomerID">
			<td class="<?php echo $CustomerTable->TableLeftColumnClass ?>"><?php echo $CustomerTable->CustomerID->caption() ?></td>
			<td<?php echo $CustomerTable->CustomerID->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerID">
<span<?php echo $CustomerTable->CustomerID->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
		<tr id="r_CustomerName">
			<td class="<?php echo $CustomerTable->TableLeftColumnClass ?>"><?php echo $CustomerTable->CustomerName->caption() ?></td>
			<td<?php echo $CustomerTable->CustomerName->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerName">
<span<?php echo $CustomerTable->CustomerName->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
		<tr id="r_CustomerEmail">
			<td class="<?php echo $CustomerTable->TableLeftColumnClass ?>"><?php echo $CustomerTable->CustomerEmail->caption() ?></td>
			<td<?php echo $CustomerTable->CustomerEmail->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerEmail">
<span<?php echo $CustomerTable->CustomerEmail->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerEmail->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
		<tr id="r_BillingAddress">
			<td class="<?php echo $CustomerTable->TableLeftColumnClass ?>"><?php echo $CustomerTable->BillingAddress->caption() ?></td>
			<td<?php echo $CustomerTable->BillingAddress->cellAttributes() ?>>
<span id="el_CustomerTable_BillingAddress">
<span<?php echo $CustomerTable->BillingAddress->viewAttributes() ?>>
<?php echo $CustomerTable->BillingAddress->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
		<tr id="r_CustomerTelephone">
			<td class="<?php echo $CustomerTable->TableLeftColumnClass ?>"><?php echo $CustomerTable->CustomerTelephone->caption() ?></td>
			<td<?php echo $CustomerTable->CustomerTelephone->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerTelephone">
<span<?php echo $CustomerTable->CustomerTelephone->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerTelephone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>