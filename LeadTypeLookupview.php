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
$LeadTypeLookup_view = new LeadTypeLookup_view();

// Run the page
$LeadTypeLookup_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTypeLookup_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fLeadTypeLookupview = currentForm = new ew.Form("fLeadTypeLookupview", "view");

// Form_CustomValidate event
fLeadTypeLookupview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTypeLookupview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $LeadTypeLookup_view->ExportOptions->render("body") ?>
<?php $LeadTypeLookup_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $LeadTypeLookup_view->showPageHeader(); ?>
<?php
$LeadTypeLookup_view->showMessage();
?>
<form name="fLeadTypeLookupview" id="fLeadTypeLookupview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTypeLookup_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTypeLookup_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTypeLookup">
<input type="hidden" name="modal" value="<?php echo (int)$LeadTypeLookup_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($LeadTypeLookup->TypeID->Visible) { // TypeID ?>
	<tr id="r_TypeID">
		<td class="<?php echo $LeadTypeLookup_view->TableLeftColumnClass ?>"><span id="elh_LeadTypeLookup_TypeID"><?php echo $LeadTypeLookup->TypeID->caption() ?></span></td>
		<td data-name="TypeID"<?php echo $LeadTypeLookup->TypeID->cellAttributes() ?>>
<span id="el_LeadTypeLookup_TypeID">
<span<?php echo $LeadTypeLookup->TypeID->viewAttributes() ?>>
<?php echo $LeadTypeLookup->TypeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($LeadTypeLookup->TypeName->Visible) { // TypeName ?>
	<tr id="r_TypeName">
		<td class="<?php echo $LeadTypeLookup_view->TableLeftColumnClass ?>"><span id="elh_LeadTypeLookup_TypeName"><?php echo $LeadTypeLookup->TypeName->caption() ?></span></td>
		<td data-name="TypeName"<?php echo $LeadTypeLookup->TypeName->cellAttributes() ?>>
<span id="el_LeadTypeLookup_TypeName">
<span<?php echo $LeadTypeLookup->TypeName->viewAttributes() ?>>
<?php echo $LeadTypeLookup->TypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$LeadTypeLookup_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$LeadTypeLookup_view->terminate();
?>