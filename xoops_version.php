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

$moduleDirName = basename(__DIR__);
//global $xoopsDB, $xoopsUser, $xoopsConfig, $myts, $xoopsModule, $xoopsModuleConfig;

$modversion = [
    'version'             => 1.51,
    'module_status'       => 'Beta 1',
    'release_date'        => '2016/03/28', //yyyy/mm/dd
    'name'                => _MI_GARAGE_NAME,
    'description'         => _MI_GARAGE_DESC,
    'official'            => 0, //1 indicates supported by XOOPS Dev Team, 0 means 3rd party supported
    'author'              => 'P.Masson (aka philou from frxoops)',
    'author_mail'         => 'author-email',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS',
    'credits'             => 'XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    'help'                => 'page=help',
    //
    'release_info'        => 'Changelog',
    'release_file'        => XOOPS_URL . '/modules/{$moduleDirName}/docs/changelog file',
    //
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . '/modules/{$moduleDirName}/docs/install.txt',
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.9',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    // images
    'image'               => 'assets/images/logoModule.png',
    'iconsmall'           => 'assets/images/iconsmall.png',
    'iconbig'             => 'assets/images/iconbig.png',
    'dirname'             => "{$moduleDirName}",
    //Frameworks
    //    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    //    'sysicons16'          => 'Frameworks/moduleclasses/icons/16',
    //    'sysicons32'          => 'Frameworks/moduleclasses/icons/32',
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin menu
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Main menu
    'hasMain'             => 1,
    //Search & Comments
    //    'hasSearch'           => 1,
    //    'search'              => array(
    //        'file'   => 'include/search.inc.php',
    //        'func'   => 'XXXX_search'),
    //    'hasComments'         => 1,
    //    'comments'              => array(
    //        'pageName'   => 'index.php',
    //        'itemName'   => 'id'),

    // Install/Update
    //    'onInstall'           => 'include/oninstall.php',
    //  'onUninstall'         => 'include/onuninstall.php',
    //    'onUpdate'            => 'include/onupdate.php'

];

//about
//$modversion["author_website_url"] = "http://www.philox.info/";
//$modversion["author_website_name"] = "Philippe Masson";
//

// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'] = [
    'garage_clients',
    'garage_vehicule',
    'garage_intervention',
    'garage_inter_pieces',
    'garage_inter_temp',
    'garage_inter_forfait',
    'garage_forfait',
    'garage_nomenc_forfait',
    'garage_pieces',
    'garage_cat_piece',
    'garage_fournisseur',
    'garage_marque',
    'garage_employe',
    'garage_num_doc',
    'garage_doc'
];

// Blocks
$modversion['blocks'][1]['file']      = 'garage_ec.php';
$modversion['blocks'][1]['name']      = _MI_GARAGE_INTER_EC;
$modversion['blocks'][1]['show_func'] = 'garage_ec_list';

// Menu
$modversion['hasMain']         = 1;
$i                             = 1;
$modversion['sub'][$i]['name'] = _MI_GARAGE_REPINPR;
$modversion['sub'][$i]['url']  = 'index.php?solde=0';
++$i;
$modversion['sub'][$i]['name'] = _MI_GARAGE_REPSOLD;
$modversion['sub'][$i]['url']  = 'index.php?solde=1';
++$i;
$modversion['sub'][$i]['name'] = _MI_GARAGE_REPARCH;
$modversion['sub'][$i]['url']  = 'index.php?solde=2';
/*
++$i;
$modversion['sub'][$i]['name'] = "Cr&eacute;ation dossier";
$modversion['sub'][$i]['url'] = "intervention.php";
*/
// Templates
$modversion['templates'][1]['file']        = 'devis_print.html';
$modversion['templates'][1]['description'] = 'Printing quote';
$modversion['templates'][2]['file']        = 'facture_print.html';
$modversion['templates'][2]['description'] = 'Printing invoice';

// Search
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'repair_search';

// preferences
$cpto = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'meca_t1';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MECAT1';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_MECAT1';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = 38.64;

++$cpto;
$modversion['config'][$cpto]['name']        = 'meca_t2';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MECAT2';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_MECAT2';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = 41.85;

++$cpto;
$modversion['config'][$cpto]['name']        = 'meca_t3';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MECAT3';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_MECAT3';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = 49.00;

++$cpto;
$modversion['config'][$cpto]['name']        = 'carro_t1';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_CARROT1';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_CARROT1';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = 38.64;

++$cpto;
$modversion['config'][$cpto]['name']        = 'carro_t2';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_CARROT2';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_CARROT2';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = 44.50;

++$cpto;
$modversion['config'][$cpto]['name']        = 'carro_t3';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_CARROT3';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_CARROT3';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = 53.00;

++$cpto;
$modversion['config'][$cpto]['name']        = 'documentation';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_SHOW_DOC';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_SHOW_DOC';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'money';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MONNAIE';
$modversion['config'][$cpto]['description'] = '';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'text';
$modversion['config'][$cpto]['default']     = '&euro;';

++$cpto;
$modversion['config'][$cpto]['name']        = 'tva';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_TX_TVA';
$modversion['config'][$cpto]['description'] = '';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'float';
$modversion['config'][$cpto]['default']     = '19.6';

++$cpto;
$modversion['config'][$cpto]['name']        = 'modif_inter_mod';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MODIF_MOD_ALLOW';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_MODIF_MOD_ALLOW';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'modif_inter_pce';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MODIF_PCE_ALLOW';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_MODIF_PCE_ALLOW';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'modif_inter_for';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_MODIF_FOR_ALLOW';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_MODIF_FOR_ALLOW';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'raison_sociale';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_RAISON_SOCIALE';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_RS';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'text';
//$modversion['config'][$cpto]['default'] = 'XXXXX';
$modversion['config'][$cpto]['default'] = '';

++$cpto;
$modversion['config'][$cpto]['name']        = 'rcs';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_RCS';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_RCS';
$modversion['config'][$cpto]['formtype']    = 'textbox';
$modversion['config'][$cpto]['valuetype']   = 'text';
//$modversion['config'][$cpto]['default'] = 'XXX-XXX-XXX RCS XXXXXX';
$modversion['config'][$cpto]['default'] = '';

++$cpto;
$modversion['config'][$cpto]['name']        = 'societe';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_SOCIETE';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_SOCIETE';
$modversion['config'][$cpto]['formtype']    = 'textarea';
$modversion['config'][$cpto]['valuetype']   = 'text';
$modversion['config'][$cpto]['default']     = '';

++$cpto;
$modversion['config'][$cpto]['name']        = 'impression_directe';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_IMPRESSION';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_IMPRESSION';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'fonction_facture';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_FCT_FACTURE';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_FCT_FACTURE';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 1;

++$cpto;
$modversion['config'][$cpto]['name']        = 'impression_facture_non_admin';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_IMP_FACTURE';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_IMP_FACTURE';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'autoriser_solde';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_AUT_SOLDE';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_AUT_SOLDE';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'autoriser_archive';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_AUT_ARCHIVE';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_AUT_ARCHIVE';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;

++$cpto;
$modversion['config'][$cpto]['name']        = 'documentation';
$modversion['config'][$cpto]['title']       = '_MI_GARAGE_AFF_ONGLET_DOC';
$modversion['config'][$cpto]['description'] = '_MI_GARAGE_DESC_AFF_ONGLET_DOC';
$modversion['config'][$cpto]['formtype']    = 'yesno';
$modversion['config'][$cpto]['valuetype']   = 'int';
$modversion['config'][$cpto]['default']     = 0;
