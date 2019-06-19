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
$AssignmentTable_view = new AssignmentTable_view();

// Run the page
$AssignmentTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AssignmentTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$AssignmentTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fAssignmentTableview = currentForm = new ew.Form("fAssignmentTableview", "view");

// Form_CustomValidate event
fAssignmentTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fAssignmentTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$AssignmentTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $AssignmentTable_view->ExportOptions->render("body") ?>
<?php $AssignmentTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $AssignmentTable_view->showPageHeader(); ?>
<?php
$AssignmentTable_view->showMessage();
?>
<form name="fAssignmentTableview" id="fAssignmentTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($AssignmentTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $AssignmentTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AssignmentTable">
<input type="hidden" name="modal" value="<?php echo (int)$AssignmentTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
	<tr id="r_AssignmentID">
		<td class="<?php echo $AssignmentTable_view->TableLeftColumnClass ?>"><span id="elh_AssignmentTable_AssignmentID"><?php echo $AssignmentTable->AssignmentID->caption() ?></span></td>
		<td data-name="AssignmentID"<?php echo $AssignmentTable->AssignmentID->cellAttributes() ?>>
<span id="el_AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
	<tr id="r_LeadID">
		<td class="<?php echo $AssignmentTable_view->TableLeftColumnClass ?>"><span id="elh_AssignmentTable_LeadID"><?php echo $AssignmentTable->LeadID->caption() ?></span></td>
		<td data-name="LeadID"<?php echo $AssignmentTable->LeadID->cellAttributes() ?>>
<span id="el_AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<?php echo $AssignmentTable->LeadID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $AssignmentTable_view->TableLeftColumnClass ?>"><span id="elh_AssignmentTable_StartDate"><?php echo $AssignmentTable->StartDate->caption() ?></span></td>
		<td data-name="StartDate"<?php echo $AssignmentTable->StartDate->cellAttributes() ?>>
<span id="el_AssignmentTable_StartDate">
<span<?php echo $AssignmentTable->StartDate->viewAttributes() ?>>
<?php echo $AssignmentTable->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
	<tr id="r_AssignmentDuration">
		<td class="<?php echo $AssignmentTable_view->TableLeftColumnClass ?>"><span id="elh_AssignmentTable_AssignmentDuration"><?php echo $AssignmentTable->AssignmentDuration->caption() ?></span></td>
		<td data-name="AssignmentDuration"<?php echo $AssignmentTable->AssignmentDuration->cellAttributes() ?>>
<span id="el_AssignmentTable_AssignmentDuration">
<span<?php echo $AssignmentTable->AssignmentDuration->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentDuration->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("JobSessionTable", explode(",", $AssignmentTable->getCurrentDetailTable())) && $JobSessionTable->DetailView) {
?>
<?php if ($AssignmentTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("JobSessionTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JobSessionTablegrid.php" ?>
<?php } ?>
</form>
<?php
$AssignmentTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$AssignmentTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$AssignmentTable_view->terminate();
?>