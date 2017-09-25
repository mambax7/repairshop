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
require_once __DIR__ . '/include/fonctions.php';
require_once __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

xoops_header();

$moduleDirName = basename(__DIR__);

$myts = MyTextSanitizer::getInstance();

if (!isset($_POST['solde'])) {
    $etat = isset($_GET['solde']) ? $_GET['solde'] : '0';
} else {
    $etat = $_POST['solde'];
}
// on accede pas de maniere anonyme au module
if (!$xoopsUser) {
    redirect_header(XOOPS_URL, 2, _NOPERM);
}

echo '<style>
                    .encours {background-color: #E6FFE6; padding: 5px;}
                    .solde {background-color: #CAFAFF; padding: 5px;}
                    .archive {background-color: #CAE2FF; padding: 5px;}
                    </style>';
if (0 == $etat) {
    $etat_des = _MD_INTER_ENCOURS;
    $style    = 'encours';
}
if (1 == $etat) {
    $etat_des = _MD_INTER_SOLDEES;
    $style    = 'solde';
}
if (2 == $etat) {
    $etat_des = _MD_INTER_ARCHIVEES;
    $style    = 'archive';
}

$xoopsModule = XoopsModule::getByDirname($moduleDirName);

if ($xoopsUser) {
    if ($xoopsUser->isAdmin($xoopsModule->mid())) {
        echo "<table width='100%'><tr><td align='center'><img src='assets/images/logo.jpg' alt='' title=''></td><a href='admin/index.php' target='_blanck'><img src='assets/images/admin.gif' alt='Admin'></a></tr></table><br>\n";
    } else {
        echo "<table width='100%'><tr><td align='center'><img src='assets/images/logo.jpg' alt='' title=''></td></tr></table><br>\n";
    }
} else {
    echo "<table width='100%'><tr><td align='center'><img src='assets/images/logo.jpg' alt='' title=''></td></tr></table><br>\n";
}

echo '<h1>' . $etat_des . '</h1>';

// on affiche les interventions en cours
$result = $xoopsDB->query('SELECT id, id_voiture, date_debut, date_fin, delai, solde  FROM ' . $xoopsDB->prefix('garage_intervention') . ' WHERE solde =' . $etat);

echo "<table class=\"outer\" width=\"100%\">\n" . '<th><div class="center;">' . _MD_INTER_DELAI . "</div></th>\n" . '<th><div class="center;">' . _MD_VEHICULE . "</div></th>\n" . '<th><div class="center;">' . _MD_VEHICULE_PROPRIETAIRE . "</div></th>\n" . "<th colspan=\"2\"><div class='center;'>" . _MD_ACTION . "</div></th>\n";

while (false !== (list($id_inter, $id_voiture, $date_debut, $date_fin, $delai, $solde) = $xoopsDB->fetchRow($result))) {

    // recup des infos du vehicule et proprio
    $req3 = $xoopsDB->query('SELECT id, immat, id_marque, gamme, modele_version, id_proprietaire FROM ' . $xoopsDB->prefix('garage_vehicule') . " WHERE id=$id_voiture");
    while (false !== (list($id_vehicule, $immat, $id_marque, $gamme, $modele_version, $id_proprietaire) = $xoopsDB->fetchRow($req3))) {
        $civilite = '';
        $nom      = '';
        $prenom   = '';
        if (0 != $id_proprietaire) {
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
        if (0 != $id_marque) {
            $sql2 = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_marque') . " WHERE id='%s'", $id_marque);
            $res  = $xoopsDB->query($sql2) || exit('erreur requete :' . $sql . '<br>');

            while (false !== (list($id_marque, $marque) = $xoopsDB->fetchRow($res))) {
                $mark = $marque;
            }
        }
        if (date('d/m/Y', strtotime($delai)) > date('d/m/Y')) {
            $retard = "<img src='assets/images/flag_green.gif' alt='OK' title='OK'>";
        }
        if (date('d/m/Y', strtotime($delai)) == date('d/m/Y')) {
            $retard = "<img src='assets/images/flag_orange.gif' alt='Livraison ce jour' title='Livraison ce jour'>";
        }
        if (date('d/m/Y', strtotime($delai)) < date('d/m/Y')) {
            $retard = "<img src='assets/images/flag_red.gif' alt='EN RETARD' title='EN RETARD'>";
        }
        echo '<tr>';
        echo '<td class="' . $style . '" ALIGN="left">' . $retard . '  ' . date('d/m/Y', strtotime($delai)) . '</td>';
        echo '<td class="' . $style . '" ALIGN="left"><b>' . $mark . '</b> ' . $gamme . ' ' . $modele_version . ' -<b> ' . $immat . '</b></td>';
        echo '<td class="' . $style . '" ALIGN="left">' . $civilite . ' ' . $nom . ' ' . $prenom . '</td>';

        // edition des factures active

        $facture = '';

        if (1 == $xoopsModuleConfig['fonction_facture']) {
            if (1 == $xoopsModuleConfig['impression_facture_non_admin'] || $xoopsUser->isAdmin($xoopsModule->mid())) {
                $facture = '<img src="images/invoice.png" alt="' . _MD_PRINT_FACTURE . '" title="' . _MD_PRINT_FACTURE . '"></a>';
            }
        }

        echo '<td class="'
             . $style
             . '" align="center"><A HREF="inter_pces.php?id_inter='
             . $id_inter
             . '" ><img src="assets/images/edit.png" alt="'
             . _MD_MODIFY
             . '" title="'
             . _MD_MODIFY
             . '"></a>&nbsp;<A HREF="devis.php?id_inter='
             . $id_inter
             . '" target="blank"><img src="images/print.gif" alt="'
             . _MD_PRINT_DEVIS
             . '" title="'
             . _MD_PRINT_DEVIS
             . '"></a>&nbsp;<A HREF="facture.php?id_inter='
             . $id_inter
             . '" target="blank">'
             . $facture
             . '</td>';
    }
}
echo '</tr></table><br>';

if (0 == $etat) {
    include __DIR__ . '/intervention.php';
}

require_once XOOPS_ROOT_PATH . '/footer.php';
