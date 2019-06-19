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
$JobSessionTable_delete = new JobSessionTable_delete();

// Run the page
$JobSessionTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobSessionTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fJobSessionTabledelete = currentForm = new ew.Form("fJobSessionTabledelete", "delete");

// Form_CustomValidate event
fJobSessionTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobSessionTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $JobSessionTable_delete->showPageHeader(); ?>
<?php
$JobSessionTable_delete->showMessage();
?>
<form name="fJobSessionTabledelete" id="fJobSessionTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobSessionTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobSessionTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobSessionTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($JobSessionTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
		<th class="<?php echo $JobSessionTable->SessionID->headerCellClass() ?>"><span id="elh_JobSessionTable_SessionID" class="JobSessionTable_SessionID"><?php echo $JobSessionTable->SessionID->caption() ?></span></th>
<?php } ?>
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
		<th class="<?php echo $JobSessionTable->AssignmentID->headerCellClass() ?>"><span id="elh_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID"><?php echo $JobSessionTable->AssignmentID->caption() ?></span></th>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
		<th class="<?php echo $JobSessionTable->SessionTeam->headerCellClass() ?>"><span id="elh_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam"><?php echo $JobSessionTable->SessionTeam->caption() ?></span></th>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
		<th class="<?php echo $JobSessionTable->StartTimestamp->headerCellClass() ?>"><span id="elh_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp"><?php echo $JobSessionTable->StartTimestamp->caption() ?></span></th>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
		<th class="<?php echo $JobSessionTable->FinishTimestamp->headerCellClass() ?>"><span id="elh_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></span></th>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<th class="<?php echo $JobSessionTable->ExpectedStart->headerCellClass() ?>"><span id="elh_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart"><?php echo $JobSessionTable->ExpectedStart->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$JobSessionTable_delete->RecCnt = 0;
$i = 0;
while (!$JobSessionTable_delete->Recordset->EOF) {
	$JobSessionTable_delete->RecCnt++;
	$JobSessionTable_delete->RowCnt++;

	// Set row properties
	$JobSessionTable->resetAttributes();
	$JobSessionTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$JobSessionTable_delete->loadRowValues($JobSessionTable_delete->Recordset);

	// Render row
	$JobSessionTable_delete->renderRow();
?>
	<tr<?php echo $JobSessionTable->rowAttributes() ?>>
<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
		<td<?php echo $JobSessionTable->SessionID->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_delete->RowCnt ?>_JobSessionTable_SessionID" class="JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
		<td<?php echo $JobSessionTable->AssignmentID->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_delete->RowCnt ?>_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<?php echo $JobSessionTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
		<td<?php echo $JobSessionTable->SessionTeam->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_delete->RowCnt ?>_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam">
<span<?php echo $JobSessionTable->SessionTeam->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionTeam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
		<td<?php echo $JobSessionTable->StartTimestamp->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_delete->RowCnt ?>_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp">
<span<?php echo $JobSessionTable->StartTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->StartTimestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
		<td<?php echo $JobSessionTable->FinishTimestamp->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_delete->RowCnt ?>_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp">
<span<?php echo $JobSessionTable->FinishTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->FinishTimestamp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td<?php echo $JobSessionTable->ExpectedStart->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_delete->RowCnt ?>_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart">
<span<?php echo $JobSessionTable->ExpectedStart->viewAttributes() ?>>
<?php echo $JobSessionTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$JobSessionTable_delete->Recordset->moveNext();
}
$JobSessionTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobSessionTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$JobSessionTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$JobSessionTable_delete->terminate();
?>