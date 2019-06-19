<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($LeadTable_grid))
	$LeadTable_grid = new LeadTable_grid();

// Run the page
$LeadTable_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTable_grid->Page_Render();
?>
<?php if (!$LeadTable->isExport()) { ?>
<script>

// Form object
var fLeadTablegrid = new ew.Form("fLeadTablegrid", "grid");
fLeadTablegrid.formKeyCountName = '<?php echo $LeadTable_grid->FormKeyCountName ?>';

// Validate form
fLeadTablegrid.validate = function() {
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
		<?php if ($LeadTable_grid->LeadID->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->LeadID->caption(), $LeadTable->LeadID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_grid->CustomerID->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->CustomerID->caption(), $LeadTable->CustomerID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CustomerID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->CustomerID->errorMessage()) ?>");
		<?php if ($LeadTable_grid->LeadType->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->LeadType->caption(), $LeadTable->LeadType->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LeadType");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->LeadType->errorMessage()) ?>");
		<?php if ($LeadTable_grid->Suburb->Required) { ?>
			elm = this.getElements("x" + infix + "_Suburb");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->Suburb->caption(), $LeadTable->Suburb->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_grid->ExpectedStart->Required) { ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->ExpectedStart->caption(), $LeadTable->ExpectedStart->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->ExpectedStart->errorMessage()) ?>");
		<?php if ($LeadTable_grid->DateTaken->Required) { ?>
			elm = this.getElements("x" + infix + "_DateTaken");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->DateTaken->caption(), $LeadTable->DateTaken->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateTaken");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->DateTaken->errorMessage()) ?>");
		<?php if ($LeadTable_grid->TakenBy->Required) { ?>
			elm = this.getElements("x" + infix + "_TakenBy");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->TakenBy->caption(), $LeadTable->TakenBy->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_grid->IsComplete->Required) { ?>
			elm = this.getElements("x" + infix + "_IsComplete");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->IsComplete->caption(), $LeadTable->IsComplete->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_IsComplete");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->IsComplete->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fLeadTablegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "CustomerID", false)) return false;
	if (ew.valueChanged(fobj, infix, "LeadType", false)) return false;
	if (ew.valueChanged(fobj, infix, "Suburb", false)) return false;
	if (ew.valueChanged(fobj, infix, "ExpectedStart", false)) return false;
	if (ew.valueChanged(fobj, infix, "DateTaken", false)) return false;
	if (ew.valueChanged(fobj, infix, "TakenBy", false)) return false;
	if (ew.valueChanged(fobj, infix, "IsComplete", false)) return false;
	return true;
}

// Form_CustomValidate event
fLeadTablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTablegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$LeadTable_grid->renderOtherOptions();
?>
<?php $LeadTable_grid->showPageHeader(); ?>
<?php
$LeadTable_grid->showMessage();
?>
<?php if ($LeadTable_grid->TotalRecs > 0 || $LeadTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($LeadTable_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> LeadTable">
<div id="fLeadTablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_LeadTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_LeadTablegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$LeadTable_grid->RowType = ROWTYPE_HEADER;

// Render list options
$LeadTable_grid->renderListOptions();

// Render list options (header, left)
$LeadTable_grid->ListOptions->render("header", "left");
?>
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
	<?php if ($LeadTable->sortUrl($LeadTable->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $LeadTable->LeadID->headerCellClass() ?>"><div id="elh_LeadTable_LeadID" class="LeadTable_LeadID"><div class="ew-table-header-caption"><?php echo $LeadTable->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $LeadTable->LeadID->headerCellClass() ?>"><div><div id="elh_LeadTable_LeadID" class="LeadTable_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
	<?php if ($LeadTable->sortUrl($LeadTable->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $LeadTable->CustomerID->headerCellClass() ?>"><div id="elh_LeadTable_CustomerID" class="LeadTable_CustomerID"><div class="ew-table-header-caption"><?php echo $LeadTable->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $LeadTable->CustomerID->headerCellClass() ?>"><div><div id="elh_LeadTable_CustomerID" class="LeadTable_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->CustomerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
	<?php if ($LeadTable->sortUrl($LeadTable->LeadType) == "") { ?>
		<th data-name="LeadType" class="<?php echo $LeadTable->LeadType->headerCellClass() ?>"><div id="elh_LeadTable_LeadType" class="LeadTable_LeadType"><div class="ew-table-header-caption"><?php echo $LeadTable->LeadType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadType" class="<?php echo $LeadTable->LeadType->headerCellClass() ?>"><div><div id="elh_LeadTable_LeadType" class="LeadTable_LeadType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->LeadType->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->LeadType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->LeadType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
	<?php if ($LeadTable->sortUrl($LeadTable->Suburb) == "") { ?>
		<th data-name="Suburb" class="<?php echo $LeadTable->Suburb->headerCellClass() ?>"><div id="elh_LeadTable_Suburb" class="LeadTable_Suburb"><div class="ew-table-header-caption"><?php echo $LeadTable->Suburb->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Suburb" class="<?php echo $LeadTable->Suburb->headerCellClass() ?>"><div><div id="elh_LeadTable_Suburb" class="LeadTable_Suburb">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->Suburb->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->Suburb->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->Suburb->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<?php if ($LeadTable->sortUrl($LeadTable->ExpectedStart) == "") { ?>
		<th data-name="ExpectedStart" class="<?php echo $LeadTable->ExpectedStart->headerCellClass() ?>"><div id="elh_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart"><div class="ew-table-header-caption"><?php echo $LeadTable->ExpectedStart->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedStart" class="<?php echo $LeadTable->ExpectedStart->headerCellClass() ?>"><div><div id="elh_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->ExpectedStart->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->ExpectedStart->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->ExpectedStart->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
	<?php if ($LeadTable->sortUrl($LeadTable->DateTaken) == "") { ?>
		<th data-name="DateTaken" class="<?php echo $LeadTable->DateTaken->headerCellClass() ?>"><div id="elh_LeadTable_DateTaken" class="LeadTable_DateTaken"><div class="ew-table-header-caption"><?php echo $LeadTable->DateTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTaken" class="<?php echo $LeadTable->DateTaken->headerCellClass() ?>"><div><div id="elh_LeadTable_DateTaken" class="LeadTable_DateTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->DateTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->DateTaken->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->DateTaken->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
	<?php if ($LeadTable->sortUrl($LeadTable->TakenBy) == "") { ?>
		<th data-name="TakenBy" class="<?php echo $LeadTable->TakenBy->headerCellClass() ?>"><div id="elh_LeadTable_TakenBy" class="LeadTable_TakenBy"><div class="ew-table-header-caption"><?php echo $LeadTable->TakenBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TakenBy" class="<?php echo $LeadTable->TakenBy->headerCellClass() ?>"><div><div id="elh_LeadTable_TakenBy" class="LeadTable_TakenBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->TakenBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->TakenBy->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->TakenBy->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
	<?php if ($LeadTable->sortUrl($LeadTable->IsComplete) == "") { ?>
		<th data-name="IsComplete" class="<?php echo $LeadTable->IsComplete->headerCellClass() ?>"><div id="elh_LeadTable_IsComplete" class="LeadTable_IsComplete"><div class="ew-table-header-caption"><?php echo $LeadTable->IsComplete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsComplete" class="<?php echo $LeadTable->IsComplete->headerCellClass() ?>"><div><div id="elh_LeadTable_IsComplete" class="LeadTable_IsComplete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->IsComplete->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->IsComplete->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->IsComplete->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$LeadTable_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$LeadTable_grid->StartRec = 1;
$LeadTable_grid->StopRec = $LeadTable_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $LeadTable_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($LeadTable_grid->FormKeyCountName) && ($LeadTable->isGridAdd() || $LeadTable->isGridEdit() || $LeadTable->isConfirm())) {
		$LeadTable_grid->KeyCount = $CurrentForm->getValue($LeadTable_grid->FormKeyCountName);
		$LeadTable_grid->StopRec = $LeadTable_grid->StartRec + $LeadTable_grid->KeyCount - 1;
	}
}
$LeadTable_grid->RecCnt = $LeadTable_grid->StartRec - 1;
if ($LeadTable_grid->Recordset && !$LeadTable_grid->Recordset->EOF) {
	$LeadTable_grid->Recordset->moveFirst();
	$selectLimit = $LeadTable_grid->UseSelectLimit;
	if (!$selectLimit && $LeadTable_grid->StartRec > 1)
		$LeadTable_grid->Recordset->move($LeadTable_grid->StartRec - 1);
} elseif (!$LeadTable->AllowAddDeleteRow && $LeadTable_grid->StopRec == 0) {
	$LeadTable_grid->StopRec = $LeadTable->GridAddRowCount;
}

// Initialize aggregate
$LeadTable->RowType = ROWTYPE_AGGREGATEINIT;
$LeadTable->resetAttributes();
$LeadTable_grid->renderRow();
if ($LeadTable->isGridAdd())
	$LeadTable_grid->RowIndex = 0;
if ($LeadTable->isGridEdit())
	$LeadTable_grid->RowIndex = 0;
while ($LeadTable_grid->RecCnt < $LeadTable_grid->StopRec) {
	$LeadTable_grid->RecCnt++;
	if ($LeadTable_grid->RecCnt >= $LeadTable_grid->StartRec) {
		$LeadTable_grid->RowCnt++;
		if ($LeadTable->isGridAdd() || $LeadTable->isGridEdit() || $LeadTable->isConfirm()) {
			$LeadTable_grid->RowIndex++;
			$CurrentForm->Index = $LeadTable_grid->RowIndex;
			if ($CurrentForm->hasValue($LeadTable_grid->FormActionName) && $LeadTable_grid->EventCancelled)
				$LeadTable_grid->RowAction = strval($CurrentForm->getValue($LeadTable_grid->FormActionName));
			elseif ($LeadTable->isGridAdd())
				$LeadTable_grid->RowAction = "insert";
			else
				$LeadTable_grid->RowAction = "";
		}

		// Set up key count
		$LeadTable_grid->KeyCount = $LeadTable_grid->RowIndex;

		// Init row class and style
		$LeadTable->resetAttributes();
		$LeadTable->CssClass = "";
		if ($LeadTable->isGridAdd()) {
			if ($LeadTable->CurrentMode == "copy") {
				$LeadTable_grid->loadRowValues($LeadTable_grid->Recordset); // Load row values
				$LeadTable_grid->setRecordKey($LeadTable_grid->RowOldKey, $LeadTable_grid->Recordset); // Set old record key
			} else {
				$LeadTable_grid->loadRowValues(); // Load default values
				$LeadTable_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$LeadTable_grid->loadRowValues($LeadTable_grid->Recordset); // Load row values
		}
		$LeadTable->RowType = ROWTYPE_VIEW; // Render view
		if ($LeadTable->isGridAdd()) // Grid add
			$LeadTable->RowType = ROWTYPE_ADD; // Render add
		if ($LeadTable->isGridAdd() && $LeadTable->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$LeadTable_grid->restoreCurrentRowFormValues($LeadTable_grid->RowIndex); // Restore form values
		if ($LeadTable->isGridEdit()) { // Grid edit
			if ($LeadTable->EventCancelled)
				$LeadTable_grid->restoreCurrentRowFormValues($LeadTable_grid->RowIndex); // Restore form values
			if ($LeadTable_grid->RowAction == "insert")
				$LeadTable->RowType = ROWTYPE_ADD; // Render add
			else
				$LeadTable->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($LeadTable->isGridEdit() && ($LeadTable->RowType == ROWTYPE_EDIT || $LeadTable->RowType == ROWTYPE_ADD) && $LeadTable->EventCancelled) // Update failed
			$LeadTable_grid->restoreCurrentRowFormValues($LeadTable_grid->RowIndex); // Restore form values
		if ($LeadTable->RowType == ROWTYPE_EDIT) // Edit row
			$LeadTable_grid->EditRowCnt++;
		if ($LeadTable->isConfirm()) // Confirm row
			$LeadTable_grid->restoreCurrentRowFormValues($LeadTable_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$LeadTable->RowAttrs = array_merge($LeadTable->RowAttrs, array('data-rowindex'=>$LeadTable_grid->RowCnt, 'id'=>'r' . $LeadTable_grid->RowCnt . '_LeadTable', 'data-rowtype'=>$LeadTable->RowType));

		// Render row
		$LeadTable_grid->renderRow();

		// Render list options
		$LeadTable_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($LeadTable_grid->RowAction <> "delete" && $LeadTable_grid->RowAction <> "insertdelete" && !($LeadTable_grid->RowAction == "insert" && $LeadTable->isConfirm() && $LeadTable_grid->emptyRow())) {
?>
	<tr<?php echo $LeadTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadTable_grid->ListOptions->render("body", "left", $LeadTable_grid->RowCnt);
?>
	<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $LeadTable->LeadID->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_LeadID" class="form-group LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->LeadID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->CurrentValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_LeadID" class="LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<?php echo $LeadTable->LeadID->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $LeadTable->CustomerID->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($LeadTable->CustomerID->getSessionValue() <> "") { ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->CustomerID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<input type="text" data-table="LeadTable" data-field="x_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" size="30" placeholder="<?php echo HtmlEncode($LeadTable->CustomerID->getPlaceHolder()) ?>" value="<?php echo $LeadTable->CustomerID->EditValue ?>"<?php echo $LeadTable->CustomerID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($LeadTable->CustomerID->getSessionValue() <> "") { ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->CustomerID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<input type="text" data-table="LeadTable" data-field="x_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" size="30" placeholder="<?php echo HtmlEncode($LeadTable->CustomerID->getPlaceHolder()) ?>" value="<?php echo $LeadTable->CustomerID->EditValue ?>"<?php echo $LeadTable->CustomerID->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_CustomerID" class="LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<?php echo $LeadTable->CustomerID->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
		<td data-name="LeadType"<?php echo $LeadTable->LeadType->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_LeadType" class="form-group LeadTable_LeadType">
<input type="text" data-table="LeadTable" data-field="x_LeadType" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" size="30" placeholder="<?php echo HtmlEncode($LeadTable->LeadType->getPlaceHolder()) ?>" value="<?php echo $LeadTable->LeadType->EditValue ?>"<?php echo $LeadTable->LeadType->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_LeadType" class="form-group LeadTable_LeadType">
<input type="text" data-table="LeadTable" data-field="x_LeadType" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" size="30" placeholder="<?php echo HtmlEncode($LeadTable->LeadType->getPlaceHolder()) ?>" value="<?php echo $LeadTable->LeadType->EditValue ?>"<?php echo $LeadTable->LeadType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_LeadType" class="LeadTable_LeadType">
<span<?php echo $LeadTable->LeadType->viewAttributes() ?>>
<?php echo $LeadTable->LeadType->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
		<td data-name="Suburb"<?php echo $LeadTable->Suburb->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_Suburb" class="form-group LeadTable_Suburb">
<input type="text" data-table="LeadTable" data-field="x_Suburb" name="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->Suburb->getPlaceHolder()) ?>" value="<?php echo $LeadTable->Suburb->EditValue ?>"<?php echo $LeadTable->Suburb->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_Suburb" class="form-group LeadTable_Suburb">
<input type="text" data-table="LeadTable" data-field="x_Suburb" name="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->Suburb->getPlaceHolder()) ?>" value="<?php echo $LeadTable->Suburb->EditValue ?>"<?php echo $LeadTable->Suburb->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_Suburb" class="LeadTable_Suburb">
<span<?php echo $LeadTable->Suburb->viewAttributes() ?>>
<?php echo $LeadTable->Suburb->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart"<?php echo $LeadTable->ExpectedStart->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_ExpectedStart" class="form-group LeadTable_ExpectedStart">
<input type="text" data-table="LeadTable" data-field="x_ExpectedStart" name="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" placeholder="<?php echo HtmlEncode($LeadTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $LeadTable->ExpectedStart->EditValue ?>"<?php echo $LeadTable->ExpectedStart->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_ExpectedStart" class="form-group LeadTable_ExpectedStart">
<input type="text" data-table="LeadTable" data-field="x_ExpectedStart" name="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" placeholder="<?php echo HtmlEncode($LeadTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $LeadTable->ExpectedStart->EditValue ?>"<?php echo $LeadTable->ExpectedStart->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart">
<span<?php echo $LeadTable->ExpectedStart->viewAttributes() ?>>
<?php echo $LeadTable->ExpectedStart->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
		<td data-name="DateTaken"<?php echo $LeadTable->DateTaken->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_DateTaken" class="form-group LeadTable_DateTaken">
<input type="text" data-table="LeadTable" data-field="x_DateTaken" name="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" placeholder="<?php echo HtmlEncode($LeadTable->DateTaken->getPlaceHolder()) ?>" value="<?php echo $LeadTable->DateTaken->EditValue ?>"<?php echo $LeadTable->DateTaken->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_DateTaken" class="form-group LeadTable_DateTaken">
<input type="text" data-table="LeadTable" data-field="x_DateTaken" name="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" placeholder="<?php echo HtmlEncode($LeadTable->DateTaken->getPlaceHolder()) ?>" value="<?php echo $LeadTable->DateTaken->EditValue ?>"<?php echo $LeadTable->DateTaken->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_DateTaken" class="LeadTable_DateTaken">
<span<?php echo $LeadTable->DateTaken->viewAttributes() ?>>
<?php echo $LeadTable->DateTaken->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
		<td data-name="TakenBy"<?php echo $LeadTable->TakenBy->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_TakenBy" class="form-group LeadTable_TakenBy">
<input type="text" data-table="LeadTable" data-field="x_TakenBy" name="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->TakenBy->getPlaceHolder()) ?>" value="<?php echo $LeadTable->TakenBy->EditValue ?>"<?php echo $LeadTable->TakenBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_TakenBy" class="form-group LeadTable_TakenBy">
<input type="text" data-table="LeadTable" data-field="x_TakenBy" name="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->TakenBy->getPlaceHolder()) ?>" value="<?php echo $LeadTable->TakenBy->EditValue ?>"<?php echo $LeadTable->TakenBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_TakenBy" class="LeadTable_TakenBy">
<span<?php echo $LeadTable->TakenBy->viewAttributes() ?>>
<?php echo $LeadTable->TakenBy->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
		<td data-name="IsComplete"<?php echo $LeadTable->IsComplete->cellAttributes() ?>>
<?php if ($LeadTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_IsComplete" class="form-group LeadTable_IsComplete">
<input type="text" data-table="LeadTable" data-field="x_IsComplete" name="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" size="30" placeholder="<?php echo HtmlEncode($LeadTable->IsComplete->getPlaceHolder()) ?>" value="<?php echo $LeadTable->IsComplete->EditValue ?>"<?php echo $LeadTable->IsComplete->editAttributes() ?>>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->OldValue) ?>">
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_IsComplete" class="form-group LeadTable_IsComplete">
<input type="text" data-table="LeadTable" data-field="x_IsComplete" name="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" size="30" placeholder="<?php echo HtmlEncode($LeadTable->IsComplete->getPlaceHolder()) ?>" value="<?php echo $LeadTable->IsComplete->EditValue ?>"<?php echo $LeadTable->IsComplete->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($LeadTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $LeadTable_grid->RowCnt ?>_LeadTable_IsComplete" class="LeadTable_IsComplete">
<span<?php echo $LeadTable->IsComplete->viewAttributes() ?>>
<?php echo $LeadTable->IsComplete->getViewValue() ?></span>
</span>
<?php if (!$LeadTable->isConfirm()) { ?>
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="fLeadTablegrid$x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->FormValue) ?>">
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="fLeadTablegrid$o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadTable_grid->ListOptions->render("body", "right", $LeadTable_grid->RowCnt);
?>
	</tr>
<?php if ($LeadTable->RowType == ROWTYPE_ADD || $LeadTable->RowType == ROWTYPE_EDIT) { ?>
<script>
fLeadTablegrid.updateLists(<?php echo $LeadTable_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$LeadTable->isGridAdd() || $LeadTable->CurrentMode == "copy")
		if (!$LeadTable_grid->Recordset->EOF)
			$LeadTable_grid->Recordset->moveNext();
}
?>
<?php
	if ($LeadTable->CurrentMode == "add" || $LeadTable->CurrentMode == "copy" || $LeadTable->CurrentMode == "edit") {
		$LeadTable_grid->RowIndex = '$rowindex$';
		$LeadTable_grid->loadRowValues();

		// Set row properties
		$LeadTable->resetAttributes();
		$LeadTable->RowAttrs = array_merge($LeadTable->RowAttrs, array('data-rowindex'=>$LeadTable_grid->RowIndex, 'id'=>'r0_LeadTable', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($LeadTable->RowAttrs["class"], "ew-template");
		$LeadTable->RowType = ROWTYPE_ADD;

		// Render row
		$LeadTable_grid->renderRow();

		// Render list options
		$LeadTable_grid->renderListOptions();
		$LeadTable_grid->StartRowCnt = 0;
?>
	<tr<?php echo $LeadTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadTable_grid->ListOptions->render("body", "left", $LeadTable_grid->RowIndex);
?>
	<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID">
<?php if (!$LeadTable->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_LeadID" class="form-group LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" id="o<?php echo $LeadTable_grid->RowIndex ?>_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID">
<?php if (!$LeadTable->isConfirm()) { ?>
<?php if ($LeadTable->CustomerID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->CustomerID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<input type="text" data-table="LeadTable" data-field="x_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" size="30" placeholder="<?php echo HtmlEncode($LeadTable->CustomerID->getPlaceHolder()) ?>" value="<?php echo $LeadTable->CustomerID->EditValue ?>"<?php echo $LeadTable->CustomerID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_CustomerID" class="form-group LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->CustomerID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="x<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_CustomerID" name="o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" id="o<?php echo $LeadTable_grid->RowIndex ?>_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
		<td data-name="LeadType">
<?php if (!$LeadTable->isConfirm()) { ?>
<span id="el$rowindex$_LeadTable_LeadType" class="form-group LeadTable_LeadType">
<input type="text" data-table="LeadTable" data-field="x_LeadType" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" size="30" placeholder="<?php echo HtmlEncode($LeadTable->LeadType->getPlaceHolder()) ?>" value="<?php echo $LeadTable->LeadType->EditValue ?>"<?php echo $LeadTable->LeadType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_LeadType" class="form-group LeadTable_LeadType">
<span<?php echo $LeadTable->LeadType->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->LeadType->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="x<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_LeadType" name="o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" id="o<?php echo $LeadTable_grid->RowIndex ?>_LeadType" value="<?php echo HtmlEncode($LeadTable->LeadType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
		<td data-name="Suburb">
<?php if (!$LeadTable->isConfirm()) { ?>
<span id="el$rowindex$_LeadTable_Suburb" class="form-group LeadTable_Suburb">
<input type="text" data-table="LeadTable" data-field="x_Suburb" name="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->Suburb->getPlaceHolder()) ?>" value="<?php echo $LeadTable->Suburb->EditValue ?>"<?php echo $LeadTable->Suburb->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_Suburb" class="form-group LeadTable_Suburb">
<span<?php echo $LeadTable->Suburb->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->Suburb->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="x<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_Suburb" name="o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" id="o<?php echo $LeadTable_grid->RowIndex ?>_Suburb" value="<?php echo HtmlEncode($LeadTable->Suburb->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart">
<?php if (!$LeadTable->isConfirm()) { ?>
<span id="el$rowindex$_LeadTable_ExpectedStart" class="form-group LeadTable_ExpectedStart">
<input type="text" data-table="LeadTable" data-field="x_ExpectedStart" name="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" placeholder="<?php echo HtmlEncode($LeadTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $LeadTable->ExpectedStart->EditValue ?>"<?php echo $LeadTable->ExpectedStart->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_ExpectedStart" class="form-group LeadTable_ExpectedStart">
<span<?php echo $LeadTable->ExpectedStart->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->ExpectedStart->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="x<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_ExpectedStart" name="o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" id="o<?php echo $LeadTable_grid->RowIndex ?>_ExpectedStart" value="<?php echo HtmlEncode($LeadTable->ExpectedStart->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
		<td data-name="DateTaken">
<?php if (!$LeadTable->isConfirm()) { ?>
<span id="el$rowindex$_LeadTable_DateTaken" class="form-group LeadTable_DateTaken">
<input type="text" data-table="LeadTable" data-field="x_DateTaken" name="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" placeholder="<?php echo HtmlEncode($LeadTable->DateTaken->getPlaceHolder()) ?>" value="<?php echo $LeadTable->DateTaken->EditValue ?>"<?php echo $LeadTable->DateTaken->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_DateTaken" class="form-group LeadTable_DateTaken">
<span<?php echo $LeadTable->DateTaken->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->DateTaken->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="x<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_DateTaken" name="o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" id="o<?php echo $LeadTable_grid->RowIndex ?>_DateTaken" value="<?php echo HtmlEncode($LeadTable->DateTaken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
		<td data-name="TakenBy">
<?php if (!$LeadTable->isConfirm()) { ?>
<span id="el$rowindex$_LeadTable_TakenBy" class="form-group LeadTable_TakenBy">
<input type="text" data-table="LeadTable" data-field="x_TakenBy" name="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->TakenBy->getPlaceHolder()) ?>" value="<?php echo $LeadTable->TakenBy->EditValue ?>"<?php echo $LeadTable->TakenBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_TakenBy" class="form-group LeadTable_TakenBy">
<span<?php echo $LeadTable->TakenBy->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->TakenBy->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="x<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_TakenBy" name="o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" id="o<?php echo $LeadTable_grid->RowIndex ?>_TakenBy" value="<?php echo HtmlEncode($LeadTable->TakenBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
		<td data-name="IsComplete">
<?php if (!$LeadTable->isConfirm()) { ?>
<span id="el$rowindex$_LeadTable_IsComplete" class="form-group LeadTable_IsComplete">
<input type="text" data-table="LeadTable" data-field="x_IsComplete" name="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" size="30" placeholder="<?php echo HtmlEncode($LeadTable->IsComplete->getPlaceHolder()) ?>" value="<?php echo $LeadTable->IsComplete->EditValue ?>"<?php echo $LeadTable->IsComplete->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_LeadTable_IsComplete" class="form-group LeadTable_IsComplete">
<span<?php echo $LeadTable->IsComplete->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->IsComplete->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="x<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="LeadTable" data-field="x_IsComplete" name="o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" id="o<?php echo $LeadTable_grid->RowIndex ?>_IsComplete" value="<?php echo HtmlEncode($LeadTable->IsComplete->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadTable_grid->ListOptions->render("body", "right", $LeadTable_grid->RowIndex);
?>
<script>
fLeadTablegrid.updateLists(<?php echo $LeadTable_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($LeadTable->CurrentMode == "add" || $LeadTable->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $LeadTable_grid->FormKeyCountName ?>" id="<?php echo $LeadTable_grid->FormKeyCountName ?>" value="<?php echo $LeadTable_grid->KeyCount ?>">
<?php echo $LeadTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($LeadTable->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $LeadTable_grid->FormKeyCountName ?>" id="<?php echo $LeadTable_grid->FormKeyCountName ?>" value="<?php echo $LeadTable_grid->KeyCount ?>">
<?php echo $LeadTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($LeadTable->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fLeadTablegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($LeadTable_grid->Recordset)
	$LeadTable_grid->Recordset->Close();
?>
</div>
<?php if ($LeadTable_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $LeadTable_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($LeadTable_grid->TotalRecs == 0 && !$LeadTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $LeadTable_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$LeadTable_grid->terminate();
?>