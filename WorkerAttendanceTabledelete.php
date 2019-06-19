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
$WorkerAttendanceTable_delete = new WorkerAttendanceTable_delete();

// Run the page
$WorkerAttendanceTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorkerAttendanceTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fWorkerAttendanceTabledelete = currentForm = new ew.Form("fWorkerAttendanceTabledelete", "delete");

// Form_CustomValidate event
fWorkerAttendanceTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fWorkerAttendanceTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $WorkerAttendanceTable_delete->showPageHeader(); ?>
<?php
$WorkerAttendanceTable_delete->showMessage();
?>
<form name="fWorkerAttendanceTabledelete" id="fWorkerAttendanceTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($WorkerAttendanceTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $WorkerAttendanceTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorkerAttendanceTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($WorkerAttendanceTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
		<th class="<?php echo $WorkerAttendanceTable->JobWorkerId->headerCellClass() ?>"><span id="elh_WorkerAttendanceTable_JobWorkerId" class="WorkerAttendanceTable_JobWorkerId"><?php echo $WorkerAttendanceTable->JobWorkerId->caption() ?></span></th>
<?php } ?>
<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
		<th class="<?php echo $WorkerAttendanceTable->EntryTimestamp->headerCellClass() ?>"><span id="elh_WorkerAttendanceTable_EntryTimestamp" class="WorkerAttendanceTable_EntryTimestamp"><?php echo $WorkerAttendanceTable->EntryTimestamp->caption() ?></span></th>
<?php } ?>
<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
		<th class="<?php echo $WorkerAttendanceTable->ExitTimestamp->headerCellClass() ?>"><span id="elh_WorkerAttendanceTable_ExitTimestamp" class="WorkerAttendanceTable_ExitTimestamp"><?php echo $WorkerAttendanceTable->ExitTimestamp->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$WorkerAttendanceTable_delete->RecCnt = 0;
$i = 0;
while (!$WorkerAttendanceTable_delete->Recordset->EOF) {
	$WorkerAttendanceTable_delete->RecCnt++;
	$WorkerAttendanceTable_delete->RowCnt++;

	// Set row properties
	$WorkerAttendanceTable->resetAttributes();
	$WorkerAttendanceTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$WorkerAttendanceTable_delete->loadRowValues($WorkerAttendanceTable_delete->Recordset);

	// Render row
	$WorkerAttendanceTable_delete->renderRow();
?>
	<tr<?php echo $WorkerAttendanceTable->rowAttributes() ?>>
<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
		<td<?php echo $WorkerAttendanceTable->JobWorkerId->cellAttributes() ?>>
<span id="el<?php echo $WorkerAttendanceTable_delete->RowCnt ?>_WorkerAttendanceTable_JobWorkerId" class="WorkerAttendanceTable_JobWorkerId">
<span<?php echo $WorkerAttendanceTable->JobWorkerId->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->JobWorkerId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
		<td<?php echo $WorkerAttendanceTable->EntryTimestamp->cellAttributes() ?>>
<span id="el<?php echo $WorkerAttendanceTable_delete->RowCnt ?>_WorkerAttendanceTable_EntryTimestamp" class="WorkerAttendanceTable_EntryTimestamp">
<span<?php echo $WorkerAttendanceTable->EntryTimestamp->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->EntryTimestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
		<td<?php echo $WorkerAttendanceTable->ExitTimestamp->cellAttributes() ?>>
<span id="el<?php echo $WorkerAttendanceTable_delete->RowCnt ?>_WorkerAttendanceTable_ExitTimestamp" class="WorkerAttendanceTable_ExitTimestamp">
<span<?php echo $WorkerAttendanceTable->ExitTimestamp->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->ExitTimestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$WorkerAttendanceTable_delete->Recordset->moveNext();
}
$WorkerAttendanceTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorkerAttendanceTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$WorkerAttendanceTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$WorkerAttendanceTable_delete->terminate();
?>