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
$TeamTable_edit = new TeamTable_edit();

// Run the page
$TeamTable_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamTable_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fTeamTableedit = currentForm = new ew.Form("fTeamTableedit", "edit");

// Validate form
fTeamTableedit.validate = function() {
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
		<?php if ($TeamTable_edit->TeamID->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->TeamID->caption(), $TeamTable->TeamID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($TeamTable_edit->TeamName->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->TeamName->caption(), $TeamTable->TeamName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($TeamTable_edit->TeamLeader->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamLeader");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->TeamLeader->caption(), $TeamTable->TeamLeader->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TeamLeader");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamTable->TeamLeader->errorMessage()) ?>");
		<?php if ($TeamTable_edit->IsVisible->Required) { ?>
			elm = this.getElements("x" + infix + "_IsVisible");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamTable->IsVisible->caption(), $TeamTable->IsVisible->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_IsVisible");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamTable->IsVisible->errorMessage()) ?>");

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
fTeamTableedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamTableedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $TeamTable_edit->showPageHeader(); ?>
<?php
$TeamTable_edit->showMessage();
?>
<form name="fTeamTableedit" id="fTeamTableedit" class="<?php echo $TeamTable_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamTable_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamTable_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamTable">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$TeamTable_edit->IsModal ?>">
<?php if ($TeamTable->getCurrentMasterTable() == "JobSessionTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="JobSessionTable">
<input type="hidden" name="fk_SessionTeam" value="<?php echo $TeamTable->TeamID->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
	<div id="r_TeamID" class="form-group row">
		<label id="elh_TeamTable_TeamID" class="<?php echo $TeamTable_edit->LeftColumnClass ?>"><?php echo $TeamTable->TeamID->caption() ?><?php echo ($TeamTable->TeamID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TeamTable_edit->RightColumnClass ?>"><div<?php echo $TeamTable->TeamID->cellAttributes() ?>>
<span id="el_TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamTable->TeamID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="TeamTable" data-field="x_TeamID" name="x_TeamID" id="x_TeamID" value="<?php echo HtmlEncode($TeamTable->TeamID->CurrentValue) ?>">
<?php echo $TeamTable->TeamID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
	<div id="r_TeamName" class="form-group row">
		<label id="elh_TeamTable_TeamName" for="x_TeamName" class="<?php echo $TeamTable_edit->LeftColumnClass ?>"><?php echo $TeamTable->TeamName->caption() ?><?php echo ($TeamTable->TeamName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TeamTable_edit->RightColumnClass ?>"><div<?php echo $TeamTable->TeamName->cellAttributes() ?>>
<span id="el_TeamTable_TeamName">
<input type="text" data-table="TeamTable" data-field="x_TeamName" name="x_TeamName" id="x_TeamName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($TeamTable->TeamName->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamName->EditValue ?>"<?php echo $TeamTable->TeamName->editAttributes() ?>>
</span>
<?php echo $TeamTable->TeamName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
	<div id="r_TeamLeader" class="form-group row">
		<label id="elh_TeamTable_TeamLeader" for="x_TeamLeader" class="<?php echo $TeamTable_edit->LeftColumnClass ?>"><?php echo $TeamTable->TeamLeader->caption() ?><?php echo ($TeamTable->TeamLeader->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TeamTable_edit->RightColumnClass ?>"><div<?php echo $TeamTable->TeamLeader->cellAttributes() ?>>
<span id="el_TeamTable_TeamLeader">
<input type="text" data-table="TeamTable" data-field="x_TeamLeader" name="x_TeamLeader" id="x_TeamLeader" size="30" placeholder="<?php echo HtmlEncode($TeamTable->TeamLeader->getPlaceHolder()) ?>" value="<?php echo $TeamTable->TeamLeader->EditValue ?>"<?php echo $TeamTable->TeamLeader->editAttributes() ?>>
</span>
<?php echo $TeamTable->TeamLeader->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
	<div id="r_IsVisible" class="form-group row">
		<label id="elh_TeamTable_IsVisible" for="x_IsVisible" class="<?php echo $TeamTable_edit->LeftColumnClass ?>"><?php echo $TeamTable->IsVisible->caption() ?><?php echo ($TeamTable->IsVisible->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TeamTable_edit->RightColumnClass ?>"><div<?php echo $TeamTable->IsVisible->cellAttributes() ?>>
<span id="el_TeamTable_IsVisible">
<input type="text" data-table="TeamTable" data-field="x_IsVisible" name="x_IsVisible" id="x_IsVisible" size="30" placeholder="<?php echo HtmlEncode($TeamTable->IsVisible->getPlaceHolder()) ?>" value="<?php echo $TeamTable->IsVisible->EditValue ?>"<?php echo $TeamTable->IsVisible->editAttributes() ?>>
</span>
<?php echo $TeamTable->IsVisible->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("TeamMemberTable", explode(",", $TeamTable->getCurrentDetailTable())) && $TeamMemberTable->DetailEdit) {
?>
<?php if ($TeamTable->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("TeamMemberTable", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "TeamMemberTablegrid.php" ?>
<?php } ?>
<?php if (!$TeamTable_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $TeamTable_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TeamTable_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$TeamTable_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$TeamTable_edit->terminate();
?>