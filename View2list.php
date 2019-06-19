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
$View2_list = new View2_list();

// Run the page
$View2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$View2_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$View2->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fView2list = currentForm = new ew.Form("fView2list", "list");
fView2list.formKeyCountName = '<?php echo $View2_list->FormKeyCountName ?>';

// Form_CustomValidate event
fView2list.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fView2list.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$View2->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($View2_list->TotalRecs > 0 && $View2_list->ExportOptions->visible()) { ?>
<?php $View2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($View2_list->ImportOptions->visible()) { ?>
<?php $View2_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$View2_list->renderOtherOptions();
?>
<?php $View2_list->showPageHeader(); ?>
<?php
$View2_list->showMessage();
?>
<?php if ($View2_list->TotalRecs > 0 || $View2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($View2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> View2">
<form name="fView2list" id="fView2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($View2_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $View2_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="View2">
<div id="gmp_View2" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($View2_list->TotalRecs > 0 || $View2->isGridEdit()) { ?>
<table id="tbl_View2list" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$View2_list->RowType = ROWTYPE_HEADER;

// Render list options
$View2_list->renderListOptions();

// Render list options (header, left)
$View2_list->ListOptions->render("header", "left");
?>
<?php if ($View2->ProductID->Visible) { // ProductID ?>
	<?php if ($View2->sortUrl($View2->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $View2->ProductID->headerCellClass() ?>"><div id="elh_View2_ProductID" class="View2_ProductID"><div class="ew-table-header-caption"><?php echo $View2->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $View2->ProductID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View2->SortUrl($View2->ProductID) ?>',1);"><div id="elh_View2_ProductID" class="View2_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View2->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($View2->ProductID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View2->ProductID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View2->ProductPrice->Visible) { // ProductPrice ?>
	<?php if ($View2->sortUrl($View2->ProductPrice) == "") { ?>
		<th data-name="ProductPrice" class="<?php echo $View2->ProductPrice->headerCellClass() ?>"><div id="elh_View2_ProductPrice" class="View2_ProductPrice"><div class="ew-table-header-caption"><?php echo $View2->ProductPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductPrice" class="<?php echo $View2->ProductPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View2->SortUrl($View2->ProductPrice) ?>',1);"><div id="elh_View2_ProductPrice" class="View2_ProductPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View2->ProductPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($View2->ProductPrice->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View2->ProductPrice->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View2->SessionID->Visible) { // SessionID ?>
	<?php if ($View2->sortUrl($View2->SessionID) == "") { ?>
		<th data-name="SessionID" class="<?php echo $View2->SessionID->headerCellClass() ?>"><div id="elh_View2_SessionID" class="View2_SessionID"><div class="ew-table-header-caption"><?php echo $View2->SessionID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionID" class="<?php echo $View2->SessionID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View2->SortUrl($View2->SessionID) ?>',1);"><div id="elh_View2_SessionID" class="View2_SessionID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View2->SessionID->caption() ?></span><span class="ew-table-header-sort"><?php if ($View2->SessionID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View2->SessionID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$View2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($View2->ExportAll && $View2->isExport()) {
	$View2_list->StopRec = $View2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($View2_list->TotalRecs > $View2_list->StartRec + $View2_list->DisplayRecs - 1)
		$View2_list->StopRec = $View2_list->StartRec + $View2_list->DisplayRecs - 1;
	else
		$View2_list->StopRec = $View2_list->TotalRecs;
}
$View2_list->RecCnt = $View2_list->StartRec - 1;
if ($View2_list->Recordset && !$View2_list->Recordset->EOF) {
	$View2_list->Recordset->moveFirst();
	$selectLimit = $View2_list->UseSelectLimit;
	if (!$selectLimit && $View2_list->StartRec > 1)
		$View2_list->Recordset->move($View2_list->StartRec - 1);
} elseif (!$View2->AllowAddDeleteRow && $View2_list->StopRec == 0) {
	$View2_list->StopRec = $View2->GridAddRowCount;
}

// Initialize aggregate
$View2->RowType = ROWTYPE_AGGREGATEINIT;
$View2->resetAttributes();
$View2_list->renderRow();
while ($View2_list->RecCnt < $View2_list->StopRec) {
	$View2_list->RecCnt++;
	if ($View2_list->RecCnt >= $View2_list->StartRec) {
		$View2_list->RowCnt++;

		// Set up key count
		$View2_list->KeyCount = $View2_list->RowIndex;

		// Init row class and style
		$View2->resetAttributes();
		$View2->CssClass = "";
		if ($View2->isGridAdd()) {
		} else {
			$View2_list->loadRowValues($View2_list->Recordset); // Load row values
		}
		$View2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$View2->RowAttrs = array_merge($View2->RowAttrs, array('data-rowindex'=>$View2_list->RowCnt, 'id'=>'r' . $View2_list->RowCnt . '_View2', 'data-rowtype'=>$View2->RowType));

		// Render row
		$View2_list->renderRow();

		// Render list options
		$View2_list->renderListOptions();
?>
	<tr<?php echo $View2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$View2_list->ListOptions->render("body", "left", $View2_list->RowCnt);
?>
	<?php if ($View2->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID"<?php echo $View2->ProductID->cellAttributes() ?>>
<span id="el<?php echo $View2_list->RowCnt ?>_View2_ProductID" class="View2_ProductID">
<span<?php echo $View2->ProductID->viewAttributes() ?>>
<?php echo $View2->ProductID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View2->ProductPrice->Visible) { // ProductPrice ?>
		<td data-name="ProductPrice"<?php echo $View2->ProductPrice->cellAttributes() ?>>
<span id="el<?php echo $View2_list->RowCnt ?>_View2_ProductPrice" class="View2_ProductPrice">
<span<?php echo $View2->ProductPrice->viewAttributes() ?>>
<?php echo $View2->ProductPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View2->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID"<?php echo $View2->SessionID->cellAttributes() ?>>
<span id="el<?php echo $View2_list->RowCnt ?>_View2_SessionID" class="View2_SessionID">
<span<?php echo $View2->SessionID->viewAttributes() ?>>
<?php echo $View2->SessionID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$View2_list->ListOptions->render("body", "right", $View2_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$View2->isGridAdd())
		$View2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$View2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($View2_list->Recordset)
	$View2_list->Recordset->Close();
?>
<?php if (!$View2->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$View2->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($View2_list->Pager)) $View2_list->Pager = new PrevNextPager($View2_list->StartRec, $View2_list->DisplayRecs, $View2_list->TotalRecs, $View2_list->AutoHidePager) ?>
<?php if ($View2_list->Pager->RecordCount > 0 && $View2_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($View2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $View2_list->pageUrl() ?>start=<?php echo $View2_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($View2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $View2_list->pageUrl() ?>start=<?php echo $View2_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $View2_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($View2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $View2_list->pageUrl() ?>start=<?php echo $View2_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($View2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $View2_list->pageUrl() ?>start=<?php echo $View2_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $View2_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($View2_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $View2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $View2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $View2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $View2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($View2_list->TotalRecs == 0 && !$View2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $View2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$View2_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$View2->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$View2_list->terminate();
?>