<?php
namespace PHPMaker2019\ASbuiltProject;

/**
 * Table class for JobSessionTable
 */
class JobSessionTable extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $SessionID;
	public $AssignmentID;
	public $SessionTeam;
	public $StartTimestamp;
	public $FinishTimestamp;
	public $ExpectedStart;
	public $SessionComment;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'JobSessionTable';
		$this->TableName = 'JobSessionTable';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`JobSessionTable`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// SessionID
		$this->SessionID = new DbField('JobSessionTable', 'JobSessionTable', 'x_SessionID', 'SessionID', '`SessionID`', '`SessionID`', 3, -1, FALSE, '`SessionID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->SessionID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->SessionID->IsPrimaryKey = TRUE; // Primary key field
		$this->SessionID->IsForeignKey = TRUE; // Foreign key field
		$this->SessionID->Sortable = TRUE; // Allow sort
		$this->SessionID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SessionID'] = &$this->SessionID;

		// AssignmentID
		$this->AssignmentID = new DbField('JobSessionTable', 'JobSessionTable', 'x_AssignmentID', 'AssignmentID', '`AssignmentID`', '`AssignmentID`', 3, -1, FALSE, '`AssignmentID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AssignmentID->IsForeignKey = TRUE; // Foreign key field
		$this->AssignmentID->Nullable = FALSE; // NOT NULL field
		$this->AssignmentID->Required = TRUE; // Required field
		$this->AssignmentID->Sortable = TRUE; // Allow sort
		$this->AssignmentID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['AssignmentID'] = &$this->AssignmentID;

		// SessionTeam
		$this->SessionTeam = new DbField('JobSessionTable', 'JobSessionTable', 'x_SessionTeam', 'SessionTeam', '`SessionTeam`', '`SessionTeam`', 3, -1, FALSE, '`SessionTeam`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SessionTeam->IsForeignKey = TRUE; // Foreign key field
		$this->SessionTeam->Sortable = TRUE; // Allow sort
		$this->SessionTeam->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SessionTeam'] = &$this->SessionTeam;

		// StartTimestamp
		$this->StartTimestamp = new DbField('JobSessionTable', 'JobSessionTable', 'x_StartTimestamp', 'StartTimestamp', '`StartTimestamp`', CastDateFieldForLike('`StartTimestamp`', 0, "DB"), 135, 0, FALSE, '`StartTimestamp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->StartTimestamp->Sortable = TRUE; // Allow sort
		$this->StartTimestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['StartTimestamp'] = &$this->StartTimestamp;

		// FinishTimestamp
		$this->FinishTimestamp = new DbField('JobSessionTable', 'JobSessionTable', 'x_FinishTimestamp', 'FinishTimestamp', '`FinishTimestamp`', CastDateFieldForLike('`FinishTimestamp`', 0, "DB"), 135, 0, FALSE, '`FinishTimestamp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FinishTimestamp->Sortable = TRUE; // Allow sort
		$this->FinishTimestamp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['FinishTimestamp'] = &$this->FinishTimestamp;

		// ExpectedStart
		$this->ExpectedStart = new DbField('JobSessionTable', 'JobSessionTable', 'x_ExpectedStart', 'ExpectedStart', '`ExpectedStart`', CastDateFieldForLike('`ExpectedStart`', 0, "DB"), 135, 0, FALSE, '`ExpectedStart`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExpectedStart->Sortable = TRUE; // Allow sort
		$this->ExpectedStart->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ExpectedStart'] = &$this->ExpectedStart;

		// SessionComment
		$this->SessionComment = new DbField('JobSessionTable', 'JobSessionTable', 'x_SessionComment', 'SessionComment', '`SessionComment`', '`SessionComment`', 201, -1, FALSE, '`SessionComment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->SessionComment->Nullable = FALSE; // NOT NULL field
		$this->SessionComment->Required = TRUE; // Required field
		$this->SessionComment->Sortable = TRUE; // Allow sort
		$this->fields['SessionComment'] = &$this->SessionComment;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "AssignmentTable") {
			if ($this->AssignmentID->getSessionValue() <> "")
				$masterFilter .= "`AssignmentID`=" . QuotedValue($this->AssignmentID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "AssignmentTable") {
			if ($this->AssignmentID->getSessionValue() <> "")
				$detailFilter .= "`AssignmentID`=" . QuotedValue($this->AssignmentID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_AssignmentTable()
	{
		return "`AssignmentID`=@AssignmentID@";
	}

	// Detail filter
	public function sqlDetailFilter_AssignmentTable()
	{
		return "`AssignmentID`=@AssignmentID@";
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "TeamTable") {
			$detailUrl = $GLOBALS["TeamTable"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_SessionTeam=" . urlencode($this->SessionTeam->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "CartTable") {
			$detailUrl = $GLOBALS["CartTable"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_SessionID=" . urlencode($this->SessionID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "JobSessionTablelist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`JobSessionTable`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->SessionID->setDbValue($conn->insert_ID());
			$rs['SessionID'] = $this->SessionID->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();

		// Cascade Update detail table 'TeamTable'
		$cascadeUpdate = FALSE;
		$rscascade = array();
		if ($rsold && (isset($rs['SessionTeam']) && $rsold['SessionTeam'] <> $rs['SessionTeam'])) { // Update detail field 'TeamID'
			$cascadeUpdate = TRUE;
			$rscascade['TeamID'] = $rs['SessionTeam']; 
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["TeamTable"]))
				$GLOBALS["TeamTable"] = new TeamTable();
			$rswrk = $GLOBALS["TeamTable"]->loadRs("`TeamID` = " . QuotedValue($rsold['SessionTeam'], DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'TeamID';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["TeamTable"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["TeamTable"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["TeamTable"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('SessionID', $rs))
				AddFilter($where, QuotedName('SessionID', $this->Dbid) . '=' . QuotedValue($rs['SessionID'], $this->SessionID->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();

		// Cascade delete detail table 'TeamTable'
		if (!isset($GLOBALS["TeamTable"]))
			$GLOBALS["TeamTable"] = new TeamTable();
		$rscascade = $GLOBALS["TeamTable"]->loadRs("`TeamID` = " . QuotedValue($rs['SessionTeam'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["TeamTable"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["TeamTable"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["TeamTable"]->Row_Deleted($dtlrow);
		}
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->SessionID->DbValue = $row['SessionID'];
		$this->AssignmentID->DbValue = $row['AssignmentID'];
		$this->SessionTeam->DbValue = $row['SessionTeam'];
		$this->StartTimestamp->DbValue = $row['StartTimestamp'];
		$this->FinishTimestamp->DbValue = $row['FinishTimestamp'];
		$this->ExpectedStart->DbValue = $row['ExpectedStart'];
		$this->SessionComment->DbValue = $row['SessionComment'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`SessionID` = @SessionID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('SessionID', $row) ? $row['SessionID'] : NULL) : $this->SessionID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@SessionID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "JobSessionTablelist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "JobSessionTableview.php")
			return $Language->phrase("View");
		elseif ($pageName == "JobSessionTableedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "JobSessionTableadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "JobSessionTablelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("JobSessionTableview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("JobSessionTableview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "JobSessionTableadd.php?" . $this->getUrlParm($parm);
		else
			$url = "JobSessionTableadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("JobSessionTableedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("JobSessionTableedit.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("JobSessionTableadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("JobSessionTableadd.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("JobSessionTabledelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "AssignmentTable" && !ContainsString($url, TABLE_SHOW_MASTER . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_AssignmentID=" . urlencode($this->AssignmentID->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "SessionID:" . JsonEncode($this->SessionID->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->SessionID->CurrentValue != NULL) {
			$url .= "SessionID=" . urlencode($this->SessionID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("SessionID") !== NULL)
				$arKeys[] = Param("SessionID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->SessionID->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->SessionID->setDbValue($rs->fields('SessionID'));
		$this->AssignmentID->setDbValue($rs->fields('AssignmentID'));
		$this->SessionTeam->setDbValue($rs->fields('SessionTeam'));
		$this->StartTimestamp->setDbValue($rs->fields('StartTimestamp'));
		$this->FinishTimestamp->setDbValue($rs->fields('FinishTimestamp'));
		$this->ExpectedStart->setDbValue($rs->fields('ExpectedStart'));
		$this->SessionComment->setDbValue($rs->fields('SessionComment'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// SessionID
		// AssignmentID
		// SessionTeam
		// StartTimestamp
		// FinishTimestamp
		// ExpectedStart
		// SessionComment
		// SessionID

		$this->SessionID->ViewValue = $this->SessionID->CurrentValue;
		$this->SessionID->ViewCustomAttributes = "";

		// AssignmentID
		$this->AssignmentID->ViewValue = $this->AssignmentID->CurrentValue;
		$this->AssignmentID->ViewValue = FormatNumber($this->AssignmentID->ViewValue, 0, -2, -2, -2);
		$this->AssignmentID->ViewCustomAttributes = "";

		// SessionTeam
		$this->SessionTeam->ViewValue = $this->SessionTeam->CurrentValue;
		$this->SessionTeam->ViewValue = FormatNumber($this->SessionTeam->ViewValue, 0, -2, -2, -2);
		$this->SessionTeam->ViewCustomAttributes = "";

		// StartTimestamp
		$this->StartTimestamp->ViewValue = $this->StartTimestamp->CurrentValue;
		$this->StartTimestamp->ViewValue = FormatDateTime($this->StartTimestamp->ViewValue, 0);
		$this->StartTimestamp->ViewCustomAttributes = "";

		// FinishTimestamp
		$this->FinishTimestamp->ViewValue = $this->FinishTimestamp->CurrentValue;
		$this->FinishTimestamp->ViewValue = FormatDateTime($this->FinishTimestamp->ViewValue, 0);
		$this->FinishTimestamp->ViewCustomAttributes = "";

		// ExpectedStart
		$this->ExpectedStart->ViewValue = $this->ExpectedStart->CurrentValue;
		$this->ExpectedStart->ViewValue = FormatDateTime($this->ExpectedStart->ViewValue, 0);
		$this->ExpectedStart->ViewCustomAttributes = "";

		// SessionComment
		$this->SessionComment->ViewValue = $this->SessionComment->CurrentValue;
		$this->SessionComment->ViewCustomAttributes = "";

		// SessionID
		$this->SessionID->LinkCustomAttributes = "";
		$this->SessionID->HrefValue = "";
		$this->SessionID->TooltipValue = "";

		// AssignmentID
		$this->AssignmentID->LinkCustomAttributes = "";
		$this->AssignmentID->HrefValue = "";
		$this->AssignmentID->TooltipValue = "";

		// SessionTeam
		$this->SessionTeam->LinkCustomAttributes = "";
		$this->SessionTeam->HrefValue = "";
		$this->SessionTeam->TooltipValue = "";

		// StartTimestamp
		$this->StartTimestamp->LinkCustomAttributes = "";
		$this->StartTimestamp->HrefValue = "";
		$this->StartTimestamp->TooltipValue = "";

		// FinishTimestamp
		$this->FinishTimestamp->LinkCustomAttributes = "";
		$this->FinishTimestamp->HrefValue = "";
		$this->FinishTimestamp->TooltipValue = "";

		// ExpectedStart
		$this->ExpectedStart->LinkCustomAttributes = "";
		$this->ExpectedStart->HrefValue = "";
		$this->ExpectedStart->TooltipValue = "";

		// SessionComment
		$this->SessionComment->LinkCustomAttributes = "";
		$this->SessionComment->HrefValue = "";
		$this->SessionComment->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// SessionID
		$this->SessionID->EditAttrs["class"] = "form-control";
		$this->SessionID->EditCustomAttributes = "";
		$this->SessionID->EditValue = $this->SessionID->CurrentValue;
		$this->SessionID->ViewCustomAttributes = "";

		// AssignmentID
		$this->AssignmentID->EditAttrs["class"] = "form-control";
		$this->AssignmentID->EditCustomAttributes = "";
		if ($this->AssignmentID->getSessionValue() <> "") {
			$this->AssignmentID->CurrentValue = $this->AssignmentID->getSessionValue();
		$this->AssignmentID->ViewValue = $this->AssignmentID->CurrentValue;
		$this->AssignmentID->ViewValue = FormatNumber($this->AssignmentID->ViewValue, 0, -2, -2, -2);
		$this->AssignmentID->ViewCustomAttributes = "";
		} else {
		$this->AssignmentID->EditValue = $this->AssignmentID->CurrentValue;
		$this->AssignmentID->PlaceHolder = RemoveHtml($this->AssignmentID->caption());
		}

		// SessionTeam
		$this->SessionTeam->EditAttrs["class"] = "form-control";
		$this->SessionTeam->EditCustomAttributes = "";
		$this->SessionTeam->EditValue = $this->SessionTeam->CurrentValue;
		$this->SessionTeam->PlaceHolder = RemoveHtml($this->SessionTeam->caption());

		// StartTimestamp
		$this->StartTimestamp->EditAttrs["class"] = "form-control";
		$this->StartTimestamp->EditCustomAttributes = "";
		$this->StartTimestamp->EditValue = FormatDateTime($this->StartTimestamp->CurrentValue, 8);
		$this->StartTimestamp->PlaceHolder = RemoveHtml($this->StartTimestamp->caption());

		// FinishTimestamp
		$this->FinishTimestamp->EditAttrs["class"] = "form-control";
		$this->FinishTimestamp->EditCustomAttributes = "";
		$this->FinishTimestamp->EditValue = FormatDateTime($this->FinishTimestamp->CurrentValue, 8);
		$this->FinishTimestamp->PlaceHolder = RemoveHtml($this->FinishTimestamp->caption());

		// ExpectedStart
		$this->ExpectedStart->EditAttrs["class"] = "form-control";
		$this->ExpectedStart->EditCustomAttributes = "";
		$this->ExpectedStart->EditValue = FormatDateTime($this->ExpectedStart->CurrentValue, 8);
		$this->ExpectedStart->PlaceHolder = RemoveHtml($this->ExpectedStart->caption());

		// SessionComment
		$this->SessionComment->EditAttrs["class"] = "form-control";
		$this->SessionComment->EditCustomAttributes = "";
		$this->SessionComment->EditValue = $this->SessionComment->CurrentValue;
		$this->SessionComment->PlaceHolder = RemoveHtml($this->SessionComment->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->SessionID);
					$doc->exportCaption($this->AssignmentID);
					$doc->exportCaption($this->SessionTeam);
					$doc->exportCaption($this->StartTimestamp);
					$doc->exportCaption($this->FinishTimestamp);
					$doc->exportCaption($this->ExpectedStart);
					$doc->exportCaption($this->SessionComment);
				} else {
					$doc->exportCaption($this->SessionID);
					$doc->exportCaption($this->AssignmentID);
					$doc->exportCaption($this->SessionTeam);
					$doc->exportCaption($this->StartTimestamp);
					$doc->exportCaption($this->FinishTimestamp);
					$doc->exportCaption($this->ExpectedStart);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->SessionID);
						$doc->exportField($this->AssignmentID);
						$doc->exportField($this->SessionTeam);
						$doc->exportField($this->StartTimestamp);
						$doc->exportField($this->FinishTimestamp);
						$doc->exportField($this->ExpectedStart);
						$doc->exportField($this->SessionComment);
					} else {
						$doc->exportField($this->SessionID);
						$doc->exportField($this->AssignmentID);
						$doc->exportField($this->SessionTeam);
						$doc->exportField($this->StartTimestamp);
						$doc->exportField($this->FinishTimestamp);
						$doc->exportField($this->ExpectedStart);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					$validRequest = $Security->isLoggedIn(); // Logged in
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$validRequest = $Security->isLoggedIn(); // Logged in
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>