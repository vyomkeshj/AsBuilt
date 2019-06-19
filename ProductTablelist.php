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
$ProductTable_list = new ProductTable_list();

// Run the page
$ProductTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ProductTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ProductTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fProductTablelist = currentForm = new ew.Form("fProductTablelist", "list");
fProductTablelist.formKeyCountName = '<?php echo $ProductTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fProductTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fProductTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ProductTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ProductTable_list->TotalRecs > 0 && $ProductTable_list->ExportOptions->visible()) { ?>
<?php $ProductTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ProductTable_list->ImportOptions->visible()) { ?>
<?php $ProductTable_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ProductTable_list->renderOtherOptions();
?>
<?php $ProductTable_list->showPageHeader(); ?>
<?php
$ProductTable_list->showMessage();
?>
<?php if ($ProductTable_list->TotalRecs > 0 || $ProductTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ProductTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ProductTable">
<form name="fProductTablelist" id="fProductTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ProductTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ProductTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ProductTable">
<div id="gmp_ProductTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($ProductTable_list->TotalRecs > 0 || $ProductTable->isGridEdit()) { ?>
<table id="tbl_ProductTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ProductTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$ProductTable_list->renderListOptions();

// Render list options (header, left)
$ProductTable_list->ListOptions->render("header", "left");
?>
<?php if ($ProductTable->ProductID->Visible) { // ProductID ?>
	<?php if ($ProductTable->sortUrl($ProductTable->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $ProductTable->ProductID->headerCellClass() ?>"><div id="elh_ProductTable_ProductID" class="ProductTable_ProductID"><div class="ew-table-header-caption"><?php echo $ProductTable->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $ProductTable->ProductID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ProductTable->SortUrl($ProductTable->ProductID) ?>',1);"><div id="elh_ProductTable_ProductID" class="ProductTable_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductTable->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductTable->ProductID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ProductTable->ProductID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ProductTable->ProductPrice->Visible) { // ProductPrice ?>
	<?php if ($ProductTable->sortUrl($ProductTable->ProductPrice) == "") { ?>
		<th data-name="ProductPrice" class="<?php echo $ProductTable->ProductPrice->headerCellClass() ?>"><div id="elh_ProductTable_ProductPrice" class="ProductTable_ProductPrice"><div class="ew-table-header-caption"><?php echo $ProductTable->ProductPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductPrice" class="<?php echo $ProductTable->ProductPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ProductTable->SortUrl($ProductTable->ProductPrice) ?>',1);"><div id="elh_ProductTable_ProductPrice" class="ProductTable_ProductPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ProductTable->ProductPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($ProductTable->ProductPrice->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ProductTable->ProductPrice->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ProductTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ProductTable->ExportAll && $ProductTable->isExport()) {
	$ProductTable_list->StopRec = $ProductTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($ProductTable_list->TotalRecs > $ProductTable_list->StartRec + $ProductTable_list->DisplayRecs - 1)
		$ProductTable_list->StopRec = $ProductTable_list->StartRec + $ProductTable_list->DisplayRecs - 1;
	else
		$ProductTable_list->StopRec = $ProductTable_list->TotalRecs;
}
$ProductTable_list->RecCnt = $ProductTable_list->StartRec - 1;
if ($ProductTable_list->Recordset && !$ProductTable_list->Recordset->EOF) {
	$ProductTable_list->Recordset->moveFirst();
	$selectLimit = $ProductTable_list->UseSelectLimit;
	if (!$selectLimit && $ProductTable_list->StartRec > 1)
		$ProductTable_list->Recordset->move($ProductTable_list->StartRec - 1);
} elseif (!$ProductTable->AllowAddDeleteRow && $ProductTable_list->StopRec == 0) {
	$ProductTable_list->StopRec = $ProductTable->GridAddRowCount;
}

// Initialize aggregate
$ProductTable->RowType = ROWTYPE_AGGREGATEINIT;
$ProductTable->resetAttributes();
$ProductTable_list->renderRow();
while ($ProductTable_list->RecCnt < $ProductTable_list->StopRec) {
	$ProductTable_list->RecCnt++;
	if ($ProductTable_list->RecCnt >= $ProductTable_list->StartRec) {
		$ProductTable_list->RowCnt++;

		// Set up key count
		$ProductTable_list->KeyCount = $ProductTable_list->RowIndex;

		// Init row class and style
		$ProductTable->resetAttributes();
		$ProductTable->CssClass = "";
		if ($ProductTable->isGridAdd()) {
		} else {
			$ProductTable_list->loadRowValues($ProductTable_list->Recordset); // Load row values
		}
		$ProductTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ProductTable->RowAttrs = array_merge($ProductTable->RowAttrs, array('data-rowindex'=>$ProductTable_list->RowCnt, 'id'=>'r' . $ProductTable_list->RowCnt . '_ProductTable', 'data-rowtype'=>$ProductTable->RowType));

		// Render row
		$ProductTable_list->renderRow();

		// Render list options
		$ProductTable_list->renderListOptions();
?>
	<tr<?php echo $ProductTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ProductTable_list->ListOptions->render("body", "left", $ProductTable_list->RowCnt);
?>
	<?php if ($ProductTable->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID"<?php echo $ProductTable->ProductID->cellAttributes() ?>>
<span id="el<?php echo $ProductTable_list->RowCnt ?>_ProductTable_ProductID" class="ProductTable_ProductID">
<span<?php echo $ProductTable->ProductID->viewAttributes() ?>>
<?php echo $ProductTable->ProductID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ProductTable->ProductPrice->Visible) { // ProductPrice ?>
		<td data-name="ProductPrice"<?php echo $ProductTable->ProductPrice->cellAttributes() ?>>
<span id="el<?php echo $ProductTable_list->RowCnt ?>_ProductTable_ProductPrice" class="ProductTable_ProductPrice">
<span<?php echo $ProductTable->ProductPrice->viewAttributes() ?>>
<?php echo $ProductTable->ProductPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ProductTable_list->ListOptions->render("body", "right", $ProductTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$ProductTable->isGridAdd())
		$ProductTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$ProductTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ProductTable_list->Recordset)
	$ProductTable_list->Recordset->Close();
?>
<?php if (!$ProductTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ProductTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ProductTable_list->Pager)) $ProductTable_list->Pager = new PrevNextPager($ProductTable_list->StartRec, $ProductTable_list->DisplayRecs, $ProductTable_list->TotalRecs, $ProductTable_list->AutoHidePager) ?>
<?php if ($ProductTable_list->Pager->RecordCount > 0 && $ProductTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ProductTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ProductTable_list->pageUrl() ?>start=<?php echo $ProductTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ProductTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ProductTable_list->pageUrl() ?>start=<?php echo $ProductTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ProductTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ProductTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ProductTable_list->pageUrl() ?>start=<?php echo $ProductTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ProductTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ProductTable_list->pageUrl() ?>start=<?php echo $ProductTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ProductTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ProductTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ProductTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ProductTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ProductTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ProductTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ProductTable_list->TotalRecs == 0 && !$ProductTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ProductTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ProductTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ProductTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ProductTable_list->terminate();
?>