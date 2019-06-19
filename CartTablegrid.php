<?php
namespace PHPMaker2019\ASbuiltProject;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($CartTable_grid))
	$CartTable_grid = new CartTable_grid();

// Run the page
$CartTable_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartTable_grid->Page_Render();
?>
<?php if (!$CartTable->isExport()) { ?>
<script>

// Form object
var fCartTablegrid = new ew.Form("fCartTablegrid", "grid");
fCartTablegrid.formKeyCountName = '<?php echo $CartTable_grid->FormKeyCountName ?>';

// Validate form
fCartTablegrid.validate = function() {
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
		<?php if ($CartTable_grid->Serial->Required) { ?>
			elm = this.getElements("x" + infix + "_Serial");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartTable->Serial->caption(), $CartTable->Serial->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($CartTable_grid->SessionID->Required) { ?>
			elm = this.getElements("x" + infix + "_SessionID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartTable->SessionID->caption(), $CartTable->SessionID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_SessionID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($CartTable->SessionID->errorMessage()) ?>");
		<?php if ($CartTable_grid->ProductID->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartTable->ProductID->caption(), $CartTable->ProductID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($CartTable->ProductID->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fCartTablegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "SessionID", false)) return false;
	if (ew.valueChanged(fobj, infix, "ProductID", false)) return false;
	return true;
}

// Form_CustomValidate event
fCartTablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCartTablegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
$CartTable_grid->renderOtherOptions();
?>
<?php $CartTable_grid->showPageHeader(); ?>
<?php
$CartTable_grid->showMessage();
?>
<?php if ($CartTable_grid->TotalRecs > 0 || $CartTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($CartTable_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CartTable">
<div id="fCartTablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_CartTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_CartTablegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$CartTable_grid->RowType = ROWTYPE_HEADER;

// Render list options
$CartTable_grid->renderListOptions();

// Render list options (header, left)
$CartTable_grid->ListOptions->render("header", "left");
?>
<?php if ($CartTable->Serial->Visible) { // Serial ?>
	<?php if ($CartTable->sortUrl($CartTable->Serial) == "") { ?>
		<th data-name="Serial" class="<?php echo $CartTable->Serial->headerCellClass() ?>"><div id="elh_CartTable_Serial" class="CartTable_Serial"><div class="ew-table-header-caption"><?php echo $CartTable->Serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Serial" class="<?php echo $CartTable->Serial->headerCellClass() ?>"><div><div id="elh_CartTable_Serial" class="CartTable_Serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartTable->Serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartTable->Serial->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CartTable->Serial->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
	<?php if ($CartTable->sortUrl($CartTable->SessionID) == "") { ?>
		<th data-name="SessionID" class="<?php echo $CartTable->SessionID->headerCellClass() ?>"><div id="elh_CartTable_SessionID" class="CartTable_SessionID"><div class="ew-table-header-caption"><?php echo $CartTable->SessionID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionID" class="<?php echo $CartTable->SessionID->headerCellClass() ?>"><div><div id="elh_CartTable_SessionID" class="CartTable_SessionID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartTable->SessionID->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartTable->SessionID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CartTable->SessionID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
	<?php if ($CartTable->sortUrl($CartTable->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $CartTable->ProductID->headerCellClass() ?>"><div id="elh_CartTable_ProductID" class="CartTable_ProductID"><div class="ew-table-header-caption"><?php echo $CartTable->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $CartTable->ProductID->headerCellClass() ?>"><div><div id="elh_CartTable_ProductID" class="CartTable_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartTable->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartTable->ProductID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CartTable->ProductID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$CartTable_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$CartTable_grid->StartRec = 1;
$CartTable_grid->StopRec = $CartTable_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $CartTable_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($CartTable_grid->FormKeyCountName) && ($CartTable->isGridAdd() || $CartTable->isGridEdit() || $CartTable->isConfirm())) {
		$CartTable_grid->KeyCount = $CurrentForm->getValue($CartTable_grid->FormKeyCountName);
		$CartTable_grid->StopRec = $CartTable_grid->StartRec + $CartTable_grid->KeyCount - 1;
	}
}
$CartTable_grid->RecCnt = $CartTable_grid->StartRec - 1;
if ($CartTable_grid->Recordset && !$CartTable_grid->Recordset->EOF) {
	$CartTable_grid->Recordset->moveFirst();
	$selectLimit = $CartTable_grid->UseSelectLimit;
	if (!$selectLimit && $CartTable_grid->StartRec > 1)
		$CartTable_grid->Recordset->move($CartTable_grid->StartRec - 1);
} elseif (!$CartTable->AllowAddDeleteRow && $CartTable_grid->StopRec == 0) {
	$CartTable_grid->StopRec = $CartTable->GridAddRowCount;
}

// Initialize aggregate
$CartTable->RowType = ROWTYPE_AGGREGATEINIT;
$CartTable->resetAttributes();
$CartTable_grid->renderRow();
if ($CartTable->isGridAdd())
	$CartTable_grid->RowIndex = 0;
if ($CartTable->isGridEdit())
	$CartTable_grid->RowIndex = 0;
while ($CartTable_grid->RecCnt < $CartTable_grid->StopRec) {
	$CartTable_grid->RecCnt++;
	if ($CartTable_grid->RecCnt >= $CartTable_grid->StartRec) {
		$CartTable_grid->RowCnt++;
		if ($CartTable->isGridAdd() || $CartTable->isGridEdit() || $CartTable->isConfirm()) {
			$CartTable_grid->RowIndex++;
			$CurrentForm->Index = $CartTable_grid->RowIndex;
			if ($CurrentForm->hasValue($CartTable_grid->FormActionName) && $CartTable_grid->EventCancelled)
				$CartTable_grid->RowAction = strval($CurrentForm->getValue($CartTable_grid->FormActionName));
			elseif ($CartTable->isGridAdd())
				$CartTable_grid->RowAction = "insert";
			else
				$CartTable_grid->RowAction = "";
		}

		// Set up key count
		$CartTable_grid->KeyCount = $CartTable_grid->RowIndex;

		// Init row class and style
		$CartTable->resetAttributes();
		$CartTable->CssClass = "";
		if ($CartTable->isGridAdd()) {
			if ($CartTable->CurrentMode == "copy") {
				$CartTable_grid->loadRowValues($CartTable_grid->Recordset); // Load row values
				$CartTable_grid->setRecordKey($CartTable_grid->RowOldKey, $CartTable_grid->Recordset); // Set old record key
			} else {
				$CartTable_grid->loadRowValues(); // Load default values
				$CartTable_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$CartTable_grid->loadRowValues($CartTable_grid->Recordset); // Load row values
		}
		$CartTable->RowType = ROWTYPE_VIEW; // Render view
		if ($CartTable->isGridAdd()) // Grid add
			$CartTable->RowType = ROWTYPE_ADD; // Render add
		if ($CartTable->isGridAdd() && $CartTable->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$CartTable_grid->restoreCurrentRowFormValues($CartTable_grid->RowIndex); // Restore form values
		if ($CartTable->isGridEdit()) { // Grid edit
			if ($CartTable->EventCancelled)
				$CartTable_grid->restoreCurrentRowFormValues($CartTable_grid->RowIndex); // Restore form values
			if ($CartTable_grid->RowAction == "insert")
				$CartTable->RowType = ROWTYPE_ADD; // Render add
			else
				$CartTable->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($CartTable->isGridEdit() && ($CartTable->RowType == ROWTYPE_EDIT || $CartTable->RowType == ROWTYPE_ADD) && $CartTable->EventCancelled) // Update failed
			$CartTable_grid->restoreCurrentRowFormValues($CartTable_grid->RowIndex); // Restore form values
		if ($CartTable->RowType == ROWTYPE_EDIT) // Edit row
			$CartTable_grid->EditRowCnt++;
		if ($CartTable->isConfirm()) // Confirm row
			$CartTable_grid->restoreCurrentRowFormValues($CartTable_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$CartTable->RowAttrs = array_merge($CartTable->RowAttrs, array('data-rowindex'=>$CartTable_grid->RowCnt, 'id'=>'r' . $CartTable_grid->RowCnt . '_CartTable', 'data-rowtype'=>$CartTable->RowType));

		// Render row
		$CartTable_grid->renderRow();

		// Render list options
		$CartTable_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($CartTable_grid->RowAction <> "delete" && $CartTable_grid->RowAction <> "insertdelete" && !($CartTable_grid->RowAction == "insert" && $CartTable->isConfirm() && $CartTable_grid->emptyRow())) {
?>
	<tr<?php echo $CartTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CartTable_grid->ListOptions->render("body", "left", $CartTable_grid->RowCnt);
?>
	<?php if ($CartTable->Serial->Visible) { // Serial ?>
		<td data-name="Serial"<?php echo $CartTable->Serial->cellAttributes() ?>>
<?php if ($CartTable->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="o<?php echo $CartTable_grid->RowIndex ?>_Serial" id="o<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->OldValue) ?>">
<?php } ?>
<?php if ($CartTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_Serial" class="form-group CartTable_Serial">
<span<?php echo $CartTable->Serial->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->Serial->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="x<?php echo $CartTable_grid->RowIndex ?>_Serial" id="x<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->CurrentValue) ?>">
<?php } ?>
<?php if ($CartTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_Serial" class="CartTable_Serial">
<span<?php echo $CartTable->Serial->viewAttributes() ?>>
<?php echo $CartTable->Serial->getViewValue() ?></span>
</span>
<?php if (!$CartTable->isConfirm()) { ?>
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="x<?php echo $CartTable_grid->RowIndex ?>_Serial" id="x<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->FormValue) ?>">
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="o<?php echo $CartTable_grid->RowIndex ?>_Serial" id="o<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="fCartTablegrid$x<?php echo $CartTable_grid->RowIndex ?>_Serial" id="fCartTablegrid$x<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->FormValue) ?>">
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="fCartTablegrid$o<?php echo $CartTable_grid->RowIndex ?>_Serial" id="fCartTablegrid$o<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID"<?php echo $CartTable->SessionID->cellAttributes() ?>>
<?php if ($CartTable->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($CartTable->SessionID->getSessionValue() <> "") { ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_SessionID" class="form-group CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->SessionID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_SessionID" class="form-group CartTable_SessionID">
<input type="text" data-table="CartTable" data-field="x_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" size="30" placeholder="<?php echo HtmlEncode($CartTable->SessionID->getPlaceHolder()) ?>" value="<?php echo $CartTable->SessionID->EditValue ?>"<?php echo $CartTable->SessionID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="o<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="o<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->OldValue) ?>">
<?php } ?>
<?php if ($CartTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($CartTable->SessionID->getSessionValue() <> "") { ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_SessionID" class="form-group CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->SessionID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_SessionID" class="form-group CartTable_SessionID">
<input type="text" data-table="CartTable" data-field="x_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" size="30" placeholder="<?php echo HtmlEncode($CartTable->SessionID->getPlaceHolder()) ?>" value="<?php echo $CartTable->SessionID->EditValue ?>"<?php echo $CartTable->SessionID->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($CartTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_SessionID" class="CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<?php echo $CartTable->SessionID->getViewValue() ?></span>
</span>
<?php if (!$CartTable->isConfirm()) { ?>
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->FormValue) ?>">
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="o<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="o<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="fCartTablegrid$x<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="fCartTablegrid$x<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->FormValue) ?>">
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="fCartTablegrid$o<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="fCartTablegrid$o<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID"<?php echo $CartTable->ProductID->cellAttributes() ?>>
<?php if ($CartTable->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_ProductID" class="form-group CartTable_ProductID">
<input type="text" data-table="CartTable" data-field="x_ProductID" name="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" size="30" placeholder="<?php echo HtmlEncode($CartTable->ProductID->getPlaceHolder()) ?>" value="<?php echo $CartTable->ProductID->EditValue ?>"<?php echo $CartTable->ProductID->editAttributes() ?>>
</span>
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="o<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="o<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->OldValue) ?>">
<?php } ?>
<?php if ($CartTable->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_ProductID" class="form-group CartTable_ProductID">
<input type="text" data-table="CartTable" data-field="x_ProductID" name="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" size="30" placeholder="<?php echo HtmlEncode($CartTable->ProductID->getPlaceHolder()) ?>" value="<?php echo $CartTable->ProductID->EditValue ?>"<?php echo $CartTable->ProductID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($CartTable->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $CartTable_grid->RowCnt ?>_CartTable_ProductID" class="CartTable_ProductID">
<span<?php echo $CartTable->ProductID->viewAttributes() ?>>
<?php echo $CartTable->ProductID->getViewValue() ?></span>
</span>
<?php if (!$CartTable->isConfirm()) { ?>
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->FormValue) ?>">
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="o<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="o<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="fCartTablegrid$x<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="fCartTablegrid$x<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->FormValue) ?>">
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="fCartTablegrid$o<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="fCartTablegrid$o<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CartTable_grid->ListOptions->render("body", "right", $CartTable_grid->RowCnt);
?>
	</tr>
<?php if ($CartTable->RowType == ROWTYPE_ADD || $CartTable->RowType == ROWTYPE_EDIT) { ?>
<script>
fCartTablegrid.updateLists(<?php echo $CartTable_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$CartTable->isGridAdd() || $CartTable->CurrentMode == "copy")
		if (!$CartTable_grid->Recordset->EOF)
			$CartTable_grid->Recordset->moveNext();
}
?>
<?php
	if ($CartTable->CurrentMode == "add" || $CartTable->CurrentMode == "copy" || $CartTable->CurrentMode == "edit") {
		$CartTable_grid->RowIndex = '$rowindex$';
		$CartTable_grid->loadRowValues();

		// Set row properties
		$CartTable->resetAttributes();
		$CartTable->RowAttrs = array_merge($CartTable->RowAttrs, array('data-rowindex'=>$CartTable_grid->RowIndex, 'id'=>'r0_CartTable', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($CartTable->RowAttrs["class"], "ew-template");
		$CartTable->RowType = ROWTYPE_ADD;

		// Render row
		$CartTable_grid->renderRow();

		// Render list options
		$CartTable_grid->renderListOptions();
		$CartTable_grid->StartRowCnt = 0;
?>
	<tr<?php echo $CartTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CartTable_grid->ListOptions->render("body", "left", $CartTable_grid->RowIndex);
?>
	<?php if ($CartTable->Serial->Visible) { // Serial ?>
		<td data-name="Serial">
<?php if (!$CartTable->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_CartTable_Serial" class="form-group CartTable_Serial">
<span<?php echo $CartTable->Serial->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->Serial->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="x<?php echo $CartTable_grid->RowIndex ?>_Serial" id="x<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="CartTable" data-field="x_Serial" name="o<?php echo $CartTable_grid->RowIndex ?>_Serial" id="o<?php echo $CartTable_grid->RowIndex ?>_Serial" value="<?php echo HtmlEncode($CartTable->Serial->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID">
<?php if (!$CartTable->isConfirm()) { ?>
<?php if ($CartTable->SessionID->getSessionValue() <> "") { ?>
<span id="el$rowindex$_CartTable_SessionID" class="form-group CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->SessionID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_CartTable_SessionID" class="form-group CartTable_SessionID">
<input type="text" data-table="CartTable" data-field="x_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" size="30" placeholder="<?php echo HtmlEncode($CartTable->SessionID->getPlaceHolder()) ?>" value="<?php echo $CartTable->SessionID->EditValue ?>"<?php echo $CartTable->SessionID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_CartTable_SessionID" class="form-group CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->SessionID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="x<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="CartTable" data-field="x_SessionID" name="o<?php echo $CartTable_grid->RowIndex ?>_SessionID" id="o<?php echo $CartTable_grid->RowIndex ?>_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID">
<?php if (!$CartTable->isConfirm()) { ?>
<span id="el$rowindex$_CartTable_ProductID" class="form-group CartTable_ProductID">
<input type="text" data-table="CartTable" data-field="x_ProductID" name="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" size="30" placeholder="<?php echo HtmlEncode($CartTable->ProductID->getPlaceHolder()) ?>" value="<?php echo $CartTable->ProductID->EditValue ?>"<?php echo $CartTable->ProductID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_CartTable_ProductID" class="form-group CartTable_ProductID">
<span<?php echo $CartTable->ProductID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->ProductID->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="x<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="CartTable" data-field="x_ProductID" name="o<?php echo $CartTable_grid->RowIndex ?>_ProductID" id="o<?php echo $CartTable_grid->RowIndex ?>_ProductID" value="<?php echo HtmlEncode($CartTable->ProductID->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CartTable_grid->ListOptions->render("body", "right", $CartTable_grid->RowIndex);
?>
<script>
fCartTablegrid.updateLists(<?php echo $CartTable_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($CartTable->CurrentMode == "add" || $CartTable->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $CartTable_grid->FormKeyCountName ?>" id="<?php echo $CartTable_grid->FormKeyCountName ?>" value="<?php echo $CartTable_grid->KeyCount ?>">
<?php echo $CartTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($CartTable->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $CartTable_grid->FormKeyCountName ?>" id="<?php echo $CartTable_grid->FormKeyCountName ?>" value="<?php echo $CartTable_grid->KeyCount ?>">
<?php echo $CartTable_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($CartTable->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fCartTablegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($CartTable_grid->Recordset)
	$CartTable_grid->Recordset->Close();
?>
</div>
<?php if ($CartTable_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $CartTable_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($CartTable_grid->TotalRecs == 0 && !$CartTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $CartTable_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$CartTable_grid->terminate();
?>