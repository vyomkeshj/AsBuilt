<?php
namespace PHPMaker2019\ASbuiltProject;
?>
<?php if ($LeadTable->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_LeadTablemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
		<tr id="r_LeadID">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->LeadID->caption() ?></td>
			<td<?php echo $LeadTable->LeadID->cellAttributes() ?>>
<span id="el_LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<?php echo $LeadTable->LeadID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
		<tr id="r_CustomerID">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->CustomerID->caption() ?></td>
			<td<?php echo $LeadTable->CustomerID->cellAttributes() ?>>
<span id="el_LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<?php echo $LeadTable->CustomerID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
		<tr id="r_LeadType">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->LeadType->caption() ?></td>
			<td<?php echo $LeadTable->LeadType->cellAttributes() ?>>
<span id="el_LeadTable_LeadType">
<span<?php echo $LeadTable->LeadType->viewAttributes() ?>>
<?php echo $LeadTable->LeadType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
		<tr id="r_Suburb">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->Suburb->caption() ?></td>
			<td<?php echo $LeadTable->Suburb->cellAttributes() ?>>
<span id="el_LeadTable_Suburb">
<span<?php echo $LeadTable->Suburb->viewAttributes() ?>>
<?php echo $LeadTable->Suburb->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<tr id="r_ExpectedStart">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->ExpectedStart->caption() ?></td>
			<td<?php echo $LeadTable->ExpectedStart->cellAttributes() ?>>
<span id="el_LeadTable_ExpectedStart">
<span<?php echo $LeadTable->ExpectedStart->viewAttributes() ?>>
<?php echo $LeadTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
		<tr id="r_DateTaken">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->DateTaken->caption() ?></td>
			<td<?php echo $LeadTable->DateTaken->cellAttributes() ?>>
<span id="el_LeadTable_DateTaken">
<span<?php echo $LeadTable->DateTaken->viewAttributes() ?>>
<?php echo $LeadTable->DateTaken->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
		<tr id="r_TakenBy">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->TakenBy->caption() ?></td>
			<td<?php echo $LeadTable->TakenBy->cellAttributes() ?>>
<span id="el_LeadTable_TakenBy">
<span<?php echo $LeadTable->TakenBy->viewAttributes() ?>>
<?php echo $LeadTable->TakenBy->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
		<tr id="r_IsComplete">
			<td class="<?php echo $LeadTable->TableLeftColumnClass ?>"><?php echo $LeadTable->IsComplete->caption() ?></td>
			<td<?php echo $LeadTable->IsComplete->cellAttributes() ?>>
<span id="el_LeadTable_IsComplete">
<span<?php echo $LeadTable->IsComplete->viewAttributes() ?>>
<?php echo $LeadTable->IsComplete->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>