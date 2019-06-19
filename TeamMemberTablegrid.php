<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($TeamMemberTable_grid))
	$TeamMemberTable_grid = new TeamMemberTable_grid();

// Run the page
$TeamMemberTable_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamMemberTable_grid->Page_Render();
?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<script>

// Form object
var fTeamMemberTablegrid = new ew.Form("fTeamMemberTablegrid", "grid");
fTeamMemberTablegrid.formKeyCountName = '<?php echo $TeamMemberTable_grid->FormKeyCountName ?>';

// Validate form
fTeamMemberTablegrid.validate = function() {
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
		<?php if ($TeamMemberTable_grid->serial->Required) { ?>
			elm = this.getElements("x" + infix + "_serial");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamMemberTable->serial->caption(), $TeamMemberTable->serial->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($TeamMemberTable_grid->TeamID->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamMemberTable->TeamID->caption(), $TeamMemberTable->TeamID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TeamID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamMemberTable->TeamID->errorMessage()) ?>");
		<?php if ($TeamMemberTable_grid->JobWorkerID->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamMemberTable->JobWorkerID->caption(), $TeamMemberTable->JobWorkerID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_JobWorkerID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamMemberTable->JobWorkerID->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fTeamMemberTablegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "TeamID", false)) return false;
	if (ew.valueChanged(fobj, infix, "JobWorkerID", false)) return false;
	return true;
}

