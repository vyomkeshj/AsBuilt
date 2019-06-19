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
$CustomerTable_view = new CustomerTable_view();

// Run the page
$CustomerTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CustomerTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$CustomerTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fCustomerTableview = currentForm = new ew.Form("fCustomerTableview", "view");

// Form_CustomValidate event
fCustomerTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCustomerTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$CustomerTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $CustomerTable_view->ExportOptions->render("body") ?>
<?php $CustomerTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $CustomerTable_view->showPageHeader(); ?>
<?php
$CustomerTable_view->showMessage();
?>
<form name="fCustomerTableview" id="fCustomerTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CustomerTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CustomerTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CustomerTable">
<input type="hidden" name="modal" value="<?php echo (int)$CustomerTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($CustomerTable->CustomerID->Visible) { // CustomerID ?>
	<tr id="r_CustomerID">
		<td class="<?php echo $CustomerTable_view->TableLeftColumnClass ?>"><span id="elh_CustomerTable_CustomerID"><?php echo $CustomerTable->CustomerID->caption() ?></span></td>
		<td data-name="CustomerID"<?php echo $CustomerTable->CustomerID->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerID">
<span<?php echo $CustomerTable->CustomerID->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
	<tr id="r_CustomerName">
		<td class="<?php echo $CustomerTable_view->TableLeftColumnClass ?>"><span id="elh_CustomerTable_CustomerName"><?php echo $CustomerTable->CustomerName->caption() ?></span></td>
		<td data-name="CustomerName"<?php echo $CustomerTable->CustomerName->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerName">
<span<?php echo $CustomerTable->CustomerName->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
	<tr id="r_CustomerEmail">
		<td class="<?php echo $CustomerTable_view->TableLeftColumnClass ?>"><span id="elh_CustomerTable_CustomerEmail"><?php echo $CustomerTable->CustomerEmail->caption() ?></span></td>
		<td data-name="CustomerEmail"<?php echo $CustomerTable->CustomerEmail->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerEmail">
<span<?php echo $CustomerTable->CustomerEmail->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerPhone->Visible) { // CustomerPhone ?>
	<tr id="r_CustomerPhone">
		<td class="<?php echo $CustomerTable_view->TableLeftColumnClass ?>"><span id="elh_CustomerTable_CustomerPhone"><?php echo $CustomerTable->CustomerPhone->caption() ?></span></td>
		<td data-name="CustomerPhone"<?php echo $CustomerTable->CustomerPhone->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerPhone">
<span<?php echo $CustomerTable->CustomerPhone->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerPhone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
	<tr id="r_BillingAddress">
		<td class="<?php echo $CustomerTable_view->TableLeftColumnClass ?>"><span id="elh_CustomerTable_BillingAddress"><?php echo $CustomerTable->BillingAddress->caption() ?></span></td>
		<td data-name="BillingAddress"<?php echo $CustomerTable->BillingAddress->cellAttributes() ?>>
<span id="el_CustomerTable_BillingAddress">
<span<?php echo $CustomerTable->BillingAddress->viewAttributes() ?>>
<?php echo $CustomerTable->BillingAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
	<tr id="r_CustomerTelephone">
		<td class="<?php echo $CustomerTable_view->TableLeftColumnClass ?>"><span id="elh_CustomerTable_CustomerTelephone"><?php echo $CustomerTable->CustomerTelephone->caption() ?></span></td>
		<td data-name="CustomerTelephone"<?php echo $CustomerTable->CustomerTelephone->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerTelephone">
<span<?php echo $CustomerTable->CustomerTelephone->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerTelephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("LeadTable", explode(",", $CustomerTable->getCurrentDetailTable())) && $LeadTable->DetailView) {
?>
<?php if ($CustomerTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("LeadTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LeadTablegrid.php" ?>
<?php } ?>
</form>
<?php
$CustomerTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$CustomerTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$CustomerTable_view->terminate();
?>