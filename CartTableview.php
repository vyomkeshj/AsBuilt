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
$CartTable_view = new CartTable_view();

// Run the page
$CartTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$CartTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fCartTableview = currentForm = new ew.Form("fCartTableview", "view");

// Form_CustomValidate event
fCartTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCartTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$CartTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $CartTable_view->ExportOptions->render("body") ?>
<?php $CartTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $CartTable_view->showPageHeader(); ?>
<?php
$CartTable_view->showMessage();
?>
<form name="fCartTableview" id="fCartTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CartTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CartTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartTable">
<input type="hidden" name="modal" value="<?php echo (int)$CartTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($CartTable->Serial->Visible) { // Serial ?>
	<tr id="r_Serial">
		<td class="<?php echo $CartTable_view->TableLeftColumnClass ?>"><span id="elh_CartTable_Serial"><?php echo $CartTable->Serial->caption() ?></span></td>
		<td data-name="Serial"<?php echo $CartTable->Serial->cellAttributes() ?>>
<span id="el_CartTable_Serial">
<span<?php echo $CartTable->Serial->viewAttributes() ?>>
<?php echo $CartTable->Serial->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
	<tr id="r_SessionID">
		<td class="<?php echo $CartTable_view->TableLeftColumnClass ?>"><span id="elh_CartTable_SessionID"><?php echo $CartTable->SessionID->caption() ?></span></td>
		<td data-name="SessionID"<?php echo $CartTable->SessionID->cellAttributes() ?>>
<span id="el_CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<?php echo $CartTable->SessionID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
	<tr id="r_ProductID">
		<td class="<?php echo $CartTable_view->TableLeftColumnClass ?>"><span id="elh_CartTable_ProductID"><?php echo $CartTable->ProductID->caption() ?></span></td>
		<td data-name="ProductID"<?php echo $CartTable->ProductID->cellAttributes() ?>>
<span id="el_CartTable_ProductID">
<span<?php echo $CartTable->ProductID->viewAttributes() ?>>
<?php echo $CartTable->ProductID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$CartTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$CartTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$CartTable_view->terminate();
?>