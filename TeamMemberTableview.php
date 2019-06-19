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
$TeamMemberTable_view = new TeamMemberTable_view();

// Run the page
$TeamMemberTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamMemberTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fTeamMemberTableview = currentForm = new ew.Form("fTeamMemberTableview", "view");

// Form_CustomValidate event
fTeamMemberTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamMemberTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $TeamMemberTable_view->ExportOptions->render("body") ?>
<?php $TeamMemberTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $TeamMemberTable_view->showPageHeader(); ?>
<?php
$TeamMemberTable_view->showMessage();
?>
<form name="fTeamMemberTableview" id="fTeamMemberTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamMemberTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamMemberTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamMemberTable">
<input type="hidden" name="modal" value="<?php echo (int)$TeamMemberTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
	<tr id="r_serial">
		<td class="<?php echo $TeamMemberTable_view->TableLeftColumnClass ?>"><span id="elh_TeamMemberTable_serial"><?php echo $TeamMemberTable->serial->caption() ?></span></td>
		<td data-name="serial"<?php echo $TeamMemberTable->serial->cellAttributes() ?>>
<span id="el_TeamMemberTable_serial">
<span<?php echo $TeamMemberTable->serial->viewAttributes() ?>>
<?php echo $TeamMemberTable->serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
	<tr id="r_TeamID">
		<td class="<?php echo $TeamMemberTable_view->TableLeftColumnClass ?>"><span id="elh_TeamMemberTable_TeamID"><?php echo $TeamMemberTable->TeamID->caption() ?></span></td>
		<td data-name="TeamID"<?php echo $TeamMemberTable->TeamID->cellAttributes() ?>>
<span id="el_TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<?php echo $TeamMemberTable->TeamID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
	<tr id="r_JobWorkerID">
		<td class="<?php echo $TeamMemberTable_view->TableLeftColumnClass ?>"><span id="elh_TeamMemberTable_JobWorkerID"><?php echo $TeamMemberTable->JobWorkerID->caption() ?></span></td>
		<td data-name="JobWorkerID"<?php echo $TeamMemberTable->JobWorkerID->cellAttributes() ?>>
<span id="el_TeamMemberTable_JobWorkerID">
<span<?php echo $TeamMemberTable->JobWorkerID->viewAttributes() ?>>
<?php echo $TeamMemberTable->JobWorkerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$TeamMemberTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$TeamMemberTable_view->terminate();
?>