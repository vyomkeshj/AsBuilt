<?php
namespace PHPMaker2019\ASbuiltProject;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_AssignmentTable", $MenuLanguage->MenuPhrase("1", "MenuText"), "AssignmentTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}AssignmentTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_Cart_View", $MenuLanguage->MenuPhrase("2", "MenuText"), "Cart_Viewlist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}Cart View'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_CartTable", $MenuLanguage->MenuPhrase("3", "MenuText"), "CartTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}CartTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_CustomerTable", $MenuLanguage->MenuPhrase("4", "MenuText"), "CustomerTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}CustomerTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_JobSessionTable", $MenuLanguage->MenuPhrase("5", "MenuText"), "JobSessionTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}JobSessionTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_JobWorkerTable", $MenuLanguage->MenuPhrase("6", "MenuText"), "JobWorkerTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}JobWorkerTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_LeadFileAssociation", $MenuLanguage->MenuPhrase("7", "MenuText"), "LeadFileAssociationlist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}LeadFileAssociation'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_LeadTable", $MenuLanguage->MenuPhrase("8", "MenuText"), "LeadTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}LeadTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_LeadTypeLookup", $MenuLanguage->MenuPhrase("9", "MenuText"), "LeadTypeLookuplist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}LeadTypeLookup'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_ProductTable", $MenuLanguage->MenuPhrase("10", "MenuText"), "ProductTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}ProductTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_Team_Member_View", $MenuLanguage->MenuPhrase("11", "MenuText"), "Team_Member_Viewlist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}Team Member View'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_TeamMemberTable", $MenuLanguage->MenuPhrase("12", "MenuText"), "TeamMemberTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}TeamMemberTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_TeamTable", $MenuLanguage->MenuPhrase("13", "MenuText"), "TeamTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}TeamTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_UserAuthTable", $MenuLanguage->MenuPhrase("14", "MenuText"), "UserAuthTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}UserAuthTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(15, "mi_View1", $MenuLanguage->MenuPhrase("15", "MenuText"), "View1list.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}View1'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_View2", $MenuLanguage->MenuPhrase("16", "MenuText"), "View2list.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}View2'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_WorkerAttendanceTable", $MenuLanguage->MenuPhrase("17", "MenuText"), "WorkerAttendanceTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}WorkerAttendanceTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(18, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("18", "MenuText"), "userlevelpermissionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_userlevels", $MenuLanguage->MenuPhrase("19", "MenuText"), "userlevelslist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}userlevels'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>