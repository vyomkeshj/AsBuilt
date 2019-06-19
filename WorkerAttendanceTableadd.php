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
$WorkerAttendanceTable_add = new WorkerAttendanceTable_add();

// Run the page
$WorkerAttendanceTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorkerAttendanceTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fWorkerAttendanceTableadd = currentForm = new ew.Form("fWorkerAttendanceTableadd", "add");

// Validate form
fWorkerAttendanceTableadd.validate = function() {
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
		<?php if ($WorkerAttendanceTable_add->JobWorkerId->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorkerAttendanceTable->JobWorkerId->caption(), $WorkerAttendanceTable->JobWorkerId->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_JobWorkerId");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($WorkerAttendanceTable->JobWorkerId->errorMessage()) ?>");
		<?php if ($WorkerAttendanceTable_add->EntryTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_EntryTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorkerAttendanceTable->EntryTimestamp->caption(), $WorkerAttendanceTable->EntryTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_EntryTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($WorkerAttendanceTable->EntryTimestamp->errorMessage()) ?>");
		<?php if ($WorkerAttendanceTable_add->ExitTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_ExitTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorkerAttendanceTable->ExitTimestamp->caption(), $WorkerAttendanceTable->ExitTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ExitTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($WorkerAttendanceTable->ExitTimestamp->errorMessage()) ?>");

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
fWorkerAttendanceTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fWorkerAttendanceTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $WorkerAttendanceTable_add->showPageHeader(); ?>
<?php
$WorkerAttendanceTable_add->showMessage();
?>
<form name="fWorkerAttendanceTableadd" id="fWorkerAttendanceTableadd" class="<?php echo $WorkerAttendanceTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($WorkerAttendanceTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $WorkerAttendanceTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorkerAttendanceTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$WorkerAttendanceTable_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
	<div id="r_JobWorkerId" class="form-group row">
		<label id="elh_WorkerAttendanceTable_JobWorkerId" for="x_JobWorkerId" class="<?php echo $WorkerAttendanceTable_add->LeftColumnClass ?>"><?php echo $WorkerAttendanceTable->JobWorkerId->caption() ?><?php echo ($WorkerAttendanceTable->JobWorkerId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorkerAttendanceTable_add->RightColumnClass ?>"><div<?php echo $WorkerAttendanceTable->JobWorkerId->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_JobWorkerId">
<input type="text" data-table="WorkerAttendanceTable" data-field="x_JobWorkerId" name="x_JobWorkerId" id="x_JobWorkerId" size="30" placeholder="<?php echo HtmlEncode($WorkerAttendanceTable->JobWorkerId->getPlaceHolder()) ?>" value="<?php echo $WorkerAttendanceTable->JobWorkerId->EditValue ?>"<?php echo $WorkerAttendanceTable->JobWorkerId->editAttributes() ?>>
</span>
<?php echo $WorkerAttendanceTable->JobWorkerId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
	<div id="r_EntryTimestamp" class="form-group row">
		<label id="elh_WorkerAttendanceTable_EntryTimestamp" for="x_EntryTimestamp" class="<?php echo $WorkerAttendanceTable_add->LeftColumnClass ?>"><?php echo $WorkerAttendanceTable->EntryTimestamp->caption() ?><?php echo ($WorkerAttendanceTable->EntryTimestamp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorkerAttendanceTable_add->RightColumnClass ?>"><div<?php echo $WorkerAttendanceTable->EntryTimestamp->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_EntryTimestamp">
<input type="text" data-table="WorkerAttendanceTable" data-field="x_EntryTimestamp" name="x_EntryTimestamp" id="x_EntryTimestamp" placeholder="<?php echo HtmlEncode($WorkerAttendanceTable->EntryTimestamp->getPlaceHolder()) ?>" value="<?php echo $WorkerAttendanceTable->EntryTimestamp->EditValue ?>"<?php echo $WorkerAttendanceTable->EntryTimestamp->editAttributes() ?>>
</span>
<?php echo $WorkerAttendanceTable->EntryTimestamp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
	<div id="r_ExitTimestamp" class="form-group row">
		<label id="elh_WorkerAttendanceTable_ExitTimestamp" for="x_ExitTimestamp" class="<?php echo $WorkerAttendanceTable_add->LeftColumnClass ?>"><?php echo $WorkerAttendanceTable->ExitTimestamp->caption() ?><?php echo ($WorkerAttendanceTable->ExitTimestamp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorkerAttendanceTable_add->RightColumnClass ?>"><div<?php echo $WorkerAttendanceTable->ExitTimestamp->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_ExitTimestamp">
<input type="text" data-table="WorkerAttendanceTable" data-field="x_ExitTimestamp" name="x_ExitTimestamp" id="x_ExitTimestamp" placeholder="<?php echo HtmlEncode($WorkerAttendanceTable->ExitTimestamp->getPlaceHolder()) ?>" value="<?php echo $WorkerAttendanceTable->ExitTimestamp->EditValue ?>"<?php echo $WorkerAttendanceTable->ExitTimestamp->editAttributes() ?>>
</span>
<?php echo $WorkerAttendanceTable->ExitTimestamp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$WorkerAttendanceTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorkerAttendanceTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorkerAttendanceTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorkerAttendanceTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$WorkerAttendanceTable_add->terminate();
?>