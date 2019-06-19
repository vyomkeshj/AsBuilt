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
$JobSessionTable_list = new JobSessionTable_list();

// Run the page
$JobSessionTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$JobSessionTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$JobSessionTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fJobSessionTablelist = currentForm = new ew.Form("fJobSessionTablelist", "list");
fJobSessionTablelist.formKeyCountName = '<?php echo $JobSessionTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fJobSessionTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fJobSessionTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$JobSessionTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($JobSessionTable_list->TotalRecs > 0 && $JobSessionTable_list->ExportOptions->visible()) { ?>
<?php $JobSessionTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($JobSessionTable_list->ImportOptions->visible()) { ?>
<?php $JobSessionTable_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$JobSessionTable->isExport() || EXPORT_MASTER_RECORD && $JobSessionTable->isExport("print")) { ?>
<?php
if ($JobSessionTable_list->DbMasterFilter <> "" && $JobSessionTable->getCurrentMasterTable() == "AssignmentTable") {
	if ($JobSessionTable_list->MasterRecordExists) {
		include_once "AssignmentTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$JobSessionTable_list->renderOtherOptions();
?>
<?php $JobSessionTable_list->showPageHeader(); ?>
<?php
$JobSessionTable_list->showMessage();
?>
<?php if ($JobSessionTable_list->TotalRecs > 0 || $JobSessionTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($JobSessionTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> JobSessionTable">
<form name="fJobSessionTablelist" id="fJobSessionTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($JobSessionTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $JobSessionTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="JobSessionTable">
<?php if ($JobSessionTable->getCurrentMasterTable() == "AssignmentTable" && $JobSessionTable->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="AssignmentTable">
<input type="hidden" name="fk_AssignmentID" value="<?php echo $JobSessionTable->AssignmentID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_JobSessionTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($JobSessionTable_list->TotalRecs > 0 || $JobSessionTable->isGridEdit()) { ?>
<table id="tbl_JobSessionTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$JobSessionTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$JobSessionTable_list->renderListOptions();

// Render list options (header, left)
$JobSessionTable_list->ListOptions->render("header", "left");
?>
<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->SessionID) == "") { ?>
		<th data-name="SessionID" class="<?php echo $JobSessionTable->SessionID->headerCellClass() ?>"><div id="elh_JobSessionTable_SessionID" class="JobSessionTable_SessionID"><div class="ew-table-header-caption"><?php echo $JobSessionTable->SessionID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionID" class="<?php echo $JobSessionTable->SessionID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobSessionTable->SortUrl($JobSessionTable->SessionID) ?>',1);"><div id="elh_JobSessionTable_SessionID" class="JobSessionTable_SessionID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->SessionID->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->SessionID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->SessionID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->AssignmentID) == "") { ?>
		<th data-name="AssignmentID" class="<?php echo $JobSessionTable->AssignmentID->headerCellClass() ?>"><div id="elh_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID"><div class="ew-table-header-caption"><?php echo $JobSessionTable->AssignmentID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssignmentID" class="<?php echo $JobSessionTable->AssignmentID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobSessionTable->SortUrl($JobSessionTable->AssignmentID) ?>',1);"><div id="elh_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->AssignmentID->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->AssignmentID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->AssignmentID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->SessionTeam) == "") { ?>
		<th data-name="SessionTeam" class="<?php echo $JobSessionTable->SessionTeam->headerCellClass() ?>"><div id="elh_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam"><div class="ew-table-header-caption"><?php echo $JobSessionTable->SessionTeam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SessionTeam" class="<?php echo $JobSessionTable->SessionTeam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobSessionTable->SortUrl($JobSessionTable->SessionTeam) ?>',1);"><div id="elh_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->SessionTeam->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->SessionTeam->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->SessionTeam->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->StartTimestamp) == "") { ?>
		<th data-name="StartTimestamp" class="<?php echo $JobSessionTable->StartTimestamp->headerCellClass() ?>"><div id="elh_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp"><div class="ew-table-header-caption"><?php echo $JobSessionTable->StartTimestamp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartTimestamp" class="<?php echo $JobSessionTable->StartTimestamp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobSessionTable->SortUrl($JobSessionTable->StartTimestamp) ?>',1);"><div id="elh_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->StartTimestamp->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->StartTimestamp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->StartTimestamp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->FinishTimestamp) == "") { ?>
		<th data-name="FinishTimestamp" class="<?php echo $JobSessionTable->FinishTimestamp->headerCellClass() ?>"><div id="elh_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp"><div class="ew-table-header-caption"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinishTimestamp" class="<?php echo $JobSessionTable->FinishTimestamp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobSessionTable->SortUrl($JobSessionTable->FinishTimestamp) ?>',1);"><div id="elh_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->FinishTimestamp->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->FinishTimestamp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->FinishTimestamp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
	<?php if ($JobSessionTable->sortUrl($JobSessionTable->ExpectedStart) == "") { ?>
		<th data-name="ExpectedStart" class="<?php echo $JobSessionTable->ExpectedStart->headerCellClass() ?>"><div id="elh_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart"><div class="ew-table-header-caption"><?php echo $JobSessionTable->ExpectedStart->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedStart" class="<?php echo $JobSessionTable->ExpectedStart->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $JobSessionTable->SortUrl($JobSessionTable->ExpectedStart) ?>',1);"><div id="elh_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $JobSessionTable->ExpectedStart->caption() ?></span><span class="ew-table-header-sort"><?php if ($JobSessionTable->ExpectedStart->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($JobSessionTable->ExpectedStart->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$JobSessionTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($JobSessionTable->ExportAll && $JobSessionTable->isExport()) {
	$JobSessionTable_list->StopRec = $JobSessionTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($JobSessionTable_list->TotalRecs > $JobSessionTable_list->StartRec + $JobSessionTable_list->DisplayRecs - 1)
		$JobSessionTable_list->StopRec = $JobSessionTable_list->StartRec + $JobSessionTable_list->DisplayRecs - 1;
	else
		$JobSessionTable_list->StopRec = $JobSessionTable_list->TotalRecs;
}
$JobSessionTable_list->RecCnt = $JobSessionTable_list->StartRec - 1;
if ($JobSessionTable_list->Recordset && !$JobSessionTable_list->Recordset->EOF) {
	$JobSessionTable_list->Recordset->moveFirst();
	$selectLimit = $JobSessionTable_list->UseSelectLimit;
	if (!$selectLimit && $JobSessionTable_list->StartRec > 1)
		$JobSessionTable_list->Recordset->move($JobSessionTable_list->StartRec - 1);
} elseif (!$JobSessionTable->AllowAddDeleteRow && $JobSessionTable_list->StopRec == 0) {
	$JobSessionTable_list->StopRec = $JobSessionTable->GridAddRowCount;
}

// Initialize aggregate
$JobSessionTable->RowType = ROWTYPE_AGGREGATEINIT;
$JobSessionTable->resetAttributes();
$JobSessionTable_list->renderRow();
while ($JobSessionTable_list->RecCnt < $JobSessionTable_list->StopRec) {
	$JobSessionTable_list->RecCnt++;
	if ($JobSessionTable_list->RecCnt >= $JobSessionTable_list->StartRec) {
		$JobSessionTable_list->RowCnt++;

		// Set up key count
		$JobSessionTable_list->KeyCount = $JobSessionTable_list->RowIndex;

		// Init row class and style
		$JobSessionTable->resetAttributes();
		$JobSessionTable->CssClass = "";
		if ($JobSessionTable->isGridAdd()) {
		} else {
			$JobSessionTable_list->loadRowValues($JobSessionTable_list->Recordset); // Load row values
		}
		$JobSessionTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$JobSessionTable->RowAttrs = array_merge($JobSessionTable->RowAttrs, array('data-rowindex'=>$JobSessionTable_list->RowCnt, 'id'=>'r' . $JobSessionTable_list->RowCnt . '_JobSessionTable', 'data-rowtype'=>$JobSessionTable->RowType));

		// Render row
		$JobSessionTable_list->renderRow();

		// Render list options
		$JobSessionTable_list->renderListOptions();
?>
	<tr<?php echo $JobSessionTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$JobSessionTable_list->ListOptions->render("body", "left", $JobSessionTable_list->RowCnt);
?>
	<?php if ($JobSessionTable->SessionID->Visible) { // SessionID ?>
		<td data-name="SessionID"<?php echo $JobSessionTable->SessionID->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_list->RowCnt ?>_JobSessionTable_SessionID" class="JobSessionTable_SessionID">
<span<?php echo $JobSessionTable->SessionID->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->AssignmentID->Visible) { // AssignmentID ?>
		<td data-name="AssignmentID"<?php echo $JobSessionTable->AssignmentID->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_list->RowCnt ?>_JobSessionTable_AssignmentID" class="JobSessionTable_AssignmentID">
<span<?php echo $JobSessionTable->AssignmentID->viewAttributes() ?>>
<?php echo $JobSessionTable->AssignmentID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->SessionTeam->Visible) { // SessionTeam ?>
		<td data-name="SessionTeam"<?php echo $JobSessionTable->SessionTeam->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_list->RowCnt ?>_JobSessionTable_SessionTeam" class="JobSessionTable_SessionTeam">
<span<?php echo $JobSessionTable->SessionTeam->viewAttributes() ?>>
<?php echo $JobSessionTable->SessionTeam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->StartTimestamp->Visible) { // StartTimestamp ?>
		<td data-name="StartTimestamp"<?php echo $JobSessionTable->StartTimestamp->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_list->RowCnt ?>_JobSessionTable_StartTimestamp" class="JobSessionTable_StartTimestamp">
<span<?php echo $JobSessionTable->StartTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->StartTimestamp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->FinishTimestamp->Visible) { // FinishTimestamp ?>
		<td data-name="FinishTimestamp"<?php echo $JobSessionTable->FinishTimestamp->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_list->RowCnt ?>_JobSessionTable_FinishTimestamp" class="JobSessionTable_FinishTimestamp">
<span<?php echo $JobSessionTable->FinishTimestamp->viewAttributes() ?>>
<?php echo $JobSessionTable->FinishTimestamp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($JobSessionTable->ExpectedStart->Visible) { // ExpectedStart ?>
		<td data-name="ExpectedStart"<?php echo $JobSessionTable->ExpectedStart->cellAttributes() ?>>
<span id="el<?php echo $JobSessionTable_list->RowCnt ?>_JobSessionTable_ExpectedStart" class="JobSessionTable_ExpectedStart">
<span<?php echo $JobSessionTable->ExpectedStart->viewAttributes() ?>>
<?php echo $JobSessionTable->ExpectedStart->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$JobSessionTable_list->ListOptions->render("body", "right", $JobSessionTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$JobSessionTable->isGridAdd())
		$JobSessionTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$JobSessionTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($JobSessionTable_list->Recordset)
	$JobSessionTable_list->Recordset->Close();
?>
<?php if (!$JobSessionTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$JobSessionTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($JobSessionTable_list->Pager)) $JobSessionTable_list->Pager = new PrevNextPager($JobSessionTable_list->StartRec, $JobSessionTable_list->DisplayRecs, $JobSessionTable_list->TotalRecs, $JobSessionTable_list->AutoHidePager) ?>
<?php if ($JobSessionTable_list->Pager->RecordCount > 0 && $JobSessionTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($JobSessionTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $JobSessionTable_list->pageUrl() ?>start=<?php echo $JobSessionTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($JobSessionTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $JobSessionTable_list->pageUrl() ?>start=<?php echo $JobSessionTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $JobSessionTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($JobSessionTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $JobSessionTable_list->pageUrl() ?>start=<?php echo $JobSessionTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($JobSessionTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $JobSessionTable_list->pageUrl() ?>start=<?php echo $JobSessionTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $JobSessionTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($JobSessionTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $JobSessionTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $JobSessionTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $JobSessionTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $JobSessionTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($JobSessionTable_list->TotalRecs == 0 && !$JobSessionTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $JobSessionTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$JobSessionTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$JobSessionTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$JobSessionTable_list->terminate();
?>