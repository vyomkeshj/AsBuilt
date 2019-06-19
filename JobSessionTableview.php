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
$JobSessionTable_view = new JobSessionTable_view();

// Run the page
$JobSessionTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobSessionTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$JobSessionTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fJobSessionTableview = currentForm = new ew.Form("fJobSessionTableview", "view");

// Form_CustomValidate event
fJobSessionTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobSessionTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$JobSessionTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $JobSessionTable_view->ExportOptions->render("body") ?>
<?php $JobSessionTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $JobSessionTable_view->showPageHeader(); ?>
<?php
$JobSessionTable_view->showMessage();
?>
<form name="fJobSessionTableview" id="fJobSessionTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobSessionTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobSessionTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobSessionTable">
<input type="hidden" name="modal" value="<?php echo (int)$JobSessionTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
	<tr id="r_SessionID">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_SessionID"><?php echo $JobSessionTable->SessionID->caption() ?></span></td>
		<td data-name="SessionID"<?php echo $JobSessionTable->SessionID->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
	<tr id="r_AssignmentID">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_AssignmentID"><?php echo $JobSessionTable->AssignmentID->caption() ?></span></td>
		<td data-name="AssignmentID"<?php echo $JobSessionTable->AssignmentID->cellAttributes() ?>>
<span id="el_JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<?php echo $JobSessionTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
	<tr id="r_SessionTeam">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_SessionTeam"><?php echo $JobSessionTable->SessionTeam->caption() ?></span></td>
		<td data-name="SessionTeam"<?php echo $JobSessionTable->SessionTeam->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionTeam">
<span<?php echo $JobSessionTable->SessionTeam->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionTeam->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
	<tr id="r_StartTimestamp">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_StartTimestamp"><?php echo $JobSessionTable->StartTimestamp->caption() ?></span></td>
		<td data-name="StartTimestamp"<?php echo $JobSessionTable->StartTimestamp->cellAttributes() ?>>
<span id="el_JobSessionTable_StartTimestamp">
<span<?php echo $JobSessionTable->StartTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->StartTimestamp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
	<tr id="r_FinishTimestamp">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_FinishTimestamp"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></span></td>
		<td data-name="FinishTimestamp"<?php echo $JobSessionTable->FinishTimestamp->cellAttributes() ?>>
<span id="el_JobSessionTable_FinishTimestamp">
<span<?php echo $JobSessionTable->FinishTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->FinishTimestamp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<tr id="r_ExpectedStart">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_ExpectedStart"><?php echo $JobSessionTable->ExpectedStart->caption() ?></span></td>
		<td data-name="ExpectedStart"<?php echo $JobSessionTable->ExpectedStart->cellAttributes() ?>>
<span id="el_JobSessionTable_ExpectedStart">
<span<?php echo $JobSessionTable->ExpectedStart->viewAttributes() ?>>
<?php echo $JobSessionTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobSessionTable->SessionComment->Visible) { // SessionComment ?>
	<tr id="r_SessionComment">
		<td class="<?php echo $JobSessionTable_view->TableLeftColumnClass ?>"><span id="elh_JobSessionTable_SessionComment"><?php echo $JobSessionTable->SessionComment->caption() ?></span></td>
		<td data-name="SessionComment"<?php echo $JobSessionTable->SessionComment->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionComment">
<span<?php echo $JobSessionTable->SessionComment->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionComment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("TeamTable", explode(",", $JobSessionTable->getCurrentDetailTable())) && $TeamTable->DetailView) {
?>
<?php if ($JobSessionTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("TeamTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TeamTablegrid.php" ?>
<?php } ?>
<?php
	if (in_array("CartTable", explode(",", $JobSessionTable->getCurrentDetailTable())) && $CartTable->DetailView) {
?>
<?php if ($JobSessionTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("CartTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "CartTablegrid.php" ?>
<?php } ?>
</form>
<?php
$JobSessionTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$JobSessionTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$JobSessionTable_view->terminate();
?>