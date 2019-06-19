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
$UserAuthTable_delete = new UserAuthTable_delete();

// Run the page
$UserAuthTable_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UserAuthTable_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fUserAuthTabledelete = currentForm = new ew.Form("fUserAuthTabledelete", "delete");

// Form_CustomValidate event
fUserAuthTabledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fUserAuthTabledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $UserAuthTable_delete->showPageHeader(); ?>
<?php
$UserAuthTable_delete->showMessage();
?>
<form name="fUserAuthTabledelete" id="fUserAuthTabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($UserAuthTable_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $UserAuthTable_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UserAuthTable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($UserAuthTable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($UserAuthTable->_UserId->Visible) { // UserId ?>
		<th class="<?php echo $UserAuthTable->_UserId->headerCellClass() ?>"><span id="elh_UserAuthTable__UserId" class="UserAuthTable__UserId"><?php echo $UserAuthTable->_UserId->caption() ?></span></th>
<?php } ?>
<?php if ($UserAuthTable->UserName->Visible) { // UserName ?>
		<th class="<?php echo $UserAuthTable->UserName->headerCellClass() ?>"><span id="elh_UserAuthTable_UserName" class="UserAuthTable_UserName"><?php echo $UserAuthTable->UserName->caption() ?></span></th>
<?php } ?>
<?php if ($UserAuthTable->Passcode->Visible) { // Passcode ?>
		<th class="<?php echo $UserAuthTable->Passcode->headerCellClass() ?>"><span id="elh_UserAuthTable_Passcode" class="UserAuthTable_Passcode"><?php echo $UserAuthTable->Passcode->caption() ?></span></th>
<?php } ?>
<?php if ($UserAuthTable->AccessLevel->Visible) { // AccessLevel ?>
		<th class="<?php echo $UserAuthTable->AccessLevel->headerCellClass() ?>"><span id="elh_UserAuthTable_AccessLevel" class="UserAuthTable_AccessLevel"><?php echo $UserAuthTable->AccessLevel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$UserAuthTable_delete->RecCnt = 0;
$i = 0;
while (!$UserAuthTable_delete->Recordset->EOF) {
	$UserAuthTable_delete->RecCnt++;
	$UserAuthTable_delete->RowCnt++;

	// Set row properties
	$UserAuthTable->resetAttributes();
	$UserAuthTable->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$UserAuthTable_delete->loadRowValues($UserAuthTable_delete->Recordset);

	// Render row
	$UserAuthTable_delete->renderRow();
?>
	<tr<?php echo $UserAuthTable->rowAttributes() ?>>
<?php if ($UserAuthTable->_UserId->Visible) { // UserId ?>
		<td<?php echo $UserAuthTable->_UserId->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_delete->RowCnt ?>_UserAuthTable__UserId" class="UserAuthTable__UserId">
<span<?php echo $UserAuthTable->_UserId->viewAttributes() ?>>
<?php echo $UserAuthTable->_UserId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($UserAuthTable->UserName->Visible) { // UserName ?>
		<td<?php echo $UserAuthTable->UserName->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_delete->RowCnt ?>_UserAuthTable_UserName" class="UserAuthTable_UserName">
<span<?php echo $UserAuthTable->UserName->viewAttributes() ?>>
<?php echo $UserAuthTable->UserName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($UserAuthTable->Passcode->Visible) { // Passcode ?>
		<td<?php echo $UserAuthTable->Passcode->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_delete->RowCnt ?>_UserAuthTable_Passcode" class="UserAuthTable_Passcode">
<span<?php echo $UserAuthTable->Passcode->viewAttributes() ?>>
<?php echo $UserAuthTable->Passcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($UserAuthTable->AccessLevel->Visible) { // AccessLevel ?>
		<td<?php echo $UserAuthTable->AccessLevel->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_delete->RowCnt ?>_UserAuthTable_AccessLevel" class="UserAuthTable_AccessLevel">
<span<?php echo $UserAuthTable->AccessLevel->viewAttributes() ?>>
<?php echo $UserAuthTable->AccessLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$UserAuthTable_delete->Recordset->moveNext();
}
$UserAuthTable_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $UserAuthTable_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$UserAuthTable_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$UserAuthTable_delete->terminate();
?>