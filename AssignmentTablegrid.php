<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($AssignmentTable_grid))
	$AssignmentTable_grid = new AssignmentTable_grid();

// Run the page
$AssignmentTable_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AssignmentTable_grid->Page_Render();
?>
<?php if (!$AssignmentTable->isExport()) { ?>
<script>

// Form object
var fAssignmentTablegrid = new ew.Form("fAssignmentTablegrid", "grid");
fAssignmentTablegrid.formKeyCountName = '<?php echo $AssignmentTable_grid->FormKeyCountName ?>';

// Validate form
fAssignmentTablegrid.validate = function() {
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
		<?php if ($AssignmentTable_grid->AssignmentID->Required) { ?>
			elm = this.getElements("x" + infix + "_AssignmentID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->AssignmentID->caption(), $AssignmentTable->AssignmentID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($AssignmentTable_grid->LeadID->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->LeadID->caption(), $AssignmentTable->LeadID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($AssignmentTable->LeadID->errorMessage()) ?>");
		<?php if ($AssignmentTable_grid->StartDate->Required) { ?>
			elm = this.getElements("x" + infix + "_StartDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->StartDate->caption(), $AssignmentTable->StartDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_StartDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($AssignmentTable->StartDate->errorMessage()) ?>");
		<?php if ($AssignmentTable_grid->AssignmentDuration->Required) { ?>
			elm = this.getElements("x" + infix + "_AssignmentDuration");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->AssignmentDuration->caption(), $AssignmentTable->AssignmentDuration->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fAssignmentTablegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "LeadID", false)) return false;
	if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
	if (ew.valueChanged(fobj, infix, "AssignmentDuration", false)) return false;
	return true;
}

// Form_CustomValidate event
fAssignmentTablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fAssignmentTablegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$AssignmentTable_grid->renderOtherOptions();
?>
<?php $AssignmentTable_grid->showPageHeader(); ?>
<?php
$AssignmentTable_grid->showMessage();
?>
<?php if ($AssignmentTable_grid->TotalRecs > 0 || $AssignmentTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($AssignmentTable_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> AssignmentTable">
<div id="fAssignmentTablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_AssignmentTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_AssignmentTablegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$AssignmentTable_grid->RowType = ROWTYPE_HEADER;

// Render list options
$AssignmentTable_grid->renderListOptions();

// Render list options (header, left)
$AssignmentTable_grid->ListOptions->render("header", "left");
?>
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->AssignmentID) == "") { ?>
		<th data-name="AssignmentID" class="<?php echo $AssignmentTable->AssignmentID->headerCellClass() ?>"><div id="elh_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID"><div class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssignmentID" class="<?php echo $AssignmentTable->AssignmentID->headerCellClass() ?>"><div><div id="elh_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentID->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->AssignmentID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->AssignmentID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $AssignmentTable->LeadID->headerCellClass() ?>"><div id="elh_AssignmentTable_LeadID" class="AssignmentTable_LeadID"><div class="ew-table-header-caption"><?php echo $AssignmentTable->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $AssignmentTable->LeadID->headerCellClass() ?>"><div><div id="elh_AssignmentTable_LeadID" class="AssignmentTable_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $AssignmentTable->StartDate->headerCellClass() ?>"><div id="elh_AssignmentTable_StartDate" class="AssignmentTable_StartDate"><div class="ew-table-header-caption"><?php echo $AssignmentTable->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $AssignmentTable->StartDate->headerCellClass() ?>"><div><div id="elh_AssignmentTable_StartDate" class="AssignmentTable_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->StartDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->StartDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->AssignmentDuration) == "") { ?>
		<th data-name="AssignmentDuration" class="<?php echo $AssignmentTable->AssignmentDuration->headerCellClass() ?>"><div id="elh_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration"><div class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentDuration->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssignmentDuration" class="<?php echo $AssignmentTable->AssignmentDuration->headerCellClass() ?>"><div><div id="elh_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentDuration->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->AssignmentDuration->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->AssignmentDuration->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$AssignmentTable_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$AssignmentTable_grid->StartRec = 1;
$AssignmentTable_grid->StopRec = $AssignmentTable_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $AssignmentTable_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($AssignmentTable_grid->FormKeyCountName) && ($AssignmentTable->isGridAdd() || $AssignmentTable->isGridEdit() || $AssignmentTable->isConfirm())) {
		$AssignmentTable_grid->KeyCount = $CurrentForm->getValue($AssignmentTable_grid->FormKeyCountName);
		$AssignmentTable_grid->StopRec = $AssignmentTable_grid->StartRec + $AssignmentTable_grid->KeyCount - 1;
	}
}
$AssignmentTable_grid->RecCnt = $AssignmentTable_grid->StartRec - 1;
if ($AssignmentTable_grid->Recordset && !$AssignmentTable_grid->Recordset->EOF) {
	$AssignmentTable_grid->Recordset->moveFirst();
	$selectLimit = $AssignmentTable_grid->UseSelectLimit;
	if (!$selectLimit && $AssignmentTable_grid->StartRec > 1)
		$AssignmentTable_grid->Recordset->move($AssignmentTable_grid->StartRec - 1);
} elseif (!$AssignmentTable->AllowAddDeleteRow && $AssignmentTable_grid->StopRec == 0) {
	$AssignmentTable_grid->StopRec = $AssignmentTable->GridAddRowCount;
}

