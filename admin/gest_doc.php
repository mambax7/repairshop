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

if (!isset($_POST['op'])) {
    $op = isset($_GET['op']) ? $_GET['op'] : '';
} else {
    $op = $_POST['op'];
}

if (!isset($_POST['id_doc'])) {
    $id_doc = isset($_GET['id_doc']) ? $_GET['id_doc'] : '';
} else {
    $id_doc = $_POST['id_doc'];
}

$myts = MyTextSanitizer::getInstance();

if (!isset($op)) {
    $op = ' ';
}
switch ($op) {

    //  ------------------------------------------------------------------------ //
    //--CREATION
    //  ------------------------------------------------------------------------ //
    case 'creatdoc':
        global $xoopsDB, $myts;

        $myts = MyTextSanitizer::getInstance();

        //  $id_doc    = $myts->makeTboxData4save($_POST["id_doc"]);
        //  $doc_fr    = $myts->makeTboxData4save($_POST["doc_fr"]);

        $id_doc = $_POST['id_doc'];
        $doc_fr = $_POST['doc_fr'];

        $sql = sprintf("INSERT INTO %s (id_doc, doc_fr ) VALUES ('%s','%s')", $xoopsDB->prefix('garage_doc'), $id_doc, $doc_fr);

        $xoopsDB->queryF($sql) || exit('erreur requete :' . $sql . '<br>');

        redirect_header('gest_doc.php', 2, _AM_DOC_CREATED);
        break;

    //  ------------------------------------------------------------------------ //
    //-- SUPPRESSION
    //  ------------------------------------------------------------------------ //

    case 'suprdoc':
        global $xoopsDB;

        $sql = 'DELETE FROM ' . $xoopsDB->prefix('garage_doc') . " WHERE id_doc='" . $id_doc . "'";
        $xoopsDB->queryF($sql) || exit('Suppression Error ' . $sql);
        redirect_header('gest_doc.php', 2, _AM_DOC_SUPR);

        break;

    //  ------------------------------------------------------------------------ //
    //-- MODIFICATION
    //  ------------------------------------------------------------------------ //
    case 'modifdoc':
        global $xoopsDB, $myts;

        $myts = MyTextSanitizer::getInstance();

        $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_doc') . " WHERE id_doc='%s'", $id_doc);
        $res = $xoopsDB->query($sql) || exit('erreur requete :' . $sql . '<br>');

        if ($res) {
            while (($row = $xoopsDB->fetchArray($res)) !== false) {
                //          $id_doc             = $myts->makeTboxData4Show($row['id_doc']);
                //          $doc_fr             = $myts->makeTboxData4Show($row['doc_fr']);
                $id_doc = $row['id_doc'];
                $doc_fr = $row['doc_fr'];
            }
        }

        xoops_cp_header();

        doc_info('Documentation');

        $form = new XoopsThemeForm(_AM_DOC_MODIFICATION, 'mdoc', "gest_doc.php?op=update&id_doc='" . $id_doc . "'", 'post', true);
        $form->addElement(new XoopsFormHidden('old_id_doc', $id_doc));
        $form->addElement(new XoopsFormText(_AM_DOC, 'id_doc', 20, 255, $id_doc));
        $form->addElement(new XoopsFormDHTMLTextArea(_AM_DOC_FR, 'doc_fr', $doc_fr, 20, 80));

        /*ajout de bouton sur le formulaire*/
        $form->addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));
        /*affichage du formulaire*/
        $form->display();

        break;

    //  ------------------------------------------------------------------------ //
    //-- UPDATE APRES MODIF
    //  ------------------------------------------------------------------------ //
    case 'update':
        global $xoopsDB, $myts;

        $myts = MyTextSanitizer::getInstance();

        //  $old_id_doc     = $myts->makeTboxData4save($_POST["old_id_doc"]);
        $id_doc = $_POST['id_doc'];
        $doc_fr = $_POST['doc_fr'];

        //  $sql = sprintf("UPDATE ".$xoopsDB->prefix("garage_doc")." SET doc_fr = '$doc_fr' WHERE id_doc='$id_doc'");

        $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('garage_doc') . " SET doc_fr = '$doc_fr' WHERE id_doc='$id_doc'")
        || exit('erreur requete :' . $sql . '<br>');

        redirect_header('gest_doc.php', 2, _AM_DOC_MODIF);

}
//  ------------------------------------------------------------------------ //
//-- CAS GENERAL - ON LISTE LES ENREGISTREMENTS + FORMULAIRE DE CREATION
//  ------------------------------------------------------------------------ //
if (empty($op)) {
    xoops_cp_header();

    doc_info('Documentation');

    $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('garage_doc')); //." ORDER BY id_doc");

    echo "<table class=\"outer\" width=\"100%\">\n" . "<th width='20px'><center>" . _AM_DOC . "</center></th>\n" . '<th><center>' . _AM_DOC_DES . "</center></th>\n" . "<th colspan=\"2\"><center>" . _AM_ACTION . "</center></th>\n";

    while ((list($id_doc, $doc_fr) = $xoopsDB->fetchRow($result)) !== false) {
        echo '<tr>';
        echo '<td class="odd" ALIGN="left">' . $id_doc . '</td>';
        echo '<td class="odd" ALIGN="left">' . nl2br($doc_fr) . '</td>';

        // suppression interdite
        //              echo '<td class="odd" align="center"><A HREF="gest_doc.php?op=modifdoc&id_doc='.$id_doc.'"><img src="../assets/images/edit.png"></a> &nbsp;&nbsp;<A HREF="gest_doc.php?op=suprdoc&id_doc='.$id_doc.'"><img src="../assets/images/delete.png"></a></td>';
        echo '<td class="odd" align="center"><A HREF="gest_doc.php?op=modifdoc&id_doc=' . $id_doc . '"><img src="../assets/images/edit.png"></a></td>';
    }
    echo '</tr></table><br>';
    /*
        $form = new XoopsThemeForm(_AM_DOC_CREATION,'cdoc','gest_doc.php?op=creatdoc','post', true);
        $form -> addElement(new XoopsFormText(_AM_DOC,'id_doc',20,255, ''));
        $form -> addElement(new XoopsFormDHTMLTextArea(_AM_DOC_FR,'doc_fr', '',20,80));
        $form -> addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));
        $form -> display();
    */
}
xoops_cp_footer();
