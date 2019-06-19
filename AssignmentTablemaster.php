<?php
namespace PHPMaker2019\ASbuiltProject;
?>
<?php if ($AssignmentTable->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_AssignmentTablemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
		<tr id="r_AssignmentID">
			<td class="<?php echo $AssignmentTable->TableLeftColumnClass ?>"><?php echo $AssignmentTable->AssignmentID->caption() ?></td>
			<td<?php echo $AssignmentTable->AssignmentID->cellAttributes() ?>>
<span id="el_AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
		<tr id="r_LeadID">
			<td class="<?php echo $AssignmentTable->TableLeftColumnClass ?>"><?php echo $AssignmentTable->LeadID->caption() ?></td>
			<td<?php echo $AssignmentTable->LeadID->cellAttributes() ?>>
<span id="el_AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<?php echo $AssignmentTable->LeadID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
		<tr id="r_StartDate">
			<td class="<?php echo $AssignmentTable->TableLeftColumnClass ?>"><?php echo $AssignmentTable->StartDate->caption() ?></td>
			<td<?php echo $AssignmentTable->StartDate->cellAttributes() ?>>
<span id="el_AssignmentTable_StartDate">
<span<?php echo $AssignmentTable->StartDate->viewAttributes() ?>>
<?php echo $AssignmentTable->StartDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
		<tr id="r_AssignmentDuration">
			<td class="<?php echo $AssignmentTable->TableLeftColumnClass ?>"><?php echo $AssignmentTable->AssignmentDuration->caption() ?></td>
			<td<?php echo $AssignmentTable->AssignmentDuration->cellAttributes() ?>>
<span id="el_AssignmentTable_AssignmentDuration">
<span<?php echo $AssignmentTable->AssignmentDuration->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentDuration->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>