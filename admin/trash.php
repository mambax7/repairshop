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

$myts = MyTextSanitizer::getInstance();

if (!isset($_POST['op'])) {
    $op = isset($_GET['op']) ? $_GET['op'] : '0';
} else {
    $op = $_POST['op'];
}
if (!isset($_POST['id_inter'])) {
    $id_inter = isset($_GET['id_inter']) ? $_GET['id_inter'] : '0';
} else {
    $id_inter = $_POST['id_inter'];
}

if (!isset($op)) {
    $op = ' ';
}
switch ($op) {

    //  ------------------------------------------------------------------------ //
    //--MISE DANS LA CORBEILLE (ETAT 9)
    //  ------------------------------------------------------------------------ //
    case 'trash':
        global $xoopsDB;

        // changement de l'état de l'intervention
        $sql = 'UPDATE ' . $xoopsDB->prefix('garage_intervention') . " SET solde='9'  WHERE id=$id_inter";
        $xoopsDB->queryF($sql) || exit('Erreur requete : ' . $sql . '<br>');
        redirect_header('intervention.php', 2, _AM_INTER_DELETED);

    //  ------------------------------------------------------------------------ //
    //--RECUP DE LA CORBEILLE (ETAT 0)
    //  ------------------------------------------------------------------------ //
    case 'recup':
        global $xoopsDB;

        // changement de l'état de l'intervention
        $sql = 'UPDATE ' . $xoopsDB->prefix('garage_intervention') . " SET solde='0'  WHERE id=$id_inter";
        $xoopsDB->queryF($sql) || exit('Erreur requete : ' . $sql . '<br>');

        redirect_header('intervention.php', 2, _AM_INTER_RECUP);

    //  ------------------------------------------------------------------------ //
    //--SUPPRESSION
    //  ------------------------------------------------------------------------ //
    case 'delete':
        global $xoopsDB;

        // suppression de l'intervention
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('garage_intervention') . " WHERE id='" . $id_inter . "'";
        $xoopsDB->queryF($sql) || exit('Erreur requete : ' . $sql . '<br>');

        // suppression des heures saisies
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('garage_inter_temp') . " WHERE id_inter='" . $id_inter . "'";
        $xoopsDB->queryF($sql) || exit('Erreur requete : ' . $sql . '<br>');

        // suppression des pieces saisies
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('garage_inter_pieces') . " WHERE id_inter='" . $id_inter . "'";
        $xoopsDB->queryF($sql) || exit('Erreur requete : ' . $sql . '<br>');

        redirect_header('intervention.php', 2, _AM_INTER_DELETED);
        break;

} // fin du switch

if (empty($op)) {
    xoops_cp_header();

    doc_info('Trash');

    echo '<style>
                    .encours {background-color: #E6FFE6; padding: 5px;}
                    .solde {background-color: #CAFAFF; padding: 5px;}
                    .archive {background-color: #CAE2FF; padding: 5px;}
                    .deleted {background-color: #FF0000; padding: 5px;}
                    </style>';
    $etat_des = _AM_INTER_TRASHED;
    $style    = 'deleted';

    echo "<table width='100%'><tr><td align='center'><img src='assets/images/logo.jpg' alt='' title=''></td></tr></table><br>\n";
    echo '<h1>' . $etat_des . '</h1>';

    // on affiche uniquement les interventions de la corbeille (etat a 9)
    $result = $xoopsDB->query('SELECT id, id_voiture, date_debut, date_fin, delai, solde  FROM ' . $xoopsDB->prefix('garage_intervention') . ' WHERE solde =9');

    echo "<table class=\"outer\" width=\"100%\">\n" . '<th><div class="center;">' . _AM_INTER_DELAI . "</div></th>\n" . '<th><center>' . _AM_VEHICULE . "</center></th>\n" . '<th><div class="center;">' . _AM_VEHICULE_PROPRIETAIRE . "</div></th>\n" . "<th colspan=\"2\"><div class='center;'>" . _AM_ACTION . "</div></th>\n";

    while ((list($id_inter, $id_voiture, $date_debut, $date_fin, $delai, $solde) = $xoopsDB->fetchRow($result)) !== false) {

        // recup des infos du vehicule et proprio
        $req3 = $xoopsDB->query('SELECT id, immat, id_marque, gamme, modele_version, id_proprietaire FROM ' . $xoopsDB->prefix('garage_vehicule') . " WHERE id=$id_voiture");
        while ((list($id_vehicule, $immat, $id_marque, $gamme, $modele_version, $id_proprietaire) = $xoopsDB->fetchRow($req3)) !== false) {
            $civilite = '';
            $nom      = '';
            $prenom   = '';
            if ($id_proprietaire != 0) {
                $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_clients') . " WHERE id='%s'", $id_proprietaire);
                $res = $xoopsDB->query($sql) || exit('erreur requete :' . $sql . '<br>');

                //            if ($res) {
                //                $nbChamps = $xoopsDB->getFieldsNum($res);
                //                $i         = 0;
                //                while ($i < $nbChamps) {
                //                    $nom_champs  = mysqli_fetch_field_direct($res, $i)->name;
                //                    $$nom_champs = mysql_result($res, 0, $nom_champs);
                //                    ++$i;
                //                }
                //            }
                if ($res) {
                    $row = $xoopsDB->fetchArray($res);
                    if (false !== $row) {
                        foreach ($row as $name => $value) {
                            $$name = $value;
                        }
                    }
                }
            }

            $mark = '';
            if ($id_marque != 0) {
                $sql2 = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_marque') . " WHERE id='%s'", $id_marque);
                $res  = $xoopsDB->query($sql2) || exit('erreur requete :' . $sql . '<br>');

                while ((list($id_marque, $marque) = $xoopsDB->fetchRow($res)) !== false) {
                    $mark = $marque;
                }
            }
            echo '<tr>';
            echo '<td class="' . $style . '" ALIGN="left">' . $delai . '</td>';
            echo '<td class="' . $style . '" ALIGN="left"><b>' . $mark . '</b> ' . $gamme . ' ' . $modele_version . ' -<b> ' . $immat . '</b></td>';
            echo '<td class="' . $style . '" ALIGN="left">' . $civilite . ' ' . $nom . ' ' . $prenom . '</td>';
            echo '<td class="'
                 . $style
                 . '" align="center"><A HREF="trash.php?id_inter='
                 . $id_inter
                 . '&op=recup" ><img src="../assets/images/recup.png" alt="'
                 . _AM_RECUP
                 . '" title="'
                 . _AM_RECUP
                 . '"></a>&nbsp;<A HREF="trash.php?id_inter='
                 . $id_inter
                 . '&op=delete"><img src="../assets/images/stop.png" alt="'
                 . _AM_INTER_SUPPR_DEF
                 . '" title="'
                 . _AM_INTER_SUPPR_DEF
                 . '"></a></td>';
        }
    }
    echo '</tr></table><br>';
}
xoops_cp_footer();
