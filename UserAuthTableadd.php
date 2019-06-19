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
$UserAuthTable_add = new UserAuthTable_add();

// Run the page
$UserAuthTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UserAuthTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fUserAuthTableadd = currentForm = new ew.Form("fUserAuthTableadd", "add");

// Validate form
fUserAuthTableadd.validate = function() {
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
		<?php if ($UserAuthTable_add->UserName->Required) { ?>
			elm = this.getElements("x" + infix + "_UserName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UserAuthTable->UserName->caption(), $UserAuthTable->UserName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($UserAuthTable_add->Passcode->Required) { ?>
			elm = this.getElements("x" + infix + "_Passcode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UserAuthTable->Passcode->caption(), $UserAuthTable->Passcode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($UserAuthTable_add->AccessLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_AccessLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $UserAuthTable->AccessLevel->caption(), $UserAuthTable->AccessLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_AccessLevel");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($UserAuthTable->AccessLevel->errorMessage()) ?>");

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
fUserAuthTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fUserAuthTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $UserAuthTable_add->showPageHeader(); ?>
<?php
$UserAuthTable_add->showMessage();
?>
<form name="fUserAuthTableadd" id="fUserAuthTableadd" class="<?php echo $UserAuthTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($UserAuthTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $UserAuthTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UserAuthTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$UserAuthTable_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($UserAuthTable->UserName->Visible) { // UserName ?>
	<div id="r_UserName" class="form-group row">
		<label id="elh_UserAuthTable_UserName" for="x_UserName" class="<?php echo $UserAuthTable_add->LeftColumnClass ?>"><?php echo $UserAuthTable->UserName->caption() ?><?php echo ($UserAuthTable->UserName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $UserAuthTable_add->RightColumnClass ?>"><div<?php echo $UserAuthTable->UserName->cellAttributes() ?>>
<span id="el_UserAuthTable_UserName">
<input type="text" data-table="UserAuthTable" data-field="x_UserName" name="x_UserName" id="x_UserName" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($UserAuthTable->UserName->getPlaceHolder()) ?>" value="<?php echo $UserAuthTable->UserName->EditValue ?>"<?php echo $UserAuthTable->UserName->editAttributes() ?>>
</span>
<?php echo $UserAuthTable->UserName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($UserAuthTable->Passcode->Visible) { // Passcode ?>
	<div id="r_Passcode" class="form-group row">
		<label id="elh_UserAuthTable_Passcode" for="x_Passcode" class="<?php echo $UserAuthTable_add->LeftColumnClass ?>"><?php echo $UserAuthTable->Passcode->caption() ?><?php echo ($UserAuthTable->Passcode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $UserAuthTable_add->RightColumnClass ?>"><div<?php echo $UserAuthTable->Passcode->cellAttributes() ?>>
<span id="el_UserAuthTable_Passcode">
<input type="text" data-table="UserAuthTable" data-field="x_Passcode" name="x_Passcode" id="x_Passcode" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($UserAuthTable->Passcode->getPlaceHolder()) ?>" value="<?php echo $UserAuthTable->Passcode->EditValue ?>"<?php echo $UserAuthTable->Passcode->editAttributes() ?>>
</span>
<?php echo $UserAuthTable->Passcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($UserAuthTable->AccessLevel->Visible) { // AccessLevel ?>
	<div id="r_AccessLevel" class="form-group row">
		<label id="elh_UserAuthTable_AccessLevel" for="x_AccessLevel" class="<?php echo $UserAuthTable_add->LeftColumnClass ?>"><?php echo $UserAuthTable->AccessLevel->caption() ?><?php echo ($UserAuthTable->AccessLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $UserAuthTable_add->RightColumnClass ?>"><div<?php echo $UserAuthTable->AccessLevel->cellAttributes() ?>>
<span id="el_UserAuthTable_AccessLevel">
<input type="text" data-table="UserAuthTable" data-field="x_AccessLevel" name="x_AccessLevel" id="x_AccessLevel" size="30" placeholder="<?php echo HtmlEncode($UserAuthTable->AccessLevel->getPlaceHolder()) ?>" value="<?php echo $UserAuthTable->AccessLevel->EditValue ?>"<?php echo $UserAuthTable->AccessLevel->editAttributes() ?>>
</span>
<?php echo $UserAuthTable->AccessLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$UserAuthTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $UserAuthTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $UserAuthTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$UserAuthTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$UserAuthTable_add->terminate();
?>