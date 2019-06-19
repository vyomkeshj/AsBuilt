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
$AssignmentTable_edit = new AssignmentTable_edit();

// Run the page
$AssignmentTable_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AssignmentTable_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fAssignmentTableedit = currentForm = new ew.Form("fAssignmentTableedit", "edit");

// Validate form
fAssignmentTableedit.validate = function() {
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
		<?php if ($AssignmentTable_edit->AssignmentID->Required) { ?>
			elm = this.getElements("x" + infix + "_AssignmentID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->AssignmentID->caption(), $AssignmentTable->AssignmentID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($AssignmentTable_edit->LeadID->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->LeadID->caption(), $AssignmentTable->LeadID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($AssignmentTable->LeadID->errorMessage()) ?>");
		<?php if ($AssignmentTable_edit->StartDate->Required) { ?>
			elm = this.getElements("x" + infix + "_StartDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->StartDate->caption(), $AssignmentTable->StartDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_StartDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($AssignmentTable->StartDate->errorMessage()) ?>");
		<?php if ($AssignmentTable_edit->AssignmentDuration->Required) { ?>
			elm = this.getElements("x" + infix + "_AssignmentDuration");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $AssignmentTable->AssignmentDuration->caption(), $AssignmentTable->AssignmentDuration->RequiredErrorMessage)) ?>");
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
fAssignmentTableedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fAssignmentTableedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $AssignmentTable_edit->showPageHeader(); ?>
<?php
$AssignmentTable_edit->showMessage();
?>
<form name="fAssignmentTableedit" id="fAssignmentTableedit" class="<?php echo $AssignmentTable_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($AssignmentTable_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $AssignmentTable_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AssignmentTable">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$AssignmentTable_edit->IsModal ?>">
<?php if ($AssignmentTable->getCurrentMasterTable() == "LeadTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="LeadTable">
<input type="hidden" name="fk_LeadID" value="<?php echo $AssignmentTable->LeadID->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
	<div id="r_AssignmentID" class="form-group row">
		<label id="elh_AssignmentTable_AssignmentID" class="<?php echo $AssignmentTable_edit->LeftColumnClass ?>"><?php echo $AssignmentTable->AssignmentID->caption() ?><?php echo ($AssignmentTable->AssignmentID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AssignmentTable_edit->RightColumnClass ?>"><div<?php echo $AssignmentTable->AssignmentID->cellAttributes() ?>>
<span id="el_AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->AssignmentID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="AssignmentTable" data-field="x_AssignmentID" name="x_AssignmentID" id="x_AssignmentID" value="<?php echo HtmlEncode($AssignmentTable->AssignmentID->CurrentValue) ?>">
<?php echo $AssignmentTable->AssignmentID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
	<div id="r_LeadID" class="form-group row">
		<label id="elh_AssignmentTable_LeadID" for="x_LeadID" class="<?php echo $AssignmentTable_edit->LeftColumnClass ?>"><?php echo $AssignmentTable->LeadID->caption() ?><?php echo ($AssignmentTable->LeadID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AssignmentTable_edit->RightColumnClass ?>"><div<?php echo $AssignmentTable->LeadID->cellAttributes() ?>>
<?php if ($AssignmentTable->LeadID->getSessionValue() <> "") { ?>
<span id="el_AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($AssignmentTable->LeadID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_LeadID" name="x_LeadID" value="<?php echo HtmlEncode($AssignmentTable->LeadID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_AssignmentTable_LeadID">
<input type="text" data-table="AssignmentTable" data-field="x_LeadID" name="x_LeadID" id="x_LeadID" size="30" placeholder="<?php echo HtmlEncode($AssignmentTable->LeadID->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->LeadID->EditValue ?>"<?php echo $AssignmentTable->LeadID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $AssignmentTable->LeadID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_AssignmentTable_StartDate" for="x_StartDate" class="<?php echo $AssignmentTable_edit->LeftColumnClass ?>"><?php echo $AssignmentTable->StartDate->caption() ?><?php echo ($AssignmentTable->StartDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AssignmentTable_edit->RightColumnClass ?>"><div<?php echo $AssignmentTable->StartDate->cellAttributes() ?>>
<span id="el_AssignmentTable_StartDate">
<input type="text" data-table="AssignmentTable" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($AssignmentTable->StartDate->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->StartDate->EditValue ?>"<?php echo $AssignmentTable->StartDate->editAttributes() ?>>
</span>
<?php echo $AssignmentTable->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
	<div id="r_AssignmentDuration" class="form-group row">
		<label id="elh_AssignmentTable_AssignmentDuration" for="x_AssignmentDuration" class="<?php echo $AssignmentTable_edit->LeftColumnClass ?>"><?php echo $AssignmentTable->AssignmentDuration->caption() ?><?php echo ($AssignmentTable->AssignmentDuration->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $AssignmentTable_edit->RightColumnClass ?>"><div<?php echo $AssignmentTable->AssignmentDuration->cellAttributes() ?>>
<span id="el_AssignmentTable_AssignmentDuration">
<input type="text" data-table="AssignmentTable" data-field="x_AssignmentDuration" name="x_AssignmentDuration" id="x_AssignmentDuration" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($AssignmentTable->AssignmentDuration->getPlaceHolder()) ?>" value="<?php echo $AssignmentTable->AssignmentDuration->EditValue ?>"<?php echo $AssignmentTable->AssignmentDuration->editAttributes() ?>>
</span>
<?php echo $AssignmentTable->AssignmentDuration->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("JobSessionTable", explode(",", $AssignmentTable->getCurrentDetailTable())) && $JobSessionTable->DetailEdit) {
?>
<?php if ($AssignmentTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("JobSessionTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "JobSessionTablegrid.php" ?>
<?php } ?>
<?php if (!$AssignmentTable_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $AssignmentTable_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $AssignmentTable_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$AssignmentTable_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$AssignmentTable_edit->terminate();
?>