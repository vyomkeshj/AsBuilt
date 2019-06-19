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
$TeamMemberTable_delete = new TeamMemberTable_delete();

// Run the page
$TeamMemberTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamMemberTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fTeamMemberTabledelete = currentForm = new ew.Form("fTeamMemberTabledelete", "delete");

// Form_CustomValidate event
fTeamMemberTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamMemberTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $TeamMemberTable_delete->showPageHeader(); ?>
<?php
$TeamMemberTable_delete->showMessage();
?>
<form name="fTeamMemberTabledelete" id="fTeamMemberTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamMemberTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamMemberTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamMemberTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($TeamMemberTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
		<th class="<?php echo $TeamMemberTable->serial->headerCellClass() ?>"><span id="elh_TeamMemberTable_serial" class="TeamMemberTable_serial"><?php echo $TeamMemberTable->serial->caption() ?></span></th>
<?php } ?>
<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
		<th class="<?php echo $TeamMemberTable->TeamID->headerCellClass() ?>"><span id="elh_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID"><?php echo $TeamMemberTable->TeamID->caption() ?></span></th>
<?php } ?>
<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<th class="<?php echo $TeamMemberTable->JobWorkerID->headerCellClass() ?>"><span id="elh_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID"><?php echo $TeamMemberTable->JobWorkerID->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$TeamMemberTable_delete->RecCnt = 0;
$i = 0;
while (!$TeamMemberTable_delete->Recordset->EOF) {
	$TeamMemberTable_delete->RecCnt++;
	$TeamMemberTable_delete->RowCnt++;

	// Set row properties
	$TeamMemberTable->resetAttributes();
	$TeamMemberTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$TeamMemberTable_delete->loadRowValues($TeamMemberTable_delete->Recordset);

	// Render row
	$TeamMemberTable_delete->renderRow();
?>
	<tr<?php echo $TeamMemberTable->rowAttributes() ?>>
<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
		<td<?php echo $TeamMemberTable->serial->cellAttributes() ?>>
<span id="el<?php echo $TeamMemberTable_delete->RowCnt ?>_TeamMemberTable_serial" class="TeamMemberTable_serial">
<span<?php echo $TeamMemberTable->serial->viewAttributes() ?>>
<?php echo $TeamMemberTable->serial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
		<td<?php echo $TeamMemberTable->TeamID->cellAttributes() ?>>
<span id="el<?php echo $TeamMemberTable_delete->RowCnt ?>_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<?php echo $TeamMemberTable->TeamID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<td<?php echo $TeamMemberTable->JobWorkerID->cellAttributes() ?>>
<span id="el<?php echo $TeamMemberTable_delete->RowCnt ?>_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID">
<span<?php echo $TeamMemberTable->JobWorkerID->viewAttributes() ?>>
<?php echo $TeamMemberTable->JobWorkerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$TeamMemberTable_delete->Recordset->moveNext();
}
$TeamMemberTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TeamMemberTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$TeamMemberTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$TeamMemberTable_delete->terminate();
?>