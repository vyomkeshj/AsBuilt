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
$Cart_View_list = new Cart_View_list();

// Run the page
$Cart_View_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cart_View_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Cart_View->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fCart_Viewlist = currentForm = new ew.Form("fCart_Viewlist", "list");
fCart_Viewlist.formKeyCountName = '<?php echo $Cart_View_list->FormKeyCountName ?>';

// Form_CustomValidate event
fCart_Viewlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCart_Viewlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Cart_View->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Cart_View_list->TotalRecs > 0 && $Cart_View_list->ExportOptions->visible()) { ?>
<?php $Cart_View_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Cart_View_list->ImportOptions->visible()) { ?>
<?php $Cart_View_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Cart_View_list->renderOtherOptions();
?>
<?php $Cart_View_list->showPageHeader(); ?>
<?php
$Cart_View_list->showMessage();
?>
<?php if ($Cart_View_list->TotalRecs > 0 || $Cart_View->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Cart_View_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Cart_View">
<form name="fCart_Viewlist" id="fCart_Viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Cart_View_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Cart_View_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cart_View">
<div id="gmp_Cart_View" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($Cart_View_list->TotalRecs > 0 || $Cart_View->isGridEdit()) { ?>
<table id="tbl_Cart_Viewlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Cart_View_list->RowType = ROWTYPE_HEADER;

// Render list options
$Cart_View_list->renderListOptions();

// Render list options (header, left)
$Cart_View_list->ListOptions->render("header", "left");
?>
<?php if ($Cart_View->ProductPrice->Visible) { // ProductPrice ?>
	<?php if ($Cart_View->sortUrl($Cart_View->ProductPrice) == "") { ?>
		<th data-name="ProductPrice" class="<?php echo $Cart_View->ProductPrice->headerCellClass() ?>"><div id="elh_Cart_View_ProductPrice" class="Cart_View_ProductPrice"><div class="ew-table-header-caption"><?php echo $Cart_View->ProductPrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductPrice" class="<?php echo $Cart_View->ProductPrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Cart_View->SortUrl($Cart_View->ProductPrice) ?>',1);"><div id="elh_Cart_View_ProductPrice" class="Cart_View_ProductPrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cart_View->ProductPrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cart_View->ProductPrice->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Cart_View->ProductPrice->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cart_View->SessionID->Visible) { // SessionID ?>
	<?php if ($Cart_View->sortUrl($Cart_View->SessionID) == "") { ?>
		<th data-name="SessionID" class="<?php echo $Cart_View->SessionID->headerCellClass() ?>"><div id="elh_Cart_View_SessionID" class="Cart_View_SessionID"><div class="ew-table-header-caption"><?php echo $Cart_View->SessionID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionID" class="<?php echo $Cart_View->SessionID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Cart_View->SortUrl($Cart_View->SessionID) ?>',1);"><div id="elh_Cart_View_SessionID" class="Cart_View_SessionID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cart_View->SessionID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cart_View->SessionID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Cart_View->SessionID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Cart_View_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Cart_View->ExportAll && $Cart_View->isExport()) {
	$Cart_View_list->StopRec = $Cart_View_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Cart_View_list->TotalRecs > $Cart_View_list->StartRec + $Cart_View_list->DisplayRecs - 1)
		$Cart_View_list->StopRec = $Cart_View_list->StartRec + $Cart_View_list->DisplayRecs - 1;
	else
		$Cart_View_list->StopRec = $Cart_View_list->TotalRecs;
}
$Cart_View_list->RecCnt = $Cart_View_list->StartRec - 1;
if ($Cart_View_list->Recordset && !$Cart_View_list->Recordset->EOF) {
	$Cart_View_list->Recordset->moveFirst();
	$selectLimit = $Cart_View_list->UseSelectLimit;
	if (!$selectLimit && $Cart_View_list->StartRec > 1)
		$Cart_View_list->Recordset->move($Cart_View_list->StartRec - 1);
} elseif (!$Cart_View->AllowAddDeleteRow && $Cart_View_list->StopRec == 0) {
	$Cart_View_list->StopRec = $Cart_View->GridAddRowCount;
}

// Initialize aggregate
$Cart_View->RowType = ROWTYPE_AGGREGATEINIT;
$Cart_View->resetAttributes();
$Cart_View_list->renderRow();
while ($Cart_View_list->RecCnt < $Cart_View_list->StopRec) {
	$Cart_View_list->RecCnt++;
	if ($Cart_View_list->RecCnt >= $Cart_View_list->StartRec) {
		$Cart_View_list->RowCnt++;

		// Set up key count
		$Cart_View_list->KeyCount = $Cart_View_list->RowIndex;

		// Init row class and style
		$Cart_View->resetAttributes();
		$Cart_View->CssClass = "";
		if ($Cart_View->isGridAdd()) {
		} else {
			$Cart_View_list->loadRowValues($Cart_View_list->Recordset); // Load row values
		}
		$Cart_View->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Cart_View->RowAttrs = array_merge($Cart_View->RowAttrs, array('data-rowindex'=>$Cart_View_list->RowCnt, 'id'=>'r' . $Cart_View_list->RowCnt . '_Cart_View', 'data-rowtype'=>$Cart_View->RowType));

		// Render row
		$Cart_View_list->renderRow();

		// Render list options
		$Cart_View_list->renderListOptions();
?>
	<tr<?php echo $Cart_View->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Cart_View_list->ListOptions->render("body", "left", $Cart_View_list->RowCnt);
?>
	<?php if ($Cart_View->ProductPrice->Visible) { // ProductPrice ?>
		<td data-name="ProductPrice"<?php echo $Cart_View->ProductPrice->cellAttributes() ?>>
<span id="el<?php echo $Cart_View_list->RowCnt ?>_Cart_View_ProductPrice" class="Cart_View_ProductPrice">
<span<?php echo $Cart_View->ProductPrice->viewAttributes() ?>>
<?php echo $Cart_View->ProductPrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cart_View->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID"<?php echo $Cart_View->SessionID->cellAttributes() ?>>
<span id="el<?php echo $Cart_View_list->RowCnt ?>_Cart_View_SessionID" class="Cart_View_SessionID">
<span<?php echo $Cart_View->SessionID->viewAttributes() ?>>
<?php echo $Cart_View->SessionID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Cart_View_list->ListOptions->render("body", "right", $Cart_View_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$Cart_View->isGridAdd())
		$Cart_View_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$Cart_View->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Cart_View_list->Recordset)
	$Cart_View_list->Recordset->Close();
?>
<?php if (!$Cart_View->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Cart_View->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Cart_View_list->Pager)) $Cart_View_list->Pager = new PrevNextPager($Cart_View_list->StartRec, $Cart_View_list->DisplayRecs, $Cart_View_list->TotalRecs, $Cart_View_list->AutoHidePager) ?>
<?php if ($Cart_View_list->Pager->RecordCount > 0 && $Cart_View_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($Cart_View_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $Cart_View_list->pageUrl() ?>start=<?php echo $Cart_View_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($Cart_View_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $Cart_View_list->pageUrl() ?>start=<?php echo $Cart_View_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $Cart_View_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($Cart_View_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $Cart_View_list->pageUrl() ?>start=<?php echo $Cart_View_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($Cart_View_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $Cart_View_list->pageUrl() ?>start=<?php echo $Cart_View_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $Cart_View_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Cart_View_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Cart_View_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Cart_View_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Cart_View_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Cart_View_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Cart_View_list->TotalRecs == 0 && !$Cart_View->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Cart_View_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Cart_View_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Cart_View->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Cart_View_list->terminate();
?>