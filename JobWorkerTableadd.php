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
$JobWorkerTable_add = new JobWorkerTable_add();

// Run the page
$JobWorkerTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobWorkerTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fJobWorkerTableadd = currentForm = new ew.Form("fJobWorkerTableadd", "add");

// Validate form
fJobWorkerTableadd.validate = function() {
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
		<?php if ($JobWorkerTable_add->JobWorkerName->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobWorkerTable->JobWorkerName->caption(), $JobWorkerTable->JobWorkerName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($JobWorkerTable_add->JobWorkerCircle->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerCircle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobWorkerTable->JobWorkerCircle->caption(), $JobWorkerTable->JobWorkerCircle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($JobWorkerTable_add->JobWorkerRate->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerRate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobWorkerTable->JobWorkerRate->caption(), $JobWorkerTable->JobWorkerRate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_JobWorkerRate");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobWorkerTable->JobWorkerRate->errorMessage()) ?>");
		<?php if ($JobWorkerTable_add->Passcode->Required) { ?>
			elm = this.getElements("x" + infix + "_Passcode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobWorkerTable->Passcode->caption(), $JobWorkerTable->Passcode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($JobWorkerTable_add->AccessLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_AccessLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobWorkerTable->AccessLevel->caption(), $JobWorkerTable->AccessLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_AccessLevel");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobWorkerTable->AccessLevel->errorMessage()) ?>");

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
fJobWorkerTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobWorkerTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $JobWorkerTable_add->showPageHeader(); ?>
<?php
$JobWorkerTable_add->showMessage();
?>
<form name="fJobWorkerTableadd" id="fJobWorkerTableadd" class="<?php echo $JobWorkerTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobWorkerTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobWorkerTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobWorkerTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$JobWorkerTable_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($JobWorkerTable->JobWorkerName->Visible) { // JobWorkerName ?>
	<div id="r_JobWorkerName" class="form-group row">
		<label id="elh_JobWorkerTable_JobWorkerName" for="x_JobWorkerName" class="<?php echo $JobWorkerTable_add->LeftColumnClass ?>"><?php echo $JobWorkerTable->JobWorkerName->caption() ?><?php echo ($JobWorkerTable->JobWorkerName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobWorkerTable_add->RightColumnClass ?>"><div<?php echo $JobWorkerTable->JobWorkerName->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerName">
<input type="text" data-table="JobWorkerTable" data-field="x_JobWorkerName" name="x_JobWorkerName" id="x_JobWorkerName" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($JobWorkerTable->JobWorkerName->getPlaceHolder()) ?>" value="<?php echo $JobWorkerTable->JobWorkerName->EditValue ?>"<?php echo $JobWorkerTable->JobWorkerName->editAttributes() ?>>
</span>
<?php echo $JobWorkerTable->JobWorkerName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerCircle->Visible) { // JobWorkerCircle ?>
	<div id="r_JobWorkerCircle" class="form-group row">
		<label id="elh_JobWorkerTable_JobWorkerCircle" for="x_JobWorkerCircle" class="<?php echo $JobWorkerTable_add->LeftColumnClass ?>"><?php echo $JobWorkerTable->JobWorkerCircle->caption() ?><?php echo ($JobWorkerTable->JobWorkerCircle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobWorkerTable_add->RightColumnClass ?>"><div<?php echo $JobWorkerTable->JobWorkerCircle->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerCircle">
<input type="text" data-table="JobWorkerTable" data-field="x_JobWorkerCircle" name="x_JobWorkerCircle" id="x_JobWorkerCircle" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($JobWorkerTable->JobWorkerCircle->getPlaceHolder()) ?>" value="<?php echo $JobWorkerTable->JobWorkerCircle->EditValue ?>"<?php echo $JobWorkerTable->JobWorkerCircle->editAttributes() ?>>
</span>
<?php echo $JobWorkerTable->JobWorkerCircle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerRate->Visible) { // JobWorkerRate ?>
	<div id="r_JobWorkerRate" class="form-group row">
		<label id="elh_JobWorkerTable_JobWorkerRate" for="x_JobWorkerRate" class="<?php echo $JobWorkerTable_add->LeftColumnClass ?>"><?php echo $JobWorkerTable->JobWorkerRate->caption() ?><?php echo ($JobWorkerTable->JobWorkerRate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobWorkerTable_add->RightColumnClass ?>"><div<?php echo $JobWorkerTable->JobWorkerRate->cellAttributes() ?>>
<span id="el_JobWorkerTable_JobWorkerRate">
<input type="text" data-table="JobWorkerTable" data-field="x_JobWorkerRate" name="x_JobWorkerRate" id="x_JobWorkerRate" size="30" placeholder="<?php echo HtmlEncode($JobWorkerTable->JobWorkerRate->getPlaceHolder()) ?>" value="<?php echo $JobWorkerTable->JobWorkerRate->EditValue ?>"<?php echo $JobWorkerTable->JobWorkerRate->editAttributes() ?>>
</span>
<?php echo $JobWorkerTable->JobWorkerRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobWorkerTable->Passcode->Visible) { // Passcode ?>
	<div id="r_Passcode" class="form-group row">
		<label id="elh_JobWorkerTable_Passcode" for="x_Passcode" class="<?php echo $JobWorkerTable_add->LeftColumnClass ?>"><?php echo $JobWorkerTable->Passcode->caption() ?><?php echo ($JobWorkerTable->Passcode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobWorkerTable_add->RightColumnClass ?>"><div<?php echo $JobWorkerTable->Passcode->cellAttributes() ?>>
<span id="el_JobWorkerTable_Passcode">
<input type="text" data-table="JobWorkerTable" data-field="x_Passcode" name="x_Passcode" id="x_Passcode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($JobWorkerTable->Passcode->getPlaceHolder()) ?>" value="<?php echo $JobWorkerTable->Passcode->EditValue ?>"<?php echo $JobWorkerTable->Passcode->editAttributes() ?>>
</span>
<?php echo $JobWorkerTable->Passcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobWorkerTable->AccessLevel->Visible) { // AccessLevel ?>
	<div id="r_AccessLevel" class="form-group row">
		<label id="elh_JobWorkerTable_AccessLevel" for="x_AccessLevel" class="<?php echo $JobWorkerTable_add->LeftColumnClass ?>"><?php echo $JobWorkerTable->AccessLevel->caption() ?><?php echo ($JobWorkerTable->AccessLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobWorkerTable_add->RightColumnClass ?>"><div<?php echo $JobWorkerTable->AccessLevel->cellAttributes() ?>>
<span id="el_JobWorkerTable_AccessLevel">
<input type="text" data-table="JobWorkerTable" data-field="x_AccessLevel" name="x_AccessLevel" id="x_AccessLevel" size="30" placeholder="<?php echo HtmlEncode($JobWorkerTable->AccessLevel->getPlaceHolder()) ?>" value="<?php echo $JobWorkerTable->AccessLevel->EditValue ?>"<?php echo $JobWorkerTable->AccessLevel->editAttributes() ?>>
</span>
<?php echo $JobWorkerTable->AccessLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$JobWorkerTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobWorkerTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobWorkerTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$JobWorkerTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$JobWorkerTable_add->terminate();
?>