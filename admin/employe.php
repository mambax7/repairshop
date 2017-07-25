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

if (!isset($_POST['op'])) {
    $op = isset($_GET['op']) ? $_GET['op'] : '';
} else {
    $op = $_POST['op'];
}
if (!isset($_POST['id_empl'])) {
    $id_empl = isset($_GET['id_empl']) ? $_GET['id_empl'] : '';
} else {
    $id_empl = $_POST['id_empl'];
}

$myts = MyTextSanitizer::getInstance();

// Executing operation from code
if (!isset($op)) {
    $op = ' ';
}
switch ($op) {

    //  ------------------------------------------------------------------------ //
    //--CREATION
    //  ------------------------------------------------------------------------ //
    case 'creatempl':
        global $xoopsDB, $myts;

        $nom_empl = (isset($_POST['nom_empl']) ? $_POST['nom_empl'] : '');
        //  if (empty($nom_empl)) { redirect_header("employe.php", 2, _AM_ERROR_NAMEEMPLREQ);}

        $pre_empl = (isset($_POST['pre_empl']) ? $_POST['pre_empl'] : '');

        $sql = sprintf("INSERT INTO %s (nom_empl, pre_empl) VALUES ( '%s', '%s')", $xoopsDB->prefix('garage_employe'), $nom_empl, $pre_empl);
        $xoopsDB->queryF($sql) || exit('erreur requete :' . $sql . '<br>');

        redirect_header('employe.php', 2, _AM_GARAGE_EMPL_ADD);
        break;

    //  ------------------------------------------------------------------------ //
    //-- SUPPRESSION
    //  ------------------------------------------------------------------------ //
    case 'suprempl':
        global $xoopsDB;

        // Suppression dans la table des employes

        $sql2 = 'DELETE FROM ' . $xoopsDB->prefix('garage_employe') . " WHERE id_empl='" . $emplsupp . "'";
        $xoopsDB->queryF($sql2) || exit('Suppression Error ' . $sql2);

        redirect_header('employe.php', 2, $msg . '<br>' . _AM_GARAGE_EMPL_SUPR);
        break;

    //  ------------------------------------------------------------------------ //
    //-- MODIFICATION
    //  ------------------------------------------------------------------------ //
    case 'modifempl':
        global $xoopsDB;

        $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_employe') . " WHERE id_empl='%s'", $id_empl);
        $res = $xoopsDB->query($sql) || exit('erreur requete :' . $sql . '<br>');

        if ($res) {
            while (($row = $xoopsDB->fetchArray($res)) !== false) {
                $id_empl = $row['id_empl'];
                $nom     = $row['nom_empl'];
                $prenom  = $row['pre_empl'];
            }
        }

        xoops_cp_header();

        $form = new XoopsThemeForm(_AM_MODIFI . ' -> ' . $id_empl, 'memploye', 'employe.php?op=update&id_empl=' . $id_empl, 'post', true);

        $form->addElement(new XoopsFormText(_AM_GARAGE_EMPL_NAME, 'nom_empl', 50, 255, $nom));
        $form->addElement(new XoopsFormText(_AM_GARAGE_EMPL_PREN, 'pre_empl', 50, 255, $prenom));

        $form->addElement(new XoopsFormButton('', 'submit', _AM_MODIF, 'submit'));
        $form->display();
        break;

    //  ------------------------------------------------------------------------ //
    //-- UPDATE APRES MODIF
    //  ------------------------------------------------------------------------ //
    case 'update':
        global $xoopsDB, $myts;

        if (empty($id_empl)) {
            redirect_header('employe.php', 2, _AM_ERROR_IDEMPLREQ);
        }

        $nom_empl = (isset($_POST['nom_empl']) ? $_POST['nom_empl'] : '');
        //  if (empty($nom_empl)) { redirect_header("employe.php", 2, _AM_ERROR_NAMEEMPLREQ);}

        $pre_empl = (isset($_POST['pre_empl']) ? $_POST['pre_empl'] : '');

        //UPDATE

        $sql = sprintf("UPDATE %s SET nom_empl='%s', pre_empl='%s' WHERE id_empl='%s'", $xoopsDB->prefix('garage_employe'), $nom_empl, $pre_empl, $id_empl);
        $xoopsDB->queryF($sql) || exit('erreur requete :' . $sql . '<br>');

        redirect_header('employe.php', 2, _AM_GARAGE_EMPL_MODIF);
        break;

}

if (empty($op)) {
    xoops_cp_header();

    doc_info('employe');

    echo "<table class=\"outer\" width=\"100%\">\n" . '<th><center>' . _AM_GARAGE_EMPL_NAME . "</center></th>\n" . '<th><center>' . _AM_GARAGE_EMPL_PREN . "</center></th>\n" . "<th colspan=\"2\"><center>" . _AM_ACTION . "</center></th>\n";

    $result = $xoopsDB->query('SELECT id_empl, nom_empl, pre_empl FROM ' . $xoopsDB->prefix('garage_employe') . ' ORDER BY nom_empl');
    while ((list($id_empl, $nom_empl, $pre_empl) = $xoopsDB->fetchRow($result)) !== false) {
        echo '<tr>';
        echo '<td class="odd" ALIGN="left">' . $nom_empl . '</td>';
        echo '<td class="odd" ALIGN="left">' . $pre_empl . '</td>';
        echo '<td class="odd" align="center"><A HREF="employe.php?op=modifempl&id_empl=' . $id_empl . '"><img src="../assets/images/edit.png"></a></td>';
        echo '<td class="odd" align="center"><A HREF="employe.php?op=suprempl&id_empl=' . $id_empl . '"><img src="../assets/images/delete.png"></a></td>';
    }
    echo '</tr></table><br>';

    $form = new XoopsThemeForm(_AM_GARAGE_EMPL_CREATION, 'cempl', 'employe.php?op=creatempl', 'post', true);

    $form->addElement(new XoopsFormText(_AM_GARAGE_EMPL_NAME, 'nom_empl', 50, 255));
    $form->addElement(new XoopsFormText(_AM_GARAGE_EMPL_PREN, 'pre_empl', 50, 255));

    $form->addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));
    $form->display();
}

xoops_cp_footer();
