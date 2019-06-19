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
$CustomerTable_list = new CustomerTable_list();

// Run the page
$CustomerTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CustomerTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$CustomerTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fCustomerTablelist = currentForm = new ew.Form("fCustomerTablelist", "list");
fCustomerTablelist.formKeyCountName = '<?php echo $CustomerTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fCustomerTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCustomerTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fCustomerTablelistsrch = currentSearchForm = new ew.Form("fCustomerTablelistsrch");

// Filters
fCustomerTablelistsrch.filterList = <?php echo $CustomerTable_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$CustomerTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($CustomerTable_list->TotalRecs > 0 && $CustomerTable_list->ExportOptions->visible()) { ?>
<?php $CustomerTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($CustomerTable_list->ImportOptions->visible()) { ?>
<?php $CustomerTable_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($CustomerTable_list->SearchOptions->visible()) { ?>
<?php $CustomerTable_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($CustomerTable_list->FilterOptions->visible()) { ?>
<?php $CustomerTable_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$CustomerTable_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$CustomerTable->isExport() && !$CustomerTable->CurrentAction) { ?>
<form name="fCustomerTablelistsrch" id="fCustomerTablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($CustomerTable_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fCustomerTablelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="CustomerTable">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($CustomerTable_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($CustomerTable_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $CustomerTable_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($CustomerTable_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($CustomerTable_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($CustomerTable_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($CustomerTable_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $CustomerTable_list->showPageHeader(); ?>
<?php
$CustomerTable_list->showMessage();
?>
<?php if ($CustomerTable_list->TotalRecs > 0 || $CustomerTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($CustomerTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CustomerTable">
<form name="fCustomerTablelist" id="fCustomerTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CustomerTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CustomerTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CustomerTable">
<div id="gmp_CustomerTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($CustomerTable_list->TotalRecs > 0 || $CustomerTable->isGridEdit()) { ?>
<table id="tbl_CustomerTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$CustomerTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$CustomerTable_list->renderListOptions();

// Render list options (header, left)
$CustomerTable_list->ListOptions->render("header", "left");
?>
<?php if ($CustomerTable->CustomerID->Visible) { // CustomerID ?>
	<?php if ($CustomerTable->sortUrl($CustomerTable->CustomerID) == "") { ?>
		<th data-name="CustomerID" class="<?php echo $CustomerTable->CustomerID->headerCellClass() ?>"><div id="elh_CustomerTable_CustomerID" class="CustomerTable_CustomerID"><div class="ew-table-header-caption"><?php echo $CustomerTable->CustomerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerID" class="<?php echo $CustomerTable->CustomerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CustomerTable->SortUrl($CustomerTable->CustomerID) ?>',1);"><div id="elh_CustomerTable_CustomerID" class="CustomerTable_CustomerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CustomerTable->CustomerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($CustomerTable->CustomerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CustomerTable->CustomerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
	<?php if ($CustomerTable->sortUrl($CustomerTable->CustomerName) == "") { ?>
		<th data-name="CustomerName" class="<?php echo $CustomerTable->CustomerName->headerCellClass() ?>"><div id="elh_CustomerTable_CustomerName" class="CustomerTable_CustomerName"><div class="ew-table-header-caption"><?php echo $CustomerTable->CustomerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerName" class="<?php echo $CustomerTable->CustomerName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CustomerTable->SortUrl($CustomerTable->CustomerName) ?>',1);"><div id="elh_CustomerTable_CustomerName" class="CustomerTable_CustomerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CustomerTable->CustomerName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CustomerTable->CustomerName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CustomerTable->CustomerName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
	<?php if ($CustomerTable->sortUrl($CustomerTable->CustomerEmail) == "") { ?>
		<th data-name="CustomerEmail" class="<?php echo $CustomerTable->CustomerEmail->headerCellClass() ?>"><div id="elh_CustomerTable_CustomerEmail" class="CustomerTable_CustomerEmail"><div class="ew-table-header-caption"><?php echo $CustomerTable->CustomerEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerEmail" class="<?php echo $CustomerTable->CustomerEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CustomerTable->SortUrl($CustomerTable->CustomerEmail) ?>',1);"><div id="elh_CustomerTable_CustomerEmail" class="CustomerTable_CustomerEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CustomerTable->CustomerEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CustomerTable->CustomerEmail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CustomerTable->CustomerEmail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
	<?php if ($CustomerTable->sortUrl($CustomerTable->BillingAddress) == "") { ?>
		<th data-name="BillingAddress" class="<?php echo $CustomerTable->BillingAddress->headerCellClass() ?>"><div id="elh_CustomerTable_BillingAddress" class="CustomerTable_BillingAddress"><div class="ew-table-header-caption"><?php echo $CustomerTable->BillingAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillingAddress" class="<?php echo $CustomerTable->BillingAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CustomerTable->SortUrl($CustomerTable->BillingAddress) ?>',1);"><div id="elh_CustomerTable_BillingAddress" class="CustomerTable_BillingAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CustomerTable->BillingAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($CustomerTable->BillingAddress->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CustomerTable->BillingAddress->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
	<?php if ($CustomerTable->sortUrl($CustomerTable->CustomerTelephone) == "") { ?>
		<th data-name="CustomerTelephone" class="<?php echo $CustomerTable->CustomerTelephone->headerCellClass() ?>"><div id="elh_CustomerTable_CustomerTelephone" class="CustomerTable_CustomerTelephone"><div class="ew-table-header-caption"><?php echo $CustomerTable->CustomerTelephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CustomerTelephone" class="<?php echo $CustomerTable->CustomerTelephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CustomerTable->SortUrl($CustomerTable->CustomerTelephone) ?>',1);"><div id="elh_CustomerTable_CustomerTelephone" class="CustomerTable_CustomerTelephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CustomerTable->CustomerTelephone->caption() ?></span><span class="ew-table-header-sort"><?php if ($CustomerTable->CustomerTelephone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CustomerTable->CustomerTelephone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$CustomerTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($CustomerTable->ExportAll && $CustomerTable->isExport()) {
	$CustomerTable_list->StopRec = $CustomerTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($CustomerTable_list->TotalRecs > $CustomerTable_list->StartRec + $CustomerTable_list->DisplayRecs - 1)
		$CustomerTable_list->StopRec = $CustomerTable_list->StartRec + $CustomerTable_list->DisplayRecs - 1;
	else
		$CustomerTable_list->StopRec = $CustomerTable_list->TotalRecs;
}
$CustomerTable_list->RecCnt = $CustomerTable_list->StartRec - 1;
if ($CustomerTable_list->Recordset && !$CustomerTable_list->Recordset->EOF) {
	$CustomerTable_list->Recordset->moveFirst();
	$selectLimit = $CustomerTable_list->UseSelectLimit;
	if (!$selectLimit && $CustomerTable_list->StartRec > 1)
		$CustomerTable_list->Recordset->move($CustomerTable_list->StartRec - 1);
} elseif (!$CustomerTable->AllowAddDeleteRow && $CustomerTable_list->StopRec == 0) {
	$CustomerTable_list->StopRec = $CustomerTable->GridAddRowCount;
}

// Initialize aggregate
$CustomerTable->RowType = ROWTYPE_AGGREGATEINIT;
$CustomerTable->resetAttributes();
$CustomerTable_list->renderRow();
while ($CustomerTable_list->RecCnt < $CustomerTable_list->StopRec) {
	$CustomerTable_list->RecCnt++;
	if ($CustomerTable_list->RecCnt >= $CustomerTable_list->StartRec) {
		$CustomerTable_list->RowCnt++;

		// Set up key count
		$CustomerTable_list->KeyCount = $CustomerTable_list->RowIndex;

		// Init row class and style
		$CustomerTable->resetAttributes();
		$CustomerTable->CssClass = "";
		if ($CustomerTable->isGridAdd()) {
		} else {
			$CustomerTable_list->loadRowValues($CustomerTable_list->Recordset); // Load row values
		}
		$CustomerTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$CustomerTable->RowAttrs = array_merge($CustomerTable->RowAttrs, array('data-rowindex'=>$CustomerTable_list->RowCnt, 'id'=>'r' . $CustomerTable_list->RowCnt . '_CustomerTable', 'data-rowtype'=>$CustomerTable->RowType));

		// Render row
		$CustomerTable_list->renderRow();

		// Render list options
		$CustomerTable_list->renderListOptions();
?>
	<tr<?php echo $CustomerTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CustomerTable_list->ListOptions->render("body", "left", $CustomerTable_list->RowCnt);
?>
	<?php if ($CustomerTable->CustomerID->Visible) { // CustomerID ?>
		<td data-name="CustomerID"<?php echo $CustomerTable->CustomerID->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_list->RowCnt ?>_CustomerTable_CustomerID" class="CustomerTable_CustomerID">
<span<?php echo $CustomerTable->CustomerID->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($CustomerTable->CustomerName->Visible) { // CustomerName ?>
		<td data-name="CustomerName"<?php echo $CustomerTable->CustomerName->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_list->RowCnt ?>_CustomerTable_CustomerName" class="CustomerTable_CustomerName">
<span<?php echo $CustomerTable->CustomerName->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($CustomerTable->CustomerEmail->Visible) { // CustomerEmail ?>
		<td data-name="CustomerEmail"<?php echo $CustomerTable->CustomerEmail->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_list->RowCnt ?>_CustomerTable_CustomerEmail" class="CustomerTable_CustomerEmail">
<span<?php echo $CustomerTable->CustomerEmail->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($CustomerTable->BillingAddress->Visible) { // BillingAddress ?>
		<td data-name="BillingAddress"<?php echo $CustomerTable->BillingAddress->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_list->RowCnt ?>_CustomerTable_BillingAddress" class="CustomerTable_BillingAddress">
<span<?php echo $CustomerTable->BillingAddress->viewAttributes() ?>>
<?php echo $CustomerTable->BillingAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($CustomerTable->CustomerTelephone->Visible) { // CustomerTelephone ?>
		<td data-name="CustomerTelephone"<?php echo $CustomerTable->CustomerTelephone->cellAttributes() ?>>
<span id="el<?php echo $CustomerTable_list->RowCnt ?>_CustomerTable_CustomerTelephone" class="CustomerTable_CustomerTelephone">
<span<?php echo $CustomerTable->CustomerTelephone->viewAttributes() ?>>
<?php echo $CustomerTable->CustomerTelephone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CustomerTable_list->ListOptions->render("body", "right", $CustomerTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$CustomerTable->isGridAdd())
		$CustomerTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$CustomerTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($CustomerTable_list->Recordset)
	$CustomerTable_list->Recordset->Close();
?>
<?php if (!$CustomerTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$CustomerTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($CustomerTable_list->Pager)) $CustomerTable_list->Pager = new PrevNextPager($CustomerTable_list->StartRec, $CustomerTable_list->DisplayRecs, $CustomerTable_list->TotalRecs, $CustomerTable_list->AutoHidePager) ?>
<?php if ($CustomerTable_list->Pager->RecordCount > 0 && $CustomerTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($CustomerTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $CustomerTable_list->pageUrl() ?>start=<?php echo $CustomerTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($CustomerTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $CustomerTable_list->pageUrl() ?>start=<?php echo $CustomerTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $CustomerTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($CustomerTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $CustomerTable_list->pageUrl() ?>start=<?php echo $CustomerTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($CustomerTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $CustomerTable_list->pageUrl() ?>start=<?php echo $CustomerTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $CustomerTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($CustomerTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $CustomerTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $CustomerTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $CustomerTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CustomerTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($CustomerTable_list->TotalRecs == 0 && !$CustomerTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $CustomerTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$CustomerTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$CustomerTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$CustomerTable_list->terminate();
?>