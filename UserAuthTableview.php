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
$UserAuthTable_view = new UserAuthTable_view();

// Run the page
$UserAuthTable_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UserAuthTable_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$UserAuthTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fUserAuthTableview = currentForm = new ew.Form("fUserAuthTableview", "view");

// Form_CustomValidate event
fUserAuthTableview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fUserAuthTableview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$UserAuthTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $UserAuthTable_view->ExportOptions->render("body") ?>
<?php $UserAuthTable_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $UserAuthTable_view->showPageHeader(); ?>
<?php
$UserAuthTable_view->showMessage();
?>
<form name="fUserAuthTableview" id="fUserAuthTableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($UserAuthTable_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $UserAuthTable_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UserAuthTable">
<input type="hidden" name="modal" value="<?php echo (int)$UserAuthTable_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($UserAuthTable->_UserId->Visible) { // UserId ?>
	<tr id="r__UserId">
		<td class="<?php echo $UserAuthTable_view->TableLeftColumnClass ?>"><span id="elh_UserAuthTable__UserId"><?php echo $UserAuthTable->_UserId->caption() ?></span></td>
		<td data-name="_UserId"<?php echo $UserAuthTable->_UserId->cellAttributes() ?>>
<span id="el_UserAuthTable__UserId">
<span<?php echo $UserAuthTable->_UserId->viewAttributes() ?>>
<?php echo $UserAuthTable->_UserId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($UserAuthTable->UserName->Visible) { // UserName ?>
	<tr id="r_UserName">
		<td class="<?php echo $UserAuthTable_view->TableLeftColumnClass ?>"><span id="elh_UserAuthTable_UserName"><?php echo $UserAuthTable->UserName->caption() ?></span></td>
		<td data-name="UserName"<?php echo $UserAuthTable->UserName->cellAttributes() ?>>
<span id="el_UserAuthTable_UserName">
<span<?php echo $UserAuthTable->UserName->viewAttributes() ?>>
<?php echo $UserAuthTable->UserName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($UserAuthTable->Passcode->Visible) { // Passcode ?>
	<tr id="r_Passcode">
		<td class="<?php echo $UserAuthTable_view->TableLeftColumnClass ?>"><span id="elh_UserAuthTable_Passcode"><?php echo $UserAuthTable->Passcode->caption() ?></span></td>
		<td data-name="Passcode"<?php echo $UserAuthTable->Passcode->cellAttributes() ?>>
<span id="el_UserAuthTable_Passcode">
<span<?php echo $UserAuthTable->Passcode->viewAttributes() ?>>
<?php echo $UserAuthTable->Passcode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($UserAuthTable->AccessLevel->Visible) { // AccessLevel ?>
	<tr id="r_AccessLevel">
		<td class="<?php echo $UserAuthTable_view->TableLeftColumnClass ?>"><span id="elh_UserAuthTable_AccessLevel"><?php echo $UserAuthTable->AccessLevel->caption() ?></span></td>
		<td data-name="AccessLevel"<?php echo $UserAuthTable->AccessLevel->cellAttributes() ?>>
<span id="el_UserAuthTable_AccessLevel">
<span<?php echo $UserAuthTable->AccessLevel->viewAttributes() ?>>
<?php echo $UserAuthTable->AccessLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$UserAuthTable_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$UserAuthTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$UserAuthTable_view->terminate();
?>