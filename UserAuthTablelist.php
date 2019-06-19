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
$UserAuthTable_list = new UserAuthTable_list();

// Run the page
$UserAuthTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$UserAuthTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$UserAuthTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fUserAuthTablelist = currentForm = new ew.Form("fUserAuthTablelist", "list");
fUserAuthTablelist.formKeyCountName = '<?php echo $UserAuthTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fUserAuthTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fUserAuthTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fUserAuthTablelistsrch = currentSearchForm = new ew.Form("fUserAuthTablelistsrch");

// Filters
fUserAuthTablelistsrch.filterList = <?php echo $UserAuthTable_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$UserAuthTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($UserAuthTable_list->TotalRecs > 0 && $UserAuthTable_list->ExportOptions->visible()) { ?>
<?php $UserAuthTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($UserAuthTable_list->ImportOptions->visible()) { ?>
<?php $UserAuthTable_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($UserAuthTable_list->SearchOptions->visible()) { ?>
<?php $UserAuthTable_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($UserAuthTable_list->FilterOptions->visible()) { ?>
<?php $UserAuthTable_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$UserAuthTable_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$UserAuthTable->isExport() && !$UserAuthTable->CurrentAction) { ?>
<form name="fUserAuthTablelistsrch" id="fUserAuthTablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($UserAuthTable_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fUserAuthTablelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="UserAuthTable">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($UserAuthTable_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($UserAuthTable_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $UserAuthTable_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($UserAuthTable_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($UserAuthTable_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($UserAuthTable_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($UserAuthTable_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $UserAuthTable_list->showPageHeader(); ?>
<?php
$UserAuthTable_list->showMessage();
?>
<?php if ($UserAuthTable_list->TotalRecs > 0 || $UserAuthTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($UserAuthTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> UserAuthTable">
<form name="fUserAuthTablelist" id="fUserAuthTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($UserAuthTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $UserAuthTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="UserAuthTable">
<div id="gmp_UserAuthTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($UserAuthTable_list->TotalRecs > 0 || $UserAuthTable->isGridEdit()) { ?>
<table id="tbl_UserAuthTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$UserAuthTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$UserAuthTable_list->renderListOptions();

// Render list options (header, left)
$UserAuthTable_list->ListOptions->render("header", "left");
?>
<?php if ($UserAuthTable->_UserId->Visible) { // UserId ?>
	<?php if ($UserAuthTable->sortUrl($UserAuthTable->_UserId) == "") { ?>
		<th data-name="_UserId" class="<?php echo $UserAuthTable->_UserId->headerCellClass() ?>"><div id="elh_UserAuthTable__UserId" class="UserAuthTable__UserId"><div class="ew-table-header-caption"><?php echo $UserAuthTable->_UserId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_UserId" class="<?php echo $UserAuthTable->_UserId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $UserAuthTable->SortUrl($UserAuthTable->_UserId) ?>',1);"><div id="elh_UserAuthTable__UserId" class="UserAuthTable__UserId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UserAuthTable->_UserId->caption() ?></span><span class="ew-table-header-sort"><?php if ($UserAuthTable->_UserId->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($UserAuthTable->_UserId->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($UserAuthTable->UserName->Visible) { // UserName ?>
	<?php if ($UserAuthTable->sortUrl($UserAuthTable->UserName) == "") { ?>
		<th data-name="UserName" class="<?php echo $UserAuthTable->UserName->headerCellClass() ?>"><div id="elh_UserAuthTable_UserName" class="UserAuthTable_UserName"><div class="ew-table-header-caption"><?php echo $UserAuthTable->UserName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserName" class="<?php echo $UserAuthTable->UserName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $UserAuthTable->SortUrl($UserAuthTable->UserName) ?>',1);"><div id="elh_UserAuthTable_UserName" class="UserAuthTable_UserName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UserAuthTable->UserName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($UserAuthTable->UserName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($UserAuthTable->UserName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($UserAuthTable->Passcode->Visible) { // Passcode ?>
	<?php if ($UserAuthTable->sortUrl($UserAuthTable->Passcode) == "") { ?>
		<th data-name="Passcode" class="<?php echo $UserAuthTable->Passcode->headerCellClass() ?>"><div id="elh_UserAuthTable_Passcode" class="UserAuthTable_Passcode"><div class="ew-table-header-caption"><?php echo $UserAuthTable->Passcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Passcode" class="<?php echo $UserAuthTable->Passcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $UserAuthTable->SortUrl($UserAuthTable->Passcode) ?>',1);"><div id="elh_UserAuthTable_Passcode" class="UserAuthTable_Passcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UserAuthTable->Passcode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($UserAuthTable->Passcode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($UserAuthTable->Passcode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($UserAuthTable->AccessLevel->Visible) { // AccessLevel ?>
	<?php if ($UserAuthTable->sortUrl($UserAuthTable->AccessLevel) == "") { ?>
		<th data-name="AccessLevel" class="<?php echo $UserAuthTable->AccessLevel->headerCellClass() ?>"><div id="elh_UserAuthTable_AccessLevel" class="UserAuthTable_AccessLevel"><div class="ew-table-header-caption"><?php echo $UserAuthTable->AccessLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccessLevel" class="<?php echo $UserAuthTable->AccessLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $UserAuthTable->SortUrl($UserAuthTable->AccessLevel) ?>',1);"><div id="elh_UserAuthTable_AccessLevel" class="UserAuthTable_AccessLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $UserAuthTable->AccessLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($UserAuthTable->AccessLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($UserAuthTable->AccessLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$UserAuthTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($UserAuthTable->ExportAll && $UserAuthTable->isExport()) {
	$UserAuthTable_list->StopRec = $UserAuthTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($UserAuthTable_list->TotalRecs > $UserAuthTable_list->StartRec + $UserAuthTable_list->DisplayRecs - 1)
		$UserAuthTable_list->StopRec = $UserAuthTable_list->StartRec + $UserAuthTable_list->DisplayRecs - 1;
	else
		$UserAuthTable_list->StopRec = $UserAuthTable_list->TotalRecs;
}
$UserAuthTable_list->RecCnt = $UserAuthTable_list->StartRec - 1;
if ($UserAuthTable_list->Recordset && !$UserAuthTable_list->Recordset->EOF) {
	$UserAuthTable_list->Recordset->moveFirst();
	$selectLimit = $UserAuthTable_list->UseSelectLimit;
	if (!$selectLimit && $UserAuthTable_list->StartRec > 1)
		$UserAuthTable_list->Recordset->move($UserAuthTable_list->StartRec - 1);
} elseif (!$UserAuthTable->AllowAddDeleteRow && $UserAuthTable_list->StopRec == 0) {
	$UserAuthTable_list->StopRec = $UserAuthTable->GridAddRowCount;
}

// Initialize aggregate
$UserAuthTable->RowType = ROWTYPE_AGGREGATEINIT;
$UserAuthTable->resetAttributes();
$UserAuthTable_list->renderRow();
while ($UserAuthTable_list->RecCnt < $UserAuthTable_list->StopRec) {
	$UserAuthTable_list->RecCnt++;
	if ($UserAuthTable_list->RecCnt >= $UserAuthTable_list->StartRec) {
		$UserAuthTable_list->RowCnt++;

		// Set up key count
		$UserAuthTable_list->KeyCount = $UserAuthTable_list->RowIndex;

		// Init row class and style
		$UserAuthTable->resetAttributes();
		$UserAuthTable->CssClass = "";
		if ($UserAuthTable->isGridAdd()) {
		} else {
			$UserAuthTable_list->loadRowValues($UserAuthTable_list->Recordset); // Load row values
		}
		$UserAuthTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$UserAuthTable->RowAttrs = array_merge($UserAuthTable->RowAttrs, array('data-rowindex'=>$UserAuthTable_list->RowCnt, 'id'=>'r' . $UserAuthTable_list->RowCnt . '_UserAuthTable', 'data-rowtype'=>$UserAuthTable->RowType));

		// Render row
		$UserAuthTable_list->renderRow();

		// Render list options
		$UserAuthTable_list->renderListOptions();
?>
	<tr<?php echo $UserAuthTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$UserAuthTable_list->ListOptions->render("body", "left", $UserAuthTable_list->RowCnt);
?>
	<?php if ($UserAuthTable->_UserId->Visible) { // UserId ?>
		<td data-name="_UserId"<?php echo $UserAuthTable->_UserId->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_list->RowCnt ?>_UserAuthTable__UserId" class="UserAuthTable__UserId">
<span<?php echo $UserAuthTable->_UserId->viewAttributes() ?>>
<?php echo $UserAuthTable->_UserId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($UserAuthTable->UserName->Visible) { // UserName ?>
		<td data-name="UserName"<?php echo $UserAuthTable->UserName->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_list->RowCnt ?>_UserAuthTable_UserName" class="UserAuthTable_UserName">
<span<?php echo $UserAuthTable->UserName->viewAttributes() ?>>
<?php echo $UserAuthTable->UserName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($UserAuthTable->Passcode->Visible) { // Passcode ?>
		<td data-name="Passcode"<?php echo $UserAuthTable->Passcode->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_list->RowCnt ?>_UserAuthTable_Passcode" class="UserAuthTable_Passcode">
<span<?php echo $UserAuthTable->Passcode->viewAttributes() ?>>
<?php echo $UserAuthTable->Passcode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($UserAuthTable->AccessLevel->Visible) { // AccessLevel ?>
		<td data-name="AccessLevel"<?php echo $UserAuthTable->AccessLevel->cellAttributes() ?>>
<span id="el<?php echo $UserAuthTable_list->RowCnt ?>_UserAuthTable_AccessLevel" class="UserAuthTable_AccessLevel">
<span<?php echo $UserAuthTable->AccessLevel->viewAttributes() ?>>
<?php echo $UserAuthTable->AccessLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$UserAuthTable_list->ListOptions->render("body", "right", $UserAuthTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$UserAuthTable->isGridAdd())
		$UserAuthTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$UserAuthTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($UserAuthTable_list->Recordset)
	$UserAuthTable_list->Recordset->Close();
?>
<?php if (!$UserAuthTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$UserAuthTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($UserAuthTable_list->Pager)) $UserAuthTable_list->Pager = new PrevNextPager($UserAuthTable_list->StartRec, $UserAuthTable_list->DisplayRecs, $UserAuthTable_list->TotalRecs, $UserAuthTable_list->AutoHidePager) ?>
<?php if ($UserAuthTable_list->Pager->RecordCount > 0 && $UserAuthTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($UserAuthTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $UserAuthTable_list->pageUrl() ?>start=<?php echo $UserAuthTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($UserAuthTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $UserAuthTable_list->pageUrl() ?>start=<?php echo $UserAuthTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $UserAuthTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($UserAuthTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $UserAuthTable_list->pageUrl() ?>start=<?php echo $UserAuthTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($UserAuthTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $UserAuthTable_list->pageUrl() ?>start=<?php echo $UserAuthTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $UserAuthTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($UserAuthTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $UserAuthTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $UserAuthTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $UserAuthTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $UserAuthTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($UserAuthTable_list->TotalRecs == 0 && !$UserAuthTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $UserAuthTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$UserAuthTable_list->showPageFooter();
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
$UserAuthTable_list->terminate();
?>