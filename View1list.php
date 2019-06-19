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
$View1_list = new View1_list();

// Run the page
$View1_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$View1_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$View1->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fView1list = currentForm = new ew.Form("fView1list", "list");
fView1list.formKeyCountName = '<?php echo $View1_list->FormKeyCountName ?>';

// Form_CustomValidate event
fView1list.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fView1list.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fView1listsrch = currentSearchForm = new ew.Form("fView1listsrch");

// Filters
fView1listsrch.filterList = <?php echo $View1_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$View1->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($View1_list->TotalRecs > 0 && $View1_list->ExportOptions->visible()) { ?>
<?php $View1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($View1_list->ImportOptions->visible()) { ?>
<?php $View1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($View1_list->SearchOptions->visible()) { ?>
<?php $View1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($View1_list->FilterOptions->visible()) { ?>
<?php $View1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$View1_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$View1->isExport() && !$View1->CurrentAction) { ?>
<form name="fView1listsrch" id="fView1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($View1_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fView1listsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="View1">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($View1_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($View1_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $View1_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $View1_list->showPageHeader(); ?>
<?php
$View1_list->showMessage();
?>
<?php if ($View1_list->TotalRecs > 0 || $View1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($View1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> View1">
<form name="fView1list" id="fView1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($View1_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $View1_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="View1">
<div id="gmp_View1" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($View1_list->TotalRecs > 0 || $View1->isGridEdit()) { ?>
<table id="tbl_View1list" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$View1_list->RowType = ROWTYPE_HEADER;

// Render list options
$View1_list->renderListOptions();

// Render list options (header, left)
$View1_list->ListOptions->render("header", "left");
?>
<?php if ($View1->LeadID->Visible) { // LeadID ?>
	<?php if ($View1->sortUrl($View1->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $View1->LeadID->headerCellClass() ?>"><div id="elh_View1_LeadID" class="View1_LeadID"><div class="ew-table-header-caption"><?php echo $View1->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $View1->LeadID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->LeadID) ?>',1);"><div id="elh_View1_LeadID" class="View1_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->Suburb->Visible) { // Suburb ?>
	<?php if ($View1->sortUrl($View1->Suburb) == "") { ?>
		<th data-name="Suburb" class="<?php echo $View1->Suburb->headerCellClass() ?>"><div id="elh_View1_Suburb" class="View1_Suburb"><div class="ew-table-header-caption"><?php echo $View1->Suburb->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Suburb" class="<?php echo $View1->Suburb->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->Suburb) ?>',1);"><div id="elh_View1_Suburb" class="View1_Suburb">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->Suburb->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->Suburb->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->Suburb->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->ExpectedStart->Visible) { // ExpectedStart ?>
	<?php if ($View1->sortUrl($View1->ExpectedStart) == "") { ?>
		<th data-name="ExpectedStart" class="<?php echo $View1->ExpectedStart->headerCellClass() ?>"><div id="elh_View1_ExpectedStart" class="View1_ExpectedStart"><div class="ew-table-header-caption"><?php echo $View1->ExpectedStart->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedStart" class="<?php echo $View1->ExpectedStart->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->ExpectedStart) ?>',1);"><div id="elh_View1_ExpectedStart" class="View1_ExpectedStart">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->ExpectedStart->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->ExpectedStart->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->ExpectedStart->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->DateTaken->Visible) { // DateTaken ?>
	<?php if ($View1->sortUrl($View1->DateTaken) == "") { ?>
		<th data-name="DateTaken" class="<?php echo $View1->DateTaken->headerCellClass() ?>"><div id="elh_View1_DateTaken" class="View1_DateTaken"><div class="ew-table-header-caption"><?php echo $View1->DateTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateTaken" class="<?php echo $View1->DateTaken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->DateTaken) ?>',1);"><div id="elh_View1_DateTaken" class="View1_DateTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->DateTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->DateTaken->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->DateTaken->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->TakenBy->Visible) { // TakenBy ?>
	<?php if ($View1->sortUrl($View1->TakenBy) == "") { ?>
		<th data-name="TakenBy" class="<?php echo $View1->TakenBy->headerCellClass() ?>"><div id="elh_View1_TakenBy" class="View1_TakenBy"><div class="ew-table-header-caption"><?php echo $View1->TakenBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TakenBy" class="<?php echo $View1->TakenBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->TakenBy) ?>',1);"><div id="elh_View1_TakenBy" class="View1_TakenBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->TakenBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->TakenBy->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->TakenBy->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->IsComplete->Visible) { // IsComplete ?>
	<?php if ($View1->sortUrl($View1->IsComplete) == "") { ?>
		<th data-name="IsComplete" class="<?php echo $View1->IsComplete->headerCellClass() ?>"><div id="elh_View1_IsComplete" class="View1_IsComplete"><div class="ew-table-header-caption"><?php echo $View1->IsComplete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IsComplete" class="<?php echo $View1->IsComplete->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->IsComplete) ?>',1);"><div id="elh_View1_IsComplete" class="View1_IsComplete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->IsComplete->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->IsComplete->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->IsComplete->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->CustomerName->Visible) { // CustomerName ?>
	<?php if ($View1->sortUrl($View1->CustomerName) == "") { ?>
		<th data-name="CustomerName" class="<?php echo $View1->CustomerName->headerCellClass() ?>"><div id="elh_View1_CustomerName" class="View1_CustomerName"><div class="ew-table-header-caption"><?php echo $View1->CustomerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerName" class="<?php echo $View1->CustomerName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->CustomerName) ?>',1);"><div id="elh_View1_CustomerName" class="View1_CustomerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->CustomerName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->CustomerName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->CustomerName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->CustomerID->Visible) { // CustomerID ?>
	<?php if ($View1->sortUrl($View1->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $View1->CustomerID->headerCellClass() ?>"><div id="elh_View1_CustomerID" class="View1_CustomerID"><div class="ew-table-header-caption"><?php echo $View1->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $View1->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->CustomerID) ?>',1);"><div id="elh_View1_CustomerID" class="View1_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->CustomerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->Address->Visible) { // Address ?>
	<?php if ($View1->sortUrl($View1->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $View1->Address->headerCellClass() ?>"><div id="elh_View1_Address" class="View1_Address"><div class="ew-table-header-caption"><?php echo $View1->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $View1->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->Address) ?>',1);"><div id="elh_View1_Address" class="View1_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$View1_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($View1->ExportAll && $View1->isExport()) {
	$View1_list->StopRec = $View1_list->TotalRecs;
} else {

	// Set the last record to display
	if ($View1_list->TotalRecs > $View1_list->StartRec + $View1_list->DisplayRecs - 1)
		$View1_list->StopRec = $View1_list->StartRec + $View1_list->DisplayRecs - 1;
	else
		$View1_list->StopRec = $View1_list->TotalRecs;
}
$View1_list->RecCnt = $View1_list->StartRec - 1;
if ($View1_list->Recordset && !$View1_list->Recordset->EOF) {
	$View1_list->Recordset->moveFirst();
	$selectLimit = $View1_list->UseSelectLimit;
	if (!$selectLimit && $View1_list->StartRec > 1)
		$View1_list->Recordset->move($View1_list->StartRec - 1);
} elseif (!$View1->AllowAddDeleteRow && $View1_list->StopRec == 0) {
	$View1_list->StopRec = $View1->GridAddRowCount;
}

// Initialize aggregate
$View1->RowType = ROWTYPE_AGGREGATEINIT;
$View1->resetAttributes();
$View1_list->renderRow();
while ($View1_list->RecCnt < $View1_list->StopRec) {
	$View1_list->RecCnt++;
	if ($View1_list->RecCnt >= $View1_list->StartRec) {
		$View1_list->RowCnt++;

		// Set up key count
		$View1_list->KeyCount = $View1_list->RowIndex;

		// Init row class and style
		$View1->resetAttributes();
		$View1->CssClass = "";
		if ($View1->isGridAdd()) {
		} else {
			$View1_list->loadRowValues($View1_list->Recordset); // Load row values
		}
		$View1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$View1->RowAttrs = array_merge($View1->RowAttrs, array('data-rowindex'=>$View1_list->RowCnt, 'id'=>'r' . $View1_list->RowCnt . '_View1', 'data-rowtype'=>$View1->RowType));

		// Render row
		$View1_list->renderRow();

		// Render list options
		$View1_list->renderListOptions();
?>
	<tr<?php echo $View1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$View1_list->ListOptions->render("body", "left", $View1_list->RowCnt);
?>
	<?php if ($View1->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $View1->LeadID->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_LeadID" class="View1_LeadID">
<span<?php echo $View1->LeadID->viewAttributes() ?>>
<?php echo $View1->LeadID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->Suburb->Visible) { // Suburb ?>
		<td data-name="Suburb"<?php echo $View1->Suburb->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_Suburb" class="View1_Suburb">
<span<?php echo $View1->Suburb->viewAttributes() ?>>
<?php echo $View1->Suburb->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart"<?php echo $View1->ExpectedStart->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_ExpectedStart" class="View1_ExpectedStart">
<span<?php echo $View1->ExpectedStart->viewAttributes() ?>>
<?php echo $View1->ExpectedStart->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->DateTaken->Visible) { // DateTaken ?>
		<td data-name="DateTaken"<?php echo $View1->DateTaken->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_DateTaken" class="View1_DateTaken">
<span<?php echo $View1->DateTaken->viewAttributes() ?>>
<?php echo $View1->DateTaken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->TakenBy->Visible) { // TakenBy ?>
		<td data-name="TakenBy"<?php echo $View1->TakenBy->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_TakenBy" class="View1_TakenBy">
<span<?php echo $View1->TakenBy->viewAttributes() ?>>
<?php echo $View1->TakenBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->IsComplete->Visible) { // IsComplete ?>
		<td data-name="IsComplete"<?php echo $View1->IsComplete->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_IsComplete" class="View1_IsComplete">
<span<?php echo $View1->IsComplete->viewAttributes() ?>>
<?php echo $View1->IsComplete->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->CustomerName->Visible) { // CustomerName ?>
		<td data-name="CustomerName"<?php echo $View1->CustomerName->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_CustomerName" class="View1_CustomerName">
<span<?php echo $View1->CustomerName->viewAttributes() ?>>
<?php echo $View1->CustomerName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $View1->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_CustomerID" class="View1_CustomerID">
<span<?php echo $View1->CustomerID->viewAttributes() ?>>
<?php echo $View1->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $View1->Address->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_Address" class="View1_Address">
<span<?php echo $View1->Address->viewAttributes() ?>>
<?php echo $View1->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$View1_list->ListOptions->render("body", "right", $View1_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$View1->isGridAdd())
		$View1_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$View1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($View1_list->Recordset)
	$View1_list->Recordset->Close();
?>
<?php if (!$View1->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$View1->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($View1_list->Pager)) $View1_list->Pager = new PrevNextPager($View1_list->StartRec, $View1_list->DisplayRecs, $View1_list->TotalRecs, $View1_list->AutoHidePager) ?>
<?php if ($View1_list->Pager->RecordCount > 0 && $View1_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($View1_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($View1_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $View1_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($View1_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($View1_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $View1_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($View1_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $View1_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $View1_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $View1_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $View1_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($View1_list->TotalRecs == 0 && !$View1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $View1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$View1_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$View1->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$View1_list->terminate();
?>