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
$TeamMemberTable_add = new TeamMemberTable_add();

// Run the page
$TeamMemberTable_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamMemberTable_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fTeamMemberTableadd = currentForm = new ew.Form("fTeamMemberTableadd", "add");

// Validate form
fTeamMemberTableadd.validate = function() {
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
		<?php if ($TeamMemberTable_add->TeamID->Required) { ?>
			elm = this.getElements("x" + infix + "_TeamID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamMemberTable->TeamID->caption(), $TeamMemberTable->TeamID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_TeamID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamMemberTable->TeamID->errorMessage()) ?>");
		<?php if ($TeamMemberTable_add->JobWorkerID->Required) { ?>
			elm = this.getElements("x" + infix + "_JobWorkerID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $TeamMemberTable->JobWorkerID->caption(), $TeamMemberTable->JobWorkerID->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_JobWorkerID");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($TeamMemberTable->JobWorkerID->errorMessage()) ?>");

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
fTeamMemberTableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamMemberTableadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $TeamMemberTable_add->showPageHeader(); ?>
<?php
$TeamMemberTable_add->showMessage();
?>
<form name="fTeamMemberTableadd" id="fTeamMemberTableadd" class="<?php echo $TeamMemberTable_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamMemberTable_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamMemberTable_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamMemberTable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$TeamMemberTable_add->IsModal ?>">
<?php if ($TeamMemberTable->getCurrentMasterTable() == "TeamTable") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="TeamTable">
<input type="hidden" name="fk_TeamID" value="<?php echo $TeamMemberTable->TeamID->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
	<div id="r_TeamID" class="form-group row">
		<label id="elh_TeamMemberTable_TeamID" for="x_TeamID" class="<?php echo $TeamMemberTable_add->LeftColumnClass ?>"><?php echo $TeamMemberTable->TeamID->caption() ?><?php echo ($TeamMemberTable->TeamID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TeamMemberTable_add->RightColumnClass ?>"><div<?php echo $TeamMemberTable->TeamID->cellAttributes() ?>>
<?php if ($TeamMemberTable->TeamID->getSessionValue() <> "") { ?>
<span id="el_TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($TeamMemberTable->TeamID->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_TeamID" name="x_TeamID" value="<?php echo HtmlEncode($TeamMemberTable->TeamID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_TeamMemberTable_TeamID">
<input type="text" data-table="TeamMemberTable" data-field="x_TeamID" name="x_TeamID" id="x_TeamID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->TeamID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->TeamID->EditValue ?>"<?php echo $TeamMemberTable->TeamID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $TeamMemberTable->TeamID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
	<div id="r_JobWorkerID" class="form-group row">
		<label id="elh_TeamMemberTable_JobWorkerID" for="x_JobWorkerID" class="<?php echo $TeamMemberTable_add->LeftColumnClass ?>"><?php echo $TeamMemberTable->JobWorkerID->caption() ?><?php echo ($TeamMemberTable->JobWorkerID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $TeamMemberTable_add->RightColumnClass ?>"><div<?php echo $TeamMemberTable->JobWorkerID->cellAttributes() ?>>
<span id="el_TeamMemberTable_JobWorkerID">
<input type="text" data-table="TeamMemberTable" data-field="x_JobWorkerID" name="x_JobWorkerID" id="x_JobWorkerID" size="30" placeholder="<?php echo HtmlEncode($TeamMemberTable->JobWorkerID->getPlaceHolder()) ?>" value="<?php echo $TeamMemberTable->JobWorkerID->EditValue ?>"<?php echo $TeamMemberTable->JobWorkerID->editAttributes() ?>>
</span>
<?php echo $TeamMemberTable->JobWorkerID->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$TeamMemberTable_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $TeamMemberTable_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TeamMemberTable_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$TeamMemberTable_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$TeamMemberTable_add->terminate();
?>