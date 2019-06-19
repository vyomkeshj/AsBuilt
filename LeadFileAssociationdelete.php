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
$LeadFileAssociation_delete = new LeadFileAssociation_delete();

// Run the page
$LeadFileAssociation_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadFileAssociation_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fLeadFileAssociationdelete = currentForm = new ew.Form("fLeadFileAssociationdelete", "delete");

// Form_CustomValidate event
fLeadFileAssociationdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadFileAssociationdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $LeadFileAssociation_delete->showPageHeader(); ?>
<?php
$LeadFileAssociation_delete->showMessage();
?>
<form name="fLeadFileAssociationdelete" id="fLeadFileAssociationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadFileAssociation_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadFileAssociation_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadFileAssociation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($LeadFileAssociation_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
		<th class="<?php echo $LeadFileAssociation->MappingID->headerCellClass() ?>"><span id="elh_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID"><?php echo $LeadFileAssociation->MappingID->caption() ?></span></th>
<?php } ?>
<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
		<th class="<?php echo $LeadFileAssociation->LeadID->headerCellClass() ?>"><span id="elh_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID"><?php echo $LeadFileAssociation->LeadID->caption() ?></span></th>
<?php } ?>
<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
		<th class="<?php echo $LeadFileAssociation->FileName->headerCellClass() ?>"><span id="elh_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName"><?php echo $LeadFileAssociation->FileName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$LeadFileAssociation_delete->RecCnt = 0;
$i = 0;
while (!$LeadFileAssociation_delete->Recordset->EOF) {
	$LeadFileAssociation_delete->RecCnt++;
	$LeadFileAssociation_delete->RowCnt++;

	// Set row properties
	$LeadFileAssociation->resetAttributes();
	$LeadFileAssociation->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$LeadFileAssociation_delete->loadRowValues($LeadFileAssociation_delete->Recordset);

	// Render row
	$LeadFileAssociation_delete->renderRow();
?>
	<tr<?php echo $LeadFileAssociation->rowAttributes() ?>>
<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
		<td<?php echo $LeadFileAssociation->MappingID->cellAttributes() ?>>
<span id="el<?php echo $LeadFileAssociation_delete->RowCnt ?>_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID">
<span<?php echo $LeadFileAssociation->MappingID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->MappingID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
		<td<?php echo $LeadFileAssociation->LeadID->cellAttributes() ?>>
<span id="el<?php echo $LeadFileAssociation_delete->RowCnt ?>_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->LeadID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
		<td<?php echo $LeadFileAssociation->FileName->cellAttributes() ?>>
<span id="el<?php echo $LeadFileAssociation_delete->RowCnt ?>_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName">
<span<?php echo $LeadFileAssociation->FileName->viewAttributes() ?>>
<?php echo $LeadFileAssociation->FileName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$LeadFileAssociation_delete->Recordset->moveNext();
}
$LeadFileAssociation_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LeadFileAssociation_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$LeadFileAssociation_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$LeadFileAssociation_delete->terminate();
?>