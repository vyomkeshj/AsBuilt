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
$CartTable_delete = new CartTable_delete();

// Run the page
$CartTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fCartTabledelete = currentForm = new ew.Form("fCartTabledelete", "delete");

// Form_CustomValidate event
fCartTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCartTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $CartTable_delete->showPageHeader(); ?>
<?php
$CartTable_delete->showMessage();
?>
<form name="fCartTabledelete" id="fCartTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CartTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CartTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($CartTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($CartTable->Serial->Visible) { // Serial ?>
		<th class="<?php echo $CartTable->Serial->headerCellClass() ?>"><span id="elh_CartTable_Serial" class="CartTable_Serial"><?php echo $CartTable->Serial->caption() ?></span></th>
<?php } ?>
<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
		<th class="<?php echo $CartTable->SessionID->headerCellClass() ?>"><span id="elh_CartTable_SessionID" class="CartTable_SessionID"><?php echo $CartTable->SessionID->caption() ?></span></th>
<?php } ?>
<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
		<th class="<?php echo $CartTable->ProductID->headerCellClass() ?>"><span id="elh_CartTable_ProductID" class="CartTable_ProductID"><?php echo $CartTable->ProductID->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$CartTable_delete->RecCnt = 0;
$i = 0;
while (!$CartTable_delete->Recordset->EOF) {
	$CartTable_delete->RecCnt++;
	$CartTable_delete->RowCnt++;

	// Set row properties
	$CartTable->resetAttributes();
	$CartTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$CartTable_delete->loadRowValues($CartTable_delete->Recordset);

	// Render row
	$CartTable_delete->renderRow();
?>
	<tr<?php echo $CartTable->rowAttributes() ?>>
<?php if ($CartTable->Serial->Visible) { // Serial ?>
		<td<?php echo $CartTable->Serial->cellAttributes() ?>>
<span id="el<?php echo $CartTable_delete->RowCnt ?>_CartTable_Serial" class="CartTable_Serial">
<span<?php echo $CartTable->Serial->viewAttributes() ?>>
<?php echo $CartTable->Serial->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
		<td<?php echo $CartTable->SessionID->cellAttributes() ?>>
<span id="el<?php echo $CartTable_delete->RowCnt ?>_CartTable_SessionID" class="CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<?php echo $CartTable->SessionID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
		<td<?php echo $CartTable->ProductID->cellAttributes() ?>>
<span id="el<?php echo $CartTable_delete->RowCnt ?>_CartTable_ProductID" class="CartTable_ProductID">
<span<?php echo $CartTable->ProductID->viewAttributes() ?>>
<?php echo $CartTable->ProductID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$CartTable_delete->Recordset->moveNext();
}
$CartTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CartTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$CartTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$CartTable_delete->terminate();
?>