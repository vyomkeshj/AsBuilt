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
$LeadFileAssociation_view = new LeadFileAssociation_view();

// Run the page
$LeadFileAssociation_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadFileAssociation_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fLeadFileAssociationview = currentForm = new ew.Form("fLeadFileAssociationview", "view");

// Form_CustomValidate event
fLeadFileAssociationview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadFileAssociationview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $LeadFileAssociation_view->ExportOptions->render("body") ?>
<?php $LeadFileAssociation_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $LeadFileAssociation_view->showPageHeader(); ?>
<?php
$LeadFileAssociation_view->showMessage();
?>
<form name="fLeadFileAssociationview" id="fLeadFileAssociationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadFileAssociation_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadFileAssociation_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadFileAssociation">
<input type="hidden" name="modal" value="<?php echo (int)$LeadFileAssociation_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
	<tr id="r_MappingID">
		<td class="<?php echo $LeadFileAssociation_view->TableLeftColumnClass ?>"><span id="elh_LeadFileAssociation_MappingID"><?php echo $LeadFileAssociation->MappingID->caption() ?></span></td>
		<td data-name="MappingID"<?php echo $LeadFileAssociation->MappingID->cellAttributes() ?>>
<span id="el_LeadFileAssociation_MappingID">
<span<?php echo $LeadFileAssociation->MappingID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->MappingID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
	<tr id="r_LeadID">
		<td class="<?php echo $LeadFileAssociation_view->TableLeftColumnClass ?>"><span id="elh_LeadFileAssociation_LeadID"><?php echo $LeadFileAssociation->LeadID->caption() ?></span></td>
		<td data-name="LeadID"<?php echo $LeadFileAssociation->LeadID->cellAttributes() ?>>
<span id="el_LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->LeadID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
	<tr id="r_FileName">
		<td class="<?php echo $LeadFileAssociation_view->TableLeftColumnClass ?>"><span id="elh_LeadFileAssociation_FileName"><?php echo $LeadFileAssociation->FileName->caption() ?></span></td>
		<td data-name="FileName"<?php echo $LeadFileAssociation->FileName->cellAttributes() ?>>
<span id="el_LeadFileAssociation_FileName">
<span<?php echo $LeadFileAssociation->FileName->viewAttributes() ?>>
<?php echo $LeadFileAssociation->FileName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$LeadFileAssociation_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$LeadFileAssociation_view->terminate();
?>