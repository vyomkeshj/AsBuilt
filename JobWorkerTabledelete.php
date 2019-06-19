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
$JobWorkerTable_delete = new JobWorkerTable_delete();

// Run the page
$JobWorkerTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobWorkerTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fJobWorkerTabledelete = currentForm = new ew.Form("fJobWorkerTabledelete", "delete");

// Form_CustomValidate event
fJobWorkerTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobWorkerTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $JobWorkerTable_delete->showPageHeader(); ?>
<?php
$JobWorkerTable_delete->showMessage();
?>
<form name="fJobWorkerTabledelete" id="fJobWorkerTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobWorkerTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobWorkerTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobWorkerTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($JobWorkerTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($JobWorkerTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<th class="<?php echo $JobWorkerTable->JobWorkerID->headerCellClass() ?>"><span id="elh_JobWorkerTable_JobWorkerID" class="JobWorkerTable_JobWorkerID"><?php echo $JobWorkerTable->JobWorkerID->caption() ?></span></th>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerName->Visible) { // JobWorkerName ?>
		<th class="<?php echo $JobWorkerTable->JobWorkerName->headerCellClass() ?>"><span id="elh_JobWorkerTable_JobWorkerName" class="JobWorkerTable_JobWorkerName"><?php echo $JobWorkerTable->JobWorkerName->caption() ?></span></th>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerCircle->Visible) { // JobWorkerCircle ?>
		<th class="<?php echo $JobWorkerTable->JobWorkerCircle->headerCellClass() ?>"><span id="elh_JobWorkerTable_JobWorkerCircle" class="JobWorkerTable_JobWorkerCircle"><?php echo $JobWorkerTable->JobWorkerCircle->caption() ?></span></th>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerRate->Visible) { // JobWorkerRate ?>
		<th class="<?php echo $JobWorkerTable->JobWorkerRate->headerCellClass() ?>"><span id="elh_JobWorkerTable_JobWorkerRate" class="JobWorkerTable_JobWorkerRate"><?php echo $JobWorkerTable->JobWorkerRate->caption() ?></span></th>
<?php } ?>
<?php if ($JobWorkerTable->Passcode->Visible) { // Passcode ?>
		<th class="<?php echo $JobWorkerTable->Passcode->headerCellClass() ?>"><span id="elh_JobWorkerTable_Passcode" class="JobWorkerTable_Passcode"><?php echo $JobWorkerTable->Passcode->caption() ?></span></th>
<?php } ?>
<?php if ($JobWorkerTable->AccessLevel->Visible) { // AccessLevel ?>
		<th class="<?php echo $JobWorkerTable->AccessLevel->headerCellClass() ?>"><span id="elh_JobWorkerTable_AccessLevel" class="JobWorkerTable_AccessLevel"><?php echo $JobWorkerTable->AccessLevel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$JobWorkerTable_delete->RecCnt = 0;
$i = 0;
while (!$JobWorkerTable_delete->Recordset->EOF) {
	$JobWorkerTable_delete->RecCnt++;
	$JobWorkerTable_delete->RowCnt++;

	// Set row properties
	$JobWorkerTable->resetAttributes();
	$JobWorkerTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$JobWorkerTable_delete->loadRowValues($JobWorkerTable_delete->Recordset);

	// Render row
	$JobWorkerTable_delete->renderRow();
?>
	<tr<?php echo $JobWorkerTable->rowAttributes() ?>>
<?php if ($JobWorkerTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<td<?php echo $JobWorkerTable->JobWorkerID->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_delete->RowCnt ?>_JobWorkerTable_JobWorkerID" class="JobWorkerTable_JobWorkerID">
<span<?php echo $JobWorkerTable->JobWorkerID->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerName->Visible) { // JobWorkerName ?>
		<td<?php echo $JobWorkerTable->JobWorkerName->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_delete->RowCnt ?>_JobWorkerTable_JobWorkerName" class="JobWorkerTable_JobWorkerName">
<span<?php echo $JobWorkerTable->JobWorkerName->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerCircle->Visible) { // JobWorkerCircle ?>
		<td<?php echo $JobWorkerTable->JobWorkerCircle->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_delete->RowCnt ?>_JobWorkerTable_JobWorkerCircle" class="JobWorkerTable_JobWorkerCircle">
<span<?php echo $JobWorkerTable->JobWorkerCircle->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerCircle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerRate->Visible) { // JobWorkerRate ?>
		<td<?php echo $JobWorkerTable->JobWorkerRate->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_delete->RowCnt ?>_JobWorkerTable_JobWorkerRate" class="JobWorkerTable_JobWorkerRate">
<span<?php echo $JobWorkerTable->JobWorkerRate->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobWorkerTable->Passcode->Visible) { // Passcode ?>
		<td<?php echo $JobWorkerTable->Passcode->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_delete->RowCnt ?>_JobWorkerTable_Passcode" class="JobWorkerTable_Passcode">
<span<?php echo $JobWorkerTable->Passcode->viewAttributes() ?>>
<?php echo $JobWorkerTable->Passcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobWorkerTable->AccessLevel->Visible) { // AccessLevel ?>
		<td<?php echo $JobWorkerTable->AccessLevel->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_delete->RowCnt ?>_JobWorkerTable_AccessLevel" class="JobWorkerTable_AccessLevel">
<span<?php echo $JobWorkerTable->AccessLevel->viewAttributes() ?>>
<?php echo $JobWorkerTable->AccessLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$JobWorkerTable_delete->Recordset->moveNext();
}
$JobWorkerTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobWorkerTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$JobWorkerTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$JobWorkerTable_delete->terminate();
?>