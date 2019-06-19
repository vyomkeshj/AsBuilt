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
$WorkerAttendanceTable_edit = new WorkerAttendanceTable_edit();

// Run the page
$WorkerAttendanceTable_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorkerAttendanceTable_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fWorkerAttendanceTableedit = currentForm = new ew.Form("fWorkerAttendanceTableedit", "edit");

// Validate form
fWorkerAttendanceTableedit.validate = function() {
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
		<?php if ($WorkerAttendanceTable_edit->JobWorkerId->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorkerAttendanceTable->JobWorkerId->caption(), $WorkerAttendanceTable->JobWorkerId->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_JobWorkerId");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($WorkerAttendanceTable->JobWorkerId->errorMessage()) ?>");
		<?php if ($WorkerAttendanceTable_edit->EntryTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_EntryTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $WorkerAttendanceTable->EntryTimestamp->caption(), $WorkerAttendanceTable->EntryTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_EntryTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($WorkerAttendanceTable->EntryTimestamp->errorMessage()) ?>");
		<?php if ($WorkerAttendanceTable_edit->ExitTimestamp->Required) { ?>
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
fWorkerAttendanceTableedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fWorkerAttendanceTableedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $WorkerAttendanceTable_edit->showPageHeader(); ?>
<?php
$WorkerAttendanceTable_edit->showMessage();
?>
<form name="fWorkerAttendanceTableedit" id="fWorkerAttendanceTableedit" class="<?php echo $WorkerAttendanceTable_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($WorkerAttendanceTable_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $WorkerAttendanceTable_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorkerAttendanceTable">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$WorkerAttendanceTable_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
	<div id="r_JobWorkerId" class="form-group row">
		<label id="elh_WorkerAttendanceTable_JobWorkerId" for="x_JobWorkerId" class="<?php echo $WorkerAttendanceTable_edit->LeftColumnClass ?>"><?php echo $WorkerAttendanceTable->JobWorkerId->caption() ?><?php echo ($WorkerAttendanceTable->JobWorkerId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorkerAttendanceTable_edit->RightColumnClass ?>"><div<?php echo $WorkerAttendanceTable->JobWorkerId->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_JobWorkerId">
<input type="text" data-table="WorkerAttendanceTable" data-field="x_JobWorkerId" name="x_JobWorkerId" id="x_JobWorkerId" size="30" placeholder="<?php echo HtmlEncode($WorkerAttendanceTable->JobWorkerId->getPlaceHolder()) ?>" value="<?php echo $WorkerAttendanceTable->JobWorkerId->EditValue ?>"<?php echo $WorkerAttendanceTable->JobWorkerId->editAttributes() ?>>
</span>
<?php echo $WorkerAttendanceTable->JobWorkerId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
	<div id="r_EntryTimestamp" class="form-group row">
		<label id="elh_WorkerAttendanceTable_EntryTimestamp" for="x_EntryTimestamp" class="<?php echo $WorkerAttendanceTable_edit->LeftColumnClass ?>"><?php echo $WorkerAttendanceTable->EntryTimestamp->caption() ?><?php echo ($WorkerAttendanceTable->EntryTimestamp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorkerAttendanceTable_edit->RightColumnClass ?>"><div<?php echo $WorkerAttendanceTable->EntryTimestamp->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_EntryTimestamp">
<span<?php echo $WorkerAttendanceTable->EntryTimestamp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($WorkerAttendanceTable->EntryTimestamp->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="WorkerAttendanceTable" data-field="x_EntryTimestamp" name="x_EntryTimestamp" id="x_EntryTimestamp" value="<?php echo HtmlEncode($WorkerAttendanceTable->EntryTimestamp->CurrentValue) ?>">
<?php echo $WorkerAttendanceTable->EntryTimestamp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
	<div id="r_ExitTimestamp" class="form-group row">
		<label id="elh_WorkerAttendanceTable_ExitTimestamp" for="x_ExitTimestamp" class="<?php echo $WorkerAttendanceTable_edit->LeftColumnClass ?>"><?php echo $WorkerAttendanceTable->ExitTimestamp->caption() ?><?php echo ($WorkerAttendanceTable->ExitTimestamp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $WorkerAttendanceTable_edit->RightColumnClass ?>"><div<?php echo $WorkerAttendanceTable->ExitTimestamp->cellAttributes() ?>>
<span id="el_WorkerAttendanceTable_ExitTimestamp">
<input type="text" data-table="WorkerAttendanceTable" data-field="x_ExitTimestamp" name="x_ExitTimestamp" id="x_ExitTimestamp" placeholder="<?php echo HtmlEncode($WorkerAttendanceTable->ExitTimestamp->getPlaceHolder()) ?>" value="<?php echo $WorkerAttendanceTable->ExitTimestamp->EditValue ?>"<?php echo $WorkerAttendanceTable->ExitTimestamp->editAttributes() ?>>
</span>
<?php echo $WorkerAttendanceTable->ExitTimestamp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$WorkerAttendanceTable_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $WorkerAttendanceTable_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $WorkerAttendanceTable_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$WorkerAttendanceTable_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$WorkerAttendanceTable_edit->terminate();
?>