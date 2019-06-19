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
$CustomerTable_add = new CustomerTable_add();

// Run the page
$CustomerTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CustomerTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fCustomerTableadd = currentForm = new ew.Form("fCustomerTableadd", "add");

// Validate form
fCustomerTableadd.validate = function() {
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
		<?php if ($CustomerTable_add->CustomerName->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CustomerTable->CustomerName->caption(), $CustomerTable->CustomerName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($CustomerTable_add->CustomerEmail->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerEmail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CustomerTable->CustomerEmail->caption(), $CustomerTable->CustomerEmail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($CustomerTable_add->CustomerPhone->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerPhone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CustomerTable->CustomerPhone->caption(), $CustomerTable->CustomerPhone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($CustomerTable_add->BillingAddress->Required) { ?>
			elm = this.getElements("x" + infix + "_BillingAddress");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CustomerTable->BillingAddress->caption(), $CustomerTable->BillingAddress->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($CustomerTable_add->CustomerTelephone->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerTelephone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CustomerTable->CustomerTelephone->caption(), $CustomerTable->CustomerTelephone->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CustomerTelephone");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($CustomerTable->CustomerTelephone->errorMessage()) ?>");

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
fCustomerTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCustomerTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $CustomerTable_add->showPageHeader(); ?>
<?php
$CustomerTable_add->showMessage();
?>
<form name="fCustomerTableadd" id="fCustomerTableadd" class="<?php echo $CustomerTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CustomerTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CustomerTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CustomerTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$CustomerTable_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
	<div id="r_CustomerName" class="form-group row">
		<label id="elh_CustomerTable_CustomerName" for="x_CustomerName" class="<?php echo $CustomerTable_add->LeftColumnClass ?>"><?php echo $CustomerTable->CustomerName->caption() ?><?php echo ($CustomerTable->CustomerName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CustomerTable_add->RightColumnClass ?>"><div<?php echo $CustomerTable->CustomerName->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerName">
<input type="text" data-table="CustomerTable" data-field="x_CustomerName" name="x_CustomerName" id="x_CustomerName" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($CustomerTable->CustomerName->getPlaceHolder()) ?>" value="<?php echo $CustomerTable->CustomerName->EditValue ?>"<?php echo $CustomerTable->CustomerName->editAttributes() ?>>
</span>
<?php echo $CustomerTable->CustomerName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
	<div id="r_CustomerEmail" class="form-group row">
		<label id="elh_CustomerTable_CustomerEmail" for="x_CustomerEmail" class="<?php echo $CustomerTable_add->LeftColumnClass ?>"><?php echo $CustomerTable->CustomerEmail->caption() ?><?php echo ($CustomerTable->CustomerEmail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CustomerTable_add->RightColumnClass ?>"><div<?php echo $CustomerTable->CustomerEmail->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerEmail">
<input type="text" data-table="CustomerTable" data-field="x_CustomerEmail" name="x_CustomerEmail" id="x_CustomerEmail" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($CustomerTable->CustomerEmail->getPlaceHolder()) ?>" value="<?php echo $CustomerTable->CustomerEmail->EditValue ?>"<?php echo $CustomerTable->CustomerEmail->editAttributes() ?>>
</span>
<?php echo $CustomerTable->CustomerEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CustomerTable->CustomerPhone->Visible) { // CustomerPhone ?>
	<div id="r_CustomerPhone" class="form-group row">
		<label id="elh_CustomerTable_CustomerPhone" for="x_CustomerPhone" class="<?php echo $CustomerTable_add->LeftColumnClass ?>"><?php echo $CustomerTable->CustomerPhone->caption() ?><?php echo ($CustomerTable->CustomerPhone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CustomerTable_add->RightColumnClass ?>"><div<?php echo $CustomerTable->CustomerPhone->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerPhone">
<textarea data-table="CustomerTable" data-field="x_CustomerPhone" name="x_CustomerPhone" id="x_CustomerPhone" cols="35" rows="4" placeholder="<?php echo HtmlEncode($CustomerTable->CustomerPhone->getPlaceHolder()) ?>"<?php echo $CustomerTable->CustomerPhone->editAttributes() ?>><?php echo $CustomerTable->CustomerPhone->EditValue ?></textarea>
</span>
<?php echo $CustomerTable->CustomerPhone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
	<div id="r_BillingAddress" class="form-group row">
		<label id="elh_CustomerTable_BillingAddress" for="x_BillingAddress" class="<?php echo $CustomerTable_add->LeftColumnClass ?>"><?php echo $CustomerTable->BillingAddress->caption() ?><?php echo ($CustomerTable->BillingAddress->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CustomerTable_add->RightColumnClass ?>"><div<?php echo $CustomerTable->BillingAddress->cellAttributes() ?>>
<span id="el_CustomerTable_BillingAddress">
<input type="text" data-table="CustomerTable" data-field="x_BillingAddress" name="x_BillingAddress" id="x_BillingAddress" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($CustomerTable->BillingAddress->getPlaceHolder()) ?>" value="<?php echo $CustomerTable->BillingAddress->EditValue ?>"<?php echo $CustomerTable->BillingAddress->editAttributes() ?>>
</span>
<?php echo $CustomerTable->BillingAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
	<div id="r_CustomerTelephone" class="form-group row">
		<label id="elh_CustomerTable_CustomerTelephone" for="x_CustomerTelephone" class="<?php echo $CustomerTable_add->LeftColumnClass ?>"><?php echo $CustomerTable->CustomerTelephone->caption() ?><?php echo ($CustomerTable->CustomerTelephone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CustomerTable_add->RightColumnClass ?>"><div<?php echo $CustomerTable->CustomerTelephone->cellAttributes() ?>>
<span id="el_CustomerTable_CustomerTelephone">
<input type="text" data-table="CustomerTable" data-field="x_CustomerTelephone" name="x_CustomerTelephone" id="x_CustomerTelephone" size="30" placeholder="<?php echo HtmlEncode($CustomerTable->CustomerTelephone->getPlaceHolder()) ?>" value="<?php echo $CustomerTable->CustomerTelephone->EditValue ?>"<?php echo $CustomerTable->CustomerTelephone->editAttributes() ?>>
</span>
<?php echo $CustomerTable->CustomerTelephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("LeadTable", explode(",", $CustomerTable->getCurrentDetailTable())) && $LeadTable->DetailAdd) {
?>
<?php if ($CustomerTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("LeadTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LeadTablegrid.php" ?>
<?php } ?>
<?php if (!$CustomerTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $CustomerTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CustomerTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$CustomerTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$CustomerTable_add->terminate();
?>