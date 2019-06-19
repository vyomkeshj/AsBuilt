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
$LeadTable_list = new LeadTable_list();

// Run the page
$LeadTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$LeadTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fLeadTablelist = currentForm = new ew.Form("fLeadTablelist", "list");
fLeadTablelist.formKeyCountName = '<?php echo $LeadTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fLeadTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fLeadTablelistsrch = currentSearchForm = new ew.Form("fLeadTablelistsrch");

// Filters
fLeadTablelistsrch.filterList = <?php echo $LeadTable_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$LeadTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($LeadTable_list->TotalRecs > 0 && $LeadTable_list->ExportOptions->visible()) { ?>
<?php $LeadTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($LeadTable_list->ImportOptions->visible()) { ?>
<?php $LeadTable_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($LeadTable_list->SearchOptions->visible()) { ?>
<?php $LeadTable_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($LeadTable_list->FilterOptions->visible()) { ?>
<?php $LeadTable_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$LeadTable->isExport() || EXPORT_MASTER_RECORD && $LeadTable->isExport("print")) { ?>
<?php
if ($LeadTable_list->DbMasterFilter <> "" && $LeadTable->getCurrentMasterTable() == "CustomerTable") {
	if ($LeadTable_list->MasterRecordExists) {
		include_once "CustomerTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$LeadTable_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$LeadTable->isExport() && !$LeadTable->CurrentAction) { ?>
<form name="fLeadTablelistsrch" id="fLeadTablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($LeadTable_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fLeadTablelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="LeadTable">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($LeadTable_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($LeadTable_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $LeadTable_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($LeadTable_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($LeadTable_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($LeadTable_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($LeadTable_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $LeadTable_list->showPageHeader(); ?>
<?php
$LeadTable_list->showMessage();
?>
<?php if ($LeadTable_list->TotalRecs > 0 || $LeadTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($LeadTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> LeadTable">
<form name="fLeadTablelist" id="fLeadTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadTable">
<?php if ($LeadTable->getCurrentMasterTable() == "CustomerTable" && $LeadTable->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="CustomerTable">
<input type="hidden" name="fk_CustomerID" value="<?php echo $LeadTable->CustomerID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_LeadTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($LeadTable_list->TotalRecs > 0 || $LeadTable->isGridEdit()) { ?>
<table id="tbl_LeadTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$LeadTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$LeadTable_list->renderListOptions();

// Render list options (header, left)
$LeadTable_list->ListOptions->render("header", "left");
?>
<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
	<?php if ($LeadTable->sortUrl($LeadTable->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $LeadTable->LeadID->headerCellClass() ?>"><div id="elh_LeadTable_LeadID" class="LeadTable_LeadID"><div class="ew-table-header-caption"><?php echo $LeadTable->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $LeadTable->LeadID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->LeadID) ?>',1);"><div id="elh_LeadTable_LeadID" class="LeadTable_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
	<?php if ($LeadTable->sortUrl($LeadTable->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $LeadTable->CustomerID->headerCellClass() ?>"><div id="elh_LeadTable_CustomerID" class="LeadTable_CustomerID"><div class="ew-table-header-caption"><?php echo $LeadTable->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $LeadTable->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->CustomerID) ?>',1);"><div id="elh_LeadTable_CustomerID" class="LeadTable_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->CustomerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
	<?php if ($LeadTable->sortUrl($LeadTable->LeadType) == "") { ?>
		<th data-name="LeadType" class="<?php echo $LeadTable->LeadType->headerCellClass() ?>"><div id="elh_LeadTable_LeadType" class="LeadTable_LeadType"><div class="ew-table-header-caption"><?php echo $LeadTable->LeadType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadType" class="<?php echo $LeadTable->LeadType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->LeadType) ?>',1);"><div id="elh_LeadTable_LeadType" class="LeadTable_LeadType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->LeadType->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->LeadType->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->LeadType->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
	<?php if ($LeadTable->sortUrl($LeadTable->Suburb) == "") { ?>
		<th data-name="Suburb" class="<?php echo $LeadTable->Suburb->headerCellClass() ?>"><div id="elh_LeadTable_Suburb" class="LeadTable_Suburb"><div class="ew-table-header-caption"><?php echo $LeadTable->Suburb->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Suburb" class="<?php echo $LeadTable->Suburb->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->Suburb) ?>',1);"><div id="elh_LeadTable_Suburb" class="LeadTable_Suburb">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->Suburb->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->Suburb->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->Suburb->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<?php if ($LeadTable->sortUrl($LeadTable->ExpectedStart) == "") { ?>
		<th data-name="ExpectedStart" class="<?php echo $LeadTable->ExpectedStart->headerCellClass() ?>"><div id="elh_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart"><div class="ew-table-header-caption"><?php echo $LeadTable->ExpectedStart->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedStart" class="<?php echo $LeadTable->ExpectedStart->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->ExpectedStart) ?>',1);"><div id="elh_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->ExpectedStart->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->ExpectedStart->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->ExpectedStart->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
	<?php if ($LeadTable->sortUrl($LeadTable->DateTaken) == "") { ?>
		<th data-name="DateTaken" class="<?php echo $LeadTable->DateTaken->headerCellClass() ?>"><div id="elh_LeadTable_DateTaken" class="LeadTable_DateTaken"><div class="ew-table-header-caption"><?php echo $LeadTable->DateTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTaken" class="<?php echo $LeadTable->DateTaken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->DateTaken) ?>',1);"><div id="elh_LeadTable_DateTaken" class="LeadTable_DateTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->DateTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->DateTaken->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->DateTaken->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
	<?php if ($LeadTable->sortUrl($LeadTable->TakenBy) == "") { ?>
		<th data-name="TakenBy" class="<?php echo $LeadTable->TakenBy->headerCellClass() ?>"><div id="elh_LeadTable_TakenBy" class="LeadTable_TakenBy"><div class="ew-table-header-caption"><?php echo $LeadTable->TakenBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TakenBy" class="<?php echo $LeadTable->TakenBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->TakenBy) ?>',1);"><div id="elh_LeadTable_TakenBy" class="LeadTable_TakenBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->TakenBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->TakenBy->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->TakenBy->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
	<?php if ($LeadTable->sortUrl($LeadTable->IsComplete) == "") { ?>
		<th data-name="IsComplete" class="<?php echo $LeadTable->IsComplete->headerCellClass() ?>"><div id="elh_LeadTable_IsComplete" class="LeadTable_IsComplete"><div class="ew-table-header-caption"><?php echo $LeadTable->IsComplete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsComplete" class="<?php echo $LeadTable->IsComplete->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadTable->SortUrl($LeadTable->IsComplete) ?>',1);"><div id="elh_LeadTable_IsComplete" class="LeadTable_IsComplete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadTable->IsComplete->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadTable->IsComplete->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadTable->IsComplete->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$LeadTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($LeadTable->ExportAll && $LeadTable->isExport()) {
	$LeadTable_list->StopRec = $LeadTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($LeadTable_list->TotalRecs > $LeadTable_list->StartRec + $LeadTable_list->DisplayRecs - 1)
		$LeadTable_list->StopRec = $LeadTable_list->StartRec + $LeadTable_list->DisplayRecs - 1;
	else
		$LeadTable_list->StopRec = $LeadTable_list->TotalRecs;
}
$LeadTable_list->RecCnt = $LeadTable_list->StartRec - 1;
if ($LeadTable_list->Recordset && !$LeadTable_list->Recordset->EOF) {
	$LeadTable_list->Recordset->moveFirst();
	$selectLimit = $LeadTable_list->UseSelectLimit;
	if (!$selectLimit && $LeadTable_list->StartRec > 1)
		$LeadTable_list->Recordset->move($LeadTable_list->StartRec - 1);
} elseif (!$LeadTable->AllowAddDeleteRow && $LeadTable_list->StopRec == 0) {
	$LeadTable_list->StopRec = $LeadTable->GridAddRowCount;
}

// Initialize aggregate
$LeadTable->RowType = ROWTYPE_AGGREGATEINIT;
$LeadTable->resetAttributes();
$LeadTable_list->renderRow();
while ($LeadTable_list->RecCnt < $LeadTable_list->StopRec) {
	$LeadTable_list->RecCnt++;
	if ($LeadTable_list->RecCnt >= $LeadTable_list->StartRec) {
		$LeadTable_list->RowCnt++;

		// Set up key count
		$LeadTable_list->KeyCount = $LeadTable_list->RowIndex;

		// Init row class and style
		$LeadTable->resetAttributes();
		$LeadTable->CssClass = "";
		if ($LeadTable->isGridAdd()) {
		} else {
			$LeadTable_list->loadRowValues($LeadTable_list->Recordset); // Load row values
		}
		$LeadTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$LeadTable->RowAttrs = array_merge($LeadTable->RowAttrs, array('data-rowindex'=>$LeadTable_list->RowCnt, 'id'=>'r' . $LeadTable_list->RowCnt . '_LeadTable', 'data-rowtype'=>$LeadTable->RowType));

		// Render row
		$LeadTable_list->renderRow();

		// Render list options
		$LeadTable_list->renderListOptions();
?>
	<tr<?php echo $LeadTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadTable_list->ListOptions->render("body", "left", $LeadTable_list->RowCnt);
?>
	<?php if ($LeadTable->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $LeadTable->LeadID->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_LeadID" class="LeadTable_LeadID">
<span<?php echo $LeadTable->LeadID->viewAttributes() ?>>
<?php echo $LeadTable->LeadID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $LeadTable->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_CustomerID" class="LeadTable_CustomerID">
<span<?php echo $LeadTable->CustomerID->viewAttributes() ?>>
<?php echo $LeadTable->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->LeadType->Visible) { // LeadType ?>
		<td data-name="LeadType"<?php echo $LeadTable->LeadType->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_LeadType" class="LeadTable_LeadType">
<span<?php echo $LeadTable->LeadType->viewAttributes() ?>>
<?php echo $LeadTable->LeadType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->Suburb->Visible) { // Suburb ?>
		<td data-name="Suburb"<?php echo $LeadTable->Suburb->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_Suburb" class="LeadTable_Suburb">
<span<?php echo $LeadTable->Suburb->viewAttributes() ?>>
<?php echo $LeadTable->Suburb->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart"<?php echo $LeadTable->ExpectedStart->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_ExpectedStart" class="LeadTable_ExpectedStart">
<span<?php echo $LeadTable->ExpectedStart->viewAttributes() ?>>
<?php echo $LeadTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->DateTaken->Visible) { // DateTaken ?>
		<td data-name="DateTaken"<?php echo $LeadTable->DateTaken->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_DateTaken" class="LeadTable_DateTaken">
<span<?php echo $LeadTable->DateTaken->viewAttributes() ?>>
<?php echo $LeadTable->DateTaken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->TakenBy->Visible) { // TakenBy ?>
		<td data-name="TakenBy"<?php echo $LeadTable->TakenBy->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_TakenBy" class="LeadTable_TakenBy">
<span<?php echo $LeadTable->TakenBy->viewAttributes() ?>>
<?php echo $LeadTable->TakenBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadTable->IsComplete->Visible) { // IsComplete ?>
		<td data-name="IsComplete"<?php echo $LeadTable->IsComplete->cellAttributes() ?>>
<span id="el<?php echo $LeadTable_list->RowCnt ?>_LeadTable_IsComplete" class="LeadTable_IsComplete">
<span<?php echo $LeadTable->IsComplete->viewAttributes() ?>>
<?php echo $LeadTable->IsComplete->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadTable_list->ListOptions->render("body", "right", $LeadTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$LeadTable->isGridAdd())
		$LeadTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$LeadTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($LeadTable_list->Recordset)
	$LeadTable_list->Recordset->Close();
?>
<?php if (!$LeadTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$LeadTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($LeadTable_list->Pager)) $LeadTable_list->Pager = new PrevNextPager($LeadTable_list->StartRec, $LeadTable_list->DisplayRecs, $LeadTable_list->TotalRecs, $LeadTable_list->AutoHidePager) ?>
<?php if ($LeadTable_list->Pager->RecordCount > 0 && $LeadTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($LeadTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $LeadTable_list->pageUrl() ?>start=<?php echo $LeadTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($LeadTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $LeadTable_list->pageUrl() ?>start=<?php echo $LeadTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $LeadTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($LeadTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $LeadTable_list->pageUrl() ?>start=<?php echo $LeadTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($LeadTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $LeadTable_list->pageUrl() ?>start=<?php echo $LeadTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $LeadTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($LeadTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $LeadTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $LeadTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $LeadTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $LeadTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($LeadTable_list->TotalRecs == 0 && !$LeadTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $LeadTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$LeadTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$LeadTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$LeadTable_list->terminate();
?>