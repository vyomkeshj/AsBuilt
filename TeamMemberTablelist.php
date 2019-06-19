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
$TeamMemberTable_list = new TeamMemberTable_list();

// Run the page
$TeamMemberTable_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$TeamMemberTable_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fTeamMemberTablelist = currentForm = new ew.Form("fTeamMemberTablelist", "list");
fTeamMemberTablelist.formKeyCountName = '<?php echo $TeamMemberTable_list->FormKeyCountName ?>';

// Form_CustomValidate event
fTeamMemberTablelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fTeamMemberTablelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($TeamMemberTable_list->TotalRecs > 0 && $TeamMemberTable_list->ExportOptions->visible()) { ?>
<?php $TeamMemberTable_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($TeamMemberTable_list->ImportOptions->visible()) { ?>
<?php $TeamMemberTable_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$TeamMemberTable->isExport() || EXPORT_MASTER_RECORD && $TeamMemberTable->isExport("print")) { ?>
<?php
if ($TeamMemberTable_list->DbMasterFilter <> "" && $TeamMemberTable->getCurrentMasterTable() == "TeamTable") {
	if ($TeamMemberTable_list->MasterRecordExists) {
		include_once "TeamTablemaster.php";
	}
}
?>
<?php } ?>
<?php
$TeamMemberTable_list->renderOtherOptions();
?>
<?php $TeamMemberTable_list->showPageHeader(); ?>
<?php
$TeamMemberTable_list->showMessage();
?>
<?php if ($TeamMemberTable_list->TotalRecs > 0 || $TeamMemberTable->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($TeamMemberTable_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> TeamMemberTable">
<form name="fTeamMemberTablelist" id="fTeamMemberTablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($TeamMemberTable_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $TeamMemberTable_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="TeamMemberTable">
<?php if ($TeamMemberTable->getCurrentMasterTable() == "TeamTable" && $TeamMemberTable->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="TeamTable">
<input type="hidden" name="fk_TeamID" value="<?php echo $TeamMemberTable->TeamID->getSessionValue() ?>">
<?php } ?>
<div id="gmp_TeamMemberTable" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($TeamMemberTable_list->TotalRecs > 0 || $TeamMemberTable->isGridEdit()) { ?>
<table id="tbl_TeamMemberTablelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$TeamMemberTable_list->RowType = ROWTYPE_HEADER;

// Render list options
$TeamMemberTable_list->renderListOptions();

// Render list options (header, left)
$TeamMemberTable_list->ListOptions->render("header", "left");
?>
<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
	<?php if ($TeamMemberTable->sortUrl($TeamMemberTable->serial) == "") { ?>
		<th data-name="serial" class="<?php echo $TeamMemberTable->serial->headerCellClass() ?>"><div id="elh_TeamMemberTable_serial" class="TeamMemberTable_serial"><div class="ew-table-header-caption"><?php echo $TeamMemberTable->serial->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="serial" class="<?php echo $TeamMemberTable->serial->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamMemberTable->SortUrl($TeamMemberTable->serial) ?>',1);"><div id="elh_TeamMemberTable_serial" class="TeamMemberTable_serial">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamMemberTable->serial->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamMemberTable->serial->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamMemberTable->serial->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
	<?php if ($TeamMemberTable->sortUrl($TeamMemberTable->TeamID) == "") { ?>
		<th data-name="TeamID" class="<?php echo $TeamMemberTable->TeamID->headerCellClass() ?>"><div id="elh_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID"><div class="ew-table-header-caption"><?php echo $TeamMemberTable->TeamID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TeamID" class="<?php echo $TeamMemberTable->TeamID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamMemberTable->SortUrl($TeamMemberTable->TeamID) ?>',1);"><div id="elh_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamMemberTable->TeamID->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamMemberTable->TeamID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamMemberTable->TeamID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
	<?php if ($TeamMemberTable->sortUrl($TeamMemberTable->JobWorkerID) == "") { ?>
		<th data-name="JobWorkerID" class="<?php echo $TeamMemberTable->JobWorkerID->headerCellClass() ?>"><div id="elh_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID"><div class="ew-table-header-caption"><?php echo $TeamMemberTable->JobWorkerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobWorkerID" class="<?php echo $TeamMemberTable->JobWorkerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $TeamMemberTable->SortUrl($TeamMemberTable->JobWorkerID) ?>',1);"><div id="elh_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $TeamMemberTable->JobWorkerID->caption() ?></span><span class="ew-table-header-sort"><?php if ($TeamMemberTable->JobWorkerID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($TeamMemberTable->JobWorkerID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$TeamMemberTable_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($TeamMemberTable->ExportAll && $TeamMemberTable->isExport()) {
	$TeamMemberTable_list->StopRec = $TeamMemberTable_list->TotalRecs;
} else {

	// Set the last record to display
	if ($TeamMemberTable_list->TotalRecs > $TeamMemberTable_list->StartRec + $TeamMemberTable_list->DisplayRecs - 1)
		$TeamMemberTable_list->StopRec = $TeamMemberTable_list->StartRec + $TeamMemberTable_list->DisplayRecs - 1;
	else
		$TeamMemberTable_list->StopRec = $TeamMemberTable_list->TotalRecs;
}
$TeamMemberTable_list->RecCnt = $TeamMemberTable_list->StartRec - 1;
if ($TeamMemberTable_list->Recordset && !$TeamMemberTable_list->Recordset->EOF) {
	$TeamMemberTable_list->Recordset->moveFirst();
	$selectLimit = $TeamMemberTable_list->UseSelectLimit;
	if (!$selectLimit && $TeamMemberTable_list->StartRec > 1)
		$TeamMemberTable_list->Recordset->move($TeamMemberTable_list->StartRec - 1);
} elseif (!$TeamMemberTable->AllowAddDeleteRow && $TeamMemberTable_list->StopRec == 0) {
	$TeamMemberTable_list->StopRec = $TeamMemberTable->GridAddRowCount;
}

// Initialize aggregate
$TeamMemberTable->RowType = ROWTYPE_AGGREGATEINIT;
$TeamMemberTable->resetAttributes();
$TeamMemberTable_list->renderRow();
while ($TeamMemberTable_list->RecCnt < $TeamMemberTable_list->StopRec) {
	$TeamMemberTable_list->RecCnt++;
	if ($TeamMemberTable_list->RecCnt >= $TeamMemberTable_list->StartRec) {
		$TeamMemberTable_list->RowCnt++;

		// Set up key count
		$TeamMemberTable_list->KeyCount = $TeamMemberTable_list->RowIndex;

		// Init row class and style
		$TeamMemberTable->resetAttributes();
		$TeamMemberTable->CssClass = "";
		if ($TeamMemberTable->isGridAdd()) {
		} else {
			$TeamMemberTable_list->loadRowValues($TeamMemberTable_list->Recordset); // Load row values
		}
		$TeamMemberTable->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$TeamMemberTable->RowAttrs = array_merge($TeamMemberTable->RowAttrs, array('data-rowindex'=>$TeamMemberTable_list->RowCnt, 'id'=>'r' . $TeamMemberTable_list->RowCnt . '_TeamMemberTable', 'data-rowtype'=>$TeamMemberTable->RowType));

		// Render row
		$TeamMemberTable_list->renderRow();

		// Render list options
		$TeamMemberTable_list->renderListOptions();
?>
	<tr<?php echo $TeamMemberTable->rowAttributes() ?>>
<?php

// Render list options (body, left)
$TeamMemberTable_list->ListOptions->render("body", "left", $TeamMemberTable_list->RowCnt);
?>
	<?php if ($TeamMemberTable->serial->Visible) { // serial ?>
		<td data-name="serial"<?php echo $TeamMemberTable->serial->cellAttributes() ?>>
<span id="el<?php echo $TeamMemberTable_list->RowCnt ?>_TeamMemberTable_serial" class="TeamMemberTable_serial">
<span<?php echo $TeamMemberTable->serial->viewAttributes() ?>>
<?php echo $TeamMemberTable->serial->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($TeamMemberTable->TeamID->Visible) { // TeamID ?>
		<td data-name="TeamID"<?php echo $TeamMemberTable->TeamID->cellAttributes() ?>>
<span id="el<?php echo $TeamMemberTable_list->RowCnt ?>_TeamMemberTable_TeamID" class="TeamMemberTable_TeamID">
<span<?php echo $TeamMemberTable->TeamID->viewAttributes() ?>>
<?php echo $TeamMemberTable->TeamID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($TeamMemberTable->JobWorkerID->Visible) { // JobWorkerID ?>
		<td data-name="JobWorkerID"<?php echo $TeamMemberTable->JobWorkerID->cellAttributes() ?>>
<span id="el<?php echo $TeamMemberTable_list->RowCnt ?>_TeamMemberTable_JobWorkerID" class="TeamMemberTable_JobWorkerID">
<span<?php echo $TeamMemberTable->JobWorkerID->viewAttributes() ?>>
<?php echo $TeamMemberTable->JobWorkerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$TeamMemberTable_list->ListOptions->render("body", "right", $TeamMemberTable_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$TeamMemberTable->isGridAdd())
		$TeamMemberTable_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$TeamMemberTable->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($TeamMemberTable_list->Recordset)
	$TeamMemberTable_list->Recordset->Close();
?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$TeamMemberTable->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($TeamMemberTable_list->Pager)) $TeamMemberTable_list->Pager = new PrevNextPager($TeamMemberTable_list->StartRec, $TeamMemberTable_list->DisplayRecs, $TeamMemberTable_list->TotalRecs, $TeamMemberTable_list->AutoHidePager) ?>
<?php if ($TeamMemberTable_list->Pager->RecordCount > 0 && $TeamMemberTable_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($TeamMemberTable_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $TeamMemberTable_list->pageUrl() ?>start=<?php echo $TeamMemberTable_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($TeamMemberTable_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $TeamMemberTable_list->pageUrl() ?>start=<?php echo $TeamMemberTable_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $TeamMemberTable_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($TeamMemberTable_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $TeamMemberTable_list->pageUrl() ?>start=<?php echo $TeamMemberTable_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($TeamMemberTable_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $TeamMemberTable_list->pageUrl() ?>start=<?php echo $TeamMemberTable_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $TeamMemberTable_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($TeamMemberTable_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $TeamMemberTable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $TeamMemberTable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $TeamMemberTable_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $TeamMemberTable_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($TeamMemberTable_list->TotalRecs == 0 && !$TeamMemberTable->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $TeamMemberTable_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$TeamMemberTable_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$TeamMemberTable->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$TeamMemberTable_list->terminate();
?>