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
$LeadFileAssociation_list = new LeadFileAssociation_list();

// Run the page
$LeadFileAssociation_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$LeadFileAssociation_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fLeadFileAssociationlist = currentForm = new ew.Form("fLeadFileAssociationlist", "list");
fLeadFileAssociationlist.formKeyCountName = '<?php echo $LeadFileAssociation_list->FormKeyCountName ?>';

// Form_CustomValidate event
fLeadFileAssociationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fLeadFileAssociationlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fLeadFileAssociationlistsrch = currentSearchForm = new ew.Form("fLeadFileAssociationlistsrch");

// Filters
fLeadFileAssociationlistsrch.filterList = <?php echo $LeadFileAssociation_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($LeadFileAssociation_list->TotalRecs > 0 && $LeadFileAssociation_list->ExportOptions->visible()) { ?>
<?php $LeadFileAssociation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($LeadFileAssociation_list->ImportOptions->visible()) { ?>
<?php $LeadFileAssociation_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($LeadFileAssociation_list->SearchOptions->visible()) { ?>
<?php $LeadFileAssociation_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($LeadFileAssociation_list->FilterOptions->visible()) { ?>
<?php $LeadFileAssociation_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$LeadFileAssociation->isExport() || EXPORT_MASTER_RECORD && $LeadFileAssociation->isExport("print")) { ?>
<?php
if ($LeadFileAssociation_list->DbMasterFilter <> "" && $LeadFileAssociation->getCurrentMasterTable() == "LeadTable") {
	if ($LeadFileAssociation_list->MasterRecordExists) {
		include_once "LeadTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$LeadFileAssociation_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$LeadFileAssociation->isExport() && !$LeadFileAssociation->CurrentAction) { ?>
<form name="fLeadFileAssociationlistsrch" id="fLeadFileAssociationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($LeadFileAssociation_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fLeadFileAssociationlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="LeadFileAssociation">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($LeadFileAssociation_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($LeadFileAssociation_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $LeadFileAssociation_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($LeadFileAssociation_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($LeadFileAssociation_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($LeadFileAssociation_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($LeadFileAssociation_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $LeadFileAssociation_list->showPageHeader(); ?>
<?php
$LeadFileAssociation_list->showMessage();
?>
<?php if ($LeadFileAssociation_list->TotalRecs > 0 || $LeadFileAssociation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($LeadFileAssociation_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> LeadFileAssociation">
<form name="fLeadFileAssociationlist" id="fLeadFileAssociationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($LeadFileAssociation_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $LeadFileAssociation_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="LeadFileAssociation">
<?php if ($LeadFileAssociation->getCurrentMasterTable() == "LeadTable" && $LeadFileAssociation->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="LeadTable">
<input type="hidden" name="fk_LeadID" value="<?php echo $LeadFileAssociation->LeadID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_LeadFileAssociation" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($LeadFileAssociation_list->TotalRecs > 0 || $LeadFileAssociation->isGridEdit()) { ?>
<table id="tbl_LeadFileAssociationlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$LeadFileAssociation_list->RowType = ROWTYPE_HEADER;

// Render list options
$LeadFileAssociation_list->renderListOptions();

// Render list options (header, left)
$LeadFileAssociation_list->ListOptions->render("header", "left");
?>
<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
	<?php if ($LeadFileAssociation->sortUrl($LeadFileAssociation->MappingID) == "") { ?>
		<th data-name="MappingID" class="<?php echo $LeadFileAssociation->MappingID->headerCellClass() ?>"><div id="elh_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID"><div class="ew-table-header-caption"><?php echo $LeadFileAssociation->MappingID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MappingID" class="<?php echo $LeadFileAssociation->MappingID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadFileAssociation->SortUrl($LeadFileAssociation->MappingID) ?>',1);"><div id="elh_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadFileAssociation->MappingID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadFileAssociation->MappingID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadFileAssociation->MappingID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
	<?php if ($LeadFileAssociation->sortUrl($LeadFileAssociation->LeadID) == "") { ?>
		<th data-name="LeadID" class="<?php echo $LeadFileAssociation->LeadID->headerCellClass() ?>"><div id="elh_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID"><div class="ew-table-header-caption"><?php echo $LeadFileAssociation->LeadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeadID" class="<?php echo $LeadFileAssociation->LeadID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadFileAssociation->SortUrl($LeadFileAssociation->LeadID) ?>',1);"><div id="elh_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadFileAssociation->LeadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($LeadFileAssociation->LeadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadFileAssociation->LeadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
	<?php if ($LeadFileAssociation->sortUrl($LeadFileAssociation->FileName) == "") { ?>
		<th data-name="FileName" class="<?php echo $LeadFileAssociation->FileName->headerCellClass() ?>"><div id="elh_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName"><div class="ew-table-header-caption"><?php echo $LeadFileAssociation->FileName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FileName" class="<?php echo $LeadFileAssociation->FileName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $LeadFileAssociation->SortUrl($LeadFileAssociation->FileName) ?>',1);"><div id="elh_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $LeadFileAssociation->FileName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($LeadFileAssociation->FileName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($LeadFileAssociation->FileName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$LeadFileAssociation_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($LeadFileAssociation->ExportAll && $LeadFileAssociation->isExport()) {
	$LeadFileAssociation_list->StopRec = $LeadFileAssociation_list->TotalRecs;
} else {

	// Set the last record to display
	if ($LeadFileAssociation_list->TotalRecs > $LeadFileAssociation_list->StartRec + $LeadFileAssociation_list->DisplayRecs - 1)
		$LeadFileAssociation_list->StopRec = $LeadFileAssociation_list->StartRec + $LeadFileAssociation_list->DisplayRecs - 1;
	else
		$LeadFileAssociation_list->StopRec = $LeadFileAssociation_list->TotalRecs;
}
$LeadFileAssociation_list->RecCnt = $LeadFileAssociation_list->StartRec - 1;
if ($LeadFileAssociation_list->Recordset && !$LeadFileAssociation_list->Recordset->EOF) {
	$LeadFileAssociation_list->Recordset->moveFirst();
	$selectLimit = $LeadFileAssociation_list->UseSelectLimit;
	if (!$selectLimit && $LeadFileAssociation_list->StartRec > 1)
		$LeadFileAssociation_list->Recordset->move($LeadFileAssociation_list->StartRec - 1);
} elseif (!$LeadFileAssociation->AllowAddDeleteRow && $LeadFileAssociation_list->StopRec == 0) {
	$LeadFileAssociation_list->StopRec = $LeadFileAssociation->GridAddRowCount;
}

// Initialize aggregate
$LeadFileAssociation->RowType = ROWTYPE_AGGREGATEINIT;
$LeadFileAssociation->resetAttributes();
$LeadFileAssociation_list->renderRow();
while ($LeadFileAssociation_list->RecCnt < $LeadFileAssociation_list->StopRec) {
	$LeadFileAssociation_list->RecCnt++;
	if ($LeadFileAssociation_list->RecCnt >= $LeadFileAssociation_list->StartRec) {
		$LeadFileAssociation_list->RowCnt++;

		// Set up key count
		$LeadFileAssociation_list->KeyCount = $LeadFileAssociation_list->RowIndex;

		// Init row class and style
		$LeadFileAssociation->resetAttributes();
		$LeadFileAssociation->CssClass = "";
		if ($LeadFileAssociation->isGridAdd()) {
		} else {
			$LeadFileAssociation_list->loadRowValues($LeadFileAssociation_list->Recordset); // Load row values
		}
		$LeadFileAssociation->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$LeadFileAssociation->RowAttrs = array_merge($LeadFileAssociation->RowAttrs, array('data-rowindex'=>$LeadFileAssociation_list->RowCnt, 'id'=>'r' . $LeadFileAssociation_list->RowCnt . '_LeadFileAssociation', 'data-rowtype'=>$LeadFileAssociation->RowType));

		// Render row
		$LeadFileAssociation_list->renderRow();

		// Render list options
		$LeadFileAssociation_list->renderListOptions();
?>
	<tr<?php echo $LeadFileAssociation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$LeadFileAssociation_list->ListOptions->render("body", "left", $LeadFileAssociation_list->RowCnt);
?>
	<?php if ($LeadFileAssociation->MappingID->Visible) { // MappingID ?>
		<td data-name="MappingID"<?php echo $LeadFileAssociation->MappingID->cellAttributes() ?>>
<span id="el<?php echo $LeadFileAssociation_list->RowCnt ?>_LeadFileAssociation_MappingID" class="LeadFileAssociation_MappingID">
<span<?php echo $LeadFileAssociation->MappingID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->MappingID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadFileAssociation->LeadID->Visible) { // LeadID ?>
		<td data-name="LeadID"<?php echo $LeadFileAssociation->LeadID->cellAttributes() ?>>
<span id="el<?php echo $LeadFileAssociation_list->RowCnt ?>_LeadFileAssociation_LeadID" class="LeadFileAssociation_LeadID">
<span<?php echo $LeadFileAssociation->LeadID->viewAttributes() ?>>
<?php echo $LeadFileAssociation->LeadID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($LeadFileAssociation->FileName->Visible) { // FileName ?>
		<td data-name="FileName"<?php echo $LeadFileAssociation->FileName->cellAttributes() ?>>
<span id="el<?php echo $LeadFileAssociation_list->RowCnt ?>_LeadFileAssociation_FileName" class="LeadFileAssociation_FileName">
<span<?php echo $LeadFileAssociation->FileName->viewAttributes() ?>>
<?php echo $LeadFileAssociation->FileName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$LeadFileAssociation_list->ListOptions->render("body", "right", $LeadFileAssociation_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$LeadFileAssociation->isGridAdd())
		$LeadFileAssociation_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$LeadFileAssociation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($LeadFileAssociation_list->Recordset)
	$LeadFileAssociation_list->Recordset->Close();
?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$LeadFileAssociation->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($LeadFileAssociation_list->Pager)) $LeadFileAssociation_list->Pager = new PrevNextPager($LeadFileAssociation_list->StartRec, $LeadFileAssociation_list->DisplayRecs, $LeadFileAssociation_list->TotalRecs, $LeadFileAssociation_list->AutoHidePager) ?>
<?php if ($LeadFileAssociation_list->Pager->RecordCount > 0 && $LeadFileAssociation_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($LeadFileAssociation_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $LeadFileAssociation_list->pageUrl() ?>start=<?php echo $LeadFileAssociation_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($LeadFileAssociation_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $LeadFileAssociation_list->pageUrl() ?>start=<?php echo $LeadFileAssociation_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $LeadFileAssociation_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($LeadFileAssociation_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $LeadFileAssociation_list->pageUrl() ?>start=<?php echo $LeadFileAssociation_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($LeadFileAssociation_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $LeadFileAssociation_list->pageUrl() ?>start=<?php echo $LeadFileAssociation_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $LeadFileAssociation_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($LeadFileAssociation_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $LeadFileAssociation_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $LeadFileAssociation_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $LeadFileAssociation_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $LeadFileAssociation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($LeadFileAssociation_list->TotalRecs == 0 && !$LeadFileAssociation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $LeadFileAssociation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$LeadFileAssociation_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$LeadFileAssociation->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$LeadFileAssociation_list->terminate();
?>