<?php
namespace PHPMaker2019\ASbuiltProject;

/**
 * Table class for LeadTable
 */
class LeadTable extends DbTable
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
	public $LeadID;
	public $CustomerID;
	public $LeadType;
	public $SiteLocation;
	public $Suburb;
	public $ExpectedStart;
	public $DateTaken;
	public $TakenBy;
	public $IsComplete;
	public $LeadComment;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'LeadTable';
		$this->TableName = 'LeadTable';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`LeadTable`";
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

		// LeadID
		$this->LeadID = new DbField('LeadTable', 'LeadTable', 'x_LeadID', 'LeadID', '`LeadID`', '`LeadID`', 3, -1, FALSE, '`LeadID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->LeadID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->LeadID->IsPrimaryKey = TRUE; // Primary key field
		$this->LeadID->IsForeignKey = TRUE; // Foreign key field
		$this->LeadID->Sortable = TRUE; // Allow sort
		$this->LeadID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LeadID'] = &$this->LeadID;

		// CustomerID
		$this->CustomerID = new DbField('LeadTable', 'LeadTable', 'x_CustomerID', 'CustomerID', '`CustomerID`', '`CustomerID`', 3, -1, FALSE, '`CustomerID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CustomerID->IsForeignKey = TRUE; // Foreign key field
		$this->CustomerID->Nullable = FALSE; // NOT NULL field
		$this->CustomerID->Required = TRUE; // Required field
		$this->CustomerID->Sortable = FALSE; // Allow sort
		$this->CustomerID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['CustomerID'] = &$this->CustomerID;

		// LeadType
		$this->LeadType = new DbField('LeadTable', 'LeadTable', 'x_LeadType', 'LeadType', '`LeadType`', '`LeadType`', 3, -1, FALSE, '`LeadType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LeadType->Nullable = FALSE; // NOT NULL field
		$this->LeadType->Required = TRUE; // Required field
		$this->LeadType->Sortable = FALSE; // Allow sort
		$this->LeadType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['LeadType'] = &$this->LeadType;

		// SiteLocation
		$this->SiteLocation = new DbField('LeadTable', 'LeadTable', 'x_SiteLocation', 'SiteLocation', '`SiteLocation`', '`SiteLocation`', 201, -1, FALSE, '`SiteLocation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->SiteLocation->Nullable = FALSE; // NOT NULL field
		$this->SiteLocation->Required = TRUE; // Required field
		$this->SiteLocation->Sortable = FALSE; // Allow sort
		$this->fields['SiteLocation'] = &$this->SiteLocation;

		// Suburb
		$this->Suburb = new DbField('LeadTable', 'LeadTable', 'x_Suburb', 'Suburb', '`Suburb`', '`Suburb`', 200, -1, FALSE, '`Suburb`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Suburb->Nullable = FALSE; // NOT NULL field
		$this->Suburb->Required = TRUE; // Required field
		$this->Suburb->Sortable = FALSE; // Allow sort
		$this->fields['Suburb'] = &$this->Suburb;

		// ExpectedStart
		$this->ExpectedStart = new DbField('LeadTable', 'LeadTable', 'x_ExpectedStart', 'ExpectedStart', '`ExpectedStart`', CastDateFieldForLike('`ExpectedStart`', 0, "DB"), 135, 0, FALSE, '`ExpectedStart`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ExpectedStart->Nullable = FALSE; // NOT NULL field
		$this->ExpectedStart->Required = TRUE; // Required field
		$this->ExpectedStart->Sortable = FALSE; // Allow sort
		$this->ExpectedStart->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ExpectedStart'] = &$this->ExpectedStart;

		// DateTaken
		$this->DateTaken = new DbField('LeadTable', 'LeadTable', 'x_DateTaken', 'DateTaken', '`DateTaken`', CastDateFieldForLike('`DateTaken`', 0, "DB"), 135, 0, FALSE, '`DateTaken`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateTaken->Nullable = FALSE; // NOT NULL field
		$this->DateTaken->Required = TRUE; // Required field
		$this->DateTaken->Sortable = FALSE; // Allow sort
		$this->DateTaken->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateTaken'] = &$this->DateTaken;

		// TakenBy
		$this->TakenBy = new DbField('LeadTable', 'LeadTable', 'x_TakenBy', 'TakenBy', '`TakenBy`', '`TakenBy`', 200, -1, FALSE, '`TakenBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TakenBy->Nullable = FALSE; // NOT NULL field
		$this->TakenBy->Required = TRUE; // Required field
		$this->TakenBy->Sortable = FALSE; // Allow sort
		$this->fields['TakenBy'] = &$this->TakenBy;

		// IsComplete
		$this->IsComplete = new DbField('LeadTable', 'LeadTable', 'x_IsComplete', 'IsComplete', '`IsComplete`', '`IsComplete`', 16, -1, FALSE, '`IsComplete`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->IsComplete->Nullable = FALSE; // NOT NULL field
		$this->IsComplete->Required = TRUE; // Required field
		$this->IsComplete->Sortable = TRUE; // Allow sort
		$this->IsComplete->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['IsComplete'] = &$this->IsComplete;

		// LeadComment
		$this->LeadComment = new DbField('LeadTable', 'LeadTable', 'x_LeadComment', 'LeadComment', '`LeadComment`', '`LeadComment`', 201, -1, FALSE, '`LeadComment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->LeadComment->Sortable = FALSE; // Allow sort
		$this->fields['LeadComment'] = &$this->LeadComment;
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
		if ($this->getCurrentMasterTable() == "CustomerTable") {
			if ($this->CustomerID->getSessionValue() <> "")
				$masterFilter .= "`CustomerID`=" . QuotedValue($this->CustomerID->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "CustomerTable") {
			if ($this->CustomerID->getSessionValue() <> "")
				$detailFilter .= "`CustomerID`=" . QuotedValue($this->CustomerID->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_CustomerTable()
	{
		return "`CustomerID`=@CustomerID@";
	}

	// Detail filter
	public function sqlDetailFilter_CustomerTable()
	{
		return "`CustomerID`=@CustomerID@";
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
		if ($this->getCurrentDetailTable() == "LeadFileAssociation") {
			$detailUrl = $GLOBALS["LeadFileAssociation"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_LeadID=" . urlencode($this->LeadID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "AssignmentTable") {
			$detailUrl = $GLOBALS["AssignmentTable"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_LeadID=" . urlencode($this->LeadID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "LeadTablelist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`LeadTable`";
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
			$this->LeadID->setDbValue($conn->insert_ID());
			$rs['LeadID'] = $this->LeadID->DbValue;
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
			if (array_key_exists('LeadID', $rs))
				AddFilter($where, QuotedName('LeadID', $this->Dbid) . '=' . QuotedValue($rs['LeadID'], $this->LeadID->DataType, $this->Dbid));
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

		// Cascade delete detail table 'LeadFileAssociation'
		if (!isset($GLOBALS["LeadFileAssociation"]))
			$GLOBALS["LeadFileAssociation"] = new LeadFileAssociation();
		$rscascade = $GLOBALS["LeadFileAssociation"]->loadRs("`LeadID` = " . QuotedValue($rs['LeadID'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["LeadFileAssociation"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["LeadFileAssociation"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["LeadFileAssociation"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'AssignmentTable'
		if (!isset($GLOBALS["AssignmentTable"]))
			$GLOBALS["AssignmentTable"] = new AssignmentTable();
		$rscascade = $GLOBALS["AssignmentTable"]->loadRs("`LeadID` = " . QuotedValue($rs['LeadID'], DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->getRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["AssignmentTable"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["AssignmentTable"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["AssignmentTable"]->Row_Deleted($dtlrow);
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
		$this->LeadID->DbValue = $row['LeadID'];
		$this->CustomerID->DbValue = $row['CustomerID'];
		$this->LeadType->DbValue = $row['LeadType'];
		$this->SiteLocation->DbValue = $row['SiteLocation'];
		$this->Suburb->DbValue = $row['Suburb'];
		$this->ExpectedStart->DbValue = $row['ExpectedStart'];
		$this->DateTaken->DbValue = $row['DateTaken'];
		$this->TakenBy->DbValue = $row['TakenBy'];
		$this->IsComplete->DbValue = $row['IsComplete'];
		$this->LeadComment->DbValue = $row['LeadComment'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`LeadID` = @LeadID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('LeadID', $row) ? $row['LeadID'] : NULL) : $this->LeadID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@LeadID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "LeadTablelist.php";
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
		if ($pageName == "LeadTableview.php")
			return $Language->phrase("View");
		elseif ($pageName == "LeadTableedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "LeadTableadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "LeadTablelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("LeadTableview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("LeadTableview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "LeadTableadd.php?" . $this->getUrlParm($parm);
		else
			$url = "LeadTableadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("LeadTableedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("LeadTableedit.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
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
			$url = $this->keyUrl("LeadTableadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("LeadTableadd.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
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
		return $this->keyUrl("LeadTabledelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "CustomerTable" && !ContainsString($url, TABLE_SHOW_MASTER . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_CustomerID=" . urlencode($this->CustomerID->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "LeadID:" . JsonEncode($this->LeadID->CurrentValue, "number");
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
		if ($this->LeadID->CurrentValue != NULL) {
			$url .= "LeadID=" . urlencode($this->LeadID->CurrentValue);
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
			if (Param("LeadID") !== NULL)
				$arKeys[] = Param("LeadID");
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
			$this->LeadID->CurrentValue = $key;
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
		$this->LeadID->setDbValue($rs->fields('LeadID'));
		$this->CustomerID->setDbValue($rs->fields('CustomerID'));
		$this->LeadType->setDbValue($rs->fields('LeadType'));
		$this->SiteLocation->setDbValue($rs->fields('SiteLocation'));
		$this->Suburb->setDbValue($rs->fields('Suburb'));
		$this->ExpectedStart->setDbValue($rs->fields('ExpectedStart'));
		$this->DateTaken->setDbValue($rs->fields('DateTaken'));
		$this->TakenBy->setDbValue($rs->fields('TakenBy'));
		$this->IsComplete->setDbValue($rs->fields('IsComplete'));
		$this->LeadComment->setDbValue($rs->fields('LeadComment'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// LeadID
		// CustomerID
		// LeadType
		// SiteLocation
		// Suburb
		// ExpectedStart
		// DateTaken
		// TakenBy
		// IsComplete
		// LeadComment
		// LeadID

		$this->LeadID->ViewValue = $this->LeadID->CurrentValue;
		$this->LeadID->ViewCustomAttributes = "";

		// CustomerID
		$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
		$this->CustomerID->ViewValue = FormatNumber($this->CustomerID->ViewValue, 0, -2, -2, -2);
		$this->CustomerID->ViewCustomAttributes = "";

		// LeadType
		$this->LeadType->ViewValue = $this->LeadType->CurrentValue;
		$this->LeadType->ViewValue = FormatNumber($this->LeadType->ViewValue, 0, -2, -2, -2);
		$this->LeadType->ViewCustomAttributes = "";

		// SiteLocation
		$this->SiteLocation->ViewValue = $this->SiteLocation->CurrentValue;
		$this->SiteLocation->ViewCustomAttributes = "";

		// Suburb
		$this->Suburb->ViewValue = $this->Suburb->CurrentValue;
		$this->Suburb->ViewCustomAttributes = "";

		// ExpectedStart
		$this->ExpectedStart->ViewValue = $this->ExpectedStart->CurrentValue;
		$this->ExpectedStart->ViewValue = FormatDateTime($this->ExpectedStart->ViewValue, 0);
		$this->ExpectedStart->ViewCustomAttributes = "";

		// DateTaken
		$this->DateTaken->ViewValue = $this->DateTaken->CurrentValue;
		$this->DateTaken->ViewValue = FormatDateTime($this->DateTaken->ViewValue, 0);
		$this->DateTaken->ViewCustomAttributes = "";

		// TakenBy
		$this->TakenBy->ViewValue = $this->TakenBy->CurrentValue;
		$this->TakenBy->ViewCustomAttributes = "";

		// IsComplete
		$this->IsComplete->ViewValue = $this->IsComplete->CurrentValue;
		$this->IsComplete->ViewValue = FormatNumber($this->IsComplete->ViewValue, 0, -2, -2, -2);
		$this->IsComplete->ViewCustomAttributes = "";

		// LeadComment
		$this->LeadComment->ViewValue = $this->LeadComment->CurrentValue;
		$this->LeadComment->ViewCustomAttributes = "";

		// LeadID
		$this->LeadID->LinkCustomAttributes = "";
		$this->LeadID->HrefValue = "";
		$this->LeadID->TooltipValue = "";

		// CustomerID
		$this->CustomerID->LinkCustomAttributes = "";
		$this->CustomerID->HrefValue = "";
		$this->CustomerID->TooltipValue = "";

		// LeadType
		$this->LeadType->LinkCustomAttributes = "";
		$this->LeadType->HrefValue = "";
		$this->LeadType->TooltipValue = "";

		// SiteLocation
		$this->SiteLocation->LinkCustomAttributes = "";
		$this->SiteLocation->HrefValue = "";
		$this->SiteLocation->TooltipValue = "";

		// Suburb
		$this->Suburb->LinkCustomAttributes = "";
		$this->Suburb->HrefValue = "";
		$this->Suburb->TooltipValue = "";

		// ExpectedStart
		$this->ExpectedStart->LinkCustomAttributes = "";
		$this->ExpectedStart->HrefValue = "";
		$this->ExpectedStart->TooltipValue = "";

		// DateTaken
		$this->DateTaken->LinkCustomAttributes = "";
		$this->DateTaken->HrefValue = "";
		$this->DateTaken->TooltipValue = "";

		// TakenBy
		$this->TakenBy->LinkCustomAttributes = "";
		$this->TakenBy->HrefValue = "";
		$this->TakenBy->TooltipValue = "";

		// IsComplete
		$this->IsComplete->LinkCustomAttributes = "";
		$this->IsComplete->HrefValue = "";
		$this->IsComplete->TooltipValue = "";

		// LeadComment
		$this->LeadComment->LinkCustomAttributes = "";
		$this->LeadComment->HrefValue = "";
		$this->LeadComment->TooltipValue = "";

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

		// LeadID
		$this->LeadID->EditAttrs["class"] = "form-control";
		$this->LeadID->EditCustomAttributes = "";
		$this->LeadID->EditValue = $this->LeadID->CurrentValue;
		$this->LeadID->ViewCustomAttributes = "";

		// CustomerID
		$this->CustomerID->EditAttrs["class"] = "form-control";
		$this->CustomerID->EditCustomAttributes = "";
		if ($this->CustomerID->getSessionValue() <> "") {
			$this->CustomerID->CurrentValue = $this->CustomerID->getSessionValue();
		$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
		$this->CustomerID->ViewValue = FormatNumber($this->CustomerID->ViewValue, 0, -2, -2, -2);
		$this->CustomerID->ViewCustomAttributes = "";
		} else {
		$this->CustomerID->EditValue = $this->CustomerID->CurrentValue;
		$this->CustomerID->PlaceHolder = RemoveHtml($this->CustomerID->caption());
		}

		// LeadType
		$this->LeadType->EditAttrs["class"] = "form-control";
		$this->LeadType->EditCustomAttributes = "";
		$this->LeadType->EditValue = $this->LeadType->CurrentValue;
		$this->LeadType->PlaceHolder = RemoveHtml($this->LeadType->caption());

		// SiteLocation
		$this->SiteLocation->EditAttrs["class"] = "form-control";
		$this->SiteLocation->EditCustomAttributes = "";
		$this->SiteLocation->EditValue = $this->SiteLocation->CurrentValue;
		$this->SiteLocation->PlaceHolder = RemoveHtml($this->SiteLocation->caption());

		// Suburb
		$this->Suburb->EditAttrs["class"] = "form-control";
		$this->Suburb->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Suburb->CurrentValue = HtmlDecode($this->Suburb->CurrentValue);
		$this->Suburb->EditValue = $this->Suburb->CurrentValue;
		$this->Suburb->PlaceHolder = RemoveHtml($this->Suburb->caption());

		// ExpectedStart
		$this->ExpectedStart->EditAttrs["class"] = "form-control";
		$this->ExpectedStart->EditCustomAttributes = "";
		$this->ExpectedStart->EditValue = FormatDateTime($this->ExpectedStart->CurrentValue, 8);
		$this->ExpectedStart->PlaceHolder = RemoveHtml($this->ExpectedStart->caption());

		// DateTaken
		$this->DateTaken->EditAttrs["class"] = "form-control";
		$this->DateTaken->EditCustomAttributes = "";
		$this->DateTaken->EditValue = FormatDateTime($this->DateTaken->CurrentValue, 8);
		$this->DateTaken->PlaceHolder = RemoveHtml($this->DateTaken->caption());

		// TakenBy
		$this->TakenBy->EditAttrs["class"] = "form-control";
		$this->TakenBy->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->TakenBy->CurrentValue = HtmlDecode($this->TakenBy->CurrentValue);
		$this->TakenBy->EditValue = $this->TakenBy->CurrentValue;
		$this->TakenBy->PlaceHolder = RemoveHtml($this->TakenBy->caption());

		// IsComplete
		$this->IsComplete->EditAttrs["class"] = "form-control";
		$this->IsComplete->EditCustomAttributes = "";
		$this->IsComplete->EditValue = $this->IsComplete->CurrentValue;
		$this->IsComplete->PlaceHolder = RemoveHtml($this->IsComplete->caption());

		// LeadComment
		$this->LeadComment->EditAttrs["class"] = "form-control";
		$this->LeadComment->EditCustomAttributes = "";
		$this->LeadComment->EditValue = $this->LeadComment->CurrentValue;
		$this->LeadComment->PlaceHolder = RemoveHtml($this->LeadComment->caption());

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
					$doc->exportCaption($this->LeadID);
					$doc->exportCaption($this->CustomerID);
					$doc->exportCaption($this->LeadType);
					$doc->exportCaption($this->SiteLocation);
					$doc->exportCaption($this->Suburb);
					$doc->exportCaption($this->ExpectedStart);
					$doc->exportCaption($this->DateTaken);
					$doc->exportCaption($this->TakenBy);
					$doc->exportCaption($this->IsComplete);
					$doc->exportCaption($this->LeadComment);
				} else {
					$doc->exportCaption($this->LeadID);
					$doc->exportCaption($this->CustomerID);
					$doc->exportCaption($this->LeadType);
					$doc->exportCaption($this->Suburb);
					$doc->exportCaption($this->ExpectedStart);
					$doc->exportCaption($this->DateTaken);
					$doc->exportCaption($this->TakenBy);
					$doc->exportCaption($this->IsComplete);
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
						$doc->exportField($this->LeadID);
						$doc->exportField($this->CustomerID);
						$doc->exportField($this->LeadType);
						$doc->exportField($this->SiteLocation);
						$doc->exportField($this->Suburb);
						$doc->exportField($this->ExpectedStart);
						$doc->exportField($this->DateTaken);
						$doc->exportField($this->TakenBy);
						$doc->exportField($this->IsComplete);
						$doc->exportField($this->LeadComment);
					} else {
						$doc->exportField($this->LeadID);
						$doc->exportField($this->CustomerID);
						$doc->exportField($this->LeadType);
						$doc->exportField($this->Suburb);
						$doc->exportField($this->ExpectedStart);
						$doc->exportField($this->DateTaken);
						$doc->exportField($this->TakenBy);
						$doc->exportField($this->IsComplete);
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