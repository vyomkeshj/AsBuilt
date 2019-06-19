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
$JobSessionTable_add = new JobSessionTable_add();

// Run the page
$JobSessionTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobSessionTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fJobSessionTableadd = currentForm = new ew.Form("fJobSessionTableadd", "add");

// Validate form
fJobSessionTableadd.validate = function() {
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
		<?php if ($JobSessionTable_add->AssignmentID->Required) { ?>
			elm = this.getElements("x" + infix + "_AssignmentID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->AssignmentID->caption(), $JobSessionTable->AssignmentID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_AssignmentID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->AssignmentID->errorMessage()) ?>");
		<?php if ($JobSessionTable_add->SessionTeam->Required) { ?>
			elm = this.getElements("x" + infix + "_SessionTeam");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->SessionTeam->caption(), $JobSessionTable->SessionTeam->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_SessionTeam");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->SessionTeam->errorMessage()) ?>");
		<?php if ($JobSessionTable_add->StartTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_StartTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->StartTimestamp->caption(), $JobSessionTable->StartTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_StartTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->StartTimestamp->errorMessage()) ?>");
		<?php if ($JobSessionTable_add->FinishTimestamp->Required) { ?>
			elm = this.getElements("x" + infix + "_FinishTimestamp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->FinishTimestamp->caption(), $JobSessionTable->FinishTimestamp->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_FinishTimestamp");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->FinishTimestamp->errorMessage()) ?>");
		<?php if ($JobSessionTable_add->ExpectedStart->Required) { ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->ExpectedStart->caption(), $JobSessionTable->ExpectedStart->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($JobSessionTable->ExpectedStart->errorMessage()) ?>");
		<?php if ($JobSessionTable_add->SessionComment->Required) { ?>
			elm = this.getElements("x" + infix + "_SessionComment");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $JobSessionTable->SessionComment->caption(), $JobSessionTable->SessionComment->RequiredErrorMessage)) ?>");
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
fJobSessionTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobSessionTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $JobSessionTable_add->showPageHeader(); ?>
<?php
$JobSessionTable_add->showMessage();
?>
<form name="fJobSessionTableadd" id="fJobSessionTableadd" class="<?php echo $JobSessionTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobSessionTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobSessionTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobSessionTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$JobSessionTable_add->IsModal ?>">
<?php if ($JobSessionTable->getCurrentMasterTable() == "AssignmentTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="AssignmentTable">
<input type="hidden" name="fk_AssignmentID" value="<?php echo $JobSessionTable->AssignmentID->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
	<div id="r_AssignmentID" class="form-group row">
		<label id="elh_JobSessionTable_AssignmentID" for="x_AssignmentID" class="<?php echo $JobSessionTable_add->LeftColumnClass ?>"><?php echo $JobSessionTable->AssignmentID->caption() ?><?php echo ($JobSessionTable->AssignmentID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobSessionTable_add->RightColumnClass ?>"><div<?php echo $JobSessionTable->AssignmentID->cellAttributes() ?>>
<?php if ($JobSessionTable->AssignmentID->getSessionValue() <> "") { ?>
<span id="el_JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($JobSessionTable->AssignmentID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_AssignmentID" name="x_AssignmentID" value="<?php echo HtmlEncode($JobSessionTable->AssignmentID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_JobSessionTable_AssignmentID">
<input type="text" data-table="JobSessionTable" data-field="x_AssignmentID" name="x_AssignmentID" id="x_AssignmentID" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->AssignmentID->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->AssignmentID->EditValue ?>"<?php echo $JobSessionTable->AssignmentID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $JobSessionTable->AssignmentID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
	<div id="r_SessionTeam" class="form-group row">
		<label id="elh_JobSessionTable_SessionTeam" for="x_SessionTeam" class="<?php echo $JobSessionTable_add->LeftColumnClass ?>"><?php echo $JobSessionTable->SessionTeam->caption() ?><?php echo ($JobSessionTable->SessionTeam->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobSessionTable_add->RightColumnClass ?>"><div<?php echo $JobSessionTable->SessionTeam->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionTeam">
<input type="text" data-table="JobSessionTable" data-field="x_SessionTeam" name="x_SessionTeam" id="x_SessionTeam" size="30" placeholder="<?php echo HtmlEncode($JobSessionTable->SessionTeam->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->SessionTeam->EditValue ?>"<?php echo $JobSessionTable->SessionTeam->editAttributes() ?>>
</span>
<?php echo $JobSessionTable->SessionTeam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
	<div id="r_StartTimestamp" class="form-group row">
		<label id="elh_JobSessionTable_StartTimestamp" for="x_StartTimestamp" class="<?php echo $JobSessionTable_add->LeftColumnClass ?>"><?php echo $JobSessionTable->StartTimestamp->caption() ?><?php echo ($JobSessionTable->StartTimestamp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobSessionTable_add->RightColumnClass ?>"><div<?php echo $JobSessionTable->StartTimestamp->cellAttributes() ?>>
<span id="el_JobSessionTable_StartTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_StartTimestamp" name="x_StartTimestamp" id="x_StartTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->StartTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->StartTimestamp->EditValue ?>"<?php echo $JobSessionTable->StartTimestamp->editAttributes() ?>>
</span>
<?php echo $JobSessionTable->StartTimestamp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
	<div id="r_FinishTimestamp" class="form-group row">
		<label id="elh_JobSessionTable_FinishTimestamp" for="x_FinishTimestamp" class="<?php echo $JobSessionTable_add->LeftColumnClass ?>"><?php echo $JobSessionTable->FinishTimestamp->caption() ?><?php echo ($JobSessionTable->FinishTimestamp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobSessionTable_add->RightColumnClass ?>"><div<?php echo $JobSessionTable->FinishTimestamp->cellAttributes() ?>>
<span id="el_JobSessionTable_FinishTimestamp">
<input type="text" data-table="JobSessionTable" data-field="x_FinishTimestamp" name="x_FinishTimestamp" id="x_FinishTimestamp" placeholder="<?php echo HtmlEncode($JobSessionTable->FinishTimestamp->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->FinishTimestamp->EditValue ?>"<?php echo $JobSessionTable->FinishTimestamp->editAttributes() ?>>
</span>
<?php echo $JobSessionTable->FinishTimestamp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<div id="r_ExpectedStart" class="form-group row">
		<label id="elh_JobSessionTable_ExpectedStart" for="x_ExpectedStart" class="<?php echo $JobSessionTable_add->LeftColumnClass ?>"><?php echo $JobSessionTable->ExpectedStart->caption() ?><?php echo ($JobSessionTable->ExpectedStart->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobSessionTable_add->RightColumnClass ?>"><div<?php echo $JobSessionTable->ExpectedStart->cellAttributes() ?>>
<span id="el_JobSessionTable_ExpectedStart">
<input type="text" data-table="JobSessionTable" data-field="x_ExpectedStart" name="x_ExpectedStart" id="x_ExpectedStart" placeholder="<?php echo HtmlEncode($JobSessionTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $JobSessionTable->ExpectedStart->EditValue ?>"<?php echo $JobSessionTable->ExpectedStart->editAttributes() ?>>
</span>
<?php echo $JobSessionTable->ExpectedStart->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($JobSessionTable->SessionComment->Visible) { // SessionComment ?>
	<div id="r_SessionComment" class="form-group row">
		<label id="elh_JobSessionTable_SessionComment" for="x_SessionComment" class="<?php echo $JobSessionTable_add->LeftColumnClass ?>"><?php echo $JobSessionTable->SessionComment->caption() ?><?php echo ($JobSessionTable->SessionComment->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $JobSessionTable_add->RightColumnClass ?>"><div<?php echo $JobSessionTable->SessionComment->cellAttributes() ?>>
<span id="el_JobSessionTable_SessionComment">
<textarea data-table="JobSessionTable" data-field="x_SessionComment" name="x_SessionComment" id="x_SessionComment" cols="35" rows="4" placeholder="<?php echo HtmlEncode($JobSessionTable->SessionComment->getPlaceHolder()) ?>"<?php echo $JobSessionTable->SessionComment->editAttributes() ?>><?php echo $JobSessionTable->SessionComment->EditValue ?></textarea>
</span>
<?php echo $JobSessionTable->SessionComment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("TeamTable", explode(",", $JobSessionTable->getCurrentDetailTable())) && $TeamTable->DetailAdd) {
?>
<?php if ($JobSessionTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("TeamTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TeamTablegrid.php" ?>
<?php } ?>
<?php
	if (in_array("CartTable", explode(",", $JobSessionTable->getCurrentDetailTable())) && $CartTable->DetailAdd) {
?>
<?php if ($JobSessionTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("CartTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "CartTablegrid.php" ?>
<?php } ?>
<?php if (!$JobSessionTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $JobSessionTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $JobSessionTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$JobSessionTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$JobSessionTable_add->terminate();
?>