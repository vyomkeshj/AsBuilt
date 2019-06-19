<?php
namespace PHPMaker2019\ASbuiltProject;

/**
 * Page class
 */
class LeadTable_add extends LeadTable
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{0F066488-51F4-4512-9E75-792816ED19E6}";

	// Table name
	public $TableName = 'LeadTable';

	// Page object name
	public $PageObjName = "LeadTable_add";

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

		// Table object (LeadTable)
		if (!isset($GLOBALS["LeadTable"]) || get_class($GLOBALS["LeadTable"]) == PROJECT_NAMESPACE . "LeadTable") {
			$GLOBALS["LeadTable"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["LeadTable"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (CustomerTable)
		if (!isset($GLOBALS['CustomerTable']))
			$GLOBALS['CustomerTable'] = new CustomerTable();

		// Table object (JobWorkerTable)
		if (!isset($GLOBALS['JobWorkerTable']))
			$GLOBALS['JobWorkerTable'] = new JobWorkerTable();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'LeadTable');

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
		global $EXPORT, $LeadTable;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($LeadTable);
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
					if ($pageName == "LeadTableview.php")
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
			$key .= @$ar['LeadID'];
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
			$this->LeadID->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("LeadTablelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->LeadID->Visible = FALSE;
		$this->CustomerID->setVisibility();
		$this->LeadType->setVisibility();
		$this->SiteLocation->setVisibility();
		$this->Suburb->setVisibility();
		$this->ExpectedStart->setVisibility();
		$this->DateTaken->setVisibility();
		$this->TakenBy->setVisibility();
		$this->IsComplete->setVisibility();
		$this->LeadComment->setVisibility();
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
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("LeadID") !== NULL) {
				$this->LeadID->setQueryStringValue(Get("LeadID"));
				$this->setKey("LeadID", $this->LeadID->CurrentValue); // Set up key
			} else {
				$this->setKey("LeadID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->setupDetailParms();

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("LeadTablelist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "LeadTablelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "LeadTableview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->LeadID->CurrentValue = NULL;
		$this->LeadID->OldValue = $this->LeadID->CurrentValue;
		$this->CustomerID->CurrentValue = NULL;
		$this->CustomerID->OldValue = $this->CustomerID->CurrentValue;
		$this->LeadType->CurrentValue = NULL;
		$this->LeadType->OldValue = $this->LeadType->CurrentValue;
		$this->SiteLocation->CurrentValue = NULL;
		$this->SiteLocation->OldValue = $this->SiteLocation->CurrentValue;
		$this->Suburb->CurrentValue = NULL;
		$this->Suburb->OldValue = $this->Suburb->CurrentValue;
		$this->ExpectedStart->CurrentValue = NULL;
		$this->ExpectedStart->OldValue = $this->ExpectedStart->CurrentValue;
		$this->DateTaken->CurrentValue = NULL;
		$this->DateTaken->OldValue = $this->DateTaken->CurrentValue;
		$this->TakenBy->CurrentValue = NULL;
		$this->TakenBy->OldValue = $this->TakenBy->CurrentValue;
		$this->IsComplete->CurrentValue = 0;
		$this->LeadComment->CurrentValue = "None";
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'CustomerID' first before field var 'x_CustomerID'
		$val = $CurrentForm->hasValue("CustomerID") ? $CurrentForm->getValue("CustomerID") : $CurrentForm->getValue("x_CustomerID");
		if (!$this->CustomerID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->CustomerID->Visible = FALSE; // Disable update for API request
			else
				$this->CustomerID->setFormValue($val);
		}

		// Check field name 'LeadType' first before field var 'x_LeadType'
		$val = $CurrentForm->hasValue("LeadType") ? $CurrentForm->getValue("LeadType") : $CurrentForm->getValue("x_LeadType");
		if (!$this->LeadType->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LeadType->Visible = FALSE; // Disable update for API request
			else
				$this->LeadType->setFormValue($val);
		}

		// Check field name 'SiteLocation' first before field var 'x_SiteLocation'
		$val = $CurrentForm->hasValue("SiteLocation") ? $CurrentForm->getValue("SiteLocation") : $CurrentForm->getValue("x_SiteLocation");
		if (!$this->SiteLocation->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SiteLocation->Visible = FALSE; // Disable update for API request
			else
				$this->SiteLocation->setFormValue($val);
		}

		// Check field name 'Suburb' first before field var 'x_Suburb'
		$val = $CurrentForm->hasValue("Suburb") ? $CurrentForm->getValue("Suburb") : $CurrentForm->getValue("x_Suburb");
		if (!$this->Suburb->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Suburb->Visible = FALSE; // Disable update for API request
			else
				$this->Suburb->setFormValue($val);
		}

		// Check field name 'ExpectedStart' first before field var 'x_ExpectedStart'
		$val = $CurrentForm->hasValue("ExpectedStart") ? $CurrentForm->getValue("ExpectedStart") : $CurrentForm->getValue("x_ExpectedStart");
		if (!$this->ExpectedStart->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ExpectedStart->Visible = FALSE; // Disable update for API request
			else
				$this->ExpectedStart->setFormValue($val);
			$this->ExpectedStart->CurrentValue = UnFormatDateTime($this->ExpectedStart->CurrentValue, 0);
		}

		// Check field name 'DateTaken' first before field var 'x_DateTaken'
		$val = $CurrentForm->hasValue("DateTaken") ? $CurrentForm->getValue("DateTaken") : $CurrentForm->getValue("x_DateTaken");
		if (!$this->DateTaken->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateTaken->Visible = FALSE; // Disable update for API request
			else
				$this->DateTaken->setFormValue($val);
			$this->DateTaken->CurrentValue = UnFormatDateTime($this->DateTaken->CurrentValue, 0);
		}

		// Check field name 'TakenBy' first before field var 'x_TakenBy'
		$val = $CurrentForm->hasValue("TakenBy") ? $CurrentForm->getValue("TakenBy") : $CurrentForm->getValue("x_TakenBy");
		if (!$this->TakenBy->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->TakenBy->Visible = FALSE; // Disable update for API request
			else
				$this->TakenBy->setFormValue($val);
		}

		// Check field name 'IsComplete' first before field var 'x_IsComplete'
		$val = $CurrentForm->hasValue("IsComplete") ? $CurrentForm->getValue("IsComplete") : $CurrentForm->getValue("x_IsComplete");
		if (!$this->IsComplete->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IsComplete->Visible = FALSE; // Disable update for API request
			else
				$this->IsComplete->setFormValue($val);
		}

		// Check field name 'LeadComment' first before field var 'x_LeadComment'
		$val = $CurrentForm->hasValue("LeadComment") ? $CurrentForm->getValue("LeadComment") : $CurrentForm->getValue("x_LeadComment");
		if (!$this->LeadComment->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LeadComment->Visible = FALSE; // Disable update for API request
			else
				$this->LeadComment->setFormValue($val);
		}

		// Check field name 'LeadID' first before field var 'x_LeadID'
		$val = $CurrentForm->hasValue("LeadID") ? $CurrentForm->getValue("LeadID") : $CurrentForm->getValue("x_LeadID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->CustomerID->CurrentValue = $this->CustomerID->FormValue;
		$this->LeadType->CurrentValue = $this->LeadType->FormValue;
		$this->SiteLocation->CurrentValue = $this->SiteLocation->FormValue;
		$this->Suburb->CurrentValue = $this->Suburb->FormValue;
		$this->ExpectedStart->CurrentValue = $this->ExpectedStart->FormValue;
		$this->ExpectedStart->CurrentValue = UnFormatDateTime($this->ExpectedStart->CurrentValue, 0);
		$this->DateTaken->CurrentValue = $this->DateTaken->FormValue;
		$this->DateTaken->CurrentValue = UnFormatDateTime($this->DateTaken->CurrentValue, 0);
		$this->TakenBy->CurrentValue = $this->TakenBy->FormValue;
		$this->IsComplete->CurrentValue = $this->IsComplete->FormValue;
		$this->LeadComment->CurrentValue = $this->LeadComment->FormValue;
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
		$this->LeadID->setDbValue($row['LeadID']);
		$this->CustomerID->setDbValue($row['CustomerID']);
		$this->LeadType->setDbValue($row['LeadType']);
		$this->SiteLocation->setDbValue($row['SiteLocation']);
		$this->Suburb->setDbValue($row['Suburb']);
		$this->ExpectedStart->setDbValue($row['ExpectedStart']);
		$this->DateTaken->setDbValue($row['DateTaken']);
		$this->TakenBy->setDbValue($row['TakenBy']);
		$this->IsComplete->setDbValue($row['IsComplete']);
		$this->LeadComment->setDbValue($row['LeadComment']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['LeadID'] = $this->LeadID->CurrentValue;
		$row['CustomerID'] = $this->CustomerID->CurrentValue;
		$row['LeadType'] = $this->LeadType->CurrentValue;
		$row['SiteLocation'] = $this->SiteLocation->CurrentValue;
		$row['Suburb'] = $this->Suburb->CurrentValue;
		$row['ExpectedStart'] = $this->ExpectedStart->CurrentValue;
		$row['DateTaken'] = $this->DateTaken->CurrentValue;
		$row['TakenBy'] = $this->TakenBy->CurrentValue;
		$row['IsComplete'] = $this->IsComplete->CurrentValue;
		$row['LeadComment'] = $this->LeadComment->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("LeadID")) <> "")
			$this->LeadID->CurrentValue = $this->getKey("LeadID"); // LeadID
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// CustomerID
			$this->CustomerID->EditAttrs["class"] = "form-control";
			$this->CustomerID->EditCustomAttributes = "";
			if ($this->CustomerID->getSessionValue() <> "") {
				$this->CustomerID->CurrentValue = $this->CustomerID->getSessionValue();
			$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
			$this->CustomerID->ViewValue = FormatNumber($this->CustomerID->ViewValue, 0, -2, -2, -2);
			$this->CustomerID->ViewCustomAttributes = "";
			} else {
			$this->CustomerID->EditValue = HtmlEncode($this->CustomerID->CurrentValue);
			$this->CustomerID->PlaceHolder = RemoveHtml($this->CustomerID->caption());
			}

			// LeadType
			$this->LeadType->EditAttrs["class"] = "form-control";
			$this->LeadType->EditCustomAttributes = "";
			$this->LeadType->EditValue = HtmlEncode($this->LeadType->CurrentValue);
			$this->LeadType->PlaceHolder = RemoveHtml($this->LeadType->caption());

			// SiteLocation
			$this->SiteLocation->EditAttrs["class"] = "form-control";
			$this->SiteLocation->EditCustomAttributes = "";
			$this->SiteLocation->EditValue = HtmlEncode($this->SiteLocation->CurrentValue);
			$this->SiteLocation->PlaceHolder = RemoveHtml($this->SiteLocation->caption());

			// Suburb
			$this->Suburb->EditAttrs["class"] = "form-control";
			$this->Suburb->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Suburb->CurrentValue = HtmlDecode($this->Suburb->CurrentValue);
			$this->Suburb->EditValue = HtmlEncode($this->Suburb->CurrentValue);
			$this->Suburb->PlaceHolder = RemoveHtml($this->Suburb->caption());

			// ExpectedStart
			$this->ExpectedStart->EditAttrs["class"] = "form-control";
			$this->ExpectedStart->EditCustomAttributes = "";
			$this->ExpectedStart->EditValue = HtmlEncode(FormatDateTime($this->ExpectedStart->CurrentValue, 8));
			$this->ExpectedStart->PlaceHolder = RemoveHtml($this->ExpectedStart->caption());

			// DateTaken
			$this->DateTaken->EditAttrs["class"] = "form-control";
			$this->DateTaken->EditCustomAttributes = "";
			$this->DateTaken->EditValue = HtmlEncode(FormatDateTime($this->DateTaken->CurrentValue, 8));
			$this->DateTaken->PlaceHolder = RemoveHtml($this->DateTaken->caption());

			// TakenBy
			$this->TakenBy->EditAttrs["class"] = "form-control";
			$this->TakenBy->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->TakenBy->CurrentValue = HtmlDecode($this->TakenBy->CurrentValue);
			$this->TakenBy->EditValue = HtmlEncode($this->TakenBy->CurrentValue);
			$this->TakenBy->PlaceHolder = RemoveHtml($this->TakenBy->caption());

			// IsComplete
			$this->IsComplete->EditAttrs["class"] = "form-control";
			$this->IsComplete->EditCustomAttributes = "";
			$this->IsComplete->EditValue = HtmlEncode($this->IsComplete->CurrentValue);
			$this->IsComplete->PlaceHolder = RemoveHtml($this->IsComplete->caption());

			// LeadComment
			$this->LeadComment->EditAttrs["class"] = "form-control";
			$this->LeadComment->EditCustomAttributes = "";
			$this->LeadComment->EditValue = HtmlEncode($this->LeadComment->CurrentValue);
			$this->LeadComment->PlaceHolder = RemoveHtml($this->LeadComment->caption());

			// Add refer script
			// CustomerID

			$this->CustomerID->LinkCustomAttributes = "";
			$this->CustomerID->HrefValue = "";

			// LeadType
			$this->LeadType->LinkCustomAttributes = "";
			$this->LeadType->HrefValue = "";

			// SiteLocation
			$this->SiteLocation->LinkCustomAttributes = "";
			$this->SiteLocation->HrefValue = "";

			// Suburb
			$this->Suburb->LinkCustomAttributes = "";
			$this->Suburb->HrefValue = "";

			// ExpectedStart
			$this->ExpectedStart->LinkCustomAttributes = "";
			$this->ExpectedStart->HrefValue = "";

			// DateTaken
			$this->DateTaken->LinkCustomAttributes = "";
			$this->DateTaken->HrefValue = "";

			// TakenBy
			$this->TakenBy->LinkCustomAttributes = "";
			$this->TakenBy->HrefValue = "";

			// IsComplete
			$this->IsComplete->LinkCustomAttributes = "";
			$this->IsComplete->HrefValue = "";

			// LeadComment
			$this->LeadComment->LinkCustomAttributes = "";
			$this->LeadComment->HrefValue = "";
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
		if ($this->LeadID->Required) {
			if (!$this->LeadID->IsDetailKey && $this->LeadID->FormValue != NULL && $this->LeadID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LeadID->caption(), $this->LeadID->RequiredErrorMessage));
			}
		}
		if ($this->CustomerID->Required) {
			if (!$this->CustomerID->IsDetailKey && $this->CustomerID->FormValue != NULL && $this->CustomerID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CustomerID->caption(), $this->CustomerID->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->CustomerID->FormValue)) {
			AddMessage($FormError, $this->CustomerID->errorMessage());
		}
		if ($this->LeadType->Required) {
			if (!$this->LeadType->IsDetailKey && $this->LeadType->FormValue != NULL && $this->LeadType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LeadType->caption(), $this->LeadType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->LeadType->FormValue)) {
			AddMessage($FormError, $this->LeadType->errorMessage());
		}
		if ($this->SiteLocation->Required) {
			if (!$this->SiteLocation->IsDetailKey && $this->SiteLocation->FormValue != NULL && $this->SiteLocation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SiteLocation->caption(), $this->SiteLocation->RequiredErrorMessage));
			}
		}
		if ($this->Suburb->Required) {
			if (!$this->Suburb->IsDetailKey && $this->Suburb->FormValue != NULL && $this->Suburb->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Suburb->caption(), $this->Suburb->RequiredErrorMessage));
			}
		}
		if ($this->ExpectedStart->Required) {
			if (!$this->ExpectedStart->IsDetailKey && $this->ExpectedStart->FormValue != NULL && $this->ExpectedStart->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ExpectedStart->caption(), $this->ExpectedStart->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->ExpectedStart->FormValue)) {
			AddMessage($FormError, $this->ExpectedStart->errorMessage());
		}
		if ($this->DateTaken->Required) {
			if (!$this->DateTaken->IsDetailKey && $this->DateTaken->FormValue != NULL && $this->DateTaken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateTaken->caption(), $this->DateTaken->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateTaken->FormValue)) {
			AddMessage($FormError, $this->DateTaken->errorMessage());
		}
		if ($this->TakenBy->Required) {
			if (!$this->TakenBy->IsDetailKey && $this->TakenBy->FormValue != NULL && $this->TakenBy->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->TakenBy->caption(), $this->TakenBy->RequiredErrorMessage));
			}
		}
		if ($this->IsComplete->Required) {
			if (!$this->IsComplete->IsDetailKey && $this->IsComplete->FormValue != NULL && $this->IsComplete->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IsComplete->caption(), $this->IsComplete->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->IsComplete->FormValue)) {
			AddMessage($FormError, $this->IsComplete->errorMessage());
		}
		if ($this->LeadComment->Required) {
			if (!$this->LeadComment->IsDetailKey && $this->LeadComment->FormValue != NULL && $this->LeadComment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LeadComment->caption(), $this->LeadComment->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("LeadFileAssociation", $detailTblVar) && $GLOBALS["LeadFileAssociation"]->DetailAdd) {
			if (!isset($GLOBALS["LeadFileAssociation_grid"]))
				$GLOBALS["LeadFileAssociation_grid"] = new LeadFileAssociation_grid(); // Get detail page object
			$GLOBALS["LeadFileAssociation_grid"]->validateGridForm();
		}
		if (in_array("AssignmentTable", $detailTblVar) && $GLOBALS["AssignmentTable"]->DetailAdd) {
			if (!isset($GLOBALS["AssignmentTable_grid"]))
				$GLOBALS["AssignmentTable_grid"] = new AssignmentTable_grid(); // Get detail page object
			$GLOBALS["AssignmentTable_grid"]->validateGridForm();
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// CustomerID
		$this->CustomerID->setDbValueDef($rsnew, $this->CustomerID->CurrentValue, 0, FALSE);

		// LeadType
		$this->LeadType->setDbValueDef($rsnew, $this->LeadType->CurrentValue, 0, FALSE);

		// SiteLocation
		$this->SiteLocation->setDbValueDef($rsnew, $this->SiteLocation->CurrentValue, "", FALSE);

		// Suburb
		$this->Suburb->setDbValueDef($rsnew, $this->Suburb->CurrentValue, "", FALSE);

		// ExpectedStart
		$this->ExpectedStart->setDbValueDef($rsnew, UnFormatDateTime($this->ExpectedStart->CurrentValue, 0), CurrentDate(), FALSE);

		// DateTaken
		$this->DateTaken->setDbValueDef($rsnew, UnFormatDateTime($this->DateTaken->CurrentValue, 0), CurrentDate(), FALSE);

		// TakenBy
		$this->TakenBy->setDbValueDef($rsnew, $this->TakenBy->CurrentValue, "", FALSE);

		// IsComplete
		$this->IsComplete->setDbValueDef($rsnew, $this->IsComplete->CurrentValue, 0, strval($this->IsComplete->CurrentValue) == "");

		// LeadComment
		$this->LeadComment->setDbValueDef($rsnew, $this->LeadComment->CurrentValue, NULL, strval($this->LeadComment->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("LeadFileAssociation", $detailTblVar) && $GLOBALS["LeadFileAssociation"]->DetailAdd) {
				$GLOBALS["LeadFileAssociation"]->LeadID->setSessionValue($this->LeadID->CurrentValue); // Set master key
				if (!isset($GLOBALS["LeadFileAssociation_grid"]))
					$GLOBALS["LeadFileAssociation_grid"] = new LeadFileAssociation_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "LeadFileAssociation"); // Load user level of detail table
				$addRow = $GLOBALS["LeadFileAssociation_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["LeadFileAssociation"]->LeadID->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("AssignmentTable", $detailTblVar) && $GLOBALS["AssignmentTable"]->DetailAdd) {
				$GLOBALS["AssignmentTable"]->LeadID->setSessionValue($this->LeadID->CurrentValue); // Set master key
				if (!isset($GLOBALS["AssignmentTable_grid"]))
					$GLOBALS["AssignmentTable_grid"] = new AssignmentTable_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "AssignmentTable"); // Load user level of detail table
				$addRow = $GLOBALS["AssignmentTable_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["AssignmentTable"]->LeadID->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (Get(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Get(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "CustomerTable") {
				$validMaster = TRUE;
				if (Get("fk_CustomerID") !== NULL) {
					$this->CustomerID->setQueryStringValue(Get("fk_CustomerID"));
					$this->CustomerID->setSessionValue($this->CustomerID->QueryStringValue);
					if (!is_numeric($this->CustomerID->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (Post(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Post(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "CustomerTable") {
				$validMaster = TRUE;
				if (Post("fk_CustomerID") !== NULL) {
					$this->CustomerID->setFormValue(Post("fk_CustomerID"));
					$this->CustomerID->setSessionValue($this->CustomerID->FormValue);
					if (!is_numeric($this->CustomerID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($masterTblVar <> "CustomerTable") {
				if ($this->CustomerID->CurrentValue == "")
					$this->CustomerID->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
			if (in_array("LeadFileAssociation", $detailTblVar)) {
				if (!isset($GLOBALS["LeadFileAssociation_grid"]))
					$GLOBALS["LeadFileAssociation_grid"] = new LeadFileAssociation_grid();
				if ($GLOBALS["LeadFileAssociation_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["LeadFileAssociation_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["LeadFileAssociation_grid"]->CurrentMode = "add";
					$GLOBALS["LeadFileAssociation_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["LeadFileAssociation_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["LeadFileAssociation_grid"]->setStartRecordNumber(1);
					$GLOBALS["LeadFileAssociation_grid"]->LeadID->IsDetailKey = TRUE;
					$GLOBALS["LeadFileAssociation_grid"]->LeadID->CurrentValue = $this->LeadID->CurrentValue;
					$GLOBALS["LeadFileAssociation_grid"]->LeadID->setSessionValue($GLOBALS["LeadFileAssociation_grid"]->LeadID->CurrentValue);
				}
			}
			if (in_array("AssignmentTable", $detailTblVar)) {
				if (!isset($GLOBALS["AssignmentTable_grid"]))
					$GLOBALS["AssignmentTable_grid"] = new AssignmentTable_grid();
				if ($GLOBALS["AssignmentTable_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["AssignmentTable_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["AssignmentTable_grid"]->CurrentMode = "add";
					$GLOBALS["AssignmentTable_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["AssignmentTable_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["AssignmentTable_grid"]->setStartRecordNumber(1);
					$GLOBALS["AssignmentTable_grid"]->LeadID->IsDetailKey = TRUE;
					$GLOBALS["AssignmentTable_grid"]->LeadID->CurrentValue = $this->LeadID->CurrentValue;
					$GLOBALS["AssignmentTable_grid"]->LeadID->setSessionValue($GLOBALS["AssignmentTable_grid"]->LeadID->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("LeadTablelist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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