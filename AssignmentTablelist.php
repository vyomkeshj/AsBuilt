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
$AssignmentTable_list = new AssignmentTable_list();

// Run the page
$AssignmentTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$AssignmentTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$AssignmentTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fAssignmentTablelist = currentForm = new ew.Form("fAssignmentTablelist", "list");
fAssignmentTablelist.formKeyCountName = '<?php echo $AssignmentTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fAssignmentTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fAssignmentTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fAssignmentTablelistsrch = currentSearchForm = new ew.Form("fAssignmentTablelistsrch");

// Filters
fAssignmentTablelistsrch.filterList = <?php echo $AssignmentTable_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$AssignmentTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($AssignmentTable_list->TotalRecs > 0 && $AssignmentTable_list->ExportOptions->visible()) { ?>
<?php $AssignmentTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($AssignmentTable_list->ImportOptions->visible()) { ?>
<?php $AssignmentTable_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($AssignmentTable_list->SearchOptions->visible()) { ?>
<?php $AssignmentTable_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($AssignmentTable_list->FilterOptions->visible()) { ?>
<?php $AssignmentTable_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$AssignmentTable->isExport() || EXPORT_MASTER_RECORD && $AssignmentTable->isExport("print")) { ?>
<?php
if ($AssignmentTable_list->DbMasterFilter <> "" && $AssignmentTable->getCurrentMasterTable() == "LeadTable") {
	if ($AssignmentTable_list->MasterRecordExists) {
		include_once "LeadTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$AssignmentTable_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$AssignmentTable->isExport() && !$AssignmentTable->CurrentAction) { ?>
<form name="fAssignmentTablelistsrch" id="fAssignmentTablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($AssignmentTable_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fAssignmentTablelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="AssignmentTable">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($AssignmentTable_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($AssignmentTable_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $AssignmentTable_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($AssignmentTable_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($AssignmentTable_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($AssignmentTable_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($AssignmentTable_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $AssignmentTable_list->showPageHeader(); ?>
<?php
$AssignmentTable_list->showMessage();
?>
<?php if ($AssignmentTable_list->TotalRecs > 0 || $AssignmentTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($AssignmentTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> AssignmentTable">
<form name="fAssignmentTablelist" id="fAssignmentTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($AssignmentTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $AssignmentTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="AssignmentTable">
<?php if ($AssignmentTable->getCurrentMasterTable() == "LeadTable" && $AssignmentTable->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="LeadTable">
<input type="hidden" name="fk_LeadID" value="<?php echo $AssignmentTable->LeadID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_AssignmentTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($AssignmentTable_list->TotalRecs > 0 || $AssignmentTable->isGridEdit()) { ?>
<table id="tbl_AssignmentTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$AssignmentTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$AssignmentTable_list->renderListOptions();

// Render list options (header, left)
$AssignmentTable_list->ListOptions->render("header", "left");
?>
<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->AssignmentID) == "") { ?>
		<th data-name="AssignmentID" class="<?php echo $AssignmentTable->AssignmentID->headerCellClass() ?>"><div id="elh_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID"><div class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssignmentID" class="<?php echo $AssignmentTable->AssignmentID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $AssignmentTable->SortUrl($AssignmentTable->AssignmentID) ?>',1);"><div id="elh_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentID->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->AssignmentID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->AssignmentID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $AssignmentTable->LeadID->headerCellClass() ?>"><div id="elh_AssignmentTable_LeadID" class="AssignmentTable_LeadID"><div class="ew-table-header-caption"><?php echo $AssignmentTable->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $AssignmentTable->LeadID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $AssignmentTable->SortUrl($AssignmentTable->LeadID) ?>',1);"><div id="elh_AssignmentTable_LeadID" class="AssignmentTable_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $AssignmentTable->StartDate->headerCellClass() ?>"><div id="elh_AssignmentTable_StartDate" class="AssignmentTable_StartDate"><div class="ew-table-header-caption"><?php echo $AssignmentTable->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $AssignmentTable->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $AssignmentTable->SortUrl($AssignmentTable->StartDate) ?>',1);"><div id="elh_AssignmentTable_StartDate" class="AssignmentTable_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->StartDate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->StartDate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
	<?php if ($AssignmentTable->sortUrl($AssignmentTable->AssignmentDuration) == "") { ?>
		<th data-name="AssignmentDuration" class="<?php echo $AssignmentTable->AssignmentDuration->headerCellClass() ?>"><div id="elh_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration"><div class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentDuration->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssignmentDuration" class="<?php echo $AssignmentTable->AssignmentDuration->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $AssignmentTable->SortUrl($AssignmentTable->AssignmentDuration) ?>',1);"><div id="elh_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $AssignmentTable->AssignmentDuration->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($AssignmentTable->AssignmentDuration->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($AssignmentTable->AssignmentDuration->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$AssignmentTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($AssignmentTable->ExportAll && $AssignmentTable->isExport()) {
	$AssignmentTable_list->StopRec = $AssignmentTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($AssignmentTable_list->TotalRecs > $AssignmentTable_list->StartRec + $AssignmentTable_list->DisplayRecs - 1)
		$AssignmentTable_list->StopRec = $AssignmentTable_list->StartRec + $AssignmentTable_list->DisplayRecs - 1;
	else
		$AssignmentTable_list->StopRec = $AssignmentTable_list->TotalRecs;
}
$AssignmentTable_list->RecCnt = $AssignmentTable_list->StartRec - 1;
if ($AssignmentTable_list->Recordset && !$AssignmentTable_list->Recordset->EOF) {
	$AssignmentTable_list->Recordset->moveFirst();
	$selectLimit = $AssignmentTable_list->UseSelectLimit;
	if (!$selectLimit && $AssignmentTable_list->StartRec > 1)
		$AssignmentTable_list->Recordset->move($AssignmentTable_list->StartRec - 1);
} elseif (!$AssignmentTable->AllowAddDeleteRow && $AssignmentTable_list->StopRec == 0) {
	$AssignmentTable_list->StopRec = $AssignmentTable->GridAddRowCount;
}

// Initialize aggregate
$AssignmentTable->RowType = ROWTYPE_AGGREGATEINIT;
$AssignmentTable->resetAttributes();
$AssignmentTable_list->renderRow();
while ($AssignmentTable_list->RecCnt < $AssignmentTable_list->StopRec) {
	$AssignmentTable_list->RecCnt++;
	if ($AssignmentTable_list->RecCnt >= $AssignmentTable_list->StartRec) {
		$AssignmentTable_list->RowCnt++;

		// Set up key count
		$AssignmentTable_list->KeyCount = $AssignmentTable_list->RowIndex;

		// Init row class and style
		$AssignmentTable->resetAttributes();
		$AssignmentTable->CssClass = "";
		if ($AssignmentTable->isGridAdd()) {
		} else {
			$AssignmentTable_list->loadRowValues($AssignmentTable_list->Recordset); // Load row values
		}
		$AssignmentTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$AssignmentTable->RowAttrs = array_merge($AssignmentTable->RowAttrs, array('data-rowindex'=>$AssignmentTable_list->RowCnt, 'id'=>'r' . $AssignmentTable_list->RowCnt . '_AssignmentTable', 'data-rowtype'=>$AssignmentTable->RowType));

		// Render row
		$AssignmentTable_list->renderRow();

		// Render list options
		$AssignmentTable_list->renderListOptions();
?>
	<tr<?php echo $AssignmentTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$AssignmentTable_list->ListOptions->render("body", "left", $AssignmentTable_list->RowCnt);
?>
	<?php if ($AssignmentTable->AssignmentID->Visible) { // AssignmentID ?>
		<td data-name="AssignmentID"<?php echo $AssignmentTable->AssignmentID->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_list->RowCnt ?>_AssignmentTable_AssignmentID" class="AssignmentTable_AssignmentID">
<span<?php echo $AssignmentTable->AssignmentID->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($AssignmentTable->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $AssignmentTable->LeadID->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_list->RowCnt ?>_AssignmentTable_LeadID" class="AssignmentTable_LeadID">
<span<?php echo $AssignmentTable->LeadID->viewAttributes() ?>>
<?php echo $AssignmentTable->LeadID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($AssignmentTable->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate"<?php echo $AssignmentTable->StartDate->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_list->RowCnt ?>_AssignmentTable_StartDate" class="AssignmentTable_StartDate">
<span<?php echo $AssignmentTable->StartDate->viewAttributes() ?>>
<?php echo $AssignmentTable->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($AssignmentTable->AssignmentDuration->Visible) { // AssignmentDuration ?>
		<td data-name="AssignmentDuration"<?php echo $AssignmentTable->AssignmentDuration->cellAttributes() ?>>
<span id="el<?php echo $AssignmentTable_list->RowCnt ?>_AssignmentTable_AssignmentDuration" class="AssignmentTable_AssignmentDuration">
<span<?php echo $AssignmentTable->AssignmentDuration->viewAttributes() ?>>
<?php echo $AssignmentTable->AssignmentDuration->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$AssignmentTable_list->ListOptions->render("body", "right", $AssignmentTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$AssignmentTable->isGridAdd())
		$AssignmentTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$AssignmentTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($AssignmentTable_list->Recordset)
	$AssignmentTable_list->Recordset->Close();
?>
<?php if (!$AssignmentTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$AssignmentTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($AssignmentTable_list->Pager)) $AssignmentTable_list->Pager = new PrevNextPager($AssignmentTable_list->StartRec, $AssignmentTable_list->DisplayRecs, $AssignmentTable_list->TotalRecs, $AssignmentTable_list->AutoHidePager) ?>
<?php if ($AssignmentTable_list->Pager->RecordCount > 0 && $AssignmentTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($AssignmentTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $AssignmentTable_list->pageUrl() ?>start=<?php echo $AssignmentTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($AssignmentTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $AssignmentTable_list->pageUrl() ?>start=<?php echo $AssignmentTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $AssignmentTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($AssignmentTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $AssignmentTable_list->pageUrl() ?>start=<?php echo $AssignmentTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($AssignmentTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $AssignmentTable_list->pageUrl() ?>start=<?php echo $AssignmentTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $AssignmentTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($AssignmentTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $AssignmentTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $AssignmentTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $AssignmentTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $AssignmentTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($AssignmentTable_list->TotalRecs == 0 && !$AssignmentTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $AssignmentTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$AssignmentTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$AssignmentTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$AssignmentTable_list->terminate();
?>