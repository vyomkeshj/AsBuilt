<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($JobSessionTable_grid))
	$JobSessionTable_grid = new JobSessionTable_grid();

// Run the page
$JobSessionTable_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobSessionTable_grid->Page_Render();
?>
<?php if (!$JobSessionTable->isExport()) { ?>
<script>

// Form object
var fJobSessionTablegrid = new ew.Form("fJobSessionTablegrid", "grid");
fJobSessionTablegrid.formKeyCountName = '<?php echo $JobSessionTable_grid->FormKeyCountName ?>';

// Validate form
fJobSessionTablegrid.validate = function() {
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
		<?php if ($JobSessionTable_grid->SessionID->Required) { ?>
			elm = this.getElements("x" + infix + "_SessionID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->SessionID->caption(), $JobSessionTable->SessionID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($JobSessionTable_grid->AssignmentID->Required) { ?>
			elm = this.getElements("x" + infix + "_AssignmentID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->AssignmentID->caption(), $JobSessionTable->AssignmentID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_AssignmentID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->AssignmentID->errorMessage()) ?>");
		<?php if ($JobSessionTable_grid->SessionTeam->Required) { ?>
			elm = this.getElements("x" + infix + "_SessionTeam");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->SessionTeam->caption(), $JobSessionTable->SessionTeam->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_SessionTeam");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->SessionTeam->errorMessage()) ?>");
		<?php if ($JobSessionTable_grid->StartTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_StartTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->StartTimestamp->caption(), $JobSessionTable->StartTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_StartTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->StartTimestamp->errorMessage()) ?>");
		<?php if ($JobSessionTable_grid->FinishTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_FinishTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->FinishTimestamp->caption(), $JobSessionTable->FinishTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_FinishTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->FinishTimestamp->errorMessage()) ?>");
		<?php if ($JobSessionTable_grid->ExpectedStart->Required) { ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->ExpectedStart->caption(), $JobSessionTable->ExpectedStart->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->ExpectedStart->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fJobSessionTablegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "AssignmentID", false)) return false;
	if (ew.valueChanged(fobj, infix, "SessionTeam", false)) return false;
	if (ew.valueChanged(fobj, infix, "StartTimestamp", false)) return false;
	if (ew.valueChanged(fobj, infix, "FinishTimestamp", false)) return false;
	if (ew.valueChanged(fobj, infix, "ExpectedStart", false)) return false;
	return true;
}

// Form_CustomValidate event
fJobSessionTablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobSessionTablegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$JobSessionTable_grid->renderOtherOptions();
?>
<?php $JobSessionTable_grid->showPageHeader(); ?>
<?php
$JobSessionTable_grid->showMessage();
?>
<?php if ($JobSessionTable_grid->TotalRecs > 0 || $JobSessionTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobSessionTable_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobSessionTable">
<div id="fJobSessionTablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_JobSessionTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_JobSessionTablegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobSessionTable_grid->RowType = ROWTYPE_HEADER;

// Render list options
$JobSessionTable_grid->renderListOptions();

// Render list options (header, left)
$JobSessionTable_grid->ListOptions->render("header", "left");
?>
<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->SessionID) == "") { ?>
		<th data-name="SessionID" class="<?php echo $JobSessionTable->SessionID->headerCellClass() ?>"><div id="elh_JobSessionTable_SessionID" class="JobSessionTable_SessionID"><div class="ew-table-header-caption"><?php echo $JobSessionTable->SessionID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionID" class="<?php echo $JobSessionTable->SessionID->headerCellClass() ?>"><div><div id="elh_JobSessionTable_SessionID" class="JobSessionTable_SessionID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->SessionID->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->SessionID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->SessionID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->AssignmentID) == "") { ?>
		<th data-name="AssignmentID" class="<?php echo $JobSessionTable->AssignmentID->headerCellClass() ?>"><div id="elh_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID"><div class="ew-table-header-caption"><?php echo $JobSessionTable->AssignmentID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssignmentID" class="<?php echo $JobSessionTable->AssignmentID->headerCellClass() ?>"><div><div id="elh_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->AssignmentID->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->AssignmentID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->AssignmentID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->SessionTeam) == "") { ?>
		<th data-name="SessionTeam" class="<?php echo $JobSessionTable->SessionTeam->headerCellClass() ?>"><div id="elh_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam"><div class="ew-table-header-caption"><?php echo $JobSessionTable->SessionTeam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionTeam" class="<?php echo $JobSessionTable->SessionTeam->headerCellClass() ?>"><div><div id="elh_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->SessionTeam->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->SessionTeam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->SessionTeam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->StartTimestamp) == "") { ?>
		<th data-name="StartTimestamp" class="<?php echo $JobSessionTable->StartTimestamp->headerCellClass() ?>"><div id="elh_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp"><div class="ew-table-header-caption"><?php echo $JobSessionTable->StartTimestamp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartTimestamp" class="<?php echo $JobSessionTable->StartTimestamp->headerCellClass() ?>"><div><div id="elh_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->StartTimestamp->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->StartTimestamp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->StartTimestamp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->FinishTimestamp) == "") { ?>
		<th data-name="FinishTimestamp" class="<?php echo $JobSessionTable->FinishTimestamp->headerCellClass() ?>"><div id="elh_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp"><div class="ew-table-header-caption"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinishTimestamp" class="<?php echo $JobSessionTable->FinishTimestamp->headerCellClass() ?>"><div><div id="elh_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->FinishTimestamp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->FinishTimestamp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->ExpectedStart) == "") { ?>
		<th data-name="ExpectedStart" class="<?php echo $JobSessionTable->ExpectedStart->headerCellClass() ?>"><div id="elh_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart"><div class="ew-table-header-caption"><?php echo $JobSessionTable->ExpectedStart->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedStart" class="<?php echo $JobSessionTable->ExpectedStart->headerCellClass() ?>"><div><div id="elh_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->ExpectedStart->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->ExpectedStart->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->ExpectedStart->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobSessionTable_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$JobSessionTable_grid->StartRec = 1;
$JobSessionTable_grid->StopRec = $JobSessionTable_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $JobSessionTable_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($JobSessionTable_grid->FormKeyCountName) && ($JobSessionTable->isGridAdd() || $JobSessionTable->isGridEdit() || $JobSessionTable->isConfirm())) {
		$JobSessionTable_grid->KeyCount = $CurrentForm->getValue($JobSessionTable_grid->FormKeyCountName);
		$JobSessionTable_grid->StopRec = $JobSessionTable_grid->StartRec + $JobSessionTable_grid->KeyCount - 1;
	}
}
$JobSessionTable_grid->RecCnt = $JobSessionTable_grid->StartRec - 1;
if ($JobSessionTable_grid->Recordset && !$JobSessionTable_grid->Recordset->EOF) {
	$JobSessionTable_grid->Recordset->moveFirst();
	$selectLimit = $JobSessionTable_grid->UseSelectLimit;
	if (!$selectLimit && $JobSessionTable_grid->StartRec > 1)
		$JobSessionTable_grid->Recordset->move($JobSessionTable_grid->StartRec - 1);
} elseif (!$JobSessionTable->AllowAddDeleteRow && $JobSessionTable_grid->StopRec == 0) {
	$JobSessionTable_grid->StopRec = $JobSessionTable->GridAddRowCount;
}

