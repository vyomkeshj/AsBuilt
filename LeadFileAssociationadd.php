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
$LeadFileAssociation_add = new LeadFileAssociation_add();

// Run the page
$LeadFileAssociation_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadFileAssociation_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fLeadFileAssociationadd = currentForm = new ew.Form("fLeadFileAssociationadd", "add");

// Validate form
fLeadFileAssociationadd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($LeadFileAssociation_add->LeadID->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadFileAssociation->LeadID->caption(), $LeadFileAssociation->LeadID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadFileAssociation->LeadID->errorMessage()) ?>");
		<?php if ($LeadFileAssociation_add->FileName->Required) { ?>
			elm = this.getElements("x" + infix + "_FileName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadFileAssociation->FileName->caption(), $LeadFileAssociation->FileName->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fLeadFileAssociationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadFileAssociationadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $LeadFileAssociation_add->showPageHeader(); ?>
<?php
$LeadFileAssociation_add->showMessage();
?>
<form name="fLeadFileAssociationadd" id="fLeadFileAssociationadd" class="<?php echo $LeadFileAssociation_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadFileAssociation_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadFileAssociation_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadFileAssociation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$LeadFileAssociation_add->IsModal ?>">
<?php if ($LeadFileAssociation->getCurrentMasterTable() == "LeadTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="LeadTable">
<input type="hidden" name="fk_LeadID" value="<?php echo $LeadFileAssociation->LeadID->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
	<div id="r_LeadID" class="form-group row">
		<label id="elh_LeadFileAssociation_LeadID" for="x_LeadID" class="<?php echo $LeadFileAssociation_add->LeftColumnClass ?>"><?php echo $LeadFileAssociation->LeadID->caption() ?><?php echo ($LeadFileAssociation->LeadID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadFileAssociation_add->RightColumnClass ?>"><div<?php echo $LeadFileAssociation->LeadID->cellAttributes() ?>>
<?php if ($LeadFileAssociation->LeadID->getSessionValue() <> "") { ?>
<span id="el_LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadFileAssociation->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_LeadID" name="x_LeadID" value="<?php echo HtmlEncode($LeadFileAssociation->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_LeadFileAssociation_LeadID">
<input type="text" data-table="LeadFileAssociation" data-field="x_LeadID" name="x_LeadID" id="x_LeadID" size="30" placeholder="<?php echo HtmlEncode($LeadFileAssociation->LeadID->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->LeadID->EditValue ?>"<?php echo $LeadFileAssociation->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $LeadFileAssociation->LeadID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
	<div id="r_FileName" class="form-group row">
		<label id="elh_LeadFileAssociation_FileName" for="x_FileName" class="<?php echo $LeadFileAssociation_add->LeftColumnClass ?>"><?php echo $LeadFileAssociation->FileName->caption() ?><?php echo ($LeadFileAssociation->FileName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadFileAssociation_add->RightColumnClass ?>"><div<?php echo $LeadFileAssociation->FileName->cellAttributes() ?>>
<span id="el_LeadFileAssociation_FileName">
<input type="text" data-table="LeadFileAssociation" data-field="x_FileName" name="x_FileName" id="x_FileName" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($LeadFileAssociation->FileName->getPlaceHolder()) ?>" value="<?php echo $LeadFileAssociation->FileName->EditValue ?>"<?php echo $LeadFileAssociation->FileName->editAttributes() ?>>
</span>
<?php echo $LeadFileAssociation->FileName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$LeadFileAssociation_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $LeadFileAssociation_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LeadFileAssociation_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$LeadFileAssociation_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$LeadFileAssociation_add->terminate();
?>