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
 * @param $idProprietaire
 */

function get_proprietaire_info($idProprietaire)
{
    global $xoopsDB, $idProprietaire, $xoopsOption, $client_detail;
    $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_clients') . " WHERE id='%s'", $idProprietaire);
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

/**
 * @param $lieu
 */
function doc_info($lieu)
{
    global $xoopsDB;
    $req = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('garage_doc') . " WHERE id_doc='" . $lieu . "'");
    while (false !== (list($id_doc, $doc_fr) = $xoopsDB->fetchRow($req))) {
        if ('' <> $doc_fr) {
            echo '<fieldset><legend>&nbsp;<img src="../assets/images/tipanim.gif">&nbsp;<b>' . _AM_DOC . '</b>&nbsp;</legend><br>' . nl2br($doc_fr) . '</fieldset><br>';
        }
    }
}
