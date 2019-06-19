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
$CartTable_list = new CartTable_list();

// Run the page
$CartTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$CartTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$CartTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fCartTablelist = currentForm = new ew.Form("fCartTablelist", "list");
fCartTablelist.formKeyCountName = '<?php echo $CartTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fCartTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fCartTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$CartTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($CartTable_list->TotalRecs > 0 && $CartTable_list->ExportOptions->visible()) { ?>
<?php $CartTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($CartTable_list->ImportOptions->visible()) { ?>
<?php $CartTable_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$CartTable->isExport() || EXPORT_MASTER_RECORD && $CartTable->isExport("print")) { ?>
<?php
if ($CartTable_list->DbMasterFilter <> "" && $CartTable->getCurrentMasterTable() == "JobSessionTable") {
	if ($CartTable_list->MasterRecordExists) {
		include_once "JobSessionTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$CartTable_list->renderOtherOptions();
?>
<?php $CartTable_list->showPageHeader(); ?>
<?php
$CartTable_list->showMessage();
?>
<?php if ($CartTable_list->TotalRecs > 0 || $CartTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($CartTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> CartTable">
<form name="fCartTablelist" id="fCartTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($CartTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $CartTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="CartTable">
<?php if ($CartTable->getCurrentMasterTable() == "JobSessionTable" && $CartTable->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="JobSessionTable">
<input type="hidden" name="fk_SessionID" value="<?php echo $CartTable->SessionID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_CartTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($CartTable_list->TotalRecs > 0 || $CartTable->isGridEdit()) { ?>
<table id="tbl_CartTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$CartTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$CartTable_list->renderListOptions();

// Render list options (header, left)
$CartTable_list->ListOptions->render("header", "left");
?>
<?php if ($CartTable->Serial->Visible) { // Serial ?>
	<?php if ($CartTable->sortUrl($CartTable->Serial) == "") { ?>
		<th data-name="Serial" class="<?php echo $CartTable->Serial->headerCellClass() ?>"><div id="elh_CartTable_Serial" class="CartTable_Serial"><div class="ew-table-header-caption"><?php echo $CartTable->Serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Serial" class="<?php echo $CartTable->Serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CartTable->SortUrl($CartTable->Serial) ?>',1);"><div id="elh_CartTable_Serial" class="CartTable_Serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartTable->Serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartTable->Serial->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CartTable->Serial->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
	<?php if ($CartTable->sortUrl($CartTable->SessionID) == "") { ?>
		<th data-name="SessionID" class="<?php echo $CartTable->SessionID->headerCellClass() ?>"><div id="elh_CartTable_SessionID" class="CartTable_SessionID"><div class="ew-table-header-caption"><?php echo $CartTable->SessionID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionID" class="<?php echo $CartTable->SessionID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CartTable->SortUrl($CartTable->SessionID) ?>',1);"><div id="elh_CartTable_SessionID" class="CartTable_SessionID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartTable->SessionID->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartTable->SessionID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CartTable->SessionID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
	<?php if ($CartTable->sortUrl($CartTable->ProductID) == "") { ?>
		<th data-name="ProductID" class="<?php echo $CartTable->ProductID->headerCellClass() ?>"><div id="elh_CartTable_ProductID" class="CartTable_ProductID"><div class="ew-table-header-caption"><?php echo $CartTable->ProductID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProductID" class="<?php echo $CartTable->ProductID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $CartTable->SortUrl($CartTable->ProductID) ?>',1);"><div id="elh_CartTable_ProductID" class="CartTable_ProductID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $CartTable->ProductID->caption() ?></span><span class="ew-table-header-sort"><?php if ($CartTable->ProductID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($CartTable->ProductID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$CartTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($CartTable->ExportAll && $CartTable->isExport()) {
	$CartTable_list->StopRec = $CartTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($CartTable_list->TotalRecs > $CartTable_list->StartRec + $CartTable_list->DisplayRecs - 1)
		$CartTable_list->StopRec = $CartTable_list->StartRec + $CartTable_list->DisplayRecs - 1;
	else
		$CartTable_list->StopRec = $CartTable_list->TotalRecs;
}
$CartTable_list->RecCnt = $CartTable_list->StartRec - 1;
if ($CartTable_list->Recordset && !$CartTable_list->Recordset->EOF) {
	$CartTable_list->Recordset->moveFirst();
	$selectLimit = $CartTable_list->UseSelectLimit;
	if (!$selectLimit && $CartTable_list->StartRec > 1)
		$CartTable_list->Recordset->move($CartTable_list->StartRec - 1);
} elseif (!$CartTable->AllowAddDeleteRow && $CartTable_list->StopRec == 0) {
	$CartTable_list->StopRec = $CartTable->GridAddRowCount;
}

// Initialize aggregate
$CartTable->RowType = ROWTYPE_AGGREGATEINIT;
$CartTable->resetAttributes();
$CartTable_list->renderRow();
while ($CartTable_list->RecCnt < $CartTable_list->StopRec) {
	$CartTable_list->RecCnt++;
	if ($CartTable_list->RecCnt >= $CartTable_list->StartRec) {
		$CartTable_list->RowCnt++;

		// Set up key count
		$CartTable_list->KeyCount = $CartTable_list->RowIndex;

		// Init row class and style
		$CartTable->resetAttributes();
		$CartTable->CssClass = "";
		if ($CartTable->isGridAdd()) {
		} else {
			$CartTable_list->loadRowValues($CartTable_list->Recordset); // Load row values
		}
		$CartTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$CartTable->RowAttrs = array_merge($CartTable->RowAttrs, array('data-rowindex'=>$CartTable_list->RowCnt, 'id'=>'r' . $CartTable_list->RowCnt . '_CartTable', 'data-rowtype'=>$CartTable->RowType));

		// Render row
		$CartTable_list->renderRow();

		// Render list options
		$CartTable_list->renderListOptions();
?>
	<tr<?php echo $CartTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$CartTable_list->ListOptions->render("body", "left", $CartTable_list->RowCnt);
?>
	<?php if ($CartTable->Serial->Visible) { // Serial ?>
		<td data-name="Serial"<?php echo $CartTable->Serial->cellAttributes() ?>>
<span id="el<?php echo $CartTable_list->RowCnt ?>_CartTable_Serial" class="CartTable_Serial">
<span<?php echo $CartTable->Serial->viewAttributes() ?>>
<?php echo $CartTable->Serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($CartTable->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID"<?php echo $CartTable->SessionID->cellAttributes() ?>>
<span id="el<?php echo $CartTable_list->RowCnt ?>_CartTable_SessionID" class="CartTable_SessionID">
<span<?php echo $CartTable->SessionID->viewAttributes() ?>>
<?php echo $CartTable->SessionID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($CartTable->ProductID->Visible) { // ProductID ?>
		<td data-name="ProductID"<?php echo $CartTable->ProductID->cellAttributes() ?>>
<span id="el<?php echo $CartTable_list->RowCnt ?>_CartTable_ProductID" class="CartTable_ProductID">
<span<?php echo $CartTable->ProductID->viewAttributes() ?>>
<?php echo $CartTable->ProductID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$CartTable_list->ListOptions->render("body", "right", $CartTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$CartTable->isGridAdd())
		$CartTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$CartTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($CartTable_list->Recordset)
	$CartTable_list->Recordset->Close();
?>
<?php if (!$CartTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$CartTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($CartTable_list->Pager)) $CartTable_list->Pager = new PrevNextPager($CartTable_list->StartRec, $CartTable_list->DisplayRecs, $CartTable_list->TotalRecs, $CartTable_list->AutoHidePager) ?>
<?php if ($CartTable_list->Pager->RecordCount > 0 && $CartTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($CartTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $CartTable_list->pageUrl() ?>start=<?php echo $CartTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($CartTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $CartTable_list->pageUrl() ?>start=<?php echo $CartTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $CartTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($CartTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $CartTable_list->pageUrl() ?>start=<?php echo $CartTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($CartTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $CartTable_list->pageUrl() ?>start=<?php echo $CartTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $CartTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($CartTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $CartTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $CartTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $CartTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $CartTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($CartTable_list->TotalRecs == 0 && !$CartTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $CartTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$CartTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$CartTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$CartTable_list->terminate();
?>