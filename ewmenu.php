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
$sideMenu->addMenuItem(4, "mi_CustomerTable", $MenuLanguage->MenuPhrase("4", "MenuText"), "CustomerTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}CustomerTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_LeadTable", $MenuLanguage->MenuPhrase("8", "MenuText"), "LeadTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}LeadTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_LeadTypeLookup", $MenuLanguage->MenuPhrase("9", "MenuText"), "LeadTypeLookuplist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}LeadTypeLookup'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_ProductTable", $MenuLanguage->MenuPhrase("10", "MenuText"), "ProductTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}ProductTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_TeamTable", $MenuLanguage->MenuPhrase("13", "MenuText"), "TeamTablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}TeamTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_WorkerAttendanceTable", $MenuLanguage->MenuPhrase("17", "MenuText"), "WorkerAttendanceTablelist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}WorkerAttendanceTable'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(18, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("18", "MenuText"), "userlevelpermissionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_userlevels", $MenuLanguage->MenuPhrase("19", "MenuText"), "userlevelslist.php", -1, "", IsLoggedIn() || AllowListMenu('{0F066488-51F4-4512-9E75-792816ED19E6}userlevels'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>