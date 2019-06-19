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
$LeadTypeLookup_edit = new LeadTypeLookup_edit();

// Run the page
$LeadTypeLookup_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTypeLookup_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fLeadTypeLookupedit = currentForm = new ew.Form("fLeadTypeLookupedit", "edit");

// Validate form
fLeadTypeLookupedit.validate = function() {
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
		<?php if ($LeadTypeLookup_edit->TypeID->Required) { ?>
			elm = this.getElements("x" + infix + "_TypeID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTypeLookup->TypeID->caption(), $LeadTypeLookup->TypeID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTypeLookup_edit->TypeName->Required) { ?>
			elm = this.getElements("x" + infix + "_TypeName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTypeLookup->TypeName->caption(), $LeadTypeLookup->TypeName->RequiredErrorMessage)) ?>");
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
fLeadTypeLookupedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTypeLookupedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $LeadTypeLookup_edit->showPageHeader(); ?>
<?php
$LeadTypeLookup_edit->showMessage();
?>
<form name="fLeadTypeLookupedit" id="fLeadTypeLookupedit" class="<?php echo $LeadTypeLookup_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTypeLookup_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTypeLookup_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTypeLookup">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$LeadTypeLookup_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($LeadTypeLookup->TypeID->Visible) { // TypeID ?>
	<div id="r_TypeID" class="form-group row">
		<label id="elh_LeadTypeLookup_TypeID" class="<?php echo $LeadTypeLookup_edit->LeftColumnClass ?>"><?php echo $LeadTypeLookup->TypeID->caption() ?><?php echo ($LeadTypeLookup->TypeID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTypeLookup_edit->RightColumnClass ?>"><div<?php echo $LeadTypeLookup->TypeID->cellAttributes() ?>>
<span id="el_LeadTypeLookup_TypeID">
<span<?php echo $LeadTypeLookup->TypeID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTypeLookup->TypeID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTypeLookup" data-field="x_TypeID" name="x_TypeID" id="x_TypeID" value="<?php echo HtmlEncode($LeadTypeLookup->TypeID->CurrentValue) ?>">
<?php echo $LeadTypeLookup->TypeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTypeLookup->TypeName->Visible) { // TypeName ?>
	<div id="r_TypeName" class="form-group row">
		<label id="elh_LeadTypeLookup_TypeName" for="x_TypeName" class="<?php echo $LeadTypeLookup_edit->LeftColumnClass ?>"><?php echo $LeadTypeLookup->TypeName->caption() ?><?php echo ($LeadTypeLookup->TypeName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTypeLookup_edit->RightColumnClass ?>"><div<?php echo $LeadTypeLookup->TypeName->cellAttributes() ?>>
<span id="el_LeadTypeLookup_TypeName">
<input type="text" data-table="LeadTypeLookup" data-field="x_TypeName" name="x_TypeName" id="x_TypeName" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($LeadTypeLookup->TypeName->getPlaceHolder()) ?>" value="<?php echo $LeadTypeLookup->TypeName->EditValue ?>"<?php echo $LeadTypeLookup->TypeName->editAttributes() ?>>
</span>
<?php echo $LeadTypeLookup->TypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$LeadTypeLookup_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $LeadTypeLookup_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LeadTypeLookup_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$LeadTypeLookup_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$LeadTypeLookup_edit->terminate();
?>