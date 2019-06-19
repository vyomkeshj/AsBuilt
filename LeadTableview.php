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
$LeadTable_view = new LeadTable_view();

// Run the page
$LeadTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$LeadTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fLeadTableview = currentForm = new ew.Form("fLeadTableview", "view");

// Form_CustomValidate event
fLeadTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$LeadTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $LeadTable_view->ExportOptions->render("body") ?>
<?php $LeadTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $LeadTable_view->showPageHeader(); ?>
<?php
$LeadTable_view->showMessage();
?>
<form name="fLeadTableview" id="fLeadTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTable">
<input type="hidden" name="modal" value="<?php echo (int)$LeadTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
	<tr id="r_LeadID">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_LeadID"><?php echo $LeadTable->LeadID->caption() ?></span></td>
		<td data-name="LeadID"<?php echo $LeadTable->LeadID->cellAttributes() ?>>
<span id="el_LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<?php echo $LeadTable->LeadID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_CustomerID"><?php echo $LeadTable->CustomerID->caption() ?></span></td>
		<td data-name="CustomerID"<?php echo $LeadTable->CustomerID->cellAttributes() ?>>
<span id="el_LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<?php echo $LeadTable->CustomerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
	<tr id="r_LeadType">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_LeadType"><?php echo $LeadTable->LeadType->caption() ?></span></td>
		<td data-name="LeadType"<?php echo $LeadTable->LeadType->cellAttributes() ?>>
<span id="el_LeadTable_LeadType">
<span<?php echo $LeadTable->LeadType->viewAttributes() ?>>
<?php echo $LeadTable->LeadType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->SiteLocation->Visible) { // SiteLocation ?>
	<tr id="r_SiteLocation">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_SiteLocation"><?php echo $LeadTable->SiteLocation->caption() ?></span></td>
		<td data-name="SiteLocation"<?php echo $LeadTable->SiteLocation->cellAttributes() ?>>
<span id="el_LeadTable_SiteLocation">
<span<?php echo $LeadTable->SiteLocation->viewAttributes() ?>>
<?php echo $LeadTable->SiteLocation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
	<tr id="r_Suburb">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_Suburb"><?php echo $LeadTable->Suburb->caption() ?></span></td>
		<td data-name="Suburb"<?php echo $LeadTable->Suburb->cellAttributes() ?>>
<span id="el_LeadTable_Suburb">
<span<?php echo $LeadTable->Suburb->viewAttributes() ?>>
<?php echo $LeadTable->Suburb->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<tr id="r_ExpectedStart">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_ExpectedStart"><?php echo $LeadTable->ExpectedStart->caption() ?></span></td>
		<td data-name="ExpectedStart"<?php echo $LeadTable->ExpectedStart->cellAttributes() ?>>
<span id="el_LeadTable_ExpectedStart">
<span<?php echo $LeadTable->ExpectedStart->viewAttributes() ?>>
<?php echo $LeadTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
	<tr id="r_DateTaken">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_DateTaken"><?php echo $LeadTable->DateTaken->caption() ?></span></td>
		<td data-name="DateTaken"<?php echo $LeadTable->DateTaken->cellAttributes() ?>>
<span id="el_LeadTable_DateTaken">
<span<?php echo $LeadTable->DateTaken->viewAttributes() ?>>
<?php echo $LeadTable->DateTaken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
	<tr id="r_TakenBy">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_TakenBy"><?php echo $LeadTable->TakenBy->caption() ?></span></td>
		<td data-name="TakenBy"<?php echo $LeadTable->TakenBy->cellAttributes() ?>>
<span id="el_LeadTable_TakenBy">
<span<?php echo $LeadTable->TakenBy->viewAttributes() ?>>
<?php echo $LeadTable->TakenBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
	<tr id="r_IsComplete">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_IsComplete"><?php echo $LeadTable->IsComplete->caption() ?></span></td>
		<td data-name="IsComplete"<?php echo $LeadTable->IsComplete->cellAttributes() ?>>
<span id="el_LeadTable_IsComplete">
<span<?php echo $LeadTable->IsComplete->viewAttributes() ?>>
<?php echo $LeadTable->IsComplete->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTable->LeadComment->Visible) { // LeadComment ?>
	<tr id="r_LeadComment">
		<td class="<?php echo $LeadTable_view->TableLeftColumnClass ?>"><span id="elh_LeadTable_LeadComment"><?php echo $LeadTable->LeadComment->caption() ?></span></td>
		<td data-name="LeadComment"<?php echo $LeadTable->LeadComment->cellAttributes() ?>>
<span id="el_LeadTable_LeadComment">
<span<?php echo $LeadTable->LeadComment->viewAttributes() ?>>
<?php echo $LeadTable->LeadComment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("LeadFileAssociation", explode(",", $LeadTable->getCurrentDetailTable())) && $LeadFileAssociation->DetailView) {
?>
<?php if ($LeadTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("LeadFileAssociation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LeadFileAssociationgrid.php" ?>
<?php } ?>
<?php
	if (in_array("AssignmentTable", explode(",", $LeadTable->getCurrentDetailTable())) && $AssignmentTable->DetailView) {
?>
<?php if ($LeadTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("AssignmentTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AssignmentTablegrid.php" ?>
<?php } ?>
</form>
<?php
$LeadTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$LeadTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$LeadTable_view->terminate();
?>