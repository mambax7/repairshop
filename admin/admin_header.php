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

require_once __DIR__ . '/../../../include/cp_header.php';
require_once $GLOBALS['xoops']->path('www/class/xoopsformloader.php');

//require_once __DIR__ . '/../class/utility.php';
//require_once __DIR__ . '/../include/common.php';

$moduleDirName = basename(dirname(__DIR__));

//$moduleDirName = $GLOBALS['xoopsModule']->getVar('dirname');

$pathIcon16           = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('sysicons16'));
$pathIcon32           = $GLOBALS['xoops']->url('www/' . $GLOBALS['xoopsModule']->getInfo('sysicons32'));
$xoopsModuleAdminPath = $GLOBALS['xoops']->path('www/' . $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin'));
require_once "{$xoopsModuleAdminPath}/moduleadmin.php";

$myts = MyTextSanitizer::getInstance();
if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
}

//include_once(XOOPS_ROOT_PATH."/class/xoopsmodule.php");
require_once $GLOBALS['xoops']->path("modules/{$moduleDirName}/include/functions.php");

//$mod_path = XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname();
define('MOD_PATH', XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->dirname());
define('MOD_DIR', $xoopsModule->dirname());

define('TAB_INDEX', 1);
define('TAB_PERMISSION', 10);

if ($xoopsUser) {
    $xoopsModule = XoopsModule::getByDirname('repair');
    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header($xoopsConfig['xoops_url'] . ' / ', 3, _NOPERM);
        exit();
    }
} else {
    redirect_header($xoopsConfig['xoops_url'] . ' / ', 3, _NOPERM);
    exit();
}

$GLOBALS['xoopsTpl']->assign('pathIcon16', $pathIcon16);
$GLOBALS['xoopsTpl']->assign('pathIcon32', $pathIcon32);

// Load language files
xoops_loadLanguage('admin', $moduleDirName);
xoops_loadLanguage('modinfo', $moduleDirName);
xoops_loadLanguage('main', $moduleDirName);

//xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
