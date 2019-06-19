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
$TeamTable_list = new TeamTable_list();

// Run the page
$TeamTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$TeamTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fTeamTablelist = currentForm = new ew.Form("fTeamTablelist", "list");
fTeamTablelist.formKeyCountName = '<?php echo $TeamTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fTeamTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fTeamTablelistsrch = currentSearchForm = new ew.Form("fTeamTablelistsrch");

// Filters
fTeamTablelistsrch.filterList = <?php echo $TeamTable_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$TeamTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($TeamTable_list->TotalRecs > 0 && $TeamTable_list->ExportOptions->visible()) { ?>
<?php $TeamTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($TeamTable_list->ImportOptions->visible()) { ?>
<?php $TeamTable_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($TeamTable_list->SearchOptions->visible()) { ?>
<?php $TeamTable_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($TeamTable_list->FilterOptions->visible()) { ?>
<?php $TeamTable_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$TeamTable->isExport() || EXPORT_MASTER_RECORD && $TeamTable->isExport("print")) { ?>
<?php
if ($TeamTable_list->DbMasterFilter <> "" && $TeamTable->getCurrentMasterTable() == "JobSessionTable") {
	if ($TeamTable_list->MasterRecordExists) {
		include_once "JobSessionTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$TeamTable_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$TeamTable->isExport() && !$TeamTable->CurrentAction) { ?>
<form name="fTeamTablelistsrch" id="fTeamTablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($TeamTable_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fTeamTablelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="TeamTable">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($TeamTable_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($TeamTable_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $TeamTable_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($TeamTable_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($TeamTable_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($TeamTable_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($TeamTable_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $TeamTable_list->showPageHeader(); ?>
<?php
$TeamTable_list->showMessage();
?>
<?php if ($TeamTable_list->TotalRecs > 0 || $TeamTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($TeamTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TeamTable">
<form name="fTeamTablelist" id="fTeamTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamTable">
<?php if ($TeamTable->getCurrentMasterTable() == "JobSessionTable" && $TeamTable->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="JobSessionTable">
<input type="hidden" name="fk_SessionTeam" value="<?php echo $TeamTable->TeamID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_TeamTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($TeamTable_list->TotalRecs > 0 || $TeamTable->isGridEdit()) { ?>
<table id="tbl_TeamTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$TeamTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$TeamTable_list->renderListOptions();

// Render list options (header, left)
$TeamTable_list->ListOptions->render("header", "left");
?>
<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
	<?php if ($TeamTable->sortUrl($TeamTable->TeamID) == "") { ?>
		<th data-name="TeamID" class="<?php echo $TeamTable->TeamID->headerCellClass() ?>"><div id="elh_TeamTable_TeamID" class="TeamTable_TeamID"><div class="ew-table-header-caption"><?php echo $TeamTable->TeamID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamID" class="<?php echo $TeamTable->TeamID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamTable->SortUrl($TeamTable->TeamID) ?>',1);"><div id="elh_TeamTable_TeamID" class="TeamTable_TeamID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->TeamID->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->TeamID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->TeamID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
	<?php if ($TeamTable->sortUrl($TeamTable->TeamName) == "") { ?>
		<th data-name="TeamName" class="<?php echo $TeamTable->TeamName->headerCellClass() ?>"><div id="elh_TeamTable_TeamName" class="TeamTable_TeamName"><div class="ew-table-header-caption"><?php echo $TeamTable->TeamName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamName" class="<?php echo $TeamTable->TeamName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamTable->SortUrl($TeamTable->TeamName) ?>',1);"><div id="elh_TeamTable_TeamName" class="TeamTable_TeamName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->TeamName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->TeamName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->TeamName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
	<?php if ($TeamTable->sortUrl($TeamTable->TeamLeader) == "") { ?>
		<th data-name="TeamLeader" class="<?php echo $TeamTable->TeamLeader->headerCellClass() ?>"><div id="elh_TeamTable_TeamLeader" class="TeamTable_TeamLeader"><div class="ew-table-header-caption"><?php echo $TeamTable->TeamLeader->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamLeader" class="<?php echo $TeamTable->TeamLeader->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamTable->SortUrl($TeamTable->TeamLeader) ?>',1);"><div id="elh_TeamTable_TeamLeader" class="TeamTable_TeamLeader">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->TeamLeader->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->TeamLeader->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->TeamLeader->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
	<?php if ($TeamTable->sortUrl($TeamTable->IsVisible) == "") { ?>
		<th data-name="IsVisible" class="<?php echo $TeamTable->IsVisible->headerCellClass() ?>"><div id="elh_TeamTable_IsVisible" class="TeamTable_IsVisible"><div class="ew-table-header-caption"><?php echo $TeamTable->IsVisible->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsVisible" class="<?php echo $TeamTable->IsVisible->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamTable->SortUrl($TeamTable->IsVisible) ?>',1);"><div id="elh_TeamTable_IsVisible" class="TeamTable_IsVisible">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamTable->IsVisible->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamTable->IsVisible->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamTable->IsVisible->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$TeamTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($TeamTable->ExportAll && $TeamTable->isExport()) {
	$TeamTable_list->StopRec = $TeamTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($TeamTable_list->TotalRecs > $TeamTable_list->StartRec + $TeamTable_list->DisplayRecs - 1)
		$TeamTable_list->StopRec = $TeamTable_list->StartRec + $TeamTable_list->DisplayRecs - 1;
	else
		$TeamTable_list->StopRec = $TeamTable_list->TotalRecs;
}
$TeamTable_list->RecCnt = $TeamTable_list->StartRec - 1;
if ($TeamTable_list->Recordset && !$TeamTable_list->Recordset->EOF) {
	$TeamTable_list->Recordset->moveFirst();
	$selectLimit = $TeamTable_list->UseSelectLimit;
	if (!$selectLimit && $TeamTable_list->StartRec > 1)
		$TeamTable_list->Recordset->move($TeamTable_list->StartRec - 1);
} elseif (!$TeamTable->AllowAddDeleteRow && $TeamTable_list->StopRec == 0) {
	$TeamTable_list->StopRec = $TeamTable->GridAddRowCount;
}

// Initialize aggregate
$TeamTable->RowType = ROWTYPE_AGGREGATEINIT;
$TeamTable->resetAttributes();
$TeamTable_list->renderRow();
while ($TeamTable_list->RecCnt < $TeamTable_list->StopRec) {
	$TeamTable_list->RecCnt++;
	if ($TeamTable_list->RecCnt >= $TeamTable_list->StartRec) {
		$TeamTable_list->RowCnt++;

		// Set up key count
		$TeamTable_list->KeyCount = $TeamTable_list->RowIndex;

		// Init row class and style
		$TeamTable->resetAttributes();
		$TeamTable->CssClass = "";
		if ($TeamTable->isGridAdd()) {
		} else {
			$TeamTable_list->loadRowValues($TeamTable_list->Recordset); // Load row values
		}
		$TeamTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$TeamTable->RowAttrs = array_merge($TeamTable->RowAttrs, array('data-rowindex'=>$TeamTable_list->RowCnt, 'id'=>'r' . $TeamTable_list->RowCnt . '_TeamTable', 'data-rowtype'=>$TeamTable->RowType));

		// Render row
		$TeamTable_list->renderRow();

		// Render list options
		$TeamTable_list->renderListOptions();
?>
	<tr<?php echo $TeamTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TeamTable_list->ListOptions->render("body", "left", $TeamTable_list->RowCnt);
?>
	<?php if ($TeamTable->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID"<?php echo $TeamTable->TeamID->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_list->RowCnt ?>_TeamTable_TeamID" class="TeamTable_TeamID">
<span<?php echo $TeamTable->TeamID->viewAttributes() ?>>
<?php echo $TeamTable->TeamID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($TeamTable->TeamName->Visible) { // TeamName ?>
		<td data-name="TeamName"<?php echo $TeamTable->TeamName->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_list->RowCnt ?>_TeamTable_TeamName" class="TeamTable_TeamName">
<span<?php echo $TeamTable->TeamName->viewAttributes() ?>>
<?php echo $TeamTable->TeamName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($TeamTable->TeamLeader->Visible) { // TeamLeader ?>
		<td data-name="TeamLeader"<?php echo $TeamTable->TeamLeader->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_list->RowCnt ?>_TeamTable_TeamLeader" class="TeamTable_TeamLeader">
<span<?php echo $TeamTable->TeamLeader->viewAttributes() ?>>
<?php echo $TeamTable->TeamLeader->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($TeamTable->IsVisible->Visible) { // IsVisible ?>
		<td data-name="IsVisible"<?php echo $TeamTable->IsVisible->cellAttributes() ?>>
<span id="el<?php echo $TeamTable_list->RowCnt ?>_TeamTable_IsVisible" class="TeamTable_IsVisible">
<span<?php echo $TeamTable->IsVisible->viewAttributes() ?>>
<?php echo $TeamTable->IsVisible->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TeamTable_list->ListOptions->render("body", "right", $TeamTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$TeamTable->isGridAdd())
		$TeamTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$TeamTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($TeamTable_list->Recordset)
	$TeamTable_list->Recordset->Close();
?>
<?php if (!$TeamTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$TeamTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($TeamTable_list->Pager)) $TeamTable_list->Pager = new PrevNextPager($TeamTable_list->StartRec, $TeamTable_list->DisplayRecs, $TeamTable_list->TotalRecs, $TeamTable_list->AutoHidePager) ?>
<?php if ($TeamTable_list->Pager->RecordCount > 0 && $TeamTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($TeamTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $TeamTable_list->pageUrl() ?>start=<?php echo $TeamTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($TeamTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $TeamTable_list->pageUrl() ?>start=<?php echo $TeamTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $TeamTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($TeamTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $TeamTable_list->pageUrl() ?>start=<?php echo $TeamTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($TeamTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $TeamTable_list->pageUrl() ?>start=<?php echo $TeamTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $TeamTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($TeamTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $TeamTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $TeamTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $TeamTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $TeamTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($TeamTable_list->TotalRecs == 0 && !$TeamTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $TeamTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$TeamTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$TeamTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$TeamTable_list->terminate();
?>