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
$TeamTable_view = new TeamTable_view();

// Run the page
$TeamTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$TeamTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fTeamTableview = currentForm = new ew.Form("fTeamTableview", "view");

// Form_CustomValidate event
fTeamTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$TeamTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $TeamTable_view->ExportOptions->render("body") ?>
<?php $TeamTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $TeamTable_view->showPageHeader(); ?>
<?php
$TeamTable_view->showMessage();
?>
<form name="fTeamTableview" id="fTeamTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamTable">
<input type="hidden" name="modal" value="<?php echo (int)$TeamTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
	<tr id="r_TeamID">
		<td class="<?php echo $TeamTable_view->TableLeftColumnClass ?>"><span id="elh_TeamTable_TeamID"><?php echo $TeamTable->TeamID->caption() ?></span></td>
		<td data-name="TeamID"<?php echo $TeamTable->TeamID->cellAttributes() ?>>
<span id="el_TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<?php echo $TeamTable->TeamID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
	<tr id="r_TeamName">
		<td class="<?php echo $TeamTable_view->TableLeftColumnClass ?>"><span id="elh_TeamTable_TeamName"><?php echo $TeamTable->TeamName->caption() ?></span></td>
		<td data-name="TeamName"<?php echo $TeamTable->TeamName->cellAttributes() ?>>
<span id="el_TeamTable_TeamName">
<span<?php echo $TeamTable->TeamName->viewAttributes() ?>>
<?php echo $TeamTable->TeamName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
	<tr id="r_TeamLeader">
		<td class="<?php echo $TeamTable_view->TableLeftColumnClass ?>"><span id="elh_TeamTable_TeamLeader"><?php echo $TeamTable->TeamLeader->caption() ?></span></td>
		<td data-name="TeamLeader"<?php echo $TeamTable->TeamLeader->cellAttributes() ?>>
<span id="el_TeamTable_TeamLeader">
<span<?php echo $TeamTable->TeamLeader->viewAttributes() ?>>
<?php echo $TeamTable->TeamLeader->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
	<tr id="r_IsVisible">
		<td class="<?php echo $TeamTable_view->TableLeftColumnClass ?>"><span id="elh_TeamTable_IsVisible"><?php echo $TeamTable->IsVisible->caption() ?></span></td>
		<td data-name="IsVisible"<?php echo $TeamTable->IsVisible->cellAttributes() ?>>
<span id="el_TeamTable_IsVisible">
<span<?php echo $TeamTable->IsVisible->viewAttributes() ?>>
<?php echo $TeamTable->IsVisible->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("TeamMemberTable", explode(",", $TeamTable->getCurrentDetailTable())) && $TeamMemberTable->DetailView) {
?>
<?php if ($TeamTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("TeamMemberTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TeamMemberTablegrid.php" ?>
<?php } ?>
</form>
<?php
$TeamTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$TeamTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$TeamTable_view->terminate();
?>