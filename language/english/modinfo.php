<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */
define('_MI_GARAGE_NAME', 'Repair-Shop');
define('_MI_GARAGE_DESC', 'Module for a car repair shop');

define('_MI_GARAGE_VEHICULE', 'Cars');
define('_MI_GARAGE_CLIENTS', 'Customers');
define('_MI_GARAGE_FOURNISSEURS', 'Suppliers');
define('_MI_GARAGE_PIECES', 'Spare parts');
define('_MI_GARAGE_MARQUES', 'Car Maker');
define('_MI_GARAGE_EMPLOYES', 'Workers');
define('_MI_GARAGE_CAT_PIECES', 'Spare parts categories');
define('_MI_GARAGE_INTER', 'Repairs');
define('_MI_GARAGE_FORFAIT', 'Package');
define('_MI_GARAGE_REPINPR', 'Repair in progress');
define('_MI_GARAGE_REPSOLD', 'Repair ended');
define('_MI_GARAGE_REPARCH', 'Repair archived');

//blocks
define('_MI_GARAGE_INTER_EC', 'Repair in progress');

//preferences config
define('_MI_GARAGE_MECAT1', 'Hour cost T1 M&eacute;canique');
define('_MI_GARAGE_DESC_MECAT1', '<b>current work</b>');
define('_MI_GARAGE_MECAT2', 'Hour cost T2 M&eacute;canique');
define('_MI_GARAGE_DESC_MECAT2', '<b>Complex work</b>');
define('_MI_GARAGE_MECAT3', 'Hour cost T3 M&eacute;canique');
define('_MI_GARAGE_DESC_MECAT3', '<b>High technology work</b>');
define('_MI_GARAGE_CARROT1', 'Hour cost T1 Carrosserie');
define('_MI_GARAGE_DESC_CARROT1', '<b>current work</b>');
define('_MI_GARAGE_CARROT2', 'Hour cost T2 Carrosserie');
define('_MI_GARAGE_DESC_CARROT2', '<b>Complex work</b>');
define('_MI_GARAGE_CARROT3', 'Hour cost T3 Carrosserie');
define('_MI_GARAGE_DESC_CARROT3', '<b>High technology work</b>');

define('_MI_GARAGE_SHOW_DOC', 'Show documentation in admin area');
define('_MI_GARAGE_DESC_SHOW_DOC', 'This option allow to show or not information in each part of admin');

define('_MI_GARAGE_MONNAIE', 'currency symbol');
define('_MI_GARAGE_TX_TVA', 'VAT rate');

define('_MI_GARAGE_MODIF_MOD_ALLOW', "Hide the 'action' button in the repair detail (hours)");
define('_MI_GARAGE_DESC_MODIF_MOD_ALLOW', 'Disable hours and comment update/deletion form user side');
define('_MI_GARAGE_MODIF_PCE_ALLOW', 'Disable spare parts update/deletion form user side');
define('_MI_GARAGE_DESC_MODIF_PCE_ALLOW', "Hide the 'action' button in the repair detail (spare parts)");
define('_MI_GARAGE_MODIF_FOR_ALLOW', 'Disable package update/deletion from user side');
define('_MI_GARAGE_DESC_MODIF_FOR_ALLOW', "Hide the 'action' button in the repair detail (packages)");

define('_MI_GARAGE_RAISON_SOCIALE', 'business name');
define('_MI_GARAGE_DESC_RS', 'business name for the footer at the bottom of quotation and invoice');
define('_MI_GARAGE_RCS', 'Additional text for the footer');
define('_MI_GARAGE_DESC_RCS', 'second text for the footer at the bottom of quotation and invoice');
define('_MI_GARAGE_SOCIETE', 'Name, address, phone...');
define('_MI_GARAGE_DESC_SOCIETE', 'These informations are used at the top of the documents<br>(just begind the logo)');
define('_MI_GARAGE_IMPRESSION', 'Direct printing');
define('_MI_GARAGE_DESC_IMPRESSION', 'Open the printing popup directly when you call the quotation or invoice');

define('_MI_GARAGE_FCT_FACTURE', 'Invoice Function');
define('_MI_GARAGE_DESC_FCT_FACTURE', 'Activate the invoicing function. show a spcific button to print invoices');

define('_MI_GARAGE_IMP_FACTURE', 'Invoice printing');
define('_MI_GARAGE_DESC_IMP_FACTURE', 'Allow the invoice function in the user side (if not just admin are allowed to print invoices');

define('_MI_GARAGE_AUT_SOLDE', 'Allow terminate repair');
define('_MI_GARAGE_DESC_AUT_SOLDE', 'Allow the standard user to close the repair');

define('_MI_GARAGE_AUT_ARCHIVE', 'Allow to archive');
define('_MI_GARAGE_DESC_AUT_ARCHIVE', 'Allow the standard user to archive the repair');

define('_MI_GARAGE_AFF_ONGLET_DOC', 'Show documentation menu');
define('_MI_GARAGE_DESC_AFF_ONGLET_DOC', "Show the documentation in the admin area.<br>It does'nt hide the documentation system in the different tag but just the doc menu where you can update the help text.");

// The name of this module
//define('_MI_GARAGE_NAME',"Repair Shop");
define('_MI_GARAGE_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_GARAGE_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_GARAGE_BACK_2_ADMIN', 'Back to Administration of ');

//define('_MI_GARAGE_HELP_DIR', __DIR__);

//help
define('_MI_GARAGE_HELP_OVERVIEW', 'Overview');

define('_MI_GARAGE_DOC', 'Documentation');
define('_MI_GARAGE_TRASH', 'Trash');
