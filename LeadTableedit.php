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
$LeadTable_edit = new LeadTable_edit();

// Run the page
$LeadTable_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTable_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fLeadTableedit = currentForm = new ew.Form("fLeadTableedit", "edit");

// Validate form
fLeadTableedit.validate = function() {
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
		<?php if ($LeadTable_edit->LeadID->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->LeadID->caption(), $LeadTable->LeadID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_edit->CustomerID->Required) { ?>
			elm = this.getElements("x" + infix + "_CustomerID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->CustomerID->caption(), $LeadTable->CustomerID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_CustomerID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->CustomerID->errorMessage()) ?>");
		<?php if ($LeadTable_edit->LeadType->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadType");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->LeadType->caption(), $LeadTable->LeadType->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_LeadType");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->LeadType->errorMessage()) ?>");
		<?php if ($LeadTable_edit->SiteLocation->Required) { ?>
			elm = this.getElements("x" + infix + "_SiteLocation");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->SiteLocation->caption(), $LeadTable->SiteLocation->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_edit->Suburb->Required) { ?>
			elm = this.getElements("x" + infix + "_Suburb");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->Suburb->caption(), $LeadTable->Suburb->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_edit->ExpectedStart->Required) { ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->ExpectedStart->caption(), $LeadTable->ExpectedStart->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ExpectedStart");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->ExpectedStart->errorMessage()) ?>");
		<?php if ($LeadTable_edit->DateTaken->Required) { ?>
			elm = this.getElements("x" + infix + "_DateTaken");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->DateTaken->caption(), $LeadTable->DateTaken->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_DateTaken");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->DateTaken->errorMessage()) ?>");
		<?php if ($LeadTable_edit->TakenBy->Required) { ?>
			elm = this.getElements("x" + infix + "_TakenBy");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->TakenBy->caption(), $LeadTable->TakenBy->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($LeadTable_edit->IsComplete->Required) { ?>
			elm = this.getElements("x" + infix + "_IsComplete");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->IsComplete->caption(), $LeadTable->IsComplete->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_IsComplete");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($LeadTable->IsComplete->errorMessage()) ?>");
		<?php if ($LeadTable_edit->LeadComment->Required) { ?>
			elm = this.getElements("x" + infix + "_LeadComment");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $LeadTable->LeadComment->caption(), $LeadTable->LeadComment->RequiredErrorMessage)) ?>");
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
fLeadTableedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTableedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $LeadTable_edit->showPageHeader(); ?>
<?php
$LeadTable_edit->showMessage();
?>
<form name="fLeadTableedit" id="fLeadTableedit" class="<?php echo $LeadTable_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTable_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTable_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTable">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$LeadTable_edit->IsModal ?>">
<?php if ($LeadTable->getCurrentMasterTable() == "CustomerTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="CustomerTable">
<input type="hidden" name="fk_CustomerID" value="<?php echo $LeadTable->CustomerID->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
	<div id="r_LeadID" class="form-group row">
		<label id="elh_LeadTable_LeadID" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->LeadID->caption() ?><?php echo ($LeadTable->LeadID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->LeadID->cellAttributes() ?>>
<span id="el_LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->LeadID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="LeadTable" data-field="x_LeadID" name="x_LeadID" id="x_LeadID" value="<?php echo HtmlEncode($LeadTable->LeadID->CurrentValue) ?>">
<?php echo $LeadTable->LeadID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
	<div id="r_CustomerID" class="form-group row">
		<label id="elh_LeadTable_CustomerID" for="x_CustomerID" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->CustomerID->caption() ?><?php echo ($LeadTable->CustomerID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->CustomerID->cellAttributes() ?>>
<?php if ($LeadTable->CustomerID->getSessionValue() <> "") { ?>
<span id="el_LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($LeadTable->CustomerID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_CustomerID" name="x_CustomerID" value="<?php echo HtmlEncode($LeadTable->CustomerID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_LeadTable_CustomerID">
<input type="text" data-table="LeadTable" data-field="x_CustomerID" name="x_CustomerID" id="x_CustomerID" size="30" placeholder="<?php echo HtmlEncode($LeadTable->CustomerID->getPlaceHolder()) ?>" value="<?php echo $LeadTable->CustomerID->EditValue ?>"<?php echo $LeadTable->CustomerID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $LeadTable->CustomerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
	<div id="r_LeadType" class="form-group row">
		<label id="elh_LeadTable_LeadType" for="x_LeadType" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->LeadType->caption() ?><?php echo ($LeadTable->LeadType->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->LeadType->cellAttributes() ?>>
<span id="el_LeadTable_LeadType">
<input type="text" data-table="LeadTable" data-field="x_LeadType" name="x_LeadType" id="x_LeadType" size="30" placeholder="<?php echo HtmlEncode($LeadTable->LeadType->getPlaceHolder()) ?>" value="<?php echo $LeadTable->LeadType->EditValue ?>"<?php echo $LeadTable->LeadType->editAttributes() ?>>
</span>
<?php echo $LeadTable->LeadType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->SiteLocation->Visible) { // SiteLocation ?>
	<div id="r_SiteLocation" class="form-group row">
		<label id="elh_LeadTable_SiteLocation" for="x_SiteLocation" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->SiteLocation->caption() ?><?php echo ($LeadTable->SiteLocation->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->SiteLocation->cellAttributes() ?>>
<span id="el_LeadTable_SiteLocation">
<textarea data-table="LeadTable" data-field="x_SiteLocation" name="x_SiteLocation" id="x_SiteLocation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($LeadTable->SiteLocation->getPlaceHolder()) ?>"<?php echo $LeadTable->SiteLocation->editAttributes() ?>><?php echo $LeadTable->SiteLocation->EditValue ?></textarea>
</span>
<?php echo $LeadTable->SiteLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
	<div id="r_Suburb" class="form-group row">
		<label id="elh_LeadTable_Suburb" for="x_Suburb" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->Suburb->caption() ?><?php echo ($LeadTable->Suburb->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->Suburb->cellAttributes() ?>>
<span id="el_LeadTable_Suburb">
<input type="text" data-table="LeadTable" data-field="x_Suburb" name="x_Suburb" id="x_Suburb" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->Suburb->getPlaceHolder()) ?>" value="<?php echo $LeadTable->Suburb->EditValue ?>"<?php echo $LeadTable->Suburb->editAttributes() ?>>
</span>
<?php echo $LeadTable->Suburb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<div id="r_ExpectedStart" class="form-group row">
		<label id="elh_LeadTable_ExpectedStart" for="x_ExpectedStart" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->ExpectedStart->caption() ?><?php echo ($LeadTable->ExpectedStart->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->ExpectedStart->cellAttributes() ?>>
<span id="el_LeadTable_ExpectedStart">
<input type="text" data-table="LeadTable" data-field="x_ExpectedStart" name="x_ExpectedStart" id="x_ExpectedStart" placeholder="<?php echo HtmlEncode($LeadTable->ExpectedStart->getPlaceHolder()) ?>" value="<?php echo $LeadTable->ExpectedStart->EditValue ?>"<?php echo $LeadTable->ExpectedStart->editAttributes() ?>>
</span>
<?php echo $LeadTable->ExpectedStart->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
	<div id="r_DateTaken" class="form-group row">
		<label id="elh_LeadTable_DateTaken" for="x_DateTaken" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->DateTaken->caption() ?><?php echo ($LeadTable->DateTaken->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->DateTaken->cellAttributes() ?>>
<span id="el_LeadTable_DateTaken">
<input type="text" data-table="LeadTable" data-field="x_DateTaken" name="x_DateTaken" id="x_DateTaken" placeholder="<?php echo HtmlEncode($LeadTable->DateTaken->getPlaceHolder()) ?>" value="<?php echo $LeadTable->DateTaken->EditValue ?>"<?php echo $LeadTable->DateTaken->editAttributes() ?>>
</span>
<?php echo $LeadTable->DateTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
	<div id="r_TakenBy" class="form-group row">
		<label id="elh_LeadTable_TakenBy" for="x_TakenBy" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->TakenBy->caption() ?><?php echo ($LeadTable->TakenBy->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->TakenBy->cellAttributes() ?>>
<span id="el_LeadTable_TakenBy">
<input type="text" data-table="LeadTable" data-field="x_TakenBy" name="x_TakenBy" id="x_TakenBy" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($LeadTable->TakenBy->getPlaceHolder()) ?>" value="<?php echo $LeadTable->TakenBy->EditValue ?>"<?php echo $LeadTable->TakenBy->editAttributes() ?>>
</span>
<?php echo $LeadTable->TakenBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
	<div id="r_IsComplete" class="form-group row">
		<label id="elh_LeadTable_IsComplete" for="x_IsComplete" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->IsComplete->caption() ?><?php echo ($LeadTable->IsComplete->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->IsComplete->cellAttributes() ?>>
<span id="el_LeadTable_IsComplete">
<input type="text" data-table="LeadTable" data-field="x_IsComplete" name="x_IsComplete" id="x_IsComplete" size="30" placeholder="<?php echo HtmlEncode($LeadTable->IsComplete->getPlaceHolder()) ?>" value="<?php echo $LeadTable->IsComplete->EditValue ?>"<?php echo $LeadTable->IsComplete->editAttributes() ?>>
</span>
<?php echo $LeadTable->IsComplete->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($LeadTable->LeadComment->Visible) { // LeadComment ?>
	<div id="r_LeadComment" class="form-group row">
		<label id="elh_LeadTable_LeadComment" for="x_LeadComment" class="<?php echo $LeadTable_edit->LeftColumnClass ?>"><?php echo $LeadTable->LeadComment->caption() ?><?php echo ($LeadTable->LeadComment->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $LeadTable_edit->RightColumnClass ?>"><div<?php echo $LeadTable->LeadComment->cellAttributes() ?>>
<span id="el_LeadTable_LeadComment">
<textarea data-table="LeadTable" data-field="x_LeadComment" name="x_LeadComment" id="x_LeadComment" cols="35" rows="4" placeholder="<?php echo HtmlEncode($LeadTable->LeadComment->getPlaceHolder()) ?>"<?php echo $LeadTable->LeadComment->editAttributes() ?>><?php echo $LeadTable->LeadComment->EditValue ?></textarea>
</span>
<?php echo $LeadTable->LeadComment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("LeadFileAssociation", explode(",", $LeadTable->getCurrentDetailTable())) && $LeadFileAssociation->DetailEdit) {
?>
<?php if ($LeadTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("LeadFileAssociation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "LeadFileAssociationgrid.php" ?>
<?php } ?>
<?php
	if (in_array("AssignmentTable", explode(",", $LeadTable->getCurrentDetailTable())) && $AssignmentTable->DetailEdit) {
?>
<?php if ($LeadTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("AssignmentTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AssignmentTablegrid.php" ?>
<?php } ?>
<?php if (!$LeadTable_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $LeadTable_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $LeadTable_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$LeadTable_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$LeadTable_edit->terminate();
?>