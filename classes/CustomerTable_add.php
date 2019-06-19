<?php
namespace PHPMaker2019\ASbuiltProject;

/**
 * Page class
 */
class CustomerTable_add extends CustomerTable
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{0F066488-51F4-4512-9E75-792816ED19E6}";

	// Table name
	public $TableName = 'CustomerTable';

	// Page object name
	public $PageObjName = "CustomerTable_add";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
					$this->terminate(GetUrl("CustomerTablelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->CustomerID->Visible = FALSE;
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
			if (Get("CustomerID") !== NULL) {
				$this->CustomerID->setQueryStringValue(Get("CustomerID"));
				$this->setKey("CustomerID", $this->CustomerID->CurrentValue); // Set up key
			} else {
				$this->setKey("CustomerID", ""); // Clear key
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
					$this->terminate("CustomerTablelist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "CustomerTablelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "CustomerTableview.php")
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
		$this->CustomerID->CurrentValue = NULL;
		$this->CustomerID->OldValue = $this->CustomerID->CurrentValue;
		$this->CustomerName->CurrentValue = NULL;
		$this->CustomerName->OldValue = $this->CustomerName->CurrentValue;
		$this->CustomerEmail->CurrentValue = NULL;
		$this->CustomerEmail->OldValue = $this->CustomerEmail->CurrentValue;
		$this->CustomerPhone->CurrentValue = NULL;
		$this->CustomerPhone->OldValue = $this->CustomerPhone->CurrentValue;
		$this->BillingAddress->CurrentValue = NULL;
		$this->BillingAddress->OldValue = $this->BillingAddress->CurrentValue;
		$this->CustomerTelephone->CurrentValue = NULL;
		$this->CustomerTelephone->OldValue = $this->CustomerTelephone->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

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

		// Check field name 'CustomerID' first before field var 'x_CustomerID'
		$val = $CurrentForm->hasValue("CustomerID") ? $CurrentForm->getValue("CustomerID") : $CurrentForm->getValue("x_CustomerID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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
		$this->loadDefaultValues();
		$row = [];
		$row['CustomerID'] = $this->CustomerID->CurrentValue;
		$row['CustomerName'] = $this->CustomerName->CurrentValue;
		$row['CustomerEmail'] = $this->CustomerEmail->CurrentValue;
		$row['CustomerPhone'] = $this->CustomerPhone->CurrentValue;
		$row['BillingAddress'] = $this->BillingAddress->CurrentValue;
		$row['CustomerTelephone'] = $this->CustomerTelephone->CurrentValue;
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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

			// Add refer script
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
		if (in_array("LeadTable", $detailTblVar) && $GLOBALS["LeadTable"]->DetailAdd) {
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

		// CustomerName
		$this->CustomerName->setDbValueDef($rsnew, $this->CustomerName->CurrentValue, NULL, FALSE);

		// CustomerEmail
		$this->CustomerEmail->setDbValueDef($rsnew, $this->CustomerEmail->CurrentValue, NULL, FALSE);

		// CustomerPhone
		$this->CustomerPhone->setDbValueDef($rsnew, $this->CustomerPhone->CurrentValue, "", FALSE);

		// BillingAddress
		$this->BillingAddress->setDbValueDef($rsnew, $this->BillingAddress->CurrentValue, "", FALSE);

		// CustomerTelephone
		$this->CustomerTelephone->setDbValueDef($rsnew, $this->CustomerTelephone->CurrentValue, NULL, FALSE);

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
			if (in_array("LeadTable", $detailTblVar) && $GLOBALS["LeadTable"]->DetailAdd) {
				$GLOBALS["LeadTable"]->CustomerID->setSessionValue($this->CustomerID->CurrentValue); // Set master key
				if (!isset($GLOBALS["LeadTable_grid"]))
					$GLOBALS["LeadTable_grid"] = new LeadTable_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "LeadTable"); // Load user level of detail table
				$addRow = $GLOBALS["LeadTable_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["LeadTable"]->CustomerID->setSessionValue(""); // Clear master key if insert failed
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
				if ($GLOBALS["LeadTable_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["LeadTable_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["LeadTable_grid"]->CurrentMode = "add";
					$GLOBALS["LeadTable_grid"]->CurrentAction = "gridadd";

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