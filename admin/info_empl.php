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

require_once __DIR__ . '/admin_header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
require_once XOOPS_ROOT_PATH . '/class/uploader.php';

if (!isset($_POST['id_serv'])) {
    $id_serv = isset($_GET['id_serv']) ? $_GET['id_serv'] : '';
} else {
    $id_serv = $_POST['id_serv'];
}
$myts = MyTextSanitizer::getInstance();
global $xoopsDB, $myts, $id_service;
//xoops_cp_header();
$id_service = $id_serv;

echo bonjour;

$result5 = $xoopsDB->query('SELECT name FROM xoopsv2_users');

echo "<table class=\"outer\" width=\"100%\">\n"
     . '<th><div class="center;">'
     . _AM_ORGA_SERV_CID
     . "</div></th>\n"
     . '<th><div class="center;">'
     . _AM_ORGA_SERV_NAME
     . "</div></th>\n"
     . '<th><div class="center;">'
     . _AM_ORGA_SERV_PERE
     . "</div></th>\n"
     . '<th><div class="center;">'
     . _AM_ORGA_SERV_CHEF
     . "</div></th>\n"
     . '<th><div class="center;">'
     . _AM_ORGA_SERV_SECR
     . "</div></th>\n"
     . '<th><div class="center;">'
     . _AM_ORGA_SERV_ADJ
     . "</div></th>\n"
     . "<th colspan=\"3\"><div class="center;">"
     . _AM_ACTION
     . "</div></th>\n";

$result     = $xoopsDB->query('SELECT id_serv, nom_serv, pere, chef, secretaire, adjoint FROM ' . $xoopsDB->prefix('service') . " WHERE id_serv='" . $id_service . "'");
$service    = [];
$service[0] = '---- NA ----';
while (false !== (list($id_serv, $nom_serv, $pere, $chef, $secretaire, $adjoint) = $xoopsDB->fetchRow($result))) {
    $id_chef           = $chef;
    $id_adj            = $adjoint;
    $id_sec            = $secretaire;
    $service[$id_serv] = $nom_serv;
    echo '<tr>';
    echo '<td class="odd" ALIGN="left">' . $id_serv . '</td>';
    echo '<td class="odd" ALIGN="left">' . $nom_serv . '</td>';
    echo '<td class="odd" ALIGN="left">' . $pere . '</td>';
    if ('0' == $chef) {
        $chef = '-- NA --';
    }
    echo '<td class="odd" ALIGN="left">' . $chef . '</td>';
    if ('0' == $secretaire) {
        $secretaire = '-- NA --';
    }
    echo '<td class="odd" ALIGN="left">' . $secretaire . '</td>';
    if ('0' == $adjoint) {
        $adjoint = '-- NA --';
    }
    echo '<td class="odd" ALIGN="left">' . $adjoint . '</td>';
    echo '<td class="odd" align="center"><A HREF="contact.php?op=addmem&id_serv=' . $id_serv . '"><img src="../assets/images/profil.gif"></a></td>';
    echo '<td class="odd" align="center"><A HREF="contact.php?op=modifser&id_serv=' . $id_serv . '"><img src="../assets/images/edit.png"></a></td>';
    echo '<td class="odd" align="center"><A HREF="contact.php?op=suprser&id_serv=' . $id_serv . '"><img src="../assets/images/delete.png"></a></td>';
}
$i         = 0;
$test_chef = $id_chef;
$test_sec  = $id_sec;
$test_adj  = $id_adj;
$result2   = $xoopsDB->query('SELECT id_empl, id_serv FROM ' . $xoopsDB->prefix('affecte') . " WHERE id_serv='" . $id_service . "'");
while (false !== (list($id_empl, $id_serv) = $xoopsDB->fetchRow($result2)) || '0' != $id_chef || '0' != $id_sec
       || '0' != $id_adj) {
    ++$i;
    if (1 == $i) {
        echo '<tr><th><div class="center;">'
             . _AM_ORGA_EMPL_CID
             . "</div></th>\n"
             . '<th><div class="center;">'
             . _AM_ORGA_EMPL_NAME
             . "</div></th>\n"
             . '<th><div class="center;">'
             . _AM_ORGA_EMPL_PREN
             . "</div></th>\n"
             . '<th><div class="center;">'
             . _AM_ORGA_EMPL_PHOTO
             . "</div></th>\n"
             . '<th><div class="center;">'
             . _AM_ORGA_EMPL_TEL
             . "</div></th>\n"
             . '<th><div class="center;">'
             . _AM_ORGA_EMPL_LOCA
             . "</div></th>\n"
             . "<th colspan=\"3\"><center>"
             . _AM_ACTION
             . "</center></th>\n";
    }

    $test = 0;

    if ('0' != $id_chef) {
        if ('0' == $id_sec && '0' == $id_adj) {
            $test = 1;
        }
        info_empl($id_chef, $id_serv, 'chef', $test);
        $id_chef = '0';
    }

    if ('0' != $id_sec) {
        if ('0' == $id_adj) {
            $test = 1;
        }
        info_empl($id_sec, $id_serv, 'sec', $test);
        $id_sec = '0';
    }

    if ('0' != $id_adj) {
        info_empl($id_adj, $id_serv, 'adj', 1);
        $id_adj = '0';
    }

    if ($id_empl != $test_chef && $id_empl != $test_sec && $id_empl != $test_adj) {
        info_empl($id_empl, $id_serv, '', 0);
    }
}
echo '</tr></table><br>';
