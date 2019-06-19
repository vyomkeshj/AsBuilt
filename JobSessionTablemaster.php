<?php
namespace PHPMaker2019\ASbuiltProject;
?>
<?php if ($JobSessionTable->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_JobSessionTablemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
		<tr id="r_SessionID">
			<td class="<?php echo $JobSessionTable->TableLeftColumnClass ?>"><?php echo $JobSessionTable->SessionID->caption() ?></td>
			<td<?php echo $JobSessionTable->SessionID->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
		<tr id="r_AssignmentID">
			<td class="<?php echo $JobSessionTable->TableLeftColumnClass ?>"><?php echo $JobSessionTable->AssignmentID->caption() ?></td>
			<td<?php echo $JobSessionTable->AssignmentID->cellAttributes() ?>>
<span id="el_JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<?php echo $JobSessionTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
		<tr id="r_SessionTeam">
			<td class="<?php echo $JobSessionTable->TableLeftColumnClass ?>"><?php echo $JobSessionTable->SessionTeam->caption() ?></td>
			<td<?php echo $JobSessionTable->SessionTeam->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionTeam">
<span<?php echo $JobSessionTable->SessionTeam->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionTeam->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
		<tr id="r_StartTimestamp">
			<td class="<?php echo $JobSessionTable->TableLeftColumnClass ?>"><?php echo $JobSessionTable->StartTimestamp->caption() ?></td>
			<td<?php echo $JobSessionTable->StartTimestamp->cellAttributes() ?>>
<span id="el_JobSessionTable_StartTimestamp">
<span<?php echo $JobSessionTable->StartTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->StartTimestamp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
		<tr id="r_FinishTimestamp">
			<td class="<?php echo $JobSessionTable->TableLeftColumnClass ?>"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></td>
			<td<?php echo $JobSessionTable->FinishTimestamp->cellAttributes() ?>>
<span id="el_JobSessionTable_FinishTimestamp">
<span<?php echo $JobSessionTable->FinishTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->FinishTimestamp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<tr id="r_ExpectedStart">
			<td class="<?php echo $JobSessionTable->TableLeftColumnClass ?>"><?php echo $JobSessionTable->ExpectedStart->caption() ?></td>
			<td<?php echo $JobSessionTable->ExpectedStart->cellAttributes() ?>>
<span id="el_JobSessionTable_ExpectedStart">
<span<?php echo $JobSessionTable->ExpectedStart->viewAttributes() ?>>
<?php echo $JobSessionTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>