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

function b_pages_list()
{
    global $xoopsDB, $xoopsModule, $myts;
    $myts             = MyTextSanitizer::getInstance();
    $block['content'] = ' ';
    $result2          = $xoopsDB->query('SELECT CID FROM ' . $xoopsDB->prefix('pages') . '');
    $numrows          = $xoopsDB->getRowsNum($result2);

    if ($numrows > 0) {
        $sql    = 'SELECT CID, pagetitle, pageheadline, weight, publishdate FROM ' . $xoopsDB->prefix('pages') . ' WHERE mainpage <>0 OR defaultpage =1 ORDER BY weight, pagetitle ASC';
        $result = $xoopsDB->query($sql);
        while (list($CID, $pagetitle, $pageheadline, $publishdate) = $xoopsDB->fetchrow($result)) {
            $pagetitle        = $myts->htmlSpecialChars($pagetitle);
            $block['content'] .= "<li><a href='" . XOOPS_URL . "/modules/pages/index.php?pagenum=$CID'>" . $pagetitle . '</a></li>';
        }
    } else {
        $block['content'] = _MD_NOPAGE;
    }

    return $block;
}
