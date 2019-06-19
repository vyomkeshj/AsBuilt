<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($LeadFileAssociation_grid))
	$LeadFileAssociation_grid = new LeadFileAssociation_grid();

// Run the page
$LeadFileAssociation_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadFileAssociation_grid->Page_Render();
?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<script>

// Form object
var fLeadFileAssociationgrid = new ew.Form("fLeadFileAssociationgrid", "grid");
fLeadFileAssociationgrid.formKeyCountName = '<?php echo $LeadFileAssociation_grid->FormKeyCountName ?>';

// Validate form
fLeadFileAssociationgrid.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($LeadFileAssociation_grid->MappingID->Required) { ?>
			elm = this.getElements("x" + infix + "_MappingID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadFileAssociation->MappingID->caption(), $LeadFileAssociation->MappingID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadFileAssociation_grid->LeadID->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadFileAssociation->LeadID->caption(), $LeadFileAssociation->LeadID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadFileAssociation->LeadID->errorMessage()) ?>");
		<?php if ($LeadFileAssociation_grid->FileName->Required) { ?>
			elm = this.getElements("x" + infix + "_FileName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadFileAssociation->FileName->caption(), $LeadFileAssociation->FileName->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fLeadFileAssociationgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "LeadID", false)) return false;
	if (ew.valueChanged(fobj, infix, "FileName", false)) return false;
	return true;
}

// Form_CustomValidate event
fLeadFileAssociationgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadFileAssociationgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$LeadFileAssociation_grid->renderOtherOptions();
?>
<?php $LeadFileAssociation_grid->showPageHeader(); ?>
<?php
$LeadFileAssociation_grid->showMessage();
?>
<?php if ($LeadFileAssociation_grid->TotalRecs > 0 || $LeadFileAssociation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($LeadFileAssociation_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> LeadFileAssociation">
<div id="fLeadFileAssociationgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_LeadFileAssociation" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_LeadFileAssociationgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$LeadFileAssociation_grid->RowType = ROWTYPE_HEADER;

// Render list options
$LeadFileAssociation_grid->renderListOptions();

// Render list options (header, left)
$LeadFileAssociation_grid->ListOptions->render("header", "left");
?>
<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
	<?php if ($LeadFileAssociation->sortUrl($LeadFileAssociation->MappingID) == "") { ?>
		<th data-name="MappingID" class="<?php echo $LeadFileAssociation->MappingID->headerCellClass() ?>"><div id="elh_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID"><div class="ew-table-header-caption"><?php echo $LeadFileAssociation->MappingID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MappingID" class="<?php echo $LeadFileAssociation->MappingID->headerCellClass() ?>"><div><div id="elh_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadFileAssociation->MappingID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadFileAssociation->MappingID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadFileAssociation->MappingID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
	<?php if ($LeadFileAssociation->sortUrl($LeadFileAssociation->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $LeadFileAssociation->LeadID->headerCellClass() ?>"><div id="elh_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID"><div class="ew-table-header-caption"><?php echo $LeadFileAssociation->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $LeadFileAssociation->LeadID->headerCellClass() ?>"><div><div id="elh_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadFileAssociation->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadFileAssociation->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadFileAssociation->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
	<?php if ($LeadFileAssociation->sortUrl($LeadFileAssociation->FileName) == "") { ?>
		<th data-name="FileName" class="<?php echo $LeadFileAssociation->FileName->headerCellClass() ?>"><div id="elh_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName"><div class="ew-table-header-caption"><?php echo $LeadFileAssociation->FileName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FileName" class="<?php echo $LeadFileAssociation->FileName->headerCellClass() ?>"><div><div id="elh_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadFileAssociation->FileName->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadFileAssociation->FileName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadFileAssociation->FileName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$LeadFileAssociation_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$LeadFileAssociation_grid->StartRec = 1;
$LeadFileAssociation_grid->StopRec = $LeadFileAssociation_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $LeadFileAssociation_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($LeadFileAssociation_grid->FormKeyCountName) && ($LeadFileAssociation->isGridAdd() || $LeadFileAssociation->isGridEdit() || $LeadFileAssociation->isConfirm())) {
		$LeadFileAssociation_grid->KeyCount = $CurrentForm->getValue($LeadFileAssociation_grid->FormKeyCountName);
		$LeadFileAssociation_grid->StopRec = $LeadFileAssociation_grid->StartRec + $LeadFileAssociation_grid->KeyCount - 1;
	}
}
$LeadFileAssociation_grid->RecCnt = $LeadFileAssociation_grid->StartRec - 1;
if ($LeadFileAssociation_grid->Recordset && !$LeadFileAssociation_grid->Recordset->EOF) {
	$LeadFileAssociation_grid->Recordset->moveFirst();
	$selectLimit = $LeadFileAssociation_grid->UseSelectLimit;
	if (!$selectLimit && $LeadFileAssociation_grid->StartRec > 1)
		$LeadFileAssociation_grid->Recordset->move($LeadFileAssociation_grid->StartRec - 1);
} elseif (!$LeadFileAssociation->AllowAddDeleteRow && $LeadFileAssociation_grid->StopRec == 0) {
	$LeadFileAssociation_grid->StopRec = $LeadFileAssociation->GridAddRowCount;
}

// Initialize aggregate
$LeadFileAssociation->RowType = ROWTYPE_AGGREGATEINIT;
$LeadFileAssociation->resetAttributes();
$LeadFileAssociation_grid->renderRow();
if ($LeadFileAssociation->isGridAdd())
	$LeadFileAssociation_grid->RowIndex = 0;
if ($LeadFileAssociation->isGridEdit())
	$LeadFileAssociation_grid->RowIndex = 0;
while ($LeadFileAssociation_grid->RecCnt < $LeadFileAssociation_grid->StopRec) {
	$LeadFileAssociation_grid->RecCnt++;
	if ($LeadFileAssociation_grid->RecCnt >= $LeadFileAssociation_grid->StartRec) {
		$LeadFileAssociation_grid->RowCnt++;
		if ($LeadFileAssociation->isGridAdd() || $LeadFileAssociation->isGridEdit() || $LeadFileAssociation->isConfirm()) {
			$LeadFileAssociation_grid->RowIndex++;
			$CurrentForm->Index = $LeadFileAssociation_grid->RowIndex;
			if ($CurrentForm->hasValue($LeadFileAssociation_grid->FormActionName) && $LeadFileAssociation_grid->EventCancelled)
				$LeadFileAssociation_grid->RowAction = strval($CurrentForm->getValue($LeadFileAssociation_grid->FormActionName));
			elseif ($LeadFileAssociation->isGridAdd())
				$LeadFileAssociation_grid->RowAction = "insert";
			else
				$LeadFileAssociation_grid->RowAction = "";
		}

		// Set up key count
		$LeadFileAssociation_grid->KeyCount = $LeadFileAssociation_grid->RowIndex;

		// Init row class and style
		$LeadFileAssociation->resetAttributes();
		$LeadFileAssociation->CssClass = "";
		if ($LeadFileAssociation->isGridAdd()) {
			if ($LeadFileAssociation->CurrentMode == "copy") {
				$LeadFileAssociation_grid->loadRowValues($LeadFileAssociation_grid->Recordset); // Load row values
				$LeadFileAssociation_grid->setRecordKey($LeadFileAssociation_grid->RowOldKey, $LeadFileAssociation_grid->Recordset); // Set old record key
			} else {
				$LeadFileAssociation_grid->loadRowValues(); // Load default values
				$LeadFileAssociation_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$LeadFileAssociation_grid->loadRowValues($LeadFileAssociation_grid->Recordset); // Load row values
		}
		$LeadFileAssociation->RowType = ROWTYPE_VIEW; // Render view
		if ($LeadFileAssociation->isGridAdd()) // Grid add
			$LeadFileAssociation->RowType = ROWTYPE_ADD; // Render add
		if ($LeadFileAssociation->isGridAdd() && $LeadFileAssociation->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$LeadFileAssociation_grid->restoreCurrentRowFormValues($LeadFileAssociation_grid->RowIndex); // Restore form values
		if ($LeadFileAssociation->isGridEdit()) { // Grid edit
			if ($LeadFileAssociation->EventCancelled)
				$LeadFileAssociation_grid->restoreCurrentRowFormValues($LeadFileAssociation_grid->RowIndex); // Restore form values
			if ($LeadFileAssociation_grid->RowAction == "insert")
				$LeadFileAssociation->RowType = ROWTYPE_ADD; // Render add
			else
				$LeadFileAssociation->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($LeadFileAssociation->isGridEdit() && ($LeadFileAssociation->RowType == ROWTYPE_EDIT || $LeadFileAssociation->RowType == ROWTYPE_ADD) && $LeadFileAssociation->EventCancelled) // Update failed
			$LeadFileAssociation_grid->restoreCurrentRowFormValues($LeadFileAssociation_grid->RowIndex); // Restore form values
		if ($LeadFileAssociation->RowType == ROWTYPE_EDIT) // Edit row
			$LeadFileAssociation_grid->EditRowCnt++;
		if ($LeadFileAssociation->isConfirm()) // Confirm row
			$LeadFileAssociation_grid->restoreCurrentRowFormValues($LeadFileAssociation_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$LeadFileAssociation->RowAttrs = array_merge($LeadFileAssociation->RowAttrs, array('data-rowindex'=>$LeadFileAssociation_grid->RowCnt, 'id'=>'r' . $LeadFileAssociation_grid->RowCnt . '_LeadFileAssociation', 'data-rowtype'=>$LeadFileAssociation->RowType));

		// Render row
		$LeadFileAssociation_grid->renderRow();

		// Render list options
		$LeadFileAssociation_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($LeadFileAssociation_grid->RowAction <> "delete" && $LeadFileAssociation_grid->RowAction <> "insertdelete" && !($LeadFileAssociation_grid->RowAction == "insert" && $LeadFileAssociation->isConfirm() && $LeadFileAssociation_grid->emptyRow())) {
?>
	<tr<?php echo $LeadFileAssociation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadFileAssociation_grid->ListOptions->render("body", "left", $LeadFileAssociation_grid->RowCnt);
?>
	<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
		<td data-name="MappingID"<?php echo $LeadFileAssociation->MappingID->cellAttributes() ?>>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->OldValue) ?>">
<?php } ?>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_MappingID" class="form-group LeadFileAssociation_MappingID">
<span<?php echo $LeadFileAssociation->MappingID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->MappingID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->CurrentValue) ?>">
<?php } ?>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID">
<span<?php echo $LeadFileAssociation->MappingID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->MappingID->getViewValue() ?></span>
</span>
<?php if (!$LeadFileAssociation->isConfirm()) { ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->FormValue) ?>">
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="fLeadFileAssociationgrid$x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="fLeadFileAssociationgrid$x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->FormValue) ?>">
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="fLeadFileAssociationgrid$o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="fLeadFileAssociationgrid$o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $LeadFileAssociation->LeadID->cellAttributes() ?>>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($LeadFileAssociation->LeadID->getSessionValue() <> "") { ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<input type="text" data-table="LeadFileAssociation" data-field="x_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" size="30" placeholder="<?php echo HtmlEncode($LeadFileAssociation->LeadID->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->LeadID->EditValue ?>"<?php echo $LeadFileAssociation->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->OldValue) ?>">
<?php } ?>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($LeadFileAssociation->LeadID->getSessionValue() <> "") { ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<input type="text" data-table="LeadFileAssociation" data-field="x_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" size="30" placeholder="<?php echo HtmlEncode($LeadFileAssociation->LeadID->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->LeadID->EditValue ?>"<?php echo $LeadFileAssociation->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->LeadID->getViewValue() ?></span>
</span>
<?php if (!$LeadFileAssociation->isConfirm()) { ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->FormValue) ?>">
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="fLeadFileAssociationgrid$x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="fLeadFileAssociationgrid$x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->FormValue) ?>">
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="fLeadFileAssociationgrid$o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="fLeadFileAssociationgrid$o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
		<td data-name="FileName"<?php echo $LeadFileAssociation->FileName->cellAttributes() ?>>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_FileName" class="form-group LeadFileAssociation_FileName">
<input type="text" data-table="LeadFileAssociation" data-field="x_FileName" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($LeadFileAssociation->FileName->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->FileName->EditValue ?>"<?php echo $LeadFileAssociation->FileName->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->OldValue) ?>">
<?php } ?>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_FileName" class="form-group LeadFileAssociation_FileName">
<input type="text" data-table="LeadFileAssociation" data-field="x_FileName" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($LeadFileAssociation->FileName->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->FileName->EditValue ?>"<?php echo $LeadFileAssociation->FileName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadFileAssociation_grid->RowCnt ?>_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName">
<span<?php echo $LeadFileAssociation->FileName->viewAttributes() ?>>
<?php echo $LeadFileAssociation->FileName->getViewValue() ?></span>
</span>
<?php if (!$LeadFileAssociation->isConfirm()) { ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->FormValue) ?>">
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="fLeadFileAssociationgrid$x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="fLeadFileAssociationgrid$x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->FormValue) ?>">
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="fLeadFileAssociationgrid$o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="fLeadFileAssociationgrid$o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadFileAssociation_grid->ListOptions->render("body", "right", $LeadFileAssociation_grid->RowCnt);
?>
	</tr>
<?php if ($LeadFileAssociation->RowType == ROWTYPE_ADD || $LeadFileAssociation->RowType == ROWTYPE_EDIT) { ?>
<script>
fLeadFileAssociationgrid.updateLists(<?php echo $LeadFileAssociation_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$LeadFileAssociation->isGridAdd() || $LeadFileAssociation->CurrentMode == "copy")
		if (!$LeadFileAssociation_grid->Recordset->EOF)
			$LeadFileAssociation_grid->Recordset->moveNext();
}
?>
<?php
	if ($LeadFileAssociation->CurrentMode == "add" || $LeadFileAssociation->CurrentMode == "copy" || $LeadFileAssociation->CurrentMode == "edit") {
		$LeadFileAssociation_grid->RowIndex = '$rowindex$';
		$LeadFileAssociation_grid->loadRowValues();

		// Set row properties
		$LeadFileAssociation->resetAttributes();
		$LeadFileAssociation->RowAttrs = array_merge($LeadFileAssociation->RowAttrs, array('data-rowindex'=>$LeadFileAssociation_grid->RowIndex, 'id'=>'r0_LeadFileAssociation', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($LeadFileAssociation->RowAttrs["class"], "ew-template");
		$LeadFileAssociation->RowType = ROWTYPE_ADD;

		// Render row
		$LeadFileAssociation_grid->renderRow();

		// Render list options
		$LeadFileAssociation_grid->renderListOptions();
		$LeadFileAssociation_grid->StartRowCnt = 0;
?>
	<tr<?php echo $LeadFileAssociation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadFileAssociation_grid->ListOptions->render("body", "left", $LeadFileAssociation_grid->RowIndex);
?>
	<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
		<td data-name="MappingID">
<?php if (!$LeadFileAssociation->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_LeadFileAssociation_MappingID" class="form-group LeadFileAssociation_MappingID">
<span<?php echo $LeadFileAssociation->MappingID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->MappingID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_MappingID" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_MappingID" value="<?php echo HtmlEncode($LeadFileAssociation->MappingID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID">
<?php if (!$LeadFileAssociation->isConfirm()) { ?>
<?php if ($LeadFileAssociation->LeadID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<input type="text" data-table="LeadFileAssociation" data-field="x_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" size="30" placeholder="<?php echo HtmlEncode($LeadFileAssociation->LeadID->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->LeadID->EditValue ?>"<?php echo $LeadFileAssociation->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_LeadFileAssociation_LeadID" class="form-group LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_LeadID" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
		<td data-name="FileName">
<?php if (!$LeadFileAssociation->isConfirm()) { ?>
<span id="el$rowindex$_LeadFileAssociation_FileName" class="form-group LeadFileAssociation_FileName">
<input type="text" data-table="LeadFileAssociation" data-field="x_FileName" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($LeadFileAssociation->FileName->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->FileName->EditValue ?>"<?php echo $LeadFileAssociation->FileName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadFileAssociation_FileName" class="form-group LeadFileAssociation_FileName">
<span<?php echo $LeadFileAssociation->FileName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->FileName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="x<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadFileAssociation" data-field="x_FileName" name="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" id="o<?php echo $LeadFileAssociation_grid->RowIndex ?>_FileName" value="<?php echo HtmlEncode($LeadFileAssociation->FileName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadFileAssociation_grid->ListOptions->render("body", "right", $LeadFileAssociation_grid->RowIndex);
?>
<script>
fLeadFileAssociationgrid.updateLists(<?php echo $LeadFileAssociation_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($LeadFileAssociation->CurrentMode == "add" || $LeadFileAssociation->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $LeadFileAssociation_grid->FormKeyCountName ?>" id="<?php echo $LeadFileAssociation_grid->FormKeyCountName ?>" value="<?php echo $LeadFileAssociation_grid->KeyCount ?>">
<?php echo $LeadFileAssociation_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($LeadFileAssociation->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $LeadFileAssociation_grid->FormKeyCountName ?>" id="<?php echo $LeadFileAssociation_grid->FormKeyCountName ?>" value="<?php echo $LeadFileAssociation_grid->KeyCount ?>">
<?php echo $LeadFileAssociation_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($LeadFileAssociation->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fLeadFileAssociationgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($LeadFileAssociation_grid->Recordset)
	$LeadFileAssociation_grid->Recordset->Close();
?>
</div>
<?php if ($LeadFileAssociation_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $LeadFileAssociation_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($LeadFileAssociation_grid->TotalRecs == 0 && !$LeadFileAssociation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $LeadFileAssociation_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$LeadFileAssociation_grid->terminate();
?>