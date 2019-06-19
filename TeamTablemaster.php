<?php
namespace PHPMaker2019\ASbuiltProject;
?>
<?php if ($TeamTable->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_TeamTablemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
		<tr id="r_TeamID">
			<td class="<?php echo $TeamTable->TableLeftColumnClass ?>"><?php echo $TeamTable->TeamID->caption() ?></td>
			<td<?php echo $TeamTable->TeamID->cellAttributes() ?>>
<span id="el_TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<?php echo $TeamTable->TeamID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
		<tr id="r_TeamName">
			<td class="<?php echo $TeamTable->TableLeftColumnClass ?>"><?php echo $TeamTable->TeamName->caption() ?></td>
			<td<?php echo $TeamTable->TeamName->cellAttributes() ?>>
<span id="el_TeamTable_TeamName">
<span<?php echo $TeamTable->TeamName->viewAttributes() ?>>
<?php echo $TeamTable->TeamName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
		<tr id="r_TeamLeader">
			<td class="<?php echo $TeamTable->TableLeftColumnClass ?>"><?php echo $TeamTable->TeamLeader->caption() ?></td>
			<td<?php echo $TeamTable->TeamLeader->cellAttributes() ?>>
<span id="el_TeamTable_TeamLeader">
<span<?php echo $TeamTable->TeamLeader->viewAttributes() ?>>
<?php echo $TeamTable->TeamLeader->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
		<tr id="r_IsVisible">
			<td class="<?php echo $TeamTable->TableLeftColumnClass ?>"><?php echo $TeamTable->IsVisible->caption() ?></td>
			<td<?php echo $TeamTable->IsVisible->cellAttributes() ?>>
<span id="el_TeamTable_IsVisible">
<span<?php echo $TeamTable->IsVisible->viewAttributes() ?>>
<?php echo $TeamTable->IsVisible->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>