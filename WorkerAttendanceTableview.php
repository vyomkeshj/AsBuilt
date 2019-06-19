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
$WorkerAttendanceTable_view = new WorkerAttendanceTable_view();

// Run the page
$WorkerAttendanceTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorkerAttendanceTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fWorkerAttendanceTableview = currentForm = new ew.Form("fWorkerAttendanceTableview", "view");

// Form_CustomValidate event
fWorkerAttendanceTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fWorkerAttendanceTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $WorkerAttendanceTable_view->ExportOptions->render("body") ?>
<?php $WorkerAttendanceTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $WorkerAttendanceTable_view->showPageHeader(); ?>
<?php
$WorkerAttendanceTable_view->showMessage();
?>
<form name="fWorkerAttendanceTableview" id="fWorkerAttendanceTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($WorkerAttendanceTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $WorkerAttendanceTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorkerAttendanceTable">
<input type="hidden" name="modal" value="<?php echo (int)$WorkerAttendanceTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
	<tr id="r_JobWorkerId">
		<td class="<?php echo $WorkerAttendanceTable_view->TableLeftColumnClass ?>"><span id="elh_WorkerAttendanceTable_JobWorkerId"><?php echo $WorkerAttendanceTable->JobWorkerId->caption() ?></span></td>
		<td data-name="JobWorkerId"<?php echo $WorkerAttendanceTable->JobWorkerId->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_JobWorkerId">
<span<?php echo $WorkerAttendanceTable->JobWorkerId->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->JobWorkerId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
	<tr id="r_EntryTimestamp">
		<td class="<?php echo $WorkerAttendanceTable_view->TableLeftColumnClass ?>"><span id="elh_WorkerAttendanceTable_EntryTimestamp"><?php echo $WorkerAttendanceTable->EntryTimestamp->caption() ?></span></td>
		<td data-name="EntryTimestamp"<?php echo $WorkerAttendanceTable->EntryTimestamp->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_EntryTimestamp">
<span<?php echo $WorkerAttendanceTable->EntryTimestamp->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->EntryTimestamp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
	<tr id="r_ExitTimestamp">
		<td class="<?php echo $WorkerAttendanceTable_view->TableLeftColumnClass ?>"><span id="elh_WorkerAttendanceTable_ExitTimestamp"><?php echo $WorkerAttendanceTable->ExitTimestamp->caption() ?></span></td>
		<td data-name="ExitTimestamp"<?php echo $WorkerAttendanceTable->ExitTimestamp->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_ExitTimestamp">
<span<?php echo $WorkerAttendanceTable->ExitTimestamp->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->ExitTimestamp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$WorkerAttendanceTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$WorkerAttendanceTable_view->terminate();
?>