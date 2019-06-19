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
$LeadTypeLookup_delete = new LeadTypeLookup_delete();

// Run the page
$LeadTypeLookup_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTypeLookup_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fLeadTypeLookupdelete = currentForm = new ew.Form("fLeadTypeLookupdelete", "delete");

// Form_CustomValidate event
fLeadTypeLookupdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTypeLookupdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $LeadTypeLookup_delete->showPageHeader(); ?>
<?php
$LeadTypeLookup_delete->showMessage();
?>
<form name="fLeadTypeLookupdelete" id="fLeadTypeLookupdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTypeLookup_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTypeLookup_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTypeLookup">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($LeadTypeLookup_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($LeadTypeLookup->TypeID->Visible) { // TypeID ?>
		<th class="<?php echo $LeadTypeLookup->TypeID->headerCellClass() ?>"><span id="elh_LeadTypeLookup_TypeID" class="LeadTypeLookup_TypeID"><?php echo $LeadTypeLookup->TypeID->caption() ?></span></th>
<?php } ?>
<?php if ($LeadTypeLookup->TypeName->Visible) { // TypeName ?>
		<th class="<?php echo $LeadTypeLookup->TypeName->headerCellClass() ?>"><span id="elh_LeadTypeLookup_TypeName" class="LeadTypeLookup_TypeName"><?php echo $LeadTypeLookup->TypeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$LeadTypeLookup_delete->RecCnt = 0;
$i = 0;
while (!$LeadTypeLookup_delete->Recordset->EOF) {
	$LeadTypeLookup_delete->RecCnt++;
	$LeadTypeLookup_delete->RowCnt++;

	// Set row properties
	$LeadTypeLookup->resetAttributes();
	$LeadTypeLookup->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$LeadTypeLookup_delete->loadRowValues($LeadTypeLookup_delete->Recordset);

	// Render row
	$LeadTypeLookup_delete->renderRow();
?>
	<tr<?php echo $LeadTypeLookup->rowAttributes() ?>>
<?php if ($LeadTypeLookup->TypeID->Visible) { // TypeID ?>
		<td<?php echo $LeadTypeLookup->TypeID->cellAttributes() ?>>
<span id="el<?php echo $LeadTypeLookup_delete->RowCnt ?>_LeadTypeLookup_TypeID" class="LeadTypeLookup_TypeID">
<span<?php echo $LeadTypeLookup->TypeID->viewAttributes() ?>>
<?php echo $LeadTypeLookup->TypeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadTypeLookup->TypeName->Visible) { // TypeName ?>
		<td<?php echo $LeadTypeLookup->TypeName->cellAttributes() ?>>
<span id="el<?php echo $LeadTypeLookup_delete->RowCnt ?>_LeadTypeLookup_TypeName" class="LeadTypeLookup_TypeName">
<span<?php echo $LeadTypeLookup->TypeName->viewAttributes() ?>>
<?php echo $LeadTypeLookup->TypeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$LeadTypeLookup_delete->Recordset->moveNext();
}
$LeadTypeLookup_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LeadTypeLookup_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$LeadTypeLookup_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$LeadTypeLookup_delete->terminate();
?>