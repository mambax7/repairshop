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

include __DIR__ . '/../../../include/cp_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
require_once __DIR__ . '/config.inc.php';

$perm_name = 'XORGACHART';
$module_id = $xoopsModule->getVar('mid');

$cat[CREATION] = ['name' => 'XXXXX', 'parent' => 0];

$title_of_form = "Droits d'acc&egrave;s";
$perm_desc     = 'S&eacute;lectionner les acc&egrave;s pour chaque groupe';

$form = new XoopsGroupPermForm($title_of_form, $module_id, $perm_name, $perm_desc);
foreach ($cat as $cat_id => $cat_data) {
    $form->addItem($cat_id, $cat_data['name'], $cat_data['parent']);
}

//xoops_cp_header();
$xoopsTpl->assign('content', $form->render());
//xoops_cp_footer();
