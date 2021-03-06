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

if (!isset($_POST['id'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
} else {
    $id = $_POST['id'];
}

$myts = MyTextSanitizer::getInstance();

if (!isset($op)) {
    $op = ' ';
}
switch ($op) {

    //  ------------------------------------------------------------------------ //
    //--CREATION
    //  ------------------------------------------------------------------------ //
    case 'creatfournisseur':
        global $xoopsDB, $myts;

        $nom     = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $tel     = $_POST['tel'];
        $fax     = $_POST['fax'];
        $email   = $_POST['email'];

        $sql = sprintf("INSERT INTO %s (nom, adresse, tel, fax, email) VALUES ('%s','%s','%s','%s','%s')", $xoopsDB->prefix('garage_fournisseur'), $nom, $adresse, $tel, $fax, $email);

        $xoopsDB->queryF($sql) || exit('erreur requete :' . $sql . '<br>');

        redirect_header('fournisseur.php', 2, _AM_FOURNISSEUR_CREATED);
        break;

    //  ------------------------------------------------------------------------ //
    //-- SUPPRESSION
    //  ------------------------------------------------------------------------ //

    case 'suprfournisseur':
        global $xoopsDB;

        $sql = 'DELETE FROM ' . $xoopsDB->prefix('garage_fournisseur') . " WHERE id='" . $id . "'";
        $xoopsDB->queryF($sql) || exit('Suppression Error ' . $sql);

        redirect_header('fournisseur.php', 2, _AM_FOURNISSEUR_SUPR);

        break;

    //  ------------------------------------------------------------------------ //
    //-- MODIFICATION
    //  ------------------------------------------------------------------------ //
    case 'modiffournisseur':
        global $xoopsDB;

        $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_fournisseur') . " WHERE id='%s'", $id);
        $res = $xoopsDB->query($sql) || exit('erreur requete :' . $sql . '<br>');

        if ($res) {
            while (false !== ($row = $xoopsDB->fetchArray($res))) {
                $id      = $row['id'];
                $nom     = $row['nom'];
                $adresse = $row['adresse'];
                $tel     = $row['tel'];
                $fax     = $row['fax'];
                $email   = $row['email'];
            }
        }

        xoops_cp_header();

        doc_info('Fournisseur');

        $form = new XoopsThemeForm(_AM_FOURNISSEUR_MODIFICATION, 'mfournisseur', "fournisseur.php?op=update&id='" . $id . "'", 'post', true);
        $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_NOM, 'nom', 50, 255, $nom));
        $form->addElement(new XoopsFormTextArea(_AM_FOURNISSEUR_ADDRESS, 'adresse', $adresse, 5, 60));
        $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_PHONE, 'tel', 50, 255, $tel));
        $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_FAX, 'fax', 50, 255, $fax));
        $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_EMAIL, 'email', 50, 255, $email));

        $form->addElement(new XoopsFormHidden('id', $id));
        $form->addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));

        $form->display();

        break;

    //  ------------------------------------------------------------------------ //
    //-- UPDATE APRES MODIF
    //  ------------------------------------------------------------------------ //
    case 'update':
        global $xoopsDB, $myts;

        $nom     = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $tel     = $_POST['tel'];
        $fax     = $_POST['fax'];
        $email   = $_POST['email'];

        $sql = sprintf('UPDATE ' . $xoopsDB->prefix('garage_fournisseur') . " SET nom='$nom' , adresse='$adresse', tel='$tel', fax='$fax', email='$email' WHERE id=$id");

        $xoopsDB->queryF($sql) || exit('erreur requete :' . $sql . '<br>');

        redirect_header('fournisseur.php', 2, _AM_FOURNISSEUR_MODIF);

}
//  ------------------------------------------------------------------------ //
//-- CAS GENERAL - ON LISTE LES ENREGISTREMENTS + FORMULAIRE DE CREATION
//  ------------------------------------------------------------------------ //
if (empty($op)) {
    xoops_cp_header();

    doc_info('Fournisseur');

    $result      = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('garage_fournisseur') . ' ORDER BY id');
    $fournisseur = [];
    //    $type = array();

    echo "<table class=\"outer\" width=\"100%\">\n"
         . "<th><align='left'>"
         . _AM_FOURNISSEUR_NOM
         . "</center></th>\n"
         . "<th><align='left'>"
         . _AM_FOURNISSEUR_ADDRESS
         . "</center></th>\n"
         . "<th><align='left'>"
         . _AM_FOURNISSEUR_PHONEFAX
         . "</center></th>\n"
         . "<th><align='left'>"
         . _AM_FOURNISSEUR_EMAIL
         . "</center></th>\n"
         . "<th colspan=\"2\"><div class='center;'>"
         . _AM_ACTION
         . "</div></th>\n";

    while (false !== (list($id, $nom, $adresse, $tel, $fax, $email) = $xoopsDB->fetchRow($result))) {
        $fournisseur[$id] = $id;

        echo '<tr>';
        //echo '<td class="odd" ALIGN="left">'.$id.'</td>';
        echo '<td class="odd" ALIGN="left">' . $nom . '</td>';
        echo '<td class="odd" ALIGN="left">' . $adresse . '</td>';
        echo '<td class="odd" ALIGN="left">Tel : ' . $tel . ' - Fax : ' . $fax . '</td>';
        echo '<td class="odd" ALIGN="left">' . $email . '</td>';
        echo '<td class="odd" align="center"><A HREF="fournisseur.php?op=modiffournisseur&id=' . $id . '"><img src="../assets/images/edit.png"></a></td>';
        echo '<td class="odd" align="center"><A HREF="fournisseur.php?op=suprfournisseur&id=' . $id . '"><img src="../assets/images/delete.png"></a></td>';
    }
    echo '</tr></table><br>';

    $form = new XoopsThemeForm(_AM_FOURNISSEUR_CREATION, 'cfournisseur', 'fournisseur.php?op=creatfournisseur', 'post', true);
    $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_NOM, 'nom', 50, 255, ''));
    $form->addElement(new XoopsFormTextArea(_AM_FOURNISSEUR_ADDRESS, 'adresse', '', 5, 60));
    $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_PHONE, 'tel', 50, 255, ''));
    $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_FAX, 'fax', 50, 255, ''));
    $form->addElement(new XoopsFormText(_AM_FOURNISSEUR_EMAIL, 'email', 50, 255, ''));
    $form->addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));
    $form->display();
}
xoops_cp_footer();
