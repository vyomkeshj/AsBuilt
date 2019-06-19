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
$ProductTable_delete = new ProductTable_delete();

// Run the page
$ProductTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fProductTabledelete = currentForm = new ew.Form("fProductTabledelete", "delete");

// Form_CustomValidate event
fProductTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fProductTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ProductTable_delete->showPageHeader(); ?>
<?php
$ProductTable_delete->showMessage();
?>
<form name="fProductTabledelete" id="fProductTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ProductTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ProductTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ProductTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ProductTable->ProductID->Visible) { // ProductID ?>
		<th class="<?php echo $ProductTable->ProductID->headerCellClass() ?>"><span id="elh_ProductTable_ProductID" class="ProductTable_ProductID"><?php echo $ProductTable->ProductID->caption() ?></span></th>
<?php } ?>
<?php if ($ProductTable->ProductPrice->Visible) { // ProductPrice ?>
		<th class="<?php echo $ProductTable->ProductPrice->headerCellClass() ?>"><span id="elh_ProductTable_ProductPrice" class="ProductTable_ProductPrice"><?php echo $ProductTable->ProductPrice->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ProductTable_delete->RecCnt = 0;
$i = 0;
while (!$ProductTable_delete->Recordset->EOF) {
	$ProductTable_delete->RecCnt++;
	$ProductTable_delete->RowCnt++;

	// Set row properties
	$ProductTable->resetAttributes();
	$ProductTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ProductTable_delete->loadRowValues($ProductTable_delete->Recordset);

	// Render row
	$ProductTable_delete->renderRow();
?>
	<tr<?php echo $ProductTable->rowAttributes() ?>>
<?php if ($ProductTable->ProductID->Visible) { // ProductID ?>
		<td<?php echo $ProductTable->ProductID->cellAttributes() ?>>
<span id="el<?php echo $ProductTable_delete->RowCnt ?>_ProductTable_ProductID" class="ProductTable_ProductID">
<span<?php echo $ProductTable->ProductID->viewAttributes() ?>>
<?php echo $ProductTable->ProductID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ProductTable->ProductPrice->Visible) { // ProductPrice ?>
		<td<?php echo $ProductTable->ProductPrice->cellAttributes() ?>>
<span id="el<?php echo $ProductTable_delete->RowCnt ?>_ProductTable_ProductPrice" class="ProductTable_ProductPrice">
<span<?php echo $ProductTable->ProductPrice->viewAttributes() ?>>
<?php echo $ProductTable->ProductPrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ProductTable_delete->Recordset->moveNext();
}
$ProductTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ProductTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ProductTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ProductTable_delete->terminate();
?>