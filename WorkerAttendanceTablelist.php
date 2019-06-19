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
$WorkerAttendanceTable_list = new WorkerAttendanceTable_list();

// Run the page
$WorkerAttendanceTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$WorkerAttendanceTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fWorkerAttendanceTablelist = currentForm = new ew.Form("fWorkerAttendanceTablelist", "list");
fWorkerAttendanceTablelist.formKeyCountName = '<?php echo $WorkerAttendanceTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fWorkerAttendanceTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fWorkerAttendanceTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($WorkerAttendanceTable_list->TotalRecs > 0 && $WorkerAttendanceTable_list->ExportOptions->visible()) { ?>
<?php $WorkerAttendanceTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($WorkerAttendanceTable_list->ImportOptions->visible()) { ?>
<?php $WorkerAttendanceTable_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$WorkerAttendanceTable_list->renderOtherOptions();
?>
<?php $WorkerAttendanceTable_list->showPageHeader(); ?>
<?php
$WorkerAttendanceTable_list->showMessage();
?>
<?php if ($WorkerAttendanceTable_list->TotalRecs > 0 || $WorkerAttendanceTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($WorkerAttendanceTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> WorkerAttendanceTable">
<form name="fWorkerAttendanceTablelist" id="fWorkerAttendanceTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($WorkerAttendanceTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $WorkerAttendanceTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="WorkerAttendanceTable">
<div id="gmp_WorkerAttendanceTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($WorkerAttendanceTable_list->TotalRecs > 0 || $WorkerAttendanceTable->isGridEdit()) { ?>
<table id="tbl_WorkerAttendanceTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$WorkerAttendanceTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$WorkerAttendanceTable_list->renderListOptions();

// Render list options (header, left)
$WorkerAttendanceTable_list->ListOptions->render("header", "left");
?>
<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
	<?php if ($WorkerAttendanceTable->sortUrl($WorkerAttendanceTable->JobWorkerId) == "") { ?>
		<th data-name="JobWorkerId" class="<?php echo $WorkerAttendanceTable->JobWorkerId->headerCellClass() ?>"><div id="elh_WorkerAttendanceTable_JobWorkerId" class="WorkerAttendanceTable_JobWorkerId"><div class="ew-table-header-caption"><?php echo $WorkerAttendanceTable->JobWorkerId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerId" class="<?php echo $WorkerAttendanceTable->JobWorkerId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $WorkerAttendanceTable->SortUrl($WorkerAttendanceTable->JobWorkerId) ?>',1);"><div id="elh_WorkerAttendanceTable_JobWorkerId" class="WorkerAttendanceTable_JobWorkerId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorkerAttendanceTable->JobWorkerId->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorkerAttendanceTable->JobWorkerId->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($WorkerAttendanceTable->JobWorkerId->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
	<?php if ($WorkerAttendanceTable->sortUrl($WorkerAttendanceTable->EntryTimestamp) == "") { ?>
		<th data-name="EntryTimestamp" class="<?php echo $WorkerAttendanceTable->EntryTimestamp->headerCellClass() ?>"><div id="elh_WorkerAttendanceTable_EntryTimestamp" class="WorkerAttendanceTable_EntryTimestamp"><div class="ew-table-header-caption"><?php echo $WorkerAttendanceTable->EntryTimestamp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EntryTimestamp" class="<?php echo $WorkerAttendanceTable->EntryTimestamp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $WorkerAttendanceTable->SortUrl($WorkerAttendanceTable->EntryTimestamp) ?>',1);"><div id="elh_WorkerAttendanceTable_EntryTimestamp" class="WorkerAttendanceTable_EntryTimestamp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorkerAttendanceTable->EntryTimestamp->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorkerAttendanceTable->EntryTimestamp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($WorkerAttendanceTable->EntryTimestamp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
	<?php if ($WorkerAttendanceTable->sortUrl($WorkerAttendanceTable->ExitTimestamp) == "") { ?>
		<th data-name="ExitTimestamp" class="<?php echo $WorkerAttendanceTable->ExitTimestamp->headerCellClass() ?>"><div id="elh_WorkerAttendanceTable_ExitTimestamp" class="WorkerAttendanceTable_ExitTimestamp"><div class="ew-table-header-caption"><?php echo $WorkerAttendanceTable->ExitTimestamp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitTimestamp" class="<?php echo $WorkerAttendanceTable->ExitTimestamp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $WorkerAttendanceTable->SortUrl($WorkerAttendanceTable->ExitTimestamp) ?>',1);"><div id="elh_WorkerAttendanceTable_ExitTimestamp" class="WorkerAttendanceTable_ExitTimestamp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $WorkerAttendanceTable->ExitTimestamp->caption() ?></span><span class="ew-table-header-sort"><?php if ($WorkerAttendanceTable->ExitTimestamp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($WorkerAttendanceTable->ExitTimestamp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$WorkerAttendanceTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($WorkerAttendanceTable->ExportAll && $WorkerAttendanceTable->isExport()) {
	$WorkerAttendanceTable_list->StopRec = $WorkerAttendanceTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($WorkerAttendanceTable_list->TotalRecs > $WorkerAttendanceTable_list->StartRec + $WorkerAttendanceTable_list->DisplayRecs - 1)
		$WorkerAttendanceTable_list->StopRec = $WorkerAttendanceTable_list->StartRec + $WorkerAttendanceTable_list->DisplayRecs - 1;
	else
		$WorkerAttendanceTable_list->StopRec = $WorkerAttendanceTable_list->TotalRecs;
}
$WorkerAttendanceTable_list->RecCnt = $WorkerAttendanceTable_list->StartRec - 1;
if ($WorkerAttendanceTable_list->Recordset && !$WorkerAttendanceTable_list->Recordset->EOF) {
	$WorkerAttendanceTable_list->Recordset->moveFirst();
	$selectLimit = $WorkerAttendanceTable_list->UseSelectLimit;
	if (!$selectLimit && $WorkerAttendanceTable_list->StartRec > 1)
		$WorkerAttendanceTable_list->Recordset->move($WorkerAttendanceTable_list->StartRec - 1);
} elseif (!$WorkerAttendanceTable->AllowAddDeleteRow && $WorkerAttendanceTable_list->StopRec == 0) {
	$WorkerAttendanceTable_list->StopRec = $WorkerAttendanceTable->GridAddRowCount;
}

// Initialize aggregate
$WorkerAttendanceTable->RowType = ROWTYPE_AGGREGATEINIT;
$WorkerAttendanceTable->resetAttributes();
$WorkerAttendanceTable_list->renderRow();
while ($WorkerAttendanceTable_list->RecCnt < $WorkerAttendanceTable_list->StopRec) {
	$WorkerAttendanceTable_list->RecCnt++;
	if ($WorkerAttendanceTable_list->RecCnt >= $WorkerAttendanceTable_list->StartRec) {
		$WorkerAttendanceTable_list->RowCnt++;

		// Set up key count
		$WorkerAttendanceTable_list->KeyCount = $WorkerAttendanceTable_list->RowIndex;

		// Init row class and style
		$WorkerAttendanceTable->resetAttributes();
		$WorkerAttendanceTable->CssClass = "";
		if ($WorkerAttendanceTable->isGridAdd()) {
		} else {
			$WorkerAttendanceTable_list->loadRowValues($WorkerAttendanceTable_list->Recordset); // Load row values
		}
		$WorkerAttendanceTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$WorkerAttendanceTable->RowAttrs = array_merge($WorkerAttendanceTable->RowAttrs, array('data-rowindex'=>$WorkerAttendanceTable_list->RowCnt, 'id'=>'r' . $WorkerAttendanceTable_list->RowCnt . '_WorkerAttendanceTable', 'data-rowtype'=>$WorkerAttendanceTable->RowType));

		// Render row
		$WorkerAttendanceTable_list->renderRow();

		// Render list options
		$WorkerAttendanceTable_list->renderListOptions();
?>
	<tr<?php echo $WorkerAttendanceTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$WorkerAttendanceTable_list->ListOptions->render("body", "left", $WorkerAttendanceTable_list->RowCnt);
?>
	<?php if ($WorkerAttendanceTable->JobWorkerId->Visible) { // JobWorkerId ?>
		<td data-name="JobWorkerId"<?php echo $WorkerAttendanceTable->JobWorkerId->cellAttributes() ?>>
<span id="el<?php echo $WorkerAttendanceTable_list->RowCnt ?>_WorkerAttendanceTable_JobWorkerId" class="WorkerAttendanceTable_JobWorkerId">
<span<?php echo $WorkerAttendanceTable->JobWorkerId->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->JobWorkerId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($WorkerAttendanceTable->EntryTimestamp->Visible) { // EntryTimestamp ?>
		<td data-name="EntryTimestamp"<?php echo $WorkerAttendanceTable->EntryTimestamp->cellAttributes() ?>>
<span id="el<?php echo $WorkerAttendanceTable_list->RowCnt ?>_WorkerAttendanceTable_EntryTimestamp" class="WorkerAttendanceTable_EntryTimestamp">
<span<?php echo $WorkerAttendanceTable->EntryTimestamp->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->EntryTimestamp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($WorkerAttendanceTable->ExitTimestamp->Visible) { // ExitTimestamp ?>
		<td data-name="ExitTimestamp"<?php echo $WorkerAttendanceTable->ExitTimestamp->cellAttributes() ?>>
<span id="el<?php echo $WorkerAttendanceTable_list->RowCnt ?>_WorkerAttendanceTable_ExitTimestamp" class="WorkerAttendanceTable_ExitTimestamp">
<span<?php echo $WorkerAttendanceTable->ExitTimestamp->viewAttributes() ?>>
<?php echo $WorkerAttendanceTable->ExitTimestamp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$WorkerAttendanceTable_list->ListOptions->render("body", "right", $WorkerAttendanceTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$WorkerAttendanceTable->isGridAdd())
		$WorkerAttendanceTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$WorkerAttendanceTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($WorkerAttendanceTable_list->Recordset)
	$WorkerAttendanceTable_list->Recordset->Close();
?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$WorkerAttendanceTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($WorkerAttendanceTable_list->Pager)) $WorkerAttendanceTable_list->Pager = new PrevNextPager($WorkerAttendanceTable_list->StartRec, $WorkerAttendanceTable_list->DisplayRecs, $WorkerAttendanceTable_list->TotalRecs, $WorkerAttendanceTable_list->AutoHidePager) ?>
<?php if ($WorkerAttendanceTable_list->Pager->RecordCount > 0 && $WorkerAttendanceTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($WorkerAttendanceTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $WorkerAttendanceTable_list->pageUrl() ?>start=<?php echo $WorkerAttendanceTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($WorkerAttendanceTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $WorkerAttendanceTable_list->pageUrl() ?>start=<?php echo $WorkerAttendanceTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $WorkerAttendanceTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($WorkerAttendanceTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $WorkerAttendanceTable_list->pageUrl() ?>start=<?php echo $WorkerAttendanceTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($WorkerAttendanceTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $WorkerAttendanceTable_list->pageUrl() ?>start=<?php echo $WorkerAttendanceTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $WorkerAttendanceTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($WorkerAttendanceTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $WorkerAttendanceTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $WorkerAttendanceTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $WorkerAttendanceTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $WorkerAttendanceTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($WorkerAttendanceTable_list->TotalRecs == 0 && !$WorkerAttendanceTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $WorkerAttendanceTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$WorkerAttendanceTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$WorkerAttendanceTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$WorkerAttendanceTable_list->terminate();
?>