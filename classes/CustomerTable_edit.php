<?php
namespace PHPMaker2019\ASbuiltProject;

/**
 * Page class
 */
class CustomerTable_edit extends CustomerTable
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{0F066488-51F4-4512-9E75-792816ED19E6}";

	// Table name
	public $TableName = 'CustomerTable';

	// Page object name
	public $PageObjName = "CustomerTable_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (CustomerTable)
		if (!isset($GLOBALS["CustomerTable"]) || get_class($GLOBALS["CustomerTable"]) == PROJECT_NAMESPACE . "CustomerTable") {
			$GLOBALS["CustomerTable"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["CustomerTable"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (JobWorkerTable)
		if (!isset($GLOBALS['JobWorkerTable']))
			$GLOBALS['JobWorkerTable'] = new JobWorkerTable();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'CustomerTable');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (JobWorkerTable)
		if (!isset($UserTable)) {
			$UserTable = new JobWorkerTable();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $CustomerTable;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($CustomerTable);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "CustomerTableview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['CustomerID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->CustomerID->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("CustomerTablelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->CustomerID->setVisibility();
		$this->CustomerName->setVisibility();
		$this->CustomerEmail->setVisibility();
		$this->CustomerPhone->setVisibility();
		$this->BillingAddress->setVisibility();
		$this->CustomerTelephone->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_CustomerID")) {
				$this->CustomerID->setFormValue($CurrentForm->getValue("x_CustomerID"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("CustomerID") !== NULL) {
				$this->CustomerID->setQueryStringValue(Get("CustomerID"));
				$loadByQuery = TRUE;
			} else {
				$this->CustomerID->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("CustomerTablelist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$returnUrl = $this->getViewUrl(TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "CustomerTablelist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'CustomerID' first before field var 'x_CustomerID'
		$val = $CurrentForm->hasValue("CustomerID") ? $CurrentForm->getValue("CustomerID") : $CurrentForm->getValue("x_CustomerID");
		if (!$this->CustomerID->IsDetailKey)
			$this->CustomerID->setFormValue($val);

		// Check field name 'CustomerName' first before field var 'x_CustomerName'
		$val = $CurrentForm->hasValue("CustomerName") ? $CurrentForm->getValue("CustomerName") : $CurrentForm->getValue("x_CustomerName");
		if (!$this->CustomerName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CustomerName->Visible = FALSE; // Disable update for API request
			else
				$this->CustomerName->setFormValue($val);
		}

		// Check field name 'CustomerEmail' first before field var 'x_CustomerEmail'
		$val = $CurrentForm->hasValue("CustomerEmail") ? $CurrentForm->getValue("CustomerEmail") : $CurrentForm->getValue("x_CustomerEmail");
		if (!$this->CustomerEmail->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CustomerEmail->Visible = FALSE; // Disable update for API request
			else
				$this->CustomerEmail->setFormValue($val);
		}

		// Check field name 'CustomerPhone' first before field var 'x_CustomerPhone'
		$val = $CurrentForm->hasValue("CustomerPhone") ? $CurrentForm->getValue("CustomerPhone") : $CurrentForm->getValue("x_CustomerPhone");
		if (!$this->CustomerPhone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CustomerPhone->Visible = FALSE; // Disable update for API request
			else
				$this->CustomerPhone->setFormValue($val);
		}

		// Check field name 'BillingAddress' first before field var 'x_BillingAddress'
		$val = $CurrentForm->hasValue("BillingAddress") ? $CurrentForm->getValue("BillingAddress") : $CurrentForm->getValue("x_BillingAddress");
		if (!$this->BillingAddress->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BillingAddress->Visible = FALSE; // Disable update for API request
			else
				$this->BillingAddress->setFormValue($val);
		}

		// Check field name 'CustomerTelephone' first before field var 'x_CustomerTelephone'
		$val = $CurrentForm->hasValue("CustomerTelephone") ? $CurrentForm->getValue("CustomerTelephone") : $CurrentForm->getValue("x_CustomerTelephone");
		if (!$this->CustomerTelephone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CustomerTelephone->Visible = FALSE; // Disable update for API request
			else
				$this->CustomerTelephone->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->CustomerID->CurrentValue = $this->CustomerID->FormValue;
		$this->CustomerName->CurrentValue = $this->CustomerName->FormValue;
		$this->CustomerEmail->CurrentValue = $this->CustomerEmail->FormValue;
		$this->CustomerPhone->CurrentValue = $this->CustomerPhone->FormValue;
		$this->BillingAddress->CurrentValue = $this->BillingAddress->FormValue;
		$this->CustomerTelephone->CurrentValue = $this->CustomerTelephone->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->CustomerID->setDbValue($row['CustomerID']);
		$this->CustomerName->setDbValue($row['CustomerName']);
		$this->CustomerEmail->setDbValue($row['CustomerEmail']);
		$this->CustomerPhone->setDbValue($row['CustomerPhone']);
		$this->BillingAddress->setDbValue($row['BillingAddress']);
		$this->CustomerTelephone->setDbValue($row['CustomerTelephone']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['CustomerID'] = NULL;
		$row['CustomerName'] = NULL;
		$row['CustomerEmail'] = NULL;
		$row['CustomerPhone'] = NULL;
		$row['BillingAddress'] = NULL;
		$row['CustomerTelephone'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("CustomerID")) <> "")
			$this->CustomerID->CurrentValue = $this->getKey("CustomerID"); // CustomerID
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// CustomerID
		// CustomerName
		// CustomerEmail
		// CustomerPhone
		// BillingAddress
		// CustomerTelephone

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// CustomerID
			$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
			$this->CustomerID->ViewCustomAttributes = "";

			// CustomerName
			$this->CustomerName->ViewValue = $this->CustomerName->CurrentValue;
			$this->CustomerName->ViewCustomAttributes = "";

			// CustomerEmail
			$this->CustomerEmail->ViewValue = $this->CustomerEmail->CurrentValue;
			$this->CustomerEmail->ViewCustomAttributes = "";

			// CustomerPhone
			$this->CustomerPhone->ViewValue = $this->CustomerPhone->CurrentValue;
			$this->CustomerPhone->ViewCustomAttributes = "";

			// BillingAddress
			$this->BillingAddress->ViewValue = $this->BillingAddress->CurrentValue;
			$this->BillingAddress->ViewCustomAttributes = "";

			// CustomerTelephone
			$this->CustomerTelephone->ViewValue = $this->CustomerTelephone->CurrentValue;
			$this->CustomerTelephone->ViewValue = FormatNumber($this->CustomerTelephone->ViewValue, 0, -2, -2, -2);
			$this->CustomerTelephone->ViewCustomAttributes = "";

			// CustomerID
			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";
			$this->CustomerID->TooltipValue = "";

			// CustomerName
			$this->CustomerName->LinkCustomAttributes = "";
			$this->CustomerName->HrefValue = "";
			$this->CustomerName->TooltipValue = "";

			// CustomerEmail
			$this->CustomerEmail->LinkCustomAttributes = "";
			$this->CustomerEmail->HrefValue = "";
			$this->CustomerEmail->TooltipValue = "";

			// CustomerPhone
			$this->CustomerPhone->LinkCustomAttributes = "";
			$this->CustomerPhone->HrefValue = "";
			$this->CustomerPhone->TooltipValue = "";

			// BillingAddress
			$this->BillingAddress->LinkCustomAttributes = "";
			$this->BillingAddress->HrefValue = "";
			$this->BillingAddress->TooltipValue = "";

			// CustomerTelephone
			$this->CustomerTelephone->LinkCustomAttributes = "";
			$this->CustomerTelephone->HrefValue = "";
			$this->CustomerTelephone->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// CustomerID
			$this->CustomerID->EditAttrs["class"] = "form-control";
			$this->CustomerID->EditCustomAttributes = "";
			$this->CustomerID->EditValue = $this->CustomerID->CurrentValue;
			$this->CustomerID->ViewCustomAttributes = "";

			// CustomerName
			$this->CustomerName->EditAttrs["class"] = "form-control";
			$this->CustomerName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CustomerName->CurrentValue = HtmlDecode($this->CustomerName->CurrentValue);
			$this->CustomerName->EditValue = HtmlEncode($this->CustomerName->CurrentValue);
			$this->CustomerName->PlaceHolder = RemoveHtml($this->CustomerName->caption());

			// CustomerEmail
			$this->CustomerEmail->EditAttrs["class"] = "form-control";
			$this->CustomerEmail->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->CustomerEmail->CurrentValue = HtmlDecode($this->CustomerEmail->CurrentValue);
			$this->CustomerEmail->EditValue = HtmlEncode($this->CustomerEmail->CurrentValue);
			$this->CustomerEmail->PlaceHolder = RemoveHtml($this->CustomerEmail->caption());

			// CustomerPhone
			$this->CustomerPhone->EditAttrs["class"] = "form-control";
			$this->CustomerPhone->EditCustomAttributes = "";
			$this->CustomerPhone->EditValue = HtmlEncode($this->CustomerPhone->CurrentValue);
			$this->CustomerPhone->PlaceHolder = RemoveHtml($this->CustomerPhone->caption());

			// BillingAddress
			$this->BillingAddress->EditAttrs["class"] = "form-control";
			$this->BillingAddress->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->BillingAddress->CurrentValue = HtmlDecode($this->BillingAddress->CurrentValue);
			$this->BillingAddress->EditValue = HtmlEncode($this->BillingAddress->CurrentValue);
			$this->BillingAddress->PlaceHolder = RemoveHtml($this->BillingAddress->caption());

			// CustomerTelephone
			$this->CustomerTelephone->EditAttrs["class"] = "form-control";
			$this->CustomerTelephone->EditCustomAttributes = "";
			$this->CustomerTelephone->EditValue = HtmlEncode($this->CustomerTelephone->CurrentValue);
			$this->CustomerTelephone->PlaceHolder = RemoveHtml($this->CustomerTelephone->caption());

			// Edit refer script
			// CustomerID

			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";

			// CustomerName
			$this->CustomerName->LinkCustomAttributes = "";
			$this->CustomerName->HrefValue = "";

			// CustomerEmail
			$this->CustomerEmail->LinkCustomAttributes = "";
			$this->CustomerEmail->HrefValue = "";

			// CustomerPhone
			$this->CustomerPhone->LinkCustomAttributes = "";
			$this->CustomerPhone->HrefValue = "";

			// BillingAddress
			$this->BillingAddress->LinkCustomAttributes = "";
			$this->BillingAddress->HrefValue = "";

			// CustomerTelephone
			$this->CustomerTelephone->LinkCustomAttributes = "";
			$this->CustomerTelephone->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->CustomerID->Required) {
			if (!$this->CustomerID->IsDetailKey && $this->CustomerID->FormValue != NULL && $this->CustomerID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerID->caption(), $this->CustomerID->RequiredErrorMessage));
			}
		}
		if ($this->CustomerName->Required) {
			if (!$this->CustomerName->IsDetailKey && $this->CustomerName->FormValue != NULL && $this->CustomerName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerName->caption(), $this->CustomerName->RequiredErrorMessage));
			}
		}
		if ($this->CustomerEmail->Required) {
			if (!$this->CustomerEmail->IsDetailKey && $this->CustomerEmail->FormValue != NULL && $this->CustomerEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerEmail->caption(), $this->CustomerEmail->RequiredErrorMessage));
			}
		}
		if ($this->CustomerPhone->Required) {
			if (!$this->CustomerPhone->IsDetailKey && $this->CustomerPhone->FormValue != NULL && $this->CustomerPhone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerPhone->caption(), $this->CustomerPhone->RequiredErrorMessage));
			}
		}
		if ($this->BillingAddress->Required) {
			if (!$this->BillingAddress->IsDetailKey && $this->BillingAddress->FormValue != NULL && $this->BillingAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BillingAddress->caption(), $this->BillingAddress->RequiredErrorMessage));
			}
		}
		if ($this->CustomerTelephone->Required) {
			if (!$this->CustomerTelephone->IsDetailKey && $this->CustomerTelephone->FormValue != NULL && $this->CustomerTelephone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerTelephone->caption(), $this->CustomerTelephone->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->CustomerTelephone->FormValue)) {
			AddMessage($FormError, $this->CustomerTelephone->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("LeadTable", $detailTblVar) && $GLOBALS["LeadTable"]->DetailEdit) {
			if (!isset($GLOBALS["LeadTable_grid"]))
				$GLOBALS["LeadTable_grid"] = new LeadTable_grid(); // Get detail page object
			$GLOBALS["LeadTable_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// CustomerName
			$this->CustomerName->setDbValueDef($rsnew, $this->CustomerName->CurrentValue, NULL, $this->CustomerName->ReadOnly);

			// CustomerEmail
			$this->CustomerEmail->setDbValueDef($rsnew, $this->CustomerEmail->CurrentValue, NULL, $this->CustomerEmail->ReadOnly);

			// CustomerPhone
			$this->CustomerPhone->setDbValueDef($rsnew, $this->CustomerPhone->CurrentValue, "", $this->CustomerPhone->ReadOnly);

			// BillingAddress
			$this->BillingAddress->setDbValueDef($rsnew, $this->BillingAddress->CurrentValue, "", $this->BillingAddress->ReadOnly);

			// CustomerTelephone
			$this->CustomerTelephone->setDbValueDef($rsnew, $this->CustomerTelephone->CurrentValue, NULL, $this->CustomerTelephone->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("LeadTable", $detailTblVar) && $GLOBALS["LeadTable"]->DetailEdit) {
						if (!isset($GLOBALS["LeadTable_grid"]))
							$GLOBALS["LeadTable_grid"] = new LeadTable_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "LeadTable"); // Load user level of detail table
						$editRow = $GLOBALS["LeadTable_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		if (Get(TABLE_SHOW_DETAIL) !== NULL) {
			$detailTblVar = Get(TABLE_SHOW_DETAIL);
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar <> "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("LeadTable", $detailTblVar)) {
				if (!isset($GLOBALS["LeadTable_grid"]))
					$GLOBALS["LeadTable_grid"] = new LeadTable_grid();
				if ($GLOBALS["LeadTable_grid"]->DetailEdit) {
					$GLOBALS["LeadTable_grid"]->CurrentMode = "edit";
					$GLOBALS["LeadTable_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["LeadTable_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["LeadTable_grid"]->setStartRecordNumber(1);
					$GLOBALS["LeadTable_grid"]->CustomerID->IsDetailKey = TRUE;
					$GLOBALS["LeadTable_grid"]->CustomerID->CurrentValue = $this->CustomerID->CurrentValue;
					$GLOBALS["LeadTable_grid"]->CustomerID->setSessionValue($GLOBALS["LeadTable_grid"]->CustomerID->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CustomerTablelist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>