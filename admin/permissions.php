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

include __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';

$op = '';

if (isset($HTTP_POST_VARS)) {
    foreach ($HTTP_POST_VARS as $k => $v) {
        ${$k} = $v;
    }
}

if (isset($HTTP_GET_VARS)) {
    foreach ($HTTP_GET_VARS as $k => $v) {
        ${$k} = $v;
    }
}

switch ($op) {
    case 'default':
    default:
        global $xoopsDB, $xoopsModule;

        $item_list = [];
        $block     = [];
        $module_id = $xoopsModule->getVar('mid');
        xoops_cp_header();

        echo "<table width='100%'><tr><td align='center'><img src='../Image/pages.gif' alt='' title=''></td><td align='right' width='55'><a href='../help/help.php'><img src='../Image/help.gif' alt='aide' title='aide'></a></td></tr></table><br>";
        pages_tabsAdminMenu(__FILE__);

        $result          = $xoopsDB->query('SELECT CID, pagetitle FROM ' . $xoopsDB->prefix('pages') . ' ');
        $permissioncount = $xoopsDB->getRowsNum($result);

        echo "<fieldset><legend style='font-weight: bold; color: #900;'>" . _AM_GROUPPERMISSIONS . '</legend>';
        if ($permissioncount > 0) {
            while ($myrow = $xoopsDB->fetcharray($result)) {
                $item_list          = [];
                $item_list['cid']   = $myrow['CID'];
                $item_list['title'] = $myrow['pagetitle'];

                //$title_of_form = 'Pages permission matrix';
                $title_of_form = '';
                $perm_name     = 'Page_permissions';
                $perm_desc     = _AM_PERMISSIONCHECK;

                $form    = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);
                $block[] = $item_list;

                foreach ($block as $itemlists) {
                    $form->addItem($itemlists['cid'], $itemlists['title']);
                }
            }
            echo $form->render();
        } else {
            echo "<div style='padding: 8px;'>" . _AM_NOTHINGHEREYET . '</div>';
        }
        echo '</fieldset>';

        xoops_cp_footer();
        exit();
        break;
}
xoops_cp_footer();
