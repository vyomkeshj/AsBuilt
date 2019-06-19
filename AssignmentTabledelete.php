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
$AssignmentTable_delete = new AssignmentTable_delete();

// Run the page
$AssignmentTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AssignmentTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fAssignmentTabledelete = currentForm = new ew.Form("fAssignmentTabledelete", "delete");

// Form_CustomValidate event
fAssignmentTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fAssignmentTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $AssignmentTable_delete->showPageHeader(); ?>
<?php
$AssignmentTable_delete->showMessage();
?>
<form name="fAssignmentTabledelete" id="fAssignmentTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($AssignmentTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $AssignmentTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AssignmentTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($AssignmentTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
		<th class="<?php echo $AssignmentTable->AssignmentID->headerCellClass() ?>"><span id="elh_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID"><?php echo $AssignmentTable->AssignmentID->caption() ?></span></th>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
		<th class="<?php echo $AssignmentTable->LeadID->headerCellClass() ?>"><span id="elh_AssignmentTable_LeadID" class="AssignmentTable_LeadID"><?php echo $AssignmentTable->LeadID->caption() ?></span></th>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
		<th class="<?php echo $AssignmentTable->StartDate->headerCellClass() ?>"><span id="elh_AssignmentTable_StartDate" class="AssignmentTable_StartDate"><?php echo $AssignmentTable->StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
		<th class="<?php echo $AssignmentTable->AssignmentDuration->headerCellClass() ?>"><span id="elh_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration"><?php echo $AssignmentTable->AssignmentDuration->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$AssignmentTable_delete->RecCnt = 0;
$i = 0;
while (!$AssignmentTable_delete->Recordset->EOF) {
	$AssignmentTable_delete->RecCnt++;
	$AssignmentTable_delete->RowCnt++;

	// Set row properties
	$AssignmentTable->resetAttributes();
	$AssignmentTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$AssignmentTable_delete->loadRowValues($AssignmentTable_delete->Recordset);

	// Render row
	$AssignmentTable_delete->renderRow();
?>
	<tr<?php echo $AssignmentTable->rowAttributes() ?>>
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
		<td<?php echo $AssignmentTable->AssignmentID->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_delete->RowCnt ?>_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
		<td<?php echo $AssignmentTable->LeadID->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_delete->RowCnt ?>_AssignmentTable_LeadID" class="AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<?php echo $AssignmentTable->LeadID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
		<td<?php echo $AssignmentTable->StartDate->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_delete->RowCnt ?>_AssignmentTable_StartDate" class="AssignmentTable_StartDate">
<span<?php echo $AssignmentTable->StartDate->viewAttributes() ?>>
<?php echo $AssignmentTable->StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
		<td<?php echo $AssignmentTable->AssignmentDuration->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_delete->RowCnt ?>_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration">
<span<?php echo $AssignmentTable->AssignmentDuration->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentDuration->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$AssignmentTable_delete->Recordset->moveNext();
}
$AssignmentTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AssignmentTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$AssignmentTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$AssignmentTable_delete->terminate();
?>