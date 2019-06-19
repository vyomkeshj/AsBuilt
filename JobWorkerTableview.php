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
$JobWorkerTable_view = new JobWorkerTable_view();

// Run the page
$JobWorkerTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobWorkerTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fJobWorkerTableview = currentForm = new ew.Form("fJobWorkerTableview", "view");

// Form_CustomValidate event
fJobWorkerTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobWorkerTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $JobWorkerTable_view->ExportOptions->render("body") ?>
<?php $JobWorkerTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $JobWorkerTable_view->showPageHeader(); ?>
<?php
$JobWorkerTable_view->showMessage();
?>
<form name="fJobWorkerTableview" id="fJobWorkerTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobWorkerTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobWorkerTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobWorkerTable">
<input type="hidden" name="modal" value="<?php echo (int)$JobWorkerTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($JobWorkerTable->JobWorkerID->Visible) { // JobWorkerID ?>
	<tr id="r_JobWorkerID">
		<td class="<?php echo $JobWorkerTable_view->TableLeftColumnClass ?>"><span id="elh_JobWorkerTable_JobWorkerID"><?php echo $JobWorkerTable->JobWorkerID->caption() ?></span></td>
		<td data-name="JobWorkerID"<?php echo $JobWorkerTable->JobWorkerID->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerID">
<span<?php echo $JobWorkerTable->JobWorkerID->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerName->Visible) { // JobWorkerName ?>
	<tr id="r_JobWorkerName">
		<td class="<?php echo $JobWorkerTable_view->TableLeftColumnClass ?>"><span id="elh_JobWorkerTable_JobWorkerName"><?php echo $JobWorkerTable->JobWorkerName->caption() ?></span></td>
		<td data-name="JobWorkerName"<?php echo $JobWorkerTable->JobWorkerName->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerName">
<span<?php echo $JobWorkerTable->JobWorkerName->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerCircle->Visible) { // JobWorkerCircle ?>
	<tr id="r_JobWorkerCircle">
		<td class="<?php echo $JobWorkerTable_view->TableLeftColumnClass ?>"><span id="elh_JobWorkerTable_JobWorkerCircle"><?php echo $JobWorkerTable->JobWorkerCircle->caption() ?></span></td>
		<td data-name="JobWorkerCircle"<?php echo $JobWorkerTable->JobWorkerCircle->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerCircle">
<span<?php echo $JobWorkerTable->JobWorkerCircle->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerCircle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerRate->Visible) { // JobWorkerRate ?>
	<tr id="r_JobWorkerRate">
		<td class="<?php echo $JobWorkerTable_view->TableLeftColumnClass ?>"><span id="elh_JobWorkerTable_JobWorkerRate"><?php echo $JobWorkerTable->JobWorkerRate->caption() ?></span></td>
		<td data-name="JobWorkerRate"<?php echo $JobWorkerTable->JobWorkerRate->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerRate">
<span<?php echo $JobWorkerTable->JobWorkerRate->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobWorkerTable->Passcode->Visible) { // Passcode ?>
	<tr id="r_Passcode">
		<td class="<?php echo $JobWorkerTable_view->TableLeftColumnClass ?>"><span id="elh_JobWorkerTable_Passcode"><?php echo $JobWorkerTable->Passcode->caption() ?></span></td>
		<td data-name="Passcode"<?php echo $JobWorkerTable->Passcode->cellAttributes() ?>>
<span id="el_JobWorkerTable_Passcode">
<span<?php echo $JobWorkerTable->Passcode->viewAttributes() ?>>
<?php echo $JobWorkerTable->Passcode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($JobWorkerTable->AccessLevel->Visible) { // AccessLevel ?>
	<tr id="r_AccessLevel">
		<td class="<?php echo $JobWorkerTable_view->TableLeftColumnClass ?>"><span id="elh_JobWorkerTable_AccessLevel"><?php echo $JobWorkerTable->AccessLevel->caption() ?></span></td>
		<td data-name="AccessLevel"<?php echo $JobWorkerTable->AccessLevel->cellAttributes() ?>>
<span id="el_JobWorkerTable_AccessLevel">
<span<?php echo $JobWorkerTable->AccessLevel->viewAttributes() ?>>
<?php echo $JobWorkerTable->AccessLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$JobWorkerTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$JobWorkerTable_view->terminate();
?>