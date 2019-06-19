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
$ProductTable_add = new ProductTable_add();

// Run the page
$ProductTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fProductTableadd = currentForm = new ew.Form("fProductTableadd", "add");

// Validate form
fProductTableadd.validate = function() {
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
		<?php if ($ProductTable_add->ProductName->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductTable->ProductName->caption(), $ProductTable->ProductName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($ProductTable_add->ProductPrice->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductPrice");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductTable->ProductPrice->caption(), $ProductTable->ProductPrice->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ProductPrice");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($ProductTable->ProductPrice->errorMessage()) ?>");
		<?php if ($ProductTable_add->ProductDescription->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductDescription");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ProductTable->ProductDescription->caption(), $ProductTable->ProductDescription->RequiredErrorMessage)) ?>");
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
fProductTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fProductTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ProductTable_add->showPageHeader(); ?>
<?php
$ProductTable_add->showMessage();
?>
<form name="fProductTableadd" id="fProductTableadd" class="<?php echo $ProductTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ProductTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ProductTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ProductTable_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ProductTable->ProductName->Visible) { // ProductName ?>
	<div id="r_ProductName" class="form-group row">
		<label id="elh_ProductTable_ProductName" for="x_ProductName" class="<?php echo $ProductTable_add->LeftColumnClass ?>"><?php echo $ProductTable->ProductName->caption() ?><?php echo ($ProductTable->ProductName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductTable_add->RightColumnClass ?>"><div<?php echo $ProductTable->ProductName->cellAttributes() ?>>
<span id="el_ProductTable_ProductName">
<textarea data-table="ProductTable" data-field="x_ProductName" name="x_ProductName" id="x_ProductName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ProductTable->ProductName->getPlaceHolder()) ?>"<?php echo $ProductTable->ProductName->editAttributes() ?>><?php echo $ProductTable->ProductName->EditValue ?></textarea>
</span>
<?php echo $ProductTable->ProductName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductTable->ProductPrice->Visible) { // ProductPrice ?>
	<div id="r_ProductPrice" class="form-group row">
		<label id="elh_ProductTable_ProductPrice" for="x_ProductPrice" class="<?php echo $ProductTable_add->LeftColumnClass ?>"><?php echo $ProductTable->ProductPrice->caption() ?><?php echo ($ProductTable->ProductPrice->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductTable_add->RightColumnClass ?>"><div<?php echo $ProductTable->ProductPrice->cellAttributes() ?>>
<span id="el_ProductTable_ProductPrice">
<input type="text" data-table="ProductTable" data-field="x_ProductPrice" name="x_ProductPrice" id="x_ProductPrice" size="30" placeholder="<?php echo HtmlEncode($ProductTable->ProductPrice->getPlaceHolder()) ?>" value="<?php echo $ProductTable->ProductPrice->EditValue ?>"<?php echo $ProductTable->ProductPrice->editAttributes() ?>>
</span>
<?php echo $ProductTable->ProductPrice->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ProductTable->ProductDescription->Visible) { // ProductDescription ?>
	<div id="r_ProductDescription" class="form-group row">
		<label id="elh_ProductTable_ProductDescription" for="x_ProductDescription" class="<?php echo $ProductTable_add->LeftColumnClass ?>"><?php echo $ProductTable->ProductDescription->caption() ?><?php echo ($ProductTable->ProductDescription->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ProductTable_add->RightColumnClass ?>"><div<?php echo $ProductTable->ProductDescription->cellAttributes() ?>>
<span id="el_ProductTable_ProductDescription">
<textarea data-table="ProductTable" data-field="x_ProductDescription" name="x_ProductDescription" id="x_ProductDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ProductTable->ProductDescription->getPlaceHolder()) ?>"<?php echo $ProductTable->ProductDescription->editAttributes() ?>><?php echo $ProductTable->ProductDescription->EditValue ?></textarea>
</span>
<?php echo $ProductTable->ProductDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ProductTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ProductTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ProductTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ProductTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ProductTable_add->terminate();
?>