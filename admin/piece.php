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

    case 'creatpieces':
        global $xoopsDB, $myts;

        $ref             = $_POST['ref'];
        $designation     = $_POST['designation'];
        $id_fournisseur  = $_POST['id_fournisseur'];
        $ref_fournisseur = $_POST['ref_fournisseur'];
        $tarif_ha        = $_POST['tarif_ha'];
        $tarif_client    = $_POST['tarif_client'];
        $id_cat_piece    = $_POST['id_cat_piece'];

        $sql = sprintf(
            "INSERT INTO %s (ref, designation, id_fournisseur, ref_fournisseur, tarif_ha, tarif_client, id_cat_piece) VALUES ('%s','%s','%s','%s','%s','%s','%s')",
            $xoopsDB->prefix('garage_pieces'),
            $ref,
            $designation,
            $id_fournisseur,
            $ref_fournisseur,
            $tarif_ha,
            $tarif_client,
                       $id_cat_piece
        );

        $xoopsDB->queryF($sql) || exit('erreur requete :' . $sql . '<br>');

        redirect_header('piece.php', 2, _AM_PIECES_CREATED);
        break;

    //  ------------------------------------------------------------------------ //
    //-- SUPPRESSION
    //  ------------------------------------------------------------------------ //

    case 'suprpieces':
        global $xoopsDB;

        $sql = 'DELETE FROM ' . $xoopsDB->prefix('garage_pieces') . " WHERE id='" . $id . "'";
        $xoopsDB->queryF($sql) || exit('Suppression Error ' . $sql);

        redirect_header('piece.php', 2, _AM_PIECES_SUPR);

        break;

    //  ------------------------------------------------------------------------ //
    //-- MODIFICATION
    //  ------------------------------------------------------------------------ //
    case 'modifpieces':
        global $xoopsDB;

        $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_pieces') . " WHERE id='%s'", $id);
        $res = $xoopsDB->query($sql) || exit('erreur requete :' . $sql . '<br>');

        if ($res) {
            while (false !== ($row = $xoopsDB->fetchArray($res))) {
                $id              = $row['id'];
                $ref             = $row['ref'];
                $designation     = $row['designation'];
                $id_fournisseur  = $row['id_fournisseur'];
                $ref_fournisseur = $row['ref_fournisseur'];
                $tarif_ha        = $row['tarif_ha'];
                $tarif_client    = $row['tarif_client'];
                $id_cat_piece    = $row['id_cat_piece'];
            }
        }

        xoops_cp_header();

        doc_info('Piece');

        $form = new XoopsThemeForm(_AM_PIECES_MODIFICATION, 'mpieces', "piece.php?op=update&id='" . $id . "'", 'post', true);

        $reqcat = $xoopsDB->query('SELECT id, nom FROM ' . $xoopsDB->prefix('garage_cat_piece') . ' ORDER BY nom');
        while (false !== ($row = $xoopsDB->fetchArray($reqcat))) {
            $categories[$row['id']] = $row['nom'];
        }
        $cat = new XoopsFormSelect(_AM_VEHICULE_CAT_PIECE, 'id_cat_piece', null, 5, false);
        $cat->addOptionArray($categories);
        $cat->setValue($id_cat_piece);
        $form->addElement($cat);

        $form->addElement(new XoopsFormText(_AM_PIECES_REF, 'ref', 50, 255, $ref));
        $form->addElement(new XoopsFormText(_AM_PIECES_DESIGNATION, 'designation', 50, 255, $designation));

        $req4 = $xoopsDB->query('SELECT id, nom  FROM ' . $xoopsDB->prefix('garage_fournisseur') . ' ORDER BY nom');
        while (false !== ($row = $xoopsDB->fetchArray($req4))) {
            $fournisseurs[$row['id']] = $row['nom'];
        }
        $four = new XoopsFormSelect(_AM_FSEUR, 'id_fournisseur', null, 5, false);
        $four->addOptionArray($fournisseurs);
        $four->setValue($id_fournisseur);
        $form->addElement($four);

        //$form -> addElement(new XoopsFormText(_AM_PIECES_NOM,'ref_fournisseur',50,255, $ref_fournisseur));
        $form->addElement(new XoopsFormText(_AM_PIECES_TARIF_HA, 'tarif_ha', 25, 25, $tarif_ha));
        $form->addElement(new XoopsFormText(_AM_PIECES_TARIF_CLIENT, 'tarif_client', 25, 25, $tarif_client));

        $form->addElement(new XoopsFormHidden('id', $id));

        $form->addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));

        $form->display();

        break;

    //  ------------------------------------------------------------------------ //
    //-- UPDATE APRES MODIF
    //  ------------------------------------------------------------------------ //
    case 'update':
        global $xoopsDB, $myts;

        $ref             = $_POST['ref'];
        $designation     = $_POST['designation'];
        $id_fournisseur  = $_POST['id_fournisseur'];
        $ref_fournisseur = $_POST['ref_fournisseur'];
        $id_cat_piece    = $_POST['id_cat_piece'];

        $sql = sprintf('UPDATE ' . $xoopsDB->prefix('garage_pieces') . " SET ref='$ref', designation='$designation', id_fournisseur='$id_fournisseur', ref_fournisseur='$ref_fournisseur', tarif_ha='$tarif_ha', tarif_client='$tarif_client', id_cat_piece='$id_cat_piece' WHERE id=$id");

        $xoopsDB->queryF($sql) || exit('Erreur requete : ' . $sql . '<br>');

        redirect_header('piece.php', 2, _AM_PIECES_MODIF);

}
//  ------------------------------------------------------------------------ //
//-- CAS GENERAL - ON LISTE LES ENREGISTREMENTS + FORMULAIRE DE CREATION
//  ------------------------------------------------------------------------ //
if (empty($op)) {
    xoops_cp_header();

    doc_info('Piece');

    // Cache la liste
    echo "
            <script type='text/javascript'>
            function hideAll1()
            {document.getElementById('listpiece').style.display = 'none';}
            function showForm(obj)
            {obj.style.display = 'block';}
            </script>
            <style type='text/css'>
            #listpiece
            {display: none;}
            </style>";

    echo '<p>&nbsp;
        <span style="background-color: #E9E9E9;border:1px solid #C0C0C0;font-size:10px;">&nbsp;' . _AM_PIECES . '&nbsp;
        <a href="javascript:;" onclick="hideAll1();showForm(document.getElementById(\'listpiece\'));"><b>+</b></a>/
        <a href="javascript:;" onclick="hideAll1();"><b>-</b></a>
        &nbsp;
        </span>
        </p>';
    //
    echo "<div id='listpiece'>"
         . "<table class=\"outer\" width=\"100%\">\n"
         . "<th><align='left'>"
         . _AM_CAT
         . "</center></th>\n"
         . "<th><align='left'>"
         . _AM_PIECES_REF
         . "</center></th>\n"
         . "<th><align='left'>"
         . _AM_PIECES_DESIGNATION
         . "</center></th>\n"
         . "<th><align='left'>"
         . _AM_PIECES_FOURNISSEUR
         . "</center></th>\n"
         . "<th colspan=\"2\"><div class='center;'>"
         . _AM_ACTION
         . "</div></th>\n";

    $result          = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('garage_pieces') . ' ORDER BY id_cat_piece');
    $pieces          = [];
    $nom_fournisseur = ' ';
    $categorie       = ' ';

    while (false !== (list($id, $ref, $designation, $id_fournisseur, $ref_fournisseur, $tarif_ha, $tarif_client, $id_cat_piece) = $xoopsDB->fetchRow($result))) {
        $pieces[$id] = $id;
        if (0 != $id_fournisseur) {
            $req4 = $xoopsDB->query('SELECT id, nom  FROM ' . $xoopsDB->prefix('garage_fournisseur') . " where id=$id_fournisseur");
            while (false !== ($row = $xoopsDB->fetchArray($req4))) {
                $nom_fournisseur = $row['nom'];
            }
        }
        if (0 != $id_cat_piece) {
            $req5 = $xoopsDB->query('SELECT id, nom  FROM ' . $xoopsDB->prefix('garage_cat_piece') . " where id=$id_cat_piece");
            while (false !== ($row = $xoopsDB->fetchArray($req5))) {
                $categorie = $row['nom'];
            }
        }
        echo '<tr>';
        echo '<td class="odd" ALIGN="left">' . $categorie . '</td>';
        echo '<td class="odd" ALIGN="left">' . $ref . '</td>';
        echo '<td class="odd" ALIGN="left">' . $designation . '</td>';
        echo '<td class="odd" ALIGN="left">' . $nom_fournisseur . '</td>';
        echo '<td class="odd" align="center"><A HREF="piece.php?op=modifpieces&id=' . $id . '"><img src="../assets/images/edit.png"></a></td>';
        echo '<td class="odd" align="center"><A HREF="piece.php?op=suprpieces&id=' . $id . '"><img src="../assets/images/delete.png"></a></td>';
    }
    echo '</tr></table><br></div>';

    // Formulaire de creation
    $form = new XoopsThemeForm(_AM_PIECES_CREATION, 'cpieces', 'piece.php?op=creatpieces', 'post', true);

    $reqcat = $xoopsDB->query('SELECT id, nom FROM ' . $xoopsDB->prefix('garage_cat_piece') . ' ORDER BY nom');
    while (false !== ($row = $xoopsDB->fetchArray($reqcat))) {
        $categories[$row['id']] = $row['nom'];
    }
    $cat = new XoopsFormSelect(_AM_VEHICULE_CAT_PIECE, 'id_cat_piece', null, 5, false);
    $cat->addOptionArray($categories);
    $cat->setValue($id_cat_piece);
    $form->addElement($cat);

    $form->addElement(new XoopsFormText(_AM_PIECES_REF, 'ref', 50, 255, ''));
    $form->addElement(new XoopsFormText(_AM_PIECES_DESIGNATION, 'designation', 50, 255, ''));

    $req4 = $xoopsDB->query('SELECT id, nom  FROM ' . $xoopsDB->prefix('garage_fournisseur') . ' ORDER BY nom');
    while (false !== ($row = $xoopsDB->fetchArray($req4))) {
        $fournisseurs[$row['id']] = $row['nom'];
    }
    $four = new XoopsFormSelect(_AM_FSEUR, 'id_fournisseur', null, 5, false);
    $four->addOptionArray($fournisseurs);
    $form->addElement($four);

    //  $form -> addElement(new XoopsFormText(_AM_PIECES_FOURNISSEUR,'id_fournisseur',50,255, ''));
    $form->addElement(new XoopsFormText(_AM_PIECES_REF_FOURNISSEUR, 'ref_fournisseur', 50, 255, ''));
    $form->addElement(new XoopsFormText(_AM_PIECES_TARIF_HA, 'tarif_ha', 25, 25, ''));
    $form->addElement(new XoopsFormText(_AM_PIECES_TARIF_CLIENT, 'tarif_client', 25, 25, ''));

    $form->addElement(new XoopsFormButton('', 'submit', _AM_CREATING, 'submit'));

    $form->display();
}
xoops_cp_footer();
