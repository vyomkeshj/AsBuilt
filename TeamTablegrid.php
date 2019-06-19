<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($TeamTable_grid))
	$TeamTable_grid = new TeamTable_grid();

// Run the page
$TeamTable_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamTable_grid->Page_Render();
?>
<?php if (!$TeamTable->isExport()) { ?>
<script>

// Form object
var fTeamTablegrid = new ew.Form("fTeamTablegrid", "grid");
fTeamTablegrid.formKeyCountName = '<?php echo $TeamTable_grid->FormKeyCountName ?>';

// Validate form
fTeamTablegrid.validate = function() {
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
		<?php if ($TeamTable_grid->TeamID->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->TeamID->caption(), $TeamTable->TeamID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($TeamTable_grid->TeamName->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->TeamName->caption(), $TeamTable->TeamName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($TeamTable_grid->TeamLeader->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamLeader");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->TeamLeader->caption(), $TeamTable->TeamLeader->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TeamLeader");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamTable->TeamLeader->errorMessage()) ?>");
		<?php if ($TeamTable_grid->IsVisible->Required) { ?>
			elm = this.getElements("x" + infix + "_IsVisible");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->IsVisible->caption(), $TeamTable->IsVisible->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_IsVisible");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamTable->IsVisible->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fTeamTablegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "TeamName", false)) return false;
	if (ew.valueChanged(fobj, infix, "TeamLeader", false)) return false;
	if (ew.valueChanged(fobj, infix, "IsVisible", false)) return false;
	return true;
}

// Form_CustomValidate event
fTeamTablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamTablegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$TeamTable_grid->renderOtherOptions();
?>
<?php $TeamTable_grid->showPageHeader(); ?>
<?php
$TeamTable_grid->showMessage();
?>
<?php if ($TeamTable_grid->TotalRecs > 0 || $TeamTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($TeamTable_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TeamTable">
<div id="fTeamTablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_TeamTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_TeamTablegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$TeamTable_grid->RowType = ROWTYPE_HEADER;

// Render list options
$TeamTable_grid->renderListOptions();

// Render list options (header, left)
$TeamTable_grid->ListOptions->render("header", "left");
?>
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
	<?php if ($TeamTable->sortUrl($TeamTable->TeamID) == "") { ?>
		<th data-name="TeamID" class="<?php echo $TeamTable->TeamID->headerCellClass() ?>"><div id="elh_TeamTable_TeamID" class="TeamTable_TeamID"><div class="ew-table-header-caption"><?php echo $TeamTable->TeamID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamID" class="<?php echo $TeamTable->TeamID->headerCellClass() ?>"><div><div id="elh_TeamTable_TeamID" class="TeamTable_TeamID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->TeamID->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->TeamID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->TeamID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
	<?php if ($TeamTable->sortUrl($TeamTable->TeamName) == "") { ?>
		<th data-name="TeamName" class="<?php echo $TeamTable->TeamName->headerCellClass() ?>"><div id="elh_TeamTable_TeamName" class="TeamTable_TeamName"><div class="ew-table-header-caption"><?php echo $TeamTable->TeamName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamName" class="<?php echo $TeamTable->TeamName->headerCellClass() ?>"><div><div id="elh_TeamTable_TeamName" class="TeamTable_TeamName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->TeamName->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->TeamName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->TeamName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
	<?php if ($TeamTable->sortUrl($TeamTable->TeamLeader) == "") { ?>
		<th data-name="TeamLeader" class="<?php echo $TeamTable->TeamLeader->headerCellClass() ?>"><div id="elh_TeamTable_TeamLeader" class="TeamTable_TeamLeader"><div class="ew-table-header-caption"><?php echo $TeamTable->TeamLeader->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamLeader" class="<?php echo $TeamTable->TeamLeader->headerCellClass() ?>"><div><div id="elh_TeamTable_TeamLeader" class="TeamTable_TeamLeader">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->TeamLeader->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->TeamLeader->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->TeamLeader->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
	<?php if ($TeamTable->sortUrl($TeamTable->IsVisible) == "") { ?>
		<th data-name="IsVisible" class="<?php echo $TeamTable->IsVisible->headerCellClass() ?>"><div id="elh_TeamTable_IsVisible" class="TeamTable_IsVisible"><div class="ew-table-header-caption"><?php echo $TeamTable->IsVisible->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsVisible" class="<?php echo $TeamTable->IsVisible->headerCellClass() ?>"><div><div id="elh_TeamTable_IsVisible" class="TeamTable_IsVisible">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->IsVisible->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->IsVisible->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->IsVisible->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$TeamTable_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$TeamTable_grid->StartRec = 1;
$TeamTable_grid->StopRec = $TeamTable_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $TeamTable_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($TeamTable_grid->FormKeyCountName) && ($TeamTable->isGridAdd() || $TeamTable->isGridEdit() || $TeamTable->isConfirm())) {
		$TeamTable_grid->KeyCount = $CurrentForm->getValue($TeamTable_grid->FormKeyCountName);
		$TeamTable_grid->StopRec = $TeamTable_grid->StartRec + $TeamTable_grid->KeyCount - 1;
	}
}
$TeamTable_grid->RecCnt = $TeamTable_grid->StartRec - 1;
if ($TeamTable_grid->Recordset && !$TeamTable_grid->Recordset->EOF) {
	$TeamTable_grid->Recordset->moveFirst();
	$selectLimit = $TeamTable_grid->UseSelectLimit;
	if (!$selectLimit && $TeamTable_grid->StartRec > 1)
		$TeamTable_grid->Recordset->move($TeamTable_grid->StartRec - 1);
} elseif (!$TeamTable->AllowAddDeleteRow && $TeamTable_grid->StopRec == 0) {
	$TeamTable_grid->StopRec = $TeamTable->GridAddRowCount;
}

// Initialize aggregate
$TeamTable->RowType = ROWTYPE_AGGREGATEINIT;
$TeamTable->resetAttributes();
$TeamTable_grid->renderRow();
if ($TeamTable->isGridAdd())
	$TeamTable_grid->RowIndex = 0;
if ($TeamTable->isGridEdit())
	$TeamTable_grid->RowIndex = 0;
while ($TeamTable_grid->RecCnt < $TeamTable_grid->StopRec) {
	$TeamTable_grid->RecCnt++;
	if ($TeamTable_grid->RecCnt >= $TeamTable_grid->StartRec) {
		$TeamTable_grid->RowCnt++;
		if ($TeamTable->isGridAdd() || $TeamTable->isGridEdit() || $TeamTable->isConfirm()) {
			$TeamTable_grid->RowIndex++;
			$CurrentForm->Index = $TeamTable_grid->RowIndex;
			if ($CurrentForm->hasValue($TeamTable_grid->FormActionName) && $TeamTable_grid->EventCancelled)
				$TeamTable_grid->RowAction = strval($CurrentForm->getValue($TeamTable_grid->FormActionName));
			elseif ($TeamTable->isGridAdd())
				$TeamTable_grid->RowAction = "insert";
			else
				$TeamTable_grid->RowAction = "";
		}

		// Set up key count
		$TeamTable_grid->KeyCount = $TeamTable_grid->RowIndex;

		// Init row class and style
		$TeamTable->resetAttributes();
		$TeamTable->CssClass = "";
		if ($TeamTable->isGridAdd()) {
			if ($TeamTable->CurrentMode == "copy") {
				$TeamTable_grid->loadRowValues($TeamTable_grid->Recordset); // Load row values
				$TeamTable_grid->setRecordKey($TeamTable_grid->RowOldKey, $TeamTable_grid->Recordset); // Set old record key
			} else {
				$TeamTable_grid->loadRowValues(); // Load default values
				$TeamTable_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$TeamTable_grid->loadRowValues($TeamTable_grid->Recordset); // Load row values
		}
		$TeamTable->RowType = ROWTYPE_VIEW; // Render view
		if ($TeamTable->isGridAdd()) // Grid add
			$TeamTable->RowType = ROWTYPE_ADD; // Render add
		if ($TeamTable->isGridAdd() && $TeamTable->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$TeamTable_grid->restoreCurrentRowFormValues($TeamTable_grid->RowIndex); // Restore form values
		if ($TeamTable->isGridEdit()) { // Grid edit
			if ($TeamTable->EventCancelled)
				$TeamTable_grid->restoreCurrentRowFormValues($TeamTable_grid->RowIndex); // Restore form values
			if ($TeamTable_grid->RowAction == "insert")
				$TeamTable->RowType = ROWTYPE_ADD; // Render add
			else
				$TeamTable->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($TeamTable->isGridEdit() && ($TeamTable->RowType == ROWTYPE_EDIT || $TeamTable->RowType == ROWTYPE_ADD) && $TeamTable->EventCancelled) // Update failed
			$TeamTable_grid->restoreCurrentRowFormValues($TeamTable_grid->RowIndex); // Restore form values
		if ($TeamTable->RowType == ROWTYPE_EDIT) // Edit row
			$TeamTable_grid->EditRowCnt++;
		if ($TeamTable->isConfirm()) // Confirm row
			$TeamTable_grid->restoreCurrentRowFormValues($TeamTable_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$TeamTable->RowAttrs = array_merge($TeamTable->RowAttrs, array('data-rowindex'=>$TeamTable_grid->RowCnt, 'id'=>'r' . $TeamTable_grid->RowCnt . '_TeamTable', 'data-rowtype'=>$TeamTable->RowType));

		// Render row
		$TeamTable_grid->renderRow();

		// Render list options
		$TeamTable_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($TeamTable_grid->RowAction <> "delete" && $TeamTable_grid->RowAction <> "insertdelete" && !($TeamTable_grid->RowAction == "insert" && $TeamTable->isConfirm() && $TeamTable_grid->emptyRow())) {
?>
	<tr<?php echo $TeamTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TeamTable_grid->ListOptions->render("body", "left", $TeamTable_grid->RowCnt);
?>
	<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID"<?php echo $TeamTable->TeamID->cellAttributes() ?>>
<?php if ($TeamTable->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->OldValue) ?>">
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamID" class="form-group TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamTable->TeamID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->CurrentValue) ?>">
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamID" class="TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<?php echo $TeamTable->TeamID->getViewValue() ?></span>
</span>
<?php if (!$TeamTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
		<td data-name="TeamName"<?php echo $TeamTable->TeamName->cellAttributes() ?>>
<?php if ($TeamTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamName" class="form-group TeamTable_TeamName">
<input type="text" data-table="TeamTable" data-field="x_TeamName" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TeamTable->TeamName->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamName->EditValue ?>"<?php echo $TeamTable->TeamName->editAttributes() ?>>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->OldValue) ?>">
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamName" class="form-group TeamTable_TeamName">
<input type="text" data-table="TeamTable" data-field="x_TeamName" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TeamTable->TeamName->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamName->EditValue ?>"<?php echo $TeamTable->TeamName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamName" class="TeamTable_TeamName">
<span<?php echo $TeamTable->TeamName->viewAttributes() ?>>
<?php echo $TeamTable->TeamName->getViewValue() ?></span>
</span>
<?php if (!$TeamTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
		<td data-name="TeamLeader"<?php echo $TeamTable->TeamLeader->cellAttributes() ?>>
<?php if ($TeamTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamLeader" class="form-group TeamTable_TeamLeader">
<input type="text" data-table="TeamTable" data-field="x_TeamLeader" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" size="30" placeholder="<?php echo HtmlEncode($TeamTable->TeamLeader->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamLeader->EditValue ?>"<?php echo $TeamTable->TeamLeader->editAttributes() ?>>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->OldValue) ?>">
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamLeader" class="form-group TeamTable_TeamLeader">
<input type="text" data-table="TeamTable" data-field="x_TeamLeader" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" size="30" placeholder="<?php echo HtmlEncode($TeamTable->TeamLeader->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamLeader->EditValue ?>"<?php echo $TeamTable->TeamLeader->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_TeamLeader" class="TeamTable_TeamLeader">
<span<?php echo $TeamTable->TeamLeader->viewAttributes() ?>>
<?php echo $TeamTable->TeamLeader->getViewValue() ?></span>
</span>
<?php if (!$TeamTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
		<td data-name="IsVisible"<?php echo $TeamTable->IsVisible->cellAttributes() ?>>
<?php if ($TeamTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_IsVisible" class="form-group TeamTable_IsVisible">
<input type="text" data-table="TeamTable" data-field="x_IsVisible" name="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" size="30" placeholder="<?php echo HtmlEncode($TeamTable->IsVisible->getPlaceHolder()) ?>" value="<?php echo $TeamTable->IsVisible->EditValue ?>"<?php echo $TeamTable->IsVisible->editAttributes() ?>>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->OldValue) ?>">
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_IsVisible" class="form-group TeamTable_IsVisible">
<input type="text" data-table="TeamTable" data-field="x_IsVisible" name="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" size="30" placeholder="<?php echo HtmlEncode($TeamTable->IsVisible->getPlaceHolder()) ?>" value="<?php echo $TeamTable->IsVisible->EditValue ?>"<?php echo $TeamTable->IsVisible->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($TeamTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $TeamTable_grid->RowCnt ?>_TeamTable_IsVisible" class="TeamTable_IsVisible">
<span<?php echo $TeamTable->IsVisible->viewAttributes() ?>>
<?php echo $TeamTable->IsVisible->getViewValue() ?></span>
</span>
<?php if (!$TeamTable->isConfirm()) { ?>
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="fTeamTablegrid$x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->FormValue) ?>">
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="fTeamTablegrid$o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TeamTable_grid->ListOptions->render("body", "right", $TeamTable_grid->RowCnt);
?>
	</tr>
<?php if ($TeamTable->RowType == ROWTYPE_ADD || $TeamTable->RowType == ROWTYPE_EDIT) { ?>
<script>
fTeamTablegrid.updateLists(<?php echo $TeamTable_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$TeamTable->isGridAdd() || $TeamTable->CurrentMode == "copy")
		if (!$TeamTable_grid->Recordset->EOF)
			$TeamTable_grid->Recordset->moveNext();
}
?>
<?php
	if ($TeamTable->CurrentMode == "add" || $TeamTable->CurrentMode == "copy" || $TeamTable->CurrentMode == "edit") {
		$TeamTable_grid->RowIndex = '$rowindex$';
		$TeamTable_grid->loadRowValues();

		// Set row properties
		$TeamTable->resetAttributes();
		$TeamTable->RowAttrs = array_merge($TeamTable->RowAttrs, array('data-rowindex'=>$TeamTable_grid->RowIndex, 'id'=>'r0_TeamTable', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($TeamTable->RowAttrs["class"], "ew-template");
		$TeamTable->RowType = ROWTYPE_ADD;

		// Render row
		$TeamTable_grid->renderRow();

		// Render list options
		$TeamTable_grid->renderListOptions();
		$TeamTable_grid->StartRowCnt = 0;
?>
	<tr<?php echo $TeamTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TeamTable_grid->ListOptions->render("body", "left", $TeamTable_grid->RowIndex);
?>
	<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID">
<?php if (!$TeamTable->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_TeamTable_TeamID" class="form-group TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamTable->TeamID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
		<td data-name="TeamName">
<?php if (!$TeamTable->isConfirm()) { ?>
<span id="el$rowindex$_TeamTable_TeamName" class="form-group TeamTable_TeamName">
<input type="text" data-table="TeamTable" data-field="x_TeamName" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TeamTable->TeamName->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamName->EditValue ?>"<?php echo $TeamTable->TeamName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_TeamTable_TeamName" class="form-group TeamTable_TeamName">
<span<?php echo $TeamTable->TeamName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamTable->TeamName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamName" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamName" value="<?php echo HtmlEncode($TeamTable->TeamName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
		<td data-name="TeamLeader">
<?php if (!$TeamTable->isConfirm()) { ?>
<span id="el$rowindex$_TeamTable_TeamLeader" class="form-group TeamTable_TeamLeader">
<input type="text" data-table="TeamTable" data-field="x_TeamLeader" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" size="30" placeholder="<?php echo HtmlEncode($TeamTable->TeamLeader->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamLeader->EditValue ?>"<?php echo $TeamTable->TeamLeader->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_TeamTable_TeamLeader" class="form-group TeamTable_TeamLeader">
<span<?php echo $TeamTable->TeamLeader->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamTable->TeamLeader->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="x<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamTable" data-field="x_TeamLeader" name="o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" id="o<?php echo $TeamTable_grid->RowIndex ?>_TeamLeader" value="<?php echo HtmlEncode($TeamTable->TeamLeader->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
		<td data-name="IsVisible">
<?php if (!$TeamTable->isConfirm()) { ?>
<span id="el$rowindex$_TeamTable_IsVisible" class="form-group TeamTable_IsVisible">
<input type="text" data-table="TeamTable" data-field="x_IsVisible" name="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" size="30" placeholder="<?php echo HtmlEncode($TeamTable->IsVisible->getPlaceHolder()) ?>" value="<?php echo $TeamTable->IsVisible->EditValue ?>"<?php echo $TeamTable->IsVisible->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_TeamTable_IsVisible" class="form-group TeamTable_IsVisible">
<span<?php echo $TeamTable->IsVisible->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamTable->IsVisible->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="x<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="TeamTable" data-field="x_IsVisible" name="o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" id="o<?php echo $TeamTable_grid->RowIndex ?>_IsVisible" value="<?php echo HtmlEncode($TeamTable->IsVisible->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TeamTable_grid->ListOptions->render("body", "right", $TeamTable_grid->RowIndex);
?>
<script>
fTeamTablegrid.updateLists(<?php echo $TeamTable_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($TeamTable->CurrentMode == "add" || $TeamTable->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $TeamTable_grid->FormKeyCountName ?>" id="<?php echo $TeamTable_grid->FormKeyCountName ?>" value="<?php echo $TeamTable_grid->KeyCount ?>">
<?php echo $TeamTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($TeamTable->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $TeamTable_grid->FormKeyCountName ?>" id="<?php echo $TeamTable_grid->FormKeyCountName ?>" value="<?php echo $TeamTable_grid->KeyCount ?>">
<?php echo $TeamTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($TeamTable->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fTeamTablegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($TeamTable_grid->Recordset)
	$TeamTable_grid->Recordset->Close();
?>
</div>
<?php if ($TeamTable_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $TeamTable_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($TeamTable_grid->TotalRecs == 0 && !$TeamTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $TeamTable_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$TeamTable_grid->terminate();
?>