// Initialize aggregate
$AssignmentTable->RowType = ROWTYPE_AGGREGATEINIT;
$AssignmentTable->resetAttributes();
$AssignmentTable_grid->renderRow();
if ($AssignmentTable->isGridAdd())
	$AssignmentTable_grid->RowIndex = 0;
if ($AssignmentTable->isGridEdit())
	$AssignmentTable_grid->RowIndex = 0;
while ($AssignmentTable_grid->RecCnt < $AssignmentTable_grid->StopRec) {
	$AssignmentTable_grid->RecCnt++;
	if ($AssignmentTable_grid->RecCnt >= $AssignmentTable_grid->StartRec) {
		$AssignmentTable_grid->RowCnt++;
		if ($AssignmentTable->isGridAdd() || $AssignmentTable->isGridEdit() || $AssignmentTable->isConfirm()) {
			$AssignmentTable_grid->RowIndex++;
			$CurrentForm->Index = $AssignmentTable_grid->RowIndex;
			if ($CurrentForm->hasValue($AssignmentTable_grid->FormActionName) && $AssignmentTable_grid->EventCancelled)
				$AssignmentTable_grid->RowAction = strval($CurrentForm->getValue($AssignmentTable_grid->FormActionName));
			elseif ($AssignmentTable->isGridAdd())
				$AssignmentTable_grid->RowAction = "insert";
			else
				$AssignmentTable_grid->RowAction = "";
		}

		// Set up key count
		$AssignmentTable_grid->KeyCount = $AssignmentTable_grid->RowIndex;

		// Init row class and style
		$AssignmentTable->resetAttributes();
		$AssignmentTable->CssClass = "";
		if ($AssignmentTable->isGridAdd()) {
			if ($AssignmentTable->CurrentMode == "copy") {
				$AssignmentTable_grid->loadRowValues($AssignmentTable_grid->Recordset); // Load row values
				$AssignmentTable_grid->setRecordKey($AssignmentTable_grid->RowOldKey, $AssignmentTable_grid->Recordset); // Set old record key
			} else {
				$AssignmentTable_grid->loadRowValues(); // Load default values
				$AssignmentTable_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$AssignmentTable_grid->loadRowValues($AssignmentTable_grid->Recordset); // Load row values
		}
		$AssignmentTable->RowType = ROWTYPE_VIEW; // Render view
		if ($AssignmentTable->isGridAdd()) // Grid add
			$AssignmentTable->RowType = ROWTYPE_ADD; // Render add
		if ($AssignmentTable->isGridAdd() && $AssignmentTable->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$AssignmentTable_grid->restoreCurrentRowFormValues($AssignmentTable_grid->RowIndex); // Restore form values
		if ($AssignmentTable->isGridEdit()) { // Grid edit
			if ($AssignmentTable->EventCancelled)
				$AssignmentTable_grid->restoreCurrentRowFormValues($AssignmentTable_grid->RowIndex); // Restore form values
			if ($AssignmentTable_grid->RowAction == "insert")
				$AssignmentTable->RowType = ROWTYPE_ADD; // Render add
			else
				$AssignmentTable->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($AssignmentTable->isGridEdit() && ($AssignmentTable->RowType == ROWTYPE_EDIT || $AssignmentTable->RowType == ROWTYPE_ADD) && $AssignmentTable->EventCancelled) // Update failed
			$AssignmentTable_grid->restoreCurrentRowFormValues($AssignmentTable_grid->RowIndex); // Restore form values
		if ($AssignmentTable->RowType == ROWTYPE_EDIT) // Edit row
			$AssignmentTable_grid->EditRowCnt++;
		if ($AssignmentTable->isConfirm()) // Confirm row
			$AssignmentTable_grid->restoreCurrentRowFormValues($AssignmentTable_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$AssignmentTable->RowAttrs = array_merge($AssignmentTable->RowAttrs, array('data-rowindex'=>$AssignmentTable_grid->RowCnt, 'id'=>'r' . $AssignmentTable_grid->RowCnt . '_AssignmentTable', 'data-rowtype'=>$AssignmentTable->RowType));

		// Render row
		$AssignmentTable_grid->renderRow();

		// Render list options
		$AssignmentTable_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($AssignmentTable_grid->RowAction <> "delete" && $AssignmentTable_grid->RowAction <> "insertdelete" && !($AssignmentTable_grid->RowAction == "insert" && $AssignmentTable->isConfirm() && $AssignmentTable_grid->emptyRow())) {
?>
	<tr<?php echo $AssignmentTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AssignmentTable_grid->ListOptions->render("body", "left", $AssignmentTable_grid->RowCnt);
?>
	<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
		<td data-name="AssignmentID"<?php echo $AssignmentTable->AssignmentID->cellAttributes() ?>>
<?php if ($AssignmentTable->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->OldValue) ?>">
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_AssignmentID" class="form-group AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->AssignmentID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->CurrentValue) ?>">
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentID->getViewValue() ?></span>
</span>
<?php if (!$AssignmentTable->isConfirm()) { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $AssignmentTable->LeadID->cellAttributes() ?>>
<?php if ($AssignmentTable->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($AssignmentTable->LeadID->getSessionValue() <> "") { ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<input type="text" data-table="AssignmentTable" data-field="x_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" size="30" placeholder="<?php echo HtmlEncode($AssignmentTable->LeadID->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->LeadID->EditValue ?>"<?php echo $AssignmentTable->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->OldValue) ?>">
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($AssignmentTable->LeadID->getSessionValue() <> "") { ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<input type="text" data-table="AssignmentTable" data-field="x_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" size="30" placeholder="<?php echo HtmlEncode($AssignmentTable->LeadID->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->LeadID->EditValue ?>"<?php echo $AssignmentTable->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_LeadID" class="AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<?php echo $AssignmentTable->LeadID->getViewValue() ?></span>
</span>
<?php if (!$AssignmentTable->isConfirm()) { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate"<?php echo $AssignmentTable->StartDate->cellAttributes() ?>>
<?php if ($AssignmentTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_StartDate" class="form-group AssignmentTable_StartDate">
<input type="text" data-table="AssignmentTable" data-field="x_StartDate" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($AssignmentTable->StartDate->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->StartDate->EditValue ?>"<?php echo $AssignmentTable->StartDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_StartDate" class="form-group AssignmentTable_StartDate">
<input type="text" data-table="AssignmentTable" data-field="x_StartDate" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($AssignmentTable->StartDate->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->StartDate->EditValue ?>"<?php echo $AssignmentTable->StartDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_StartDate" class="AssignmentTable_StartDate">
<span<?php echo $AssignmentTable->StartDate->viewAttributes() ?>>
<?php echo $AssignmentTable->StartDate->getViewValue() ?></span>
</span>
<?php if (!$AssignmentTable->isConfirm()) { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
		<td data-name="AssignmentDuration"<?php echo $AssignmentTable->AssignmentDuration->cellAttributes() ?>>
<?php if ($AssignmentTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_AssignmentDuration" class="form-group AssignmentTable_AssignmentDuration">
<input type="text" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->AssignmentDuration->EditValue ?>"<?php echo $AssignmentTable->AssignmentDuration->editAttributes() ?>>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->OldValue) ?>">
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_AssignmentDuration" class="form-group AssignmentTable_AssignmentDuration">
<input type="text" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->AssignmentDuration->EditValue ?>"<?php echo $AssignmentTable->AssignmentDuration->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($AssignmentTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $AssignmentTable_grid->RowCnt ?>_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration">
<span<?php echo $AssignmentTable->AssignmentDuration->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentDuration->getViewValue() ?></span>
</span>
<?php if (!$AssignmentTable->isConfirm()) { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="fAssignmentTablegrid$x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->FormValue) ?>">
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="fAssignmentTablegrid$o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AssignmentTable_grid->ListOptions->render("body", "right", $AssignmentTable_grid->RowCnt);
?>
	</tr>
<?php if ($AssignmentTable->RowType == ROWTYPE_ADD || $AssignmentTable->RowType == ROWTYPE_EDIT) { ?>
<script>
fAssignmentTablegrid.updateLists(<?php echo $AssignmentTable_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$AssignmentTable->isGridAdd() || $AssignmentTable->CurrentMode == "copy")
		if (!$AssignmentTable_grid->Recordset->EOF)
			$AssignmentTable_grid->Recordset->moveNext();
}
?>
<?php
	if ($AssignmentTable->CurrentMode == "add" || $AssignmentTable->CurrentMode == "copy" || $AssignmentTable->CurrentMode == "edit") {
		$AssignmentTable_grid->RowIndex = '$rowindex$';
		$AssignmentTable_grid->loadRowValues();

		// Set row properties
		$AssignmentTable->resetAttributes();
		$AssignmentTable->RowAttrs = array_merge($AssignmentTable->RowAttrs, array('data-rowindex'=>$AssignmentTable_grid->RowIndex, 'id'=>'r0_AssignmentTable', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($AssignmentTable->RowAttrs["class"], "ew-template");
		$AssignmentTable->RowType = ROWTYPE_ADD;

		// Render row
		$AssignmentTable_grid->renderRow();

		// Render list options
		$AssignmentTable_grid->renderListOptions();
		$AssignmentTable_grid->StartRowCnt = 0;
?>
	<tr<?php echo $AssignmentTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AssignmentTable_grid->ListOptions->render("body", "left", $AssignmentTable_grid->RowIndex);
?>
	<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
		<td data-name="AssignmentID">
<?php if (!$AssignmentTable->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_AssignmentTable_AssignmentID" class="form-group AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->AssignmentID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID">
<?php if (!$AssignmentTable->isConfirm()) { ?>
<?php if ($AssignmentTable->LeadID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<input type="text" data-table="AssignmentTable" data-field="x_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" size="30" placeholder="<?php echo HtmlEncode($AssignmentTable->LeadID->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->LeadID->EditValue ?>"<?php echo $AssignmentTable->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_AssignmentTable_LeadID" class="form-group AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_LeadID" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$AssignmentTable->isConfirm()) { ?>
<span id="el$rowindex$_AssignmentTable_StartDate" class="form-group AssignmentTable_StartDate">
<input type="text" data-table="AssignmentTable" data-field="x_StartDate" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($AssignmentTable->StartDate->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->StartDate->EditValue ?>"<?php echo $AssignmentTable->StartDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_AssignmentTable_StartDate" class="form-group AssignmentTable_StartDate">
<span<?php echo $AssignmentTable->StartDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->StartDate->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_StartDate" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($AssignmentTable->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
		<td data-name="AssignmentDuration">
<?php if (!$AssignmentTable->isConfirm()) { ?>
<span id="el$rowindex$_AssignmentTable_AssignmentDuration" class="form-group AssignmentTable_AssignmentDuration">
<input type="text" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->AssignmentDuration->EditValue ?>"<?php echo $AssignmentTable->AssignmentDuration->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_AssignmentTable_AssignmentDuration" class="form-group AssignmentTable_AssignmentDuration">
<span<?php echo $AssignmentTable->AssignmentDuration->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->AssignmentDuration->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="x<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" id="o<?php echo $AssignmentTable_grid->RowIndex ?>_AssignmentDuration" value="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AssignmentTable_grid->ListOptions->render("body", "right", $AssignmentTable_grid->RowIndex);
?>
<script>
fAssignmentTablegrid.updateLists(<?php echo $AssignmentTable_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($AssignmentTable->CurrentMode == "add" || $AssignmentTable->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $AssignmentTable_grid->FormKeyCountName ?>" id="<?php echo $AssignmentTable_grid->FormKeyCountName ?>" value="<?php echo $AssignmentTable_grid->KeyCount ?>">
<?php echo $AssignmentTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($AssignmentTable->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $AssignmentTable_grid->FormKeyCountName ?>" id="<?php echo $AssignmentTable_grid->FormKeyCountName ?>" value="<?php echo $AssignmentTable_grid->KeyCount ?>">
<?php echo $AssignmentTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($AssignmentTable->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fAssignmentTablegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($AssignmentTable_grid->Recordset)
	$AssignmentTable_grid->Recordset->Close();
?>
</div>
<?php if ($AssignmentTable_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $AssignmentTable_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($AssignmentTable_grid->TotalRecs == 0 && !$AssignmentTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $AssignmentTable_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$AssignmentTable_grid->terminate();
?>