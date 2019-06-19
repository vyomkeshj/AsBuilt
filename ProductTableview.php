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
$ProductTable_view = new ProductTable_view();

// Run the page
$ProductTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ProductTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fProductTableview = currentForm = new ew.Form("fProductTableview", "view");

// Form_CustomValidate event
fProductTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fProductTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ProductTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ProductTable_view->ExportOptions->render("body") ?>
<?php $ProductTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ProductTable_view->showPageHeader(); ?>
<?php
$ProductTable_view->showMessage();
?>
<form name="fProductTableview" id="fProductTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ProductTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ProductTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductTable">
<input type="hidden" name="modal" value="<?php echo (int)$ProductTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ProductTable->ProductID->Visible) { // ProductID ?>
	<tr id="r_ProductID">
		<td class="<?php echo $ProductTable_view->TableLeftColumnClass ?>"><span id="elh_ProductTable_ProductID"><?php echo $ProductTable->ProductID->caption() ?></span></td>
		<td data-name="ProductID"<?php echo $ProductTable->ProductID->cellAttributes() ?>>
<span id="el_ProductTable_ProductID">
<span<?php echo $ProductTable->ProductID->viewAttributes() ?>>
<?php echo $ProductTable->ProductID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ProductTable->ProductName->Visible) { // ProductName ?>
	<tr id="r_ProductName">
		<td class="<?php echo $ProductTable_view->TableLeftColumnClass ?>"><span id="elh_ProductTable_ProductName"><?php echo $ProductTable->ProductName->caption() ?></span></td>
		<td data-name="ProductName"<?php echo $ProductTable->ProductName->cellAttributes() ?>>
<span id="el_ProductTable_ProductName">
<span<?php echo $ProductTable->ProductName->viewAttributes() ?>>
<?php echo $ProductTable->ProductName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ProductTable->ProductPrice->Visible) { // ProductPrice ?>
	<tr id="r_ProductPrice">
		<td class="<?php echo $ProductTable_view->TableLeftColumnClass ?>"><span id="elh_ProductTable_ProductPrice"><?php echo $ProductTable->ProductPrice->caption() ?></span></td>
		<td data-name="ProductPrice"<?php echo $ProductTable->ProductPrice->cellAttributes() ?>>
<span id="el_ProductTable_ProductPrice">
<span<?php echo $ProductTable->ProductPrice->viewAttributes() ?>>
<?php echo $ProductTable->ProductPrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ProductTable->ProductDescription->Visible) { // ProductDescription ?>
	<tr id="r_ProductDescription">
		<td class="<?php echo $ProductTable_view->TableLeftColumnClass ?>"><span id="elh_ProductTable_ProductDescription"><?php echo $ProductTable->ProductDescription->caption() ?></span></td>
		<td data-name="ProductDescription"<?php echo $ProductTable->ProductDescription->cellAttributes() ?>>
<span id="el_ProductTable_ProductDescription">
<span<?php echo $ProductTable->ProductDescription->viewAttributes() ?>>
<?php echo $ProductTable->ProductDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ProductTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ProductTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ProductTable_view->terminate();
?>