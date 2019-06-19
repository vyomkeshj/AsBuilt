<?php
namespace PHPMaker2019\ASbuiltProject;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$LeadTable_delete = new LeadTable_delete();

// Run the page
$LeadTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fLeadTabledelete = currentForm = new ew.Form("fLeadTabledelete", "delete");

// Form_CustomValidate event
fLeadTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $LeadTable_delete->showPageHeader(); ?>
<?php
$LeadTable_delete->showMessage();
?>
<form name="fLeadTabledelete" id="fLeadTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($LeadTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
		<th class="<?php echo $LeadTable->LeadID->headerCellClass() ?>"><span id="elh_LeadTable_LeadID" class="LeadTable_LeadID"><?php echo $LeadTable->LeadID->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
		<th class="<?php echo $LeadTable->CustomerID->headerCellClass() ?>"><span id="elh_LeadTable_CustomerID" class="LeadTable_CustomerID"><?php echo $LeadTable->CustomerID->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
		<th class="<?php echo $LeadTable->LeadType->headerCellClass() ?>"><span id="elh_LeadTable_LeadType" class="LeadTable_LeadType"><?php echo $LeadTable->LeadType->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
		<th class="<?php echo $LeadTable->Suburb->headerCellClass() ?>"><span id="elh_LeadTable_Suburb" class="LeadTable_Suburb"><?php echo $LeadTable->Suburb->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<th class="<?php echo $LeadTable->ExpectedStart->headerCellClass() ?>"><span id="elh_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart"><?php echo $LeadTable->ExpectedStart->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
		<th class="<?php echo $LeadTable->DateTaken->headerCellClass() ?>"><span id="elh_LeadTable_DateTaken" class="LeadTable_DateTaken"><?php echo $LeadTable->DateTaken->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
		<th class="<?php echo $LeadTable->TakenBy->headerCellClass() ?>"><span id="elh_LeadTable_TakenBy" class="LeadTable_TakenBy"><?php echo $LeadTable->TakenBy->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
		<th class="<?php echo $LeadTable->IsComplete->headerCellClass() ?>"><span id="elh_LeadTable_IsComplete" class="LeadTable_IsComplete"><?php echo $LeadTable->IsComplete->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$LeadTable_delete->RecCnt = 0;
$i = 0;
while (!$LeadTable_delete->Recordset->EOF) {
	$LeadTable_delete->RecCnt++;
	$LeadTable_delete->RowCnt++;

	// Set row properties
	$LeadTable->resetAttributes();
	$LeadTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$LeadTable_delete->loadRowValues($LeadTable_delete->Recordset);

	// Render row
	$LeadTable_delete->renderRow();
?>
	<tr<?php echo $LeadTable->rowAttributes() ?>>
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
		<td<?php echo $LeadTable->LeadID->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_LeadID" class="LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<?php echo $LeadTable->LeadID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
		<td<?php echo $LeadTable->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_CustomerID" class="LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<?php echo $LeadTable->CustomerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
		<td<?php echo $LeadTable->LeadType->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_LeadType" class="LeadTable_LeadType">
<span<?php echo $LeadTable->LeadType->viewAttributes() ?>>
<?php echo $LeadTable->LeadType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
		<td<?php echo $LeadTable->Suburb->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_Suburb" class="LeadTable_Suburb">
<span<?php echo $LeadTable->Suburb->viewAttributes() ?>>
<?php echo $LeadTable->Suburb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td<?php echo $LeadTable->ExpectedStart->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart">
<span<?php echo $LeadTable->ExpectedStart->viewAttributes() ?>>
<?php echo $LeadTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
		<td<?php echo $LeadTable->DateTaken->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_DateTaken" class="LeadTable_DateTaken">
<span<?php echo $LeadTable->DateTaken->viewAttributes() ?>>
<?php echo $LeadTable->DateTaken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
		<td<?php echo $LeadTable->TakenBy->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_TakenBy" class="LeadTable_TakenBy">
<span<?php echo $LeadTable->TakenBy->viewAttributes() ?>>
<?php echo $LeadTable->TakenBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
		<td<?php echo $LeadTable->IsComplete->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_delete->RowCnt ?>_LeadTable_IsComplete" class="LeadTable_IsComplete">
<span<?php echo $LeadTable->IsComplete->viewAttributes() ?>>
<?php echo $LeadTable->IsComplete->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$LeadTable_delete->Recordset->moveNext();
}
$LeadTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LeadTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$LeadTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$LeadTable_delete->terminate();
?>