// Initialize aggregate
$JobSessionTable->RowType = ROWTYPE_AGGREGATEINIT;
$JobSessionTable->resetAttributes();
$JobSessionTable_grid->renderRow();
if ($JobSessionTable->isGridAdd())
	$JobSessionTable_grid->RowIndex = 0;
if ($JobSessionTable->isGridEdit())
	$JobSessionTable_grid->RowIndex = 0;
while ($JobSessionTable_grid->RecCnt < $JobSessionTable_grid->StopRec) {
	$JobSessionTable_grid->RecCnt++;
	if ($JobSessionTable_grid->RecCnt >= $JobSessionTable_grid->StartRec) {
		$JobSessionTable_grid->RowCnt++;
		if ($JobSessionTable->isGridAdd() || $JobSessionTable->isGridEdit() || $JobSessionTable->isConfirm()) {
			$JobSessionTable_grid->RowIndex++;
			$CurrentForm->Index = $JobSessionTable_grid->RowIndex;
			if ($CurrentForm->hasValue($JobSessionTable_grid->FormActionName) && $JobSessionTable_grid->EventCancelled)
				$JobSessionTable_grid->RowAction = strval($CurrentForm->getValue($JobSessionTable_grid->FormActionName));
			elseif ($JobSessionTable->isGridAdd())
				$JobSessionTable_grid->RowAction = "insert";
			else
				$JobSessionTable_grid->RowAction = "";
		}

		// Set up key count
		$JobSessionTable_grid->KeyCount = $JobSessionTable_grid->RowIndex;

		// Init row class and style
		$JobSessionTable->resetAttributes();
		$JobSessionTable->CssClass = "";
		if ($JobSessionTable->isGridAdd()) {
			if ($JobSessionTable->CurrentMode == "copy") {
				$JobSessionTable_grid->loadRowValues($JobSessionTable_grid->Recordset); // Load row values
				$JobSessionTable_grid->setRecordKey($JobSessionTable_grid->RowOldKey, $JobSessionTable_grid->Recordset); // Set old record key
			} else {
				$JobSessionTable_grid->loadRowValues(); // Load default values
				$JobSessionTable_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$JobSessionTable_grid->loadRowValues($JobSessionTable_grid->Recordset); // Load row values
		}
		$JobSessionTable->RowType = ROWTYPE_VIEW; // Render view
		if ($JobSessionTable->isGridAdd()) // Grid add
			$JobSessionTable->RowType = ROWTYPE_ADD; // Render add
		if ($JobSessionTable->isGridAdd() && $JobSessionTable->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$JobSessionTable_grid->restoreCurrentRowFormValues($JobSessionTable_grid->RowIndex); // Restore form values
		if ($JobSessionTable->isGridEdit()) { // Grid edit
			if ($JobSessionTable->EventCancelled)
				$JobSessionTable_grid->restoreCurrentRowFormValues($JobSessionTable_grid->RowIndex); // Restore form values
			if ($JobSessionTable_grid->RowAction == "insert")
				$JobSessionTable->RowType = ROWTYPE_ADD; // Render add
			else
				$JobSessionTable->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($JobSessionTable->isGridEdit() && ($JobSessionTable->RowType == ROWTYPE_EDIT || $JobSessionTable->RowType == ROWTYPE_ADD) && $JobSessionTable->EventCancelled) // Update failed
			$JobSessionTable_grid->restoreCurrentRowFormValues($JobSessionTable_grid->RowIndex); // Restore form values
		if ($JobSessionTable->RowType == ROWTYPE_EDIT) // Edit row
			$JobSessionTable_grid->EditRowCnt++;
		if ($JobSessionTable->isConfirm()) // Confirm row
			$JobSessionTable_grid->restoreCurrentRowFormValues($JobSessionTable_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$JobSessionTable->RowAttrs = array_merge($JobSessionTable->RowAttrs, array('data-rowindex'=>$JobSessionTable_grid->RowCnt, 'id'=>'r' . $JobSessionTable_grid->RowCnt . '_JobSessionTable', 'data-rowtype'=>$JobSessionTable->RowType));

		// Render row
		$JobSessionTable_grid->renderRow();

		// Render list options
		$JobSessionTable_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($JobSessionTable_grid->RowAction <> "delete" && $JobSessionTable_grid->RowAction <> "insertdelete" && !($JobSessionTable_grid->RowAction == "insert" && $JobSessionTable->isConfirm() && $JobSessionTable_grid->emptyRow())) {
?>
	<tr<?php echo $JobSessionTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobSessionTable_grid->ListOptions->render("body", "left", $JobSessionTable_grid->RowCnt);
?>
	<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID"<?php echo $JobSessionTable->SessionID->cellAttributes() ?>>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->OldValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_SessionID" class="form-group JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->SessionID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->CurrentValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_SessionID" class="JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionID->getViewValue() ?></span>
</span>
<?php if (!$JobSessionTable->isConfirm()) { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
		<td data-name="AssignmentID"<?php echo $JobSessionTable->AssignmentID->cellAttributes() ?>>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($JobSessionTable->AssignmentID->getSessionValue() <> "") { ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->AssignmentID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<input type="text" data-table="JobSessionTable" data-field="x_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->AssignmentID->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->AssignmentID->EditValue ?>"<?php echo $JobSessionTable->AssignmentID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->OldValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($JobSessionTable->AssignmentID->getSessionValue() <> "") { ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->AssignmentID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<input type="text" data-table="JobSessionTable" data-field="x_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->AssignmentID->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->AssignmentID->EditValue ?>"<?php echo $JobSessionTable->AssignmentID->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<?php echo $JobSessionTable->AssignmentID->getViewValue() ?></span>
</span>
<?php if (!$JobSessionTable->isConfirm()) { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
		<td data-name="SessionTeam"<?php echo $JobSessionTable->SessionTeam->cellAttributes() ?>>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_SessionTeam" class="form-group JobSessionTable_SessionTeam">
<input type="text" data-table="JobSessionTable" data-field="x_SessionTeam" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->SessionTeam->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->SessionTeam->EditValue ?>"<?php echo $JobSessionTable->SessionTeam->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->OldValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_SessionTeam" class="form-group JobSessionTable_SessionTeam">
<input type="text" data-table="JobSessionTable" data-field="x_SessionTeam" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->SessionTeam->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->SessionTeam->EditValue ?>"<?php echo $JobSessionTable->SessionTeam->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam">
<span<?php echo $JobSessionTable->SessionTeam->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionTeam->getViewValue() ?></span>
</span>
<?php if (!$JobSessionTable->isConfirm()) { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
		<td data-name="StartTimestamp"<?php echo $JobSessionTable->StartTimestamp->cellAttributes() ?>>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_StartTimestamp" class="form-group JobSessionTable_StartTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_StartTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->StartTimestamp->EditValue ?>"<?php echo $JobSessionTable->StartTimestamp->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->OldValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_StartTimestamp" class="form-group JobSessionTable_StartTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_StartTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->StartTimestamp->EditValue ?>"<?php echo $JobSessionTable->StartTimestamp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp">
<span<?php echo $JobSessionTable->StartTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->StartTimestamp->getViewValue() ?></span>
</span>
<?php if (!$JobSessionTable->isConfirm()) { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
		<td data-name="FinishTimestamp"<?php echo $JobSessionTable->FinishTimestamp->cellAttributes() ?>>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_FinishTimestamp" class="form-group JobSessionTable_FinishTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->FinishTimestamp->EditValue ?>"<?php echo $JobSessionTable->FinishTimestamp->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->OldValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_FinishTimestamp" class="form-group JobSessionTable_FinishTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->FinishTimestamp->EditValue ?>"<?php echo $JobSessionTable->FinishTimestamp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp">
<span<?php echo $JobSessionTable->FinishTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->FinishTimestamp->getViewValue() ?></span>
</span>
<?php if (!$JobSessionTable->isConfirm()) { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart"<?php echo $JobSessionTable->ExpectedStart->cellAttributes() ?>>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_ExpectedStart" class="form-group JobSessionTable_ExpectedStart">
<input type="text" data-table="JobSessionTable" data-field="x_ExpectedStart" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" placeholder="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->ExpectedStart->EditValue ?>"<?php echo $JobSessionTable->ExpectedStart->editAttributes() ?>>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->OldValue) ?>">
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_ExpectedStart" class="form-group JobSessionTable_ExpectedStart">
<input type="text" data-table="JobSessionTable" data-field="x_ExpectedStart" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" placeholder="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->ExpectedStart->EditValue ?>"<?php echo $JobSessionTable->ExpectedStart->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($JobSessionTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $JobSessionTable_grid->RowCnt ?>_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart">
<span<?php echo $JobSessionTable->ExpectedStart->viewAttributes() ?>>
<?php echo $JobSessionTable->ExpectedStart->getViewValue() ?></span>
</span>
<?php if (!$JobSessionTable->isConfirm()) { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="fJobSessionTablegrid$x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->FormValue) ?>">
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="fJobSessionTablegrid$o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobSessionTable_grid->ListOptions->render("body", "right", $JobSessionTable_grid->RowCnt);
?>
	</tr>
<?php if ($JobSessionTable->RowType == ROWTYPE_ADD || $JobSessionTable->RowType == ROWTYPE_EDIT) { ?>
<script>
fJobSessionTablegrid.updateLists(<?php echo $JobSessionTable_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$JobSessionTable->isGridAdd() || $JobSessionTable->CurrentMode == "copy")
		if (!$JobSessionTable_grid->Recordset->EOF)
			$JobSessionTable_grid->Recordset->moveNext();
}
?>
<?php
	if ($JobSessionTable->CurrentMode == "add" || $JobSessionTable->CurrentMode == "copy" || $JobSessionTable->CurrentMode == "edit") {
		$JobSessionTable_grid->RowIndex = '$rowindex$';
		$JobSessionTable_grid->loadRowValues();

		// Set row properties
		$JobSessionTable->resetAttributes();
		$JobSessionTable->RowAttrs = array_merge($JobSessionTable->RowAttrs, array('data-rowindex'=>$JobSessionTable_grid->RowIndex, 'id'=>'r0_JobSessionTable', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($JobSessionTable->RowAttrs["class"], "ew-template");
		$JobSessionTable->RowType = ROWTYPE_ADD;

		// Render row
		$JobSessionTable_grid->renderRow();

		// Render list options
		$JobSessionTable_grid->renderListOptions();
		$JobSessionTable_grid->StartRowCnt = 0;
?>
	<tr<?php echo $JobSessionTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobSessionTable_grid->ListOptions->render("body", "left", $JobSessionTable_grid->RowIndex);
?>
	<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID">
<?php if (!$JobSessionTable->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_SessionID" class="form-group JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->SessionID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionID" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($JobSessionTable->SessionID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
		<td data-name="AssignmentID">
<?php if (!$JobSessionTable->isConfirm()) { ?>
<?php if ($JobSessionTable->AssignmentID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->AssignmentID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<input type="text" data-table="JobSessionTable" data-field="x_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->AssignmentID->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->AssignmentID->EditValue ?>"<?php echo $JobSessionTable->AssignmentID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_AssignmentID" class="form-group JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->AssignmentID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_AssignmentID" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
		<td data-name="SessionTeam">
<?php if (!$JobSessionTable->isConfirm()) { ?>
<span id="el$rowindex$_JobSessionTable_SessionTeam" class="form-group JobSessionTable_SessionTeam">
<input type="text" data-table="JobSessionTable" data-field="x_SessionTeam" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->SessionTeam->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->SessionTeam->EditValue ?>"<?php echo $JobSessionTable->SessionTeam->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_SessionTeam" class="form-group JobSessionTable_SessionTeam">
<span<?php echo $JobSessionTable->SessionTeam->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->SessionTeam->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_SessionTeam" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_SessionTeam" value="<?php echo HtmlEncode($JobSessionTable->SessionTeam->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
		<td data-name="StartTimestamp">
<?php if (!$JobSessionTable->isConfirm()) { ?>
<span id="el$rowindex$_JobSessionTable_StartTimestamp" class="form-group JobSessionTable_StartTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_StartTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->StartTimestamp->EditValue ?>"<?php echo $JobSessionTable->StartTimestamp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_StartTimestamp" class="form-group JobSessionTable_StartTimestamp">
<span<?php echo $JobSessionTable->StartTimestamp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->StartTimestamp->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_StartTimestamp" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_StartTimestamp" value="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
		<td data-name="FinishTimestamp">
<?php if (!$JobSessionTable->isConfirm()) { ?>
<span id="el$rowindex$_JobSessionTable_FinishTimestamp" class="form-group JobSessionTable_FinishTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->FinishTimestamp->EditValue ?>"<?php echo $JobSessionTable->FinishTimestamp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_FinishTimestamp" class="form-group JobSessionTable_FinishTimestamp">
<span<?php echo $JobSessionTable->FinishTimestamp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->FinishTimestamp->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_FinishTimestamp" value="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart">
<?php if (!$JobSessionTable->isConfirm()) { ?>
<span id="el$rowindex$_JobSessionTable_ExpectedStart" class="form-group JobSessionTable_ExpectedStart">
<input type="text" data-table="JobSessionTable" data-field="x_ExpectedStart" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" placeholder="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->ExpectedStart->EditValue ?>"<?php echo $JobSessionTable->ExpectedStart->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_JobSessionTable_ExpectedStart" class="form-group JobSessionTable_ExpectedStart">
<span<?php echo $JobSessionTable->ExpectedStart->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->ExpectedStart->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="JobSessionTable" data-field="x_ExpectedStart" name="o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" id="o<?php echo $JobSessionTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobSessionTable_grid->ListOptions->render("body", "right", $JobSessionTable_grid->RowIndex);
?>
<script>
fJobSessionTablegrid.updateLists(<?php echo $JobSessionTable_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($JobSessionTable->CurrentMode == "add" || $JobSessionTable->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $JobSessionTable_grid->FormKeyCountName ?>" id="<?php echo $JobSessionTable_grid->FormKeyCountName ?>" value="<?php echo $JobSessionTable_grid->KeyCount ?>">
<?php echo $JobSessionTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($JobSessionTable->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $JobSessionTable_grid->FormKeyCountName ?>" id="<?php echo $JobSessionTable_grid->FormKeyCountName ?>" value="<?php echo $JobSessionTable_grid->KeyCount ?>">
<?php echo $JobSessionTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($JobSessionTable->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fJobSessionTablegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($JobSessionTable_grid->Recordset)
	$JobSessionTable_grid->Recordset->Close();
?>
</div>
<?php if ($JobSessionTable_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $JobSessionTable_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobSessionTable_grid->TotalRecs == 0 && !$JobSessionTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobSessionTable_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobSessionTable_grid->terminate();
?>