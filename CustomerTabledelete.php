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
$CustomerTable_delete = new CustomerTable_delete();

// Run the page
$CustomerTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CustomerTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fCustomerTabledelete = currentForm = new ew.Form("fCustomerTabledelete", "delete");

// Form_CustomValidate event
fCustomerTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCustomerTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $CustomerTable_delete->showPageHeader(); ?>
<?php
$CustomerTable_delete->showMessage();
?>
<form name="fCustomerTabledelete" id="fCustomerTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CustomerTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CustomerTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CustomerTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($CustomerTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($CustomerTable->CustomerID->Visible) { // CustomerID ?>
		<th class="<?php echo $CustomerTable->CustomerID->headerCellClass() ?>"><span id="elh_CustomerTable_CustomerID" class="CustomerTable_CustomerID"><?php echo $CustomerTable->CustomerID->caption() ?></span></th>
<?php } ?>
<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
		<th class="<?php echo $CustomerTable->CustomerName->headerCellClass() ?>"><span id="elh_CustomerTable_CustomerName" class="CustomerTable_CustomerName"><?php echo $CustomerTable->CustomerName->caption() ?></span></th>
<?php } ?>
<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
		<th class="<?php echo $CustomerTable->CustomerEmail->headerCellClass() ?>"><span id="elh_CustomerTable_CustomerEmail" class="CustomerTable_CustomerEmail"><?php echo $CustomerTable->CustomerEmail->caption() ?></span></th>
<?php } ?>
<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
		<th class="<?php echo $CustomerTable->BillingAddress->headerCellClass() ?>"><span id="elh_CustomerTable_BillingAddress" class="CustomerTable_BillingAddress"><?php echo $CustomerTable->BillingAddress->caption() ?></span></th>
<?php } ?>
<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
		<th class="<?php echo $CustomerTable->CustomerTelephone->headerCellClass() ?>"><span id="elh_CustomerTable_CustomerTelephone" class="CustomerTable_CustomerTelephone"><?php echo $CustomerTable->CustomerTelephone->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$CustomerTable_delete->RecCnt = 0;
$i = 0;
while (!$CustomerTable_delete->Recordset->EOF) {
	$CustomerTable_delete->RecCnt++;
	$CustomerTable_delete->RowCnt++;

	// Set row properties
	$CustomerTable->resetAttributes();
	$CustomerTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$CustomerTable_delete->loadRowValues($CustomerTable_delete->Recordset);

	// Render row
	$CustomerTable_delete->renderRow();
?>
	<tr<?php echo $CustomerTable->rowAttributes() ?>>
<?php if ($CustomerTable->CustomerID->Visible) { // CustomerID ?>
		<td<?php echo $CustomerTable->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_delete->RowCnt ?>_CustomerTable_CustomerID" class="CustomerTable_CustomerID">
<span<?php echo $CustomerTable->CustomerID->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
		<td<?php echo $CustomerTable->CustomerName->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_delete->RowCnt ?>_CustomerTable_CustomerName" class="CustomerTable_CustomerName">
<span<?php echo $CustomerTable->CustomerName->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
		<td<?php echo $CustomerTable->CustomerEmail->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_delete->RowCnt ?>_CustomerTable_CustomerEmail" class="CustomerTable_CustomerEmail">
<span<?php echo $CustomerTable->CustomerEmail->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
		<td<?php echo $CustomerTable->BillingAddress->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_delete->RowCnt ?>_CustomerTable_BillingAddress" class="CustomerTable_BillingAddress">
<span<?php echo $CustomerTable->BillingAddress->viewAttributes() ?>>
<?php echo $CustomerTable->BillingAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
		<td<?php echo $CustomerTable->CustomerTelephone->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_delete->RowCnt ?>_CustomerTable_CustomerTelephone" class="CustomerTable_CustomerTelephone">
<span<?php echo $CustomerTable->CustomerTelephone->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerTelephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$CustomerTable_delete->Recordset->moveNext();
}
$CustomerTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CustomerTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$CustomerTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$CustomerTable_delete->terminate();
?>