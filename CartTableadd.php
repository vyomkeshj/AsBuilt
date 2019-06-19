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
$CartTable_add = new CartTable_add();

// Run the page
$CartTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fCartTableadd = currentForm = new ew.Form("fCartTableadd", "add");

// Validate form
fCartTableadd.validate = function() {
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
		<?php if ($CartTable_add->SessionID->Required) { ?>
			elm = this.getElements("x" + infix + "_SessionID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartTable->SessionID->caption(), $CartTable->SessionID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_SessionID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($CartTable->SessionID->errorMessage()) ?>");
		<?php if ($CartTable_add->ProductID->Required) { ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $CartTable->ProductID->caption(), $CartTable->ProductID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ProductID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($CartTable->ProductID->errorMessage()) ?>");

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
fCartTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCartTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $CartTable_add->showPageHeader(); ?>
<?php
$CartTable_add->showMessage();
?>
<form name="fCartTableadd" id="fCartTableadd" class="<?php echo $CartTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CartTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CartTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$CartTable_add->IsModal ?>">
<?php if ($CartTable->getCurrentMasterTable() == "JobSessionTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="JobSessionTable">
<input type="hidden" name="fk_SessionID" value="<?php echo $CartTable->SessionID->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
	<div id="r_SessionID" class="form-group row">
		<label id="elh_CartTable_SessionID" for="x_SessionID" class="<?php echo $CartTable_add->LeftColumnClass ?>"><?php echo $CartTable->SessionID->caption() ?><?php echo ($CartTable->SessionID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartTable_add->RightColumnClass ?>"><div<?php echo $CartTable->SessionID->cellAttributes() ?>>
<?php if ($CartTable->SessionID->getSessionValue() <> "") { ?>
<span id="el_CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($CartTable->SessionID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_SessionID" name="x_SessionID" value="<?php echo HtmlEncode($CartTable->SessionID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_CartTable_SessionID">
<input type="text" data-table="CartTable" data-field="x_SessionID" name="x_SessionID" id="x_SessionID" size="30" placeholder="<?php echo HtmlEncode($CartTable->SessionID->getPlaceHolder()) ?>" value="<?php echo $CartTable->SessionID->EditValue ?>"<?php echo $CartTable->SessionID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $CartTable->SessionID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
	<div id="r_ProductID" class="form-group row">
		<label id="elh_CartTable_ProductID" for="x_ProductID" class="<?php echo $CartTable_add->LeftColumnClass ?>"><?php echo $CartTable->ProductID->caption() ?><?php echo ($CartTable->ProductID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $CartTable_add->RightColumnClass ?>"><div<?php echo $CartTable->ProductID->cellAttributes() ?>>
<span id="el_CartTable_ProductID">
<input type="text" data-table="CartTable" data-field="x_ProductID" name="x_ProductID" id="x_ProductID" size="30" placeholder="<?php echo HtmlEncode($CartTable->ProductID->getPlaceHolder()) ?>" value="<?php echo $CartTable->ProductID->EditValue ?>"<?php echo $CartTable->ProductID->editAttributes() ?>>
</span>
<?php echo $CartTable->ProductID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$CartTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $CartTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $CartTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$CartTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$CartTable_add->terminate();
?>