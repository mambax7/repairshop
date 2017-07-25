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

$moduleDirName = basename(dirname(__DIR__));

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon32    = \Xmf\Module\Admin::menuIconPath('');
$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

$moduleHelper->loadLanguage('modinfo');

xoops_loadLanguage('modinfo', $moduleDirName);

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png'
);

//global $xoopsConfig;

$adminmenu[] = array(
    'title' => _MI_GARAGE_INTER,
    'link'  => 'admin/intervention.php',
    'icon'  => $pathModIcon32 . '/ajouter.png'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_VEHICULE,
    'link'  => 'admin/vehicule.php',
    'icon'  => $pathModIcon32 . '/voiture.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_CLIENTS,
    'link'  => 'admin/client.php',
    'icon'  => $pathModIcon32 . '/client.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_FOURNISSEURS,
    'link'  => 'admin/fournisseur.php',
    'icon'  => $pathModIcon32 . '/fournisseur.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_PIECES,
    'link'  => 'admin/piece.php',
    'icon'  => $pathModIcon32 . '/piece2.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_CAT_PIECES,
    'link'  => 'admin/cat_piece.php',
    'icon'  => $pathModIcon32 . '/categorie.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_MARQUES,
    'link'  => 'admin/marque.php',
    'icon'  => $pathModIcon32 . '/marque-voiture.jpg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_FORFAIT,
    'link'  => 'admin/forfait.php',
    'icon'  => $pathModIcon32 . '/forfait-reparation.jpg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_EMPLOYES,
    'link'  => 'admin/employe.php',
    'icon'  => $pathModIcon32 . '/employe.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_DOC,
    'link'  => 'admin/gest_doc.php',
    'icon'  => $pathModIcon32 . '/doc.jpeg'
);

$adminmenu[] = array(
    'title' => _MI_GARAGE_TRASH,
    'link'  => 'admin/trash.php',
    'icon'  => $pathModIcon32 . '/corbeille.jpeg'
);

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png'
);
