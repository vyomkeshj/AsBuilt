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
$LeadTypeLookup_list = new LeadTypeLookup_list();

// Run the page
$LeadTypeLookup_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTypeLookup_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fLeadTypeLookuplist = currentForm = new ew.Form("fLeadTypeLookuplist", "list");
fLeadTypeLookuplist.formKeyCountName = '<?php echo $LeadTypeLookup_list->FormKeyCountName ?>';

// Form_CustomValidate event
fLeadTypeLookuplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTypeLookuplist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fLeadTypeLookuplistsrch = currentSearchForm = new ew.Form("fLeadTypeLookuplistsrch");

// Filters
fLeadTypeLookuplistsrch.filterList = <?php echo $LeadTypeLookup_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($LeadTypeLookup_list->TotalRecs > 0 && $LeadTypeLookup_list->ExportOptions->visible()) { ?>
<?php $LeadTypeLookup_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($LeadTypeLookup_list->ImportOptions->visible()) { ?>
<?php $LeadTypeLookup_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($LeadTypeLookup_list->SearchOptions->visible()) { ?>
<?php $LeadTypeLookup_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($LeadTypeLookup_list->FilterOptions->visible()) { ?>
<?php $LeadTypeLookup_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$LeadTypeLookup_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$LeadTypeLookup->isExport() && !$LeadTypeLookup->CurrentAction) { ?>
<form name="fLeadTypeLookuplistsrch" id="fLeadTypeLookuplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($LeadTypeLookup_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fLeadTypeLookuplistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="LeadTypeLookup">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($LeadTypeLookup_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($LeadTypeLookup_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $LeadTypeLookup_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($LeadTypeLookup_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($LeadTypeLookup_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($LeadTypeLookup_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($LeadTypeLookup_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $LeadTypeLookup_list->showPageHeader(); ?>
<?php
$LeadTypeLookup_list->showMessage();
?>
<?php if ($LeadTypeLookup_list->TotalRecs > 0 || $LeadTypeLookup->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($LeadTypeLookup_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> LeadTypeLookup">
<form name="fLeadTypeLookuplist" id="fLeadTypeLookuplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTypeLookup_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTypeLookup_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTypeLookup">
<div id="gmp_LeadTypeLookup" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($LeadTypeLookup_list->TotalRecs > 0 || $LeadTypeLookup->isGridEdit()) { ?>
<table id="tbl_LeadTypeLookuplist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$LeadTypeLookup_list->RowType = ROWTYPE_HEADER;

// Render list options
$LeadTypeLookup_list->renderListOptions();

// Render list options (header, left)
$LeadTypeLookup_list->ListOptions->render("header", "left");
?>
<?php if ($LeadTypeLookup->TypeID->Visible) { // TypeID ?>
	<?php if ($LeadTypeLookup->sortUrl($LeadTypeLookup->TypeID) == "") { ?>
		<th data-name="TypeID" class="<?php echo $LeadTypeLookup->TypeID->headerCellClass() ?>"><div id="elh_LeadTypeLookup_TypeID" class="LeadTypeLookup_TypeID"><div class="ew-table-header-caption"><?php echo $LeadTypeLookup->TypeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeID" class="<?php echo $LeadTypeLookup->TypeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTypeLookup->SortUrl($LeadTypeLookup->TypeID) ?>',1);"><div id="elh_LeadTypeLookup_TypeID" class="LeadTypeLookup_TypeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTypeLookup->TypeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTypeLookup->TypeID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTypeLookup->TypeID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTypeLookup->TypeName->Visible) { // TypeName ?>
	<?php if ($LeadTypeLookup->sortUrl($LeadTypeLookup->TypeName) == "") { ?>
		<th data-name="TypeName" class="<?php echo $LeadTypeLookup->TypeName->headerCellClass() ?>"><div id="elh_LeadTypeLookup_TypeName" class="LeadTypeLookup_TypeName"><div class="ew-table-header-caption"><?php echo $LeadTypeLookup->TypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TypeName" class="<?php echo $LeadTypeLookup->TypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTypeLookup->SortUrl($LeadTypeLookup->TypeName) ?>',1);"><div id="elh_LeadTypeLookup_TypeName" class="LeadTypeLookup_TypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTypeLookup->TypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($LeadTypeLookup->TypeName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTypeLookup->TypeName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$LeadTypeLookup_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($LeadTypeLookup->ExportAll && $LeadTypeLookup->isExport()) {
	$LeadTypeLookup_list->StopRec = $LeadTypeLookup_list->TotalRecs;
} else {

	// Set the last record to display
	if ($LeadTypeLookup_list->TotalRecs > $LeadTypeLookup_list->StartRec + $LeadTypeLookup_list->DisplayRecs - 1)
		$LeadTypeLookup_list->StopRec = $LeadTypeLookup_list->StartRec + $LeadTypeLookup_list->DisplayRecs - 1;
	else
		$LeadTypeLookup_list->StopRec = $LeadTypeLookup_list->TotalRecs;
}
$LeadTypeLookup_list->RecCnt = $LeadTypeLookup_list->StartRec - 1;
if ($LeadTypeLookup_list->Recordset && !$LeadTypeLookup_list->Recordset->EOF) {
	$LeadTypeLookup_list->Recordset->moveFirst();
	$selectLimit = $LeadTypeLookup_list->UseSelectLimit;
	if (!$selectLimit && $LeadTypeLookup_list->StartRec > 1)
		$LeadTypeLookup_list->Recordset->move($LeadTypeLookup_list->StartRec - 1);
} elseif (!$LeadTypeLookup->AllowAddDeleteRow && $LeadTypeLookup_list->StopRec == 0) {
	$LeadTypeLookup_list->StopRec = $LeadTypeLookup->GridAddRowCount;
}

// Initialize aggregate
$LeadTypeLookup->RowType = ROWTYPE_AGGREGATEINIT;
$LeadTypeLookup->resetAttributes();
$LeadTypeLookup_list->renderRow();
while ($LeadTypeLookup_list->RecCnt < $LeadTypeLookup_list->StopRec) {
	$LeadTypeLookup_list->RecCnt++;
	if ($LeadTypeLookup_list->RecCnt >= $LeadTypeLookup_list->StartRec) {
		$LeadTypeLookup_list->RowCnt++;

		// Set up key count
		$LeadTypeLookup_list->KeyCount = $LeadTypeLookup_list->RowIndex;

		// Init row class and style
		$LeadTypeLookup->resetAttributes();
		$LeadTypeLookup->CssClass = "";
		if ($LeadTypeLookup->isGridAdd()) {
		} else {
			$LeadTypeLookup_list->loadRowValues($LeadTypeLookup_list->Recordset); // Load row values
		}
		$LeadTypeLookup->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$LeadTypeLookup->RowAttrs = array_merge($LeadTypeLookup->RowAttrs, array('data-rowindex'=>$LeadTypeLookup_list->RowCnt, 'id'=>'r' . $LeadTypeLookup_list->RowCnt . '_LeadTypeLookup', 'data-rowtype'=>$LeadTypeLookup->RowType));

		// Render row
		$LeadTypeLookup_list->renderRow();

		// Render list options
		$LeadTypeLookup_list->renderListOptions();
?>
	<tr<?php echo $LeadTypeLookup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadTypeLookup_list->ListOptions->render("body", "left", $LeadTypeLookup_list->RowCnt);
?>
	<?php if ($LeadTypeLookup->TypeID->Visible) { // TypeID ?>
		<td data-name="TypeID"<?php echo $LeadTypeLookup->TypeID->cellAttributes() ?>>
<span id="el<?php echo $LeadTypeLookup_list->RowCnt ?>_LeadTypeLookup_TypeID" class="LeadTypeLookup_TypeID">
<span<?php echo $LeadTypeLookup->TypeID->viewAttributes() ?>>
<?php echo $LeadTypeLookup->TypeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTypeLookup->TypeName->Visible) { // TypeName ?>
		<td data-name="TypeName"<?php echo $LeadTypeLookup->TypeName->cellAttributes() ?>>
<span id="el<?php echo $LeadTypeLookup_list->RowCnt ?>_LeadTypeLookup_TypeName" class="LeadTypeLookup_TypeName">
<span<?php echo $LeadTypeLookup->TypeName->viewAttributes() ?>>
<?php echo $LeadTypeLookup->TypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadTypeLookup_list->ListOptions->render("body", "right", $LeadTypeLookup_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$LeadTypeLookup->isGridAdd())
		$LeadTypeLookup_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$LeadTypeLookup->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($LeadTypeLookup_list->Recordset)
	$LeadTypeLookup_list->Recordset->Close();
?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$LeadTypeLookup->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($LeadTypeLookup_list->Pager)) $LeadTypeLookup_list->Pager = new PrevNextPager($LeadTypeLookup_list->StartRec, $LeadTypeLookup_list->DisplayRecs, $LeadTypeLookup_list->TotalRecs, $LeadTypeLookup_list->AutoHidePager) ?>
<?php if ($LeadTypeLookup_list->Pager->RecordCount > 0 && $LeadTypeLookup_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($LeadTypeLookup_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $LeadTypeLookup_list->pageUrl() ?>start=<?php echo $LeadTypeLookup_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($LeadTypeLookup_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $LeadTypeLookup_list->pageUrl() ?>start=<?php echo $LeadTypeLookup_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $LeadTypeLookup_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($LeadTypeLookup_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $LeadTypeLookup_list->pageUrl() ?>start=<?php echo $LeadTypeLookup_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($LeadTypeLookup_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $LeadTypeLookup_list->pageUrl() ?>start=<?php echo $LeadTypeLookup_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $LeadTypeLookup_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($LeadTypeLookup_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $LeadTypeLookup_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $LeadTypeLookup_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $LeadTypeLookup_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $LeadTypeLookup_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($LeadTypeLookup_list->TotalRecs == 0 && !$LeadTypeLookup->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $LeadTypeLookup_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$LeadTypeLookup_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$LeadTypeLookup->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$LeadTypeLookup_list->terminate();
?>