// Form_CustomValidate event
fTeamMemberTablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamMemberTablegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$TeamMemberTable_grid->renderOtherOptions();
?>
<?php $TeamMemberTable_grid->showPageHeader(); ?>
<?php
$TeamMemberTable_grid->showMessage();
?>
<?php if ($TeamMemberTable_grid->TotalRecs > 0 || $TeamMemberTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($TeamMemberTable_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TeamMemberTable">
<div id="fTeamMemberTablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_TeamMemberTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_TeamMemberTablegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$TeamMemberTable_grid->RowType = ROWTYPE_HEADER;

// Render list options
$TeamMemberTable_grid->renderListOptions();

// Render list options (header, left)
$TeamMemberTable_grid->ListOptions->render("header", "left");
?>
<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
	<?php if ($TeamMemberTable->sortUrl($TeamMemberTable->serial) == "") { ?>
		<th data-name="serial" class="<?php echo $TeamMemberTable->serial->headerCellClass() ?>"><div id="elh_TeamMemberTable_serial" class="TeamMemberTable_serial"><div class="ew-table-header-caption"><?php echo $TeamMemberTable->serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="serial" class="<?php echo $TeamMemberTable->serial->headerCellClass() ?>"><div><div id="elh_TeamMemberTable_serial" class="TeamMemberTable_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamMemberTable->serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamMemberTable->serial->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamMemberTable->serial->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
	<?php if ($TeamMemberTable->sortUrl($TeamMemberTable->TeamID) == "") { ?>
		<th data-name="TeamID" class="<?php echo $TeamMemberTable->TeamID->headerCellClass() ?>"><div id="elh_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID"><div class="ew-table-header-caption"><?php echo $TeamMemberTable->TeamID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamID" class="<?php echo $TeamMemberTable->TeamID->headerCellClass() ?>"><div><div id="elh_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamMemberTable->TeamID->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamMemberTable->TeamID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamMemberTable->TeamID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
	<?php if ($TeamMemberTable->sortUrl($TeamMemberTable->JobWorkerID) == "") { ?>
		<th data-name="JobWorkerID" class="<?php echo $TeamMemberTable->JobWorkerID->headerCellClass() ?>"><div id="elh_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID"><div class="ew-table-header-caption"><?php echo $TeamMemberTable->JobWorkerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerID" class="<?php echo $TeamMemberTable->JobWorkerID->headerCellClass() ?>"><div><div id="elh_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamMemberTable->JobWorkerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamMemberTable->JobWorkerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamMemberTable->JobWorkerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$TeamMemberTable_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$TeamMemberTable_grid->StartRec = 1;
$TeamMemberTable_grid->StopRec = $TeamMemberTable_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $TeamMemberTable_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($TeamMemberTable_grid->FormKeyCountName) && ($TeamMemberTable->isGridAdd() || $TeamMemberTable->isGridEdit() || $TeamMemberTable->isConfirm())) {
		$TeamMemberTable_grid->KeyCount = $CurrentForm->getValue($TeamMemberTable_grid->FormKeyCountName);
		$TeamMemberTable_grid->StopRec = $TeamMemberTable_grid->StartRec + $TeamMemberTable_grid->KeyCount - 1;
	}
}
$TeamMemberTable_grid->RecCnt = $TeamMemberTable_grid->StartRec - 1;
if ($TeamMemberTable_grid->Recordset && !$TeamMemberTable_grid->Recordset->EOF) {
	$TeamMemberTable_grid->Recordset->moveFirst();
	$selectLimit = $TeamMemberTable_grid->UseSelectLimit;
	if (!$selectLimit && $TeamMemberTable_grid->StartRec > 1)
		$TeamMemberTable_grid->Recordset->move($TeamMemberTable_grid->StartRec - 1);
} elseif (!$TeamMemberTable->AllowAddDeleteRow && $TeamMemberTable_grid->StopRec == 0) {
	$TeamMemberTable_grid->StopRec = $TeamMemberTable->GridAddRowCount;
}

// Initialize aggregate
$TeamMemberTable->RowType = ROWTYPE_AGGREGATEINIT;
$TeamMemberTable->resetAttributes();
$TeamMemberTable_grid->renderRow();
if ($TeamMemberTable->isGridAdd())
	$TeamMemberTable_grid->RowIndex = 0;
if ($TeamMemberTable->isGridEdit())
	$TeamMemberTable_grid->RowIndex = 0;
while ($TeamMemberTable_grid->RecCnt < $TeamMemberTable_grid->StopRec) {
	$TeamMemberTable_grid->RecCnt++;
	if ($TeamMemberTable_grid->RecCnt >= $TeamMemberTable_grid->StartRec) {
		$TeamMemberTable_grid->RowCnt++;
		if ($TeamMemberTable->isGridAdd() || $TeamMemberTable->isGridEdit() || $TeamMemberTable->isConfirm()) {
			$TeamMemberTable_grid->RowIndex++;
			$CurrentForm->Index = $TeamMemberTable_grid->RowIndex;
			if ($CurrentForm->hasValue($TeamMemberTable_grid->FormActionName) && $TeamMemberTable_grid->EventCancelled)
				$TeamMemberTable_grid->RowAction = strval($CurrentForm->getValue($TeamMemberTable_grid->FormActionName));
			elseif ($TeamMemberTable->isGridAdd())
				$TeamMemberTable_grid->RowAction = "insert";
			else
				$TeamMemberTable_grid->RowAction = "";
		}

		// Set up key count
		$TeamMemberTable_grid->KeyCount = $TeamMemberTable_grid->RowIndex;

		// Init row class and style
		$TeamMemberTable->resetAttributes();
		$TeamMemberTable->CssClass = "";
		if ($TeamMemberTable->isGridAdd()) {
			if ($TeamMemberTable->CurrentMode == "copy") {
				$TeamMemberTable_grid->loadRowValues($TeamMemberTable_grid->Recordset); // Load row values
				$TeamMemberTable_grid->setRecordKey($TeamMemberTable_grid->RowOldKey, $TeamMemberTable_grid->Recordset); // Set old record key
			} else {
				$TeamMemberTable_grid->loadRowValues(); // Load default values
				$TeamMemberTable_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$TeamMemberTable_grid->loadRowValues($TeamMemberTable_grid->Recordset); // Load row values
		}
		$TeamMemberTable->RowType = ROWTYPE_VIEW; // Render view
		if ($TeamMemberTable->isGridAdd()) // Grid add
			$TeamMemberTable->RowType = ROWTYPE_ADD; // Render add
		if ($TeamMemberTable->isGridAdd() && $TeamMemberTable->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$TeamMemberTable_grid->restoreCurrentRowFormValues($TeamMemberTable_grid->RowIndex); // Restore form values
		if ($TeamMemberTable->isGridEdit()) { // Grid edit
			if ($TeamMemberTable->EventCancelled)
				$TeamMemberTable_grid->restoreCurrentRowFormValues($TeamMemberTable_grid->RowIndex); // Restore form values
			if ($TeamMemberTable_grid->RowAction == "insert")
				$TeamMemberTable->RowType = ROWTYPE_ADD; // Render add
			else
				$TeamMemberTable->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($TeamMemberTable->isGridEdit() && ($TeamMemberTable->RowType == ROWTYPE_EDIT || $TeamMemberTable->RowType == ROWTYPE_ADD) && $TeamMemberTable->EventCancelled) // Update failed
			$TeamMemberTable_grid->restoreCurrentRowFormValues($TeamMemberTable_grid->RowIndex); // Restore form values
		if ($TeamMemberTable->RowType == ROWTYPE_EDIT) // Edit row
			$TeamMemberTable_grid->EditRowCnt++;
		if ($TeamMemberTable->isConfirm()) // Confirm row
			$TeamMemberTable_grid->restoreCurrentRowFormValues($TeamMemberTable_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$TeamMemberTable->RowAttrs = array_merge($TeamMemberTable->RowAttrs, array('data-rowindex'=>$TeamMemberTable_grid->RowCnt, 'id'=>'r' . $TeamMemberTable_grid->RowCnt . '_TeamMemberTable', 'data-rowtype'=>$TeamMemberTable->RowType));

		// Render row
		$TeamMemberTable_grid->renderRow();

		// Render list options
		$TeamMemberTable_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($TeamMemberTable_grid->RowAction <> "delete" && $TeamMemberTable_grid->RowAction <> "insertdelete" && !($TeamMemberTable_grid->RowAction == "insert" && $TeamMemberTable->isConfirm() && $TeamMemberTable_grid->emptyRow())) {
?>
	<tr<?php echo $TeamMemberTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TeamMemberTable_grid->ListOptions->render("body", "left", $TeamMemberTable_grid->RowCnt);
?>
	<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
		<td data-name="serial"<?php echo $TeamMemberTable->serial->cellAttributes() ?>>
<?php if ($TeamMemberTable->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->OldValue) ?>">
<?php } ?>
<?php if ($TeamMemberTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_serial" class="form-group TeamMemberTable_serial">
<span<?php echo $TeamMemberTable->serial->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->serial->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->CurrentValue) ?>">
<?php } ?>
<?php if ($TeamMemberTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_serial" class="TeamMemberTable_serial">
<span<?php echo $TeamMemberTable->serial->viewAttributes() ?>>
<?php echo $TeamMemberTable->serial->getViewValue() ?></span>
</span>
<?php if (!$TeamMemberTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->FormValue) ?>">
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="fTeamMemberTablegrid$x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="fTeamMemberTablegrid$x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->FormValue) ?>">
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="fTeamMemberTablegrid$o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="fTeamMemberTablegrid$o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID"<?php echo $TeamMemberTable->TeamID->cellAttributes() ?>>
<?php if ($TeamMemberTable->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($TeamMemberTable->TeamID->getSessionValue() <> "") { ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->TeamID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<input type="text" data-table="TeamMemberTable" data-field="x_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->TeamID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->TeamID->EditValue ?>"<?php echo $TeamMemberTable->TeamID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->OldValue) ?>">
<?php } ?>
<?php if ($TeamMemberTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($TeamMemberTable->TeamID->getSessionValue() <> "") { ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->TeamID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<input type="text" data-table="TeamMemberTable" data-field="x_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->TeamID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->TeamID->EditValue ?>"<?php echo $TeamMemberTable->TeamID->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($TeamMemberTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<?php echo $TeamMemberTable->TeamID->getViewValue() ?></span>
</span>
<?php if (!$TeamMemberTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->FormValue) ?>">
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="fTeamMemberTablegrid$x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="fTeamMemberTablegrid$x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->FormValue) ?>">
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="fTeamMemberTablegrid$o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="fTeamMemberTablegrid$o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<td data-name="JobWorkerID"<?php echo $TeamMemberTable->JobWorkerID->cellAttributes() ?>>
<?php if ($TeamMemberTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_JobWorkerID" class="form-group TeamMemberTable_JobWorkerID">
<input type="text" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->JobWorkerID->EditValue ?>"<?php echo $TeamMemberTable->JobWorkerID->editAttributes() ?>>
</span>
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->OldValue) ?>">
<?php } ?>
<?php if ($TeamMemberTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_JobWorkerID" class="form-group TeamMemberTable_JobWorkerID">
<input type="text" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->JobWorkerID->EditValue ?>"<?php echo $TeamMemberTable->JobWorkerID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TeamMemberTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamMemberTable_grid->RowCnt ?>_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID">
<span<?php echo $TeamMemberTable->JobWorkerID->viewAttributes() ?>>
<?php echo $TeamMemberTable->JobWorkerID->getViewValue() ?></span>
</span>
<?php if (!$TeamMemberTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->FormValue) ?>">
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="fTeamMemberTablegrid$x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="fTeamMemberTablegrid$x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->FormValue) ?>">
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="fTeamMemberTablegrid$o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="fTeamMemberTablegrid$o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TeamMemberTable_grid->ListOptions->render("body", "right", $TeamMemberTable_grid->RowCnt);
?>
	</tr>
<?php if ($TeamMemberTable->RowType == ROWTYPE_ADD || $TeamMemberTable->RowType == ROWTYPE_EDIT) { ?>
<script>
fTeamMemberTablegrid.updateLists(<?php echo $TeamMemberTable_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$TeamMemberTable->isGridAdd() || $TeamMemberTable->CurrentMode == "copy")
		if (!$TeamMemberTable_grid->Recordset->EOF)
			$TeamMemberTable_grid->Recordset->moveNext();
}
?>
<?php
	if ($TeamMemberTable->CurrentMode == "add" || $TeamMemberTable->CurrentMode == "copy" || $TeamMemberTable->CurrentMode == "edit") {
		$TeamMemberTable_grid->RowIndex = '$rowindex$';
		$TeamMemberTable_grid->loadRowValues();

		// Set row properties
		$TeamMemberTable->resetAttributes();
		$TeamMemberTable->RowAttrs = array_merge($TeamMemberTable->RowAttrs, array('data-rowindex'=>$TeamMemberTable_grid->RowIndex, 'id'=>'r0_TeamMemberTable', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($TeamMemberTable->RowAttrs["class"], "ew-template");
		$TeamMemberTable->RowType = ROWTYPE_ADD;

		// Render row
		$TeamMemberTable_grid->renderRow();

		// Render list options
		$TeamMemberTable_grid->renderListOptions();
		$TeamMemberTable_grid->StartRowCnt = 0;
?>
	<tr<?php echo $TeamMemberTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TeamMemberTable_grid->ListOptions->render("body", "left", $TeamMemberTable_grid->RowIndex);
?>
	<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
		<td data-name="serial">
<?php if (!$TeamMemberTable->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_TeamMemberTable_serial" class="form-group TeamMemberTable_serial">
<span<?php echo $TeamMemberTable->serial->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->serial->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_serial" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_serial" value="<?php echo HtmlEncode($TeamMemberTable->serial->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID">
<?php if (!$TeamMemberTable->isConfirm()) { ?>
<?php if ($TeamMemberTable->TeamID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->TeamID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<input type="text" data-table="TeamMemberTable" data-field="x_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->TeamID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->TeamID->EditValue ?>"<?php echo $TeamMemberTable->TeamID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_TeamMemberTable_TeamID" class="form-group TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->TeamID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_TeamID" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<td data-name="JobWorkerID">
<?php if (!$TeamMemberTable->isConfirm()) { ?>
<span id="el$rowindex$_TeamMemberTable_JobWorkerID" class="form-group TeamMemberTable_JobWorkerID">
<input type="text" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->JobWorkerID->EditValue ?>"<?php echo $TeamMemberTable->JobWorkerID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_TeamMemberTable_JobWorkerID" class="form-group TeamMemberTable_JobWorkerID">
<span<?php echo $TeamMemberTable->JobWorkerID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->JobWorkerID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="x<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" id="o<?php echo $TeamMemberTable_grid->RowIndex ?>_JobWorkerID" value="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TeamMemberTable_grid->ListOptions->render("body", "right", $TeamMemberTable_grid->RowIndex);
?>
<script>
fTeamMemberTablegrid.updateLists(<?php echo $TeamMemberTable_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($TeamMemberTable->CurrentMode == "add" || $TeamMemberTable->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $TeamMemberTable_grid->FormKeyCountName ?>" id="<?php echo $TeamMemberTable_grid->FormKeyCountName ?>" value="<?php echo $TeamMemberTable_grid->KeyCount ?>">
<?php echo $TeamMemberTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($TeamMemberTable->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $TeamMemberTable_grid->FormKeyCountName ?>" id="<?php echo $TeamMemberTable_grid->FormKeyCountName ?>" value="<?php echo $TeamMemberTable_grid->KeyCount ?>">
<?php echo $TeamMemberTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($TeamMemberTable->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fTeamMemberTablegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($TeamMemberTable_grid->Recordset)
	$TeamMemberTable_grid->Recordset->Close();
?>
</div>
<?php if ($TeamMemberTable_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $TeamMemberTable_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($TeamMemberTable_grid->TotalRecs == 0 && !$TeamMemberTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $TeamMemberTable_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$TeamMemberTable_grid->terminate();
?>