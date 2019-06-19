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
$JobWorkerTable_list = new JobWorkerTable_list();

// Run the page
$JobWorkerTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobWorkerTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fJobWorkerTablelist = currentForm = new ew.Form("fJobWorkerTablelist", "list");
fJobWorkerTablelist.formKeyCountName = '<?php echo $JobWorkerTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fJobWorkerTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobWorkerTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fJobWorkerTablelistsrch = currentSearchForm = new ew.Form("fJobWorkerTablelistsrch");

// Filters
fJobWorkerTablelistsrch.filterList = <?php echo $JobWorkerTable_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($JobWorkerTable_list->TotalRecs > 0 && $JobWorkerTable_list->ExportOptions->visible()) { ?>
<?php $JobWorkerTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($JobWorkerTable_list->ImportOptions->visible()) { ?>
<?php $JobWorkerTable_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($JobWorkerTable_list->SearchOptions->visible()) { ?>
<?php $JobWorkerTable_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($JobWorkerTable_list->FilterOptions->visible()) { ?>
<?php $JobWorkerTable_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$JobWorkerTable_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$JobWorkerTable->isExport() && !$JobWorkerTable->CurrentAction) { ?>
<form name="fJobWorkerTablelistsrch" id="fJobWorkerTablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($JobWorkerTable_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fJobWorkerTablelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="JobWorkerTable">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($JobWorkerTable_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($JobWorkerTable_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $JobWorkerTable_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($JobWorkerTable_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($JobWorkerTable_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($JobWorkerTable_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($JobWorkerTable_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $JobWorkerTable_list->showPageHeader(); ?>
<?php
$JobWorkerTable_list->showMessage();
?>
<?php if ($JobWorkerTable_list->TotalRecs > 0 || $JobWorkerTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobWorkerTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobWorkerTable">
<form name="fJobWorkerTablelist" id="fJobWorkerTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobWorkerTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobWorkerTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobWorkerTable">
<div id="gmp_JobWorkerTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($JobWorkerTable_list->TotalRecs > 0 || $JobWorkerTable->isGridEdit()) { ?>
<table id="tbl_JobWorkerTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobWorkerTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$JobWorkerTable_list->renderListOptions();

// Render list options (header, left)
$JobWorkerTable_list->ListOptions->render("header", "left");
?>
<?php if ($JobWorkerTable->JobWorkerID->Visible) { // JobWorkerID ?>
	<?php if ($JobWorkerTable->sortUrl($JobWorkerTable->JobWorkerID) == "") { ?>
		<th data-name="JobWorkerID" class="<?php echo $JobWorkerTable->JobWorkerID->headerCellClass() ?>"><div id="elh_JobWorkerTable_JobWorkerID" class="JobWorkerTable_JobWorkerID"><div class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerID" class="<?php echo $JobWorkerTable->JobWorkerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobWorkerTable->SortUrl($JobWorkerTable->JobWorkerID) ?>',1);"><div id="elh_JobWorkerTable_JobWorkerID" class="JobWorkerTable_JobWorkerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobWorkerTable->JobWorkerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobWorkerTable->JobWorkerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerName->Visible) { // JobWorkerName ?>
	<?php if ($JobWorkerTable->sortUrl($JobWorkerTable->JobWorkerName) == "") { ?>
		<th data-name="JobWorkerName" class="<?php echo $JobWorkerTable->JobWorkerName->headerCellClass() ?>"><div id="elh_JobWorkerTable_JobWorkerName" class="JobWorkerTable_JobWorkerName"><div class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerName" class="<?php echo $JobWorkerTable->JobWorkerName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobWorkerTable->SortUrl($JobWorkerTable->JobWorkerName) ?>',1);"><div id="elh_JobWorkerTable_JobWorkerName" class="JobWorkerTable_JobWorkerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobWorkerTable->JobWorkerName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobWorkerTable->JobWorkerName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerCircle->Visible) { // JobWorkerCircle ?>
	<?php if ($JobWorkerTable->sortUrl($JobWorkerTable->JobWorkerCircle) == "") { ?>
		<th data-name="JobWorkerCircle" class="<?php echo $JobWorkerTable->JobWorkerCircle->headerCellClass() ?>"><div id="elh_JobWorkerTable_JobWorkerCircle" class="JobWorkerTable_JobWorkerCircle"><div class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerCircle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerCircle" class="<?php echo $JobWorkerTable->JobWorkerCircle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobWorkerTable->SortUrl($JobWorkerTable->JobWorkerCircle) ?>',1);"><div id="elh_JobWorkerTable_JobWorkerCircle" class="JobWorkerTable_JobWorkerCircle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerCircle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobWorkerTable->JobWorkerCircle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobWorkerTable->JobWorkerCircle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobWorkerTable->JobWorkerRate->Visible) { // JobWorkerRate ?>
	<?php if ($JobWorkerTable->sortUrl($JobWorkerTable->JobWorkerRate) == "") { ?>
		<th data-name="JobWorkerRate" class="<?php echo $JobWorkerTable->JobWorkerRate->headerCellClass() ?>"><div id="elh_JobWorkerTable_JobWorkerRate" class="JobWorkerTable_JobWorkerRate"><div class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerRate" class="<?php echo $JobWorkerTable->JobWorkerRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobWorkerTable->SortUrl($JobWorkerTable->JobWorkerRate) ?>',1);"><div id="elh_JobWorkerTable_JobWorkerRate" class="JobWorkerTable_JobWorkerRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobWorkerTable->JobWorkerRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobWorkerTable->JobWorkerRate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobWorkerTable->JobWorkerRate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobWorkerTable->Passcode->Visible) { // Passcode ?>
	<?php if ($JobWorkerTable->sortUrl($JobWorkerTable->Passcode) == "") { ?>
		<th data-name="Passcode" class="<?php echo $JobWorkerTable->Passcode->headerCellClass() ?>"><div id="elh_JobWorkerTable_Passcode" class="JobWorkerTable_Passcode"><div class="ew-table-header-caption"><?php echo $JobWorkerTable->Passcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Passcode" class="<?php echo $JobWorkerTable->Passcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobWorkerTable->SortUrl($JobWorkerTable->Passcode) ?>',1);"><div id="elh_JobWorkerTable_Passcode" class="JobWorkerTable_Passcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobWorkerTable->Passcode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($JobWorkerTable->Passcode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobWorkerTable->Passcode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobWorkerTable->AccessLevel->Visible) { // AccessLevel ?>
	<?php if ($JobWorkerTable->sortUrl($JobWorkerTable->AccessLevel) == "") { ?>
		<th data-name="AccessLevel" class="<?php echo $JobWorkerTable->AccessLevel->headerCellClass() ?>"><div id="elh_JobWorkerTable_AccessLevel" class="JobWorkerTable_AccessLevel"><div class="ew-table-header-caption"><?php echo $JobWorkerTable->AccessLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccessLevel" class="<?php echo $JobWorkerTable->AccessLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobWorkerTable->SortUrl($JobWorkerTable->AccessLevel) ?>',1);"><div id="elh_JobWorkerTable_AccessLevel" class="JobWorkerTable_AccessLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobWorkerTable->AccessLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobWorkerTable->AccessLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobWorkerTable->AccessLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobWorkerTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($JobWorkerTable->ExportAll && $JobWorkerTable->isExport()) {
	$JobWorkerTable_list->StopRec = $JobWorkerTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($JobWorkerTable_list->TotalRecs > $JobWorkerTable_list->StartRec + $JobWorkerTable_list->DisplayRecs - 1)
		$JobWorkerTable_list->StopRec = $JobWorkerTable_list->StartRec + $JobWorkerTable_list->DisplayRecs - 1;
	else
		$JobWorkerTable_list->StopRec = $JobWorkerTable_list->TotalRecs;
}
$JobWorkerTable_list->RecCnt = $JobWorkerTable_list->StartRec - 1;
if ($JobWorkerTable_list->Recordset && !$JobWorkerTable_list->Recordset->EOF) {
	$JobWorkerTable_list->Recordset->moveFirst();
	$selectLimit = $JobWorkerTable_list->UseSelectLimit;
	if (!$selectLimit && $JobWorkerTable_list->StartRec > 1)
		$JobWorkerTable_list->Recordset->move($JobWorkerTable_list->StartRec - 1);
} elseif (!$JobWorkerTable->AllowAddDeleteRow && $JobWorkerTable_list->StopRec == 0) {
	$JobWorkerTable_list->StopRec = $JobWorkerTable->GridAddRowCount;
}

// Initialize aggregate
$JobWorkerTable->RowType = ROWTYPE_AGGREGATEINIT;
$JobWorkerTable->resetAttributes();
$JobWorkerTable_list->renderRow();
while ($JobWorkerTable_list->RecCnt < $JobWorkerTable_list->StopRec) {
	$JobWorkerTable_list->RecCnt++;
	if ($JobWorkerTable_list->RecCnt >= $JobWorkerTable_list->StartRec) {
		$JobWorkerTable_list->RowCnt++;

		// Set up key count
		$JobWorkerTable_list->KeyCount = $JobWorkerTable_list->RowIndex;

		// Init row class and style
		$JobWorkerTable->resetAttributes();
		$JobWorkerTable->CssClass = "";
		if ($JobWorkerTable->isGridAdd()) {
		} else {
			$JobWorkerTable_list->loadRowValues($JobWorkerTable_list->Recordset); // Load row values
		}
		$JobWorkerTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$JobWorkerTable->RowAttrs = array_merge($JobWorkerTable->RowAttrs, array('data-rowindex'=>$JobWorkerTable_list->RowCnt, 'id'=>'r' . $JobWorkerTable_list->RowCnt . '_JobWorkerTable', 'data-rowtype'=>$JobWorkerTable->RowType));

		// Render row
		$JobWorkerTable_list->renderRow();

		// Render list options
		$JobWorkerTable_list->renderListOptions();
?>
	<tr<?php echo $JobWorkerTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobWorkerTable_list->ListOptions->render("body", "left", $JobWorkerTable_list->RowCnt);
?>
	<?php if ($JobWorkerTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<td data-name="JobWorkerID"<?php echo $JobWorkerTable->JobWorkerID->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_list->RowCnt ?>_JobWorkerTable_JobWorkerID" class="JobWorkerTable_JobWorkerID">
<span<?php echo $JobWorkerTable->JobWorkerID->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobWorkerTable->JobWorkerName->Visible) { // JobWorkerName ?>
		<td data-name="JobWorkerName"<?php echo $JobWorkerTable->JobWorkerName->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_list->RowCnt ?>_JobWorkerTable_JobWorkerName" class="JobWorkerTable_JobWorkerName">
<span<?php echo $JobWorkerTable->JobWorkerName->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobWorkerTable->JobWorkerCircle->Visible) { // JobWorkerCircle ?>
		<td data-name="JobWorkerCircle"<?php echo $JobWorkerTable->JobWorkerCircle->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_list->RowCnt ?>_JobWorkerTable_JobWorkerCircle" class="JobWorkerTable_JobWorkerCircle">
<span<?php echo $JobWorkerTable->JobWorkerCircle->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerCircle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobWorkerTable->JobWorkerRate->Visible) { // JobWorkerRate ?>
		<td data-name="JobWorkerRate"<?php echo $JobWorkerTable->JobWorkerRate->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_list->RowCnt ?>_JobWorkerTable_JobWorkerRate" class="JobWorkerTable_JobWorkerRate">
<span<?php echo $JobWorkerTable->JobWorkerRate->viewAttributes() ?>>
<?php echo $JobWorkerTable->JobWorkerRate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobWorkerTable->Passcode->Visible) { // Passcode ?>
		<td data-name="Passcode"<?php echo $JobWorkerTable->Passcode->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_list->RowCnt ?>_JobWorkerTable_Passcode" class="JobWorkerTable_Passcode">
<span<?php echo $JobWorkerTable->Passcode->viewAttributes() ?>>
<?php echo $JobWorkerTable->Passcode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobWorkerTable->AccessLevel->Visible) { // AccessLevel ?>
		<td data-name="AccessLevel"<?php echo $JobWorkerTable->AccessLevel->cellAttributes() ?>>
<span id="el<?php echo $JobWorkerTable_list->RowCnt ?>_JobWorkerTable_AccessLevel" class="JobWorkerTable_AccessLevel">
<span<?php echo $JobWorkerTable->AccessLevel->viewAttributes() ?>>
<?php echo $JobWorkerTable->AccessLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobWorkerTable_list->ListOptions->render("body", "right", $JobWorkerTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$JobWorkerTable->isGridAdd())
		$JobWorkerTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$JobWorkerTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($JobWorkerTable_list->Recordset)
	$JobWorkerTable_list->Recordset->Close();
?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$JobWorkerTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($JobWorkerTable_list->Pager)) $JobWorkerTable_list->Pager = new PrevNextPager($JobWorkerTable_list->StartRec, $JobWorkerTable_list->DisplayRecs, $JobWorkerTable_list->TotalRecs, $JobWorkerTable_list->AutoHidePager) ?>
<?php if ($JobWorkerTable_list->Pager->RecordCount > 0 && $JobWorkerTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($JobWorkerTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $JobWorkerTable_list->pageUrl() ?>start=<?php echo $JobWorkerTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($JobWorkerTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $JobWorkerTable_list->pageUrl() ?>start=<?php echo $JobWorkerTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $JobWorkerTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($JobWorkerTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $JobWorkerTable_list->pageUrl() ?>start=<?php echo $JobWorkerTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($JobWorkerTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $JobWorkerTable_list->pageUrl() ?>start=<?php echo $JobWorkerTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $JobWorkerTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($JobWorkerTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $JobWorkerTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $JobWorkerTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $JobWorkerTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobWorkerTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobWorkerTable_list->TotalRecs == 0 && !$JobWorkerTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobWorkerTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobWorkerTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$JobWorkerTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$JobWorkerTable_list->terminate();
?>