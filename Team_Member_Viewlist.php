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
$Team_Member_View_list = new Team_Member_View_list();

// Run the page
$Team_Member_View_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Team_Member_View_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Team_Member_View->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fTeam_Member_Viewlist = currentForm = new ew.Form("fTeam_Member_Viewlist", "list");
fTeam_Member_Viewlist.formKeyCountName = '<?php echo $Team_Member_View_list->FormKeyCountName ?>';

// Form_CustomValidate event
fTeam_Member_Viewlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeam_Member_Viewlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fTeam_Member_Viewlistsrch = currentSearchForm = new ew.Form("fTeam_Member_Viewlistsrch");

// Filters
fTeam_Member_Viewlistsrch.filterList = <?php echo $Team_Member_View_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Team_Member_View->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Team_Member_View_list->TotalRecs > 0 && $Team_Member_View_list->ExportOptions->visible()) { ?>
<?php $Team_Member_View_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Team_Member_View_list->ImportOptions->visible()) { ?>
<?php $Team_Member_View_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Team_Member_View_list->SearchOptions->visible()) { ?>
<?php $Team_Member_View_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Team_Member_View_list->FilterOptions->visible()) { ?>
<?php $Team_Member_View_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Team_Member_View_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Team_Member_View->isExport() && !$Team_Member_View->CurrentAction) { ?>
<form name="fTeam_Member_Viewlistsrch" id="fTeam_Member_Viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Team_Member_View_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fTeam_Member_Viewlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Team_Member_View">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($Team_Member_View_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($Team_Member_View_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Team_Member_View_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Team_Member_View_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Team_Member_View_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Team_Member_View_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Team_Member_View_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $Team_Member_View_list->showPageHeader(); ?>
<?php
$Team_Member_View_list->showMessage();
?>
<?php if ($Team_Member_View_list->TotalRecs > 0 || $Team_Member_View->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Team_Member_View_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Team_Member_View">
<form name="fTeam_Member_Viewlist" id="fTeam_Member_Viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Team_Member_View_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Team_Member_View_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Team_Member_View">
<div id="gmp_Team_Member_View" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($Team_Member_View_list->TotalRecs > 0 || $Team_Member_View->isGridEdit()) { ?>
<table id="tbl_Team_Member_Viewlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Team_Member_View_list->RowType = ROWTYPE_HEADER;

// Render list options
$Team_Member_View_list->renderListOptions();

// Render list options (header, left)
$Team_Member_View_list->ListOptions->render("header", "left");
?>
<?php if ($Team_Member_View->Worker_ID->Visible) { // Worker ID ?>
	<?php if ($Team_Member_View->sortUrl($Team_Member_View->Worker_ID) == "") { ?>
		<th data-name="Worker_ID" class="<?php echo $Team_Member_View->Worker_ID->headerCellClass() ?>"><div id="elh_Team_Member_View_Worker_ID" class="Team_Member_View_Worker_ID"><div class="ew-table-header-caption"><?php echo $Team_Member_View->Worker_ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Worker_ID" class="<?php echo $Team_Member_View->Worker_ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Team_Member_View->SortUrl($Team_Member_View->Worker_ID) ?>',1);"><div id="elh_Team_Member_View_Worker_ID" class="Team_Member_View_Worker_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Team_Member_View->Worker_ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Team_Member_View->Worker_ID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Team_Member_View->Worker_ID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Team_Member_View->Worker_Name->Visible) { // Worker Name ?>
	<?php if ($Team_Member_View->sortUrl($Team_Member_View->Worker_Name) == "") { ?>
		<th data-name="Worker_Name" class="<?php echo $Team_Member_View->Worker_Name->headerCellClass() ?>"><div id="elh_Team_Member_View_Worker_Name" class="Team_Member_View_Worker_Name"><div class="ew-table-header-caption"><?php echo $Team_Member_View->Worker_Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Worker_Name" class="<?php echo $Team_Member_View->Worker_Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Team_Member_View->SortUrl($Team_Member_View->Worker_Name) ?>',1);"><div id="elh_Team_Member_View_Worker_Name" class="Team_Member_View_Worker_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Team_Member_View->Worker_Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Team_Member_View->Worker_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Team_Member_View->Worker_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Team_Member_View->Worker_Circle->Visible) { // Worker Circle ?>
	<?php if ($Team_Member_View->sortUrl($Team_Member_View->Worker_Circle) == "") { ?>
		<th data-name="Worker_Circle" class="<?php echo $Team_Member_View->Worker_Circle->headerCellClass() ?>"><div id="elh_Team_Member_View_Worker_Circle" class="Team_Member_View_Worker_Circle"><div class="ew-table-header-caption"><?php echo $Team_Member_View->Worker_Circle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Worker_Circle" class="<?php echo $Team_Member_View->Worker_Circle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Team_Member_View->SortUrl($Team_Member_View->Worker_Circle) ?>',1);"><div id="elh_Team_Member_View_Worker_Circle" class="Team_Member_View_Worker_Circle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Team_Member_View->Worker_Circle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Team_Member_View->Worker_Circle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Team_Member_View->Worker_Circle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Team_Member_View->TeamID->Visible) { // TeamID ?>
	<?php if ($Team_Member_View->sortUrl($Team_Member_View->TeamID) == "") { ?>
		<th data-name="TeamID" class="<?php echo $Team_Member_View->TeamID->headerCellClass() ?>"><div id="elh_Team_Member_View_TeamID" class="Team_Member_View_TeamID"><div class="ew-table-header-caption"><?php echo $Team_Member_View->TeamID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamID" class="<?php echo $Team_Member_View->TeamID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Team_Member_View->SortUrl($Team_Member_View->TeamID) ?>',1);"><div id="elh_Team_Member_View_TeamID" class="Team_Member_View_TeamID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Team_Member_View->TeamID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Team_Member_View->TeamID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Team_Member_View->TeamID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Team_Member_View_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Team_Member_View->ExportAll && $Team_Member_View->isExport()) {
	$Team_Member_View_list->StopRec = $Team_Member_View_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Team_Member_View_list->TotalRecs > $Team_Member_View_list->StartRec + $Team_Member_View_list->DisplayRecs - 1)
		$Team_Member_View_list->StopRec = $Team_Member_View_list->StartRec + $Team_Member_View_list->DisplayRecs - 1;
	else
		$Team_Member_View_list->StopRec = $Team_Member_View_list->TotalRecs;
}
$Team_Member_View_list->RecCnt = $Team_Member_View_list->StartRec - 1;
if ($Team_Member_View_list->Recordset && !$Team_Member_View_list->Recordset->EOF) {
	$Team_Member_View_list->Recordset->moveFirst();
	$selectLimit = $Team_Member_View_list->UseSelectLimit;
	if (!$selectLimit && $Team_Member_View_list->StartRec > 1)
		$Team_Member_View_list->Recordset->move($Team_Member_View_list->StartRec - 1);
} elseif (!$Team_Member_View->AllowAddDeleteRow && $Team_Member_View_list->StopRec == 0) {
	$Team_Member_View_list->StopRec = $Team_Member_View->GridAddRowCount;
}

// Initialize aggregate
$Team_Member_View->RowType = ROWTYPE_AGGREGATEINIT;
$Team_Member_View->resetAttributes();
$Team_Member_View_list->renderRow();
while ($Team_Member_View_list->RecCnt < $Team_Member_View_list->StopRec) {
	$Team_Member_View_list->RecCnt++;
	if ($Team_Member_View_list->RecCnt >= $Team_Member_View_list->StartRec) {
		$Team_Member_View_list->RowCnt++;

		// Set up key count
		$Team_Member_View_list->KeyCount = $Team_Member_View_list->RowIndex;

		// Init row class and style
		$Team_Member_View->resetAttributes();
		$Team_Member_View->CssClass = "";
		if ($Team_Member_View->isGridAdd()) {
		} else {
			$Team_Member_View_list->loadRowValues($Team_Member_View_list->Recordset); // Load row values
		}
		$Team_Member_View->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Team_Member_View->RowAttrs = array_merge($Team_Member_View->RowAttrs, array('data-rowindex'=>$Team_Member_View_list->RowCnt, 'id'=>'r' . $Team_Member_View_list->RowCnt . '_Team_Member_View', 'data-rowtype'=>$Team_Member_View->RowType));

		// Render row
		$Team_Member_View_list->renderRow();

		// Render list options
		$Team_Member_View_list->renderListOptions();
?>
	<tr<?php echo $Team_Member_View->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Team_Member_View_list->ListOptions->render("body", "left", $Team_Member_View_list->RowCnt);
?>
	<?php if ($Team_Member_View->Worker_ID->Visible) { // Worker ID ?>
		<td data-name="Worker_ID"<?php echo $Team_Member_View->Worker_ID->cellAttributes() ?>>
<span id="el<?php echo $Team_Member_View_list->RowCnt ?>_Team_Member_View_Worker_ID" class="Team_Member_View_Worker_ID">
<span<?php echo $Team_Member_View->Worker_ID->viewAttributes() ?>>
<?php echo $Team_Member_View->Worker_ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Team_Member_View->Worker_Name->Visible) { // Worker Name ?>
		<td data-name="Worker_Name"<?php echo $Team_Member_View->Worker_Name->cellAttributes() ?>>
<span id="el<?php echo $Team_Member_View_list->RowCnt ?>_Team_Member_View_Worker_Name" class="Team_Member_View_Worker_Name">
<span<?php echo $Team_Member_View->Worker_Name->viewAttributes() ?>>
<?php echo $Team_Member_View->Worker_Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Team_Member_View->Worker_Circle->Visible) { // Worker Circle ?>
		<td data-name="Worker_Circle"<?php echo $Team_Member_View->Worker_Circle->cellAttributes() ?>>
<span id="el<?php echo $Team_Member_View_list->RowCnt ?>_Team_Member_View_Worker_Circle" class="Team_Member_View_Worker_Circle">
<span<?php echo $Team_Member_View->Worker_Circle->viewAttributes() ?>>
<?php echo $Team_Member_View->Worker_Circle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Team_Member_View->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID"<?php echo $Team_Member_View->TeamID->cellAttributes() ?>>
<span id="el<?php echo $Team_Member_View_list->RowCnt ?>_Team_Member_View_TeamID" class="Team_Member_View_TeamID">
<span<?php echo $Team_Member_View->TeamID->viewAttributes() ?>>
<?php echo $Team_Member_View->TeamID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Team_Member_View_list->ListOptions->render("body", "right", $Team_Member_View_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$Team_Member_View->isGridAdd())
		$Team_Member_View_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$Team_Member_View->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Team_Member_View_list->Recordset)
	$Team_Member_View_list->Recordset->Close();
?>
<?php if (!$Team_Member_View->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Team_Member_View->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Team_Member_View_list->Pager)) $Team_Member_View_list->Pager = new PrevNextPager($Team_Member_View_list->StartRec, $Team_Member_View_list->DisplayRecs, $Team_Member_View_list->TotalRecs, $Team_Member_View_list->AutoHidePager) ?>
<?php if ($Team_Member_View_list->Pager->RecordCount > 0 && $Team_Member_View_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($Team_Member_View_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $Team_Member_View_list->pageUrl() ?>start=<?php echo $Team_Member_View_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($Team_Member_View_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $Team_Member_View_list->pageUrl() ?>start=<?php echo $Team_Member_View_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $Team_Member_View_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($Team_Member_View_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $Team_Member_View_list->pageUrl() ?>start=<?php echo $Team_Member_View_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($Team_Member_View_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $Team_Member_View_list->pageUrl() ?>start=<?php echo $Team_Member_View_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $Team_Member_View_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Team_Member_View_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Team_Member_View_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Team_Member_View_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Team_Member_View_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Team_Member_View_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Team_Member_View_list->TotalRecs == 0 && !$Team_Member_View->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Team_Member_View_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Team_Member_View_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Team_Member_View->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Team_Member_View_list->terminate();
?>