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
$TeamTable_delete = new TeamTable_delete();

// Run the page
$TeamTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fTeamTabledelete = currentForm = new ew.Form("fTeamTabledelete", "delete");

// Form_CustomValidate event
fTeamTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $TeamTable_delete->showPageHeader(); ?>
<?php
$TeamTable_delete->showMessage();
?>
<form name="fTeamTabledelete" id="fTeamTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($TeamTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
		<th class="<?php echo $TeamTable->TeamID->headerCellClass() ?>"><span id="elh_TeamTable_TeamID" class="TeamTable_TeamID"><?php echo $TeamTable->TeamID->caption() ?></span></th>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
		<th class="<?php echo $TeamTable->TeamName->headerCellClass() ?>"><span id="elh_TeamTable_TeamName" class="TeamTable_TeamName"><?php echo $TeamTable->TeamName->caption() ?></span></th>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
		<th class="<?php echo $TeamTable->TeamLeader->headerCellClass() ?>"><span id="elh_TeamTable_TeamLeader" class="TeamTable_TeamLeader"><?php echo $TeamTable->TeamLeader->caption() ?></span></th>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
		<th class="<?php echo $TeamTable->IsVisible->headerCellClass() ?>"><span id="elh_TeamTable_IsVisible" class="TeamTable_IsVisible"><?php echo $TeamTable->IsVisible->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$TeamTable_delete->RecCnt = 0;
$i = 0;
while (!$TeamTable_delete->Recordset->EOF) {
	$TeamTable_delete->RecCnt++;
	$TeamTable_delete->RowCnt++;

	// Set row properties
	$TeamTable->resetAttributes();
	$TeamTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$TeamTable_delete->loadRowValues($TeamTable_delete->Recordset);

	// Render row
	$TeamTable_delete->renderRow();
?>
	<tr<?php echo $TeamTable->rowAttributes() ?>>
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
		<td<?php echo $TeamTable->TeamID->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_delete->RowCnt ?>_TeamTable_TeamID" class="TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<?php echo $TeamTable->TeamID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
		<td<?php echo $TeamTable->TeamName->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_delete->RowCnt ?>_TeamTable_TeamName" class="TeamTable_TeamName">
<span<?php echo $TeamTable->TeamName->viewAttributes() ?>>
<?php echo $TeamTable->TeamName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
		<td<?php echo $TeamTable->TeamLeader->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_delete->RowCnt ?>_TeamTable_TeamLeader" class="TeamTable_TeamLeader">
<span<?php echo $TeamTable->TeamLeader->viewAttributes() ?>>
<?php echo $TeamTable->TeamLeader->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
		<td<?php echo $TeamTable->IsVisible->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_delete->RowCnt ?>_TeamTable_IsVisible" class="TeamTable_IsVisible">
<span<?php echo $TeamTable->IsVisible->viewAttributes() ?>>
<?php echo $TeamTable->IsVisible->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$TeamTable_delete->Recordset->moveNext();
}
$TeamTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $TeamTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$TeamTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$TeamTable_delete->terminate();
?>