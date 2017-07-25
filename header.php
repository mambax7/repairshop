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

include __DIR__ . '/../../mainfile.php';

// Permission associ&eacute;e au module
/*
$perm_name = 'XORGACHART';
if ($xoopsUser)  $groups = $xoopsUser->getGroups();
else $groups = XOOPS_GROUP_ANONYMOUS;
$module_id = $xoopsModule->getVar("mid");
$gpermHandler =  xoops_getHandler('groupperm');
*/
$myts = MyTextSanitizer::getInstance();
foreach ($_POST as $k => $v) {
    if (is_string($v)) {
        $$k = $myts->stripSlashesGPC($v);
    } else {
        $$k = $v;
    }
}
foreach ($_GET as $k => $v) {
    if (is_string($v)) {
        $$k = $myts->stripSlashesGPC($v);
    } else {
        $$k = $v;
    }
}
