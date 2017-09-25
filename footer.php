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

$xoopsTpl->assign('mod_dirname', $xoopsModule->getVar('dirname'));
$xoopsTpl->assign('mod_dir_image', XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/assets/images');
if ($xoopsUser) {
    if ('' == $xoopsUser->getVar('name')) {
        $xoopsTpl->assign('xoops_name', $xoopsUser->getVar('uname'));
    } else {
        $xoopsTpl->assign('xoops_name', $xoopsUser->getVar('name'));
    }
} else {
    $xoopsTpl->assign('xoops_name', 'Anonyme');
}
require_once XOOPS_ROOT_PATH . '/footer.php';
