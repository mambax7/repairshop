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

use Xmf\Request;

include __DIR__ . '/../../mainfile.php';
require_once __DIR__ . '/include/fonctions.php';
require_once __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

$moduleDirName = basename(__DIR__);

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

xoops_header();

if (is_object($xoopsUser)) {
    $xoopsModule = XoopsModule::getByDirname($moduleDirName);
    if (!$xoopsUser->isAdmin($xoopsModule->mid())) {
        redirect_header(XOOPS_URL . '/', 3, _NOPERM);
        exit();
    }
    $admintest = 1;
} else {
    redirect_header(XOOPS_URL . '/', 3, _NOPERM);
    exit();
}

$myts = MyTextSanitizer::getInstance();

if (!isset($op)) {
    $op = ' ';
}
switch ($op) {

    //  ------------------------------------------------------------------------ //
    //--CREATION
    //  ------------------------------------------------------------------------ //
    case 'create':
        global $xoopsDB, $myts, $xoopsModule, $xoopsModuleConfig;

        $id_voiture          = Request::getInt('id_voiture', 0, 'POST');//$_POST['id_voiture'];
        $kilometrage         = Request::getInt('kilometrage', 0, 'POST');//$_POST['kilometrage'];
        $new_vehicule        = Request::getString('new_vehicule', '', 'POST');//$_POST['new_vehicule'];
        $new_proprietaire    = Request::getString('new_proprietaire', '', 'POST');//$_POST['new_proprietaire'];
        $new_proprietaire_rs = Request::getString('new_proprietaire_rs', '', 'POST');//$_POST['new_proprietaire_rs'];
        $description         = Request::getString('description', '', 'POST');//$_POST['description'];
        $delai               = Request::getString('delai', '', 'POST');//$_POST['delai'];
        $date_debut          = Request::getString('date_debut', '', 'POST');//$_POST['date_debut'];
        $hmeca_t1            = Request::getInt('hmeca_t1', 0, 'POST');//$_POST['hmeca_t1'];
        $hmeca_t2            = Request::getInt('hmeca_t2', 0, 'POST');//$_POST['hmeca_t2'];
        $hmeca_t3            = Request::getInt('hmeca_t3', 0, 'POST');//$_POST['hmeca_t3'];
        $hcarro_t1           = Request::getInt('hcarro_t1', 0, 'POST');//$_POST['hcarro_t1'];
        $hcarro_t2           = Request::getInt('hcarro_t2', 0, 'POST');//$_POST['hcarro_t2'];
        $hcarro_t3           = Request::getInt('hcarro_t3', 0, 'POST');//$_POST['hcarro_t3'];
        $tmeca_t1            = $xoopsModuleConfig['meca_t1'];
        $tmeca_t2            = $xoopsModuleConfig['meca_t2'];
        $tmeca_t3            = $xoopsModuleConfig['meca_t3'];
        $tcarro_t1           = $xoopsModuleConfig['carro_t1'];
        $tcarro_t2           = $xoopsModuleConfig['carro_t2'];
        $tcarro_t3           = $xoopsModuleConfig['carro_t3'];
        $id_marque           = Request::getInt('id_marque', 0, 'POST'); //$_POST['id_marque'];
        $gamme               = Request::getInt('gamme', 0, 'POST');//$_POST['gamme'];
        $modele_version      = Request::getString('modele_version', '', 'POST');//$_POST['modele_version'];
        $id_inter_recurrente = 0;

        // par defaut non soldée (1 pour une intervention soldee)
        $solde = '0';

        if ($id_voiture == 0 && $new_vehicule != '') {
            //on cree le vehicule dans la table des vehicules
            $sqlnv = 'INSERT INTO ' . $xoopsDB->prefix('garage_vehicule') . " (immat, id_proprietaire, id_marque, gamme, modele_version) VALUE ('" . $new_vehicule . "', '" . $id_proprietaire . "','" . $id_marque . "', '" . $gamme . "', '" . $modele_version . "')";
            $xoopsDB->queryF($sqlnv) || die('Erreur requete : ' . $sqlnv . '<br>');

            // recup de la valeur de l'autoincrement pour appeler la page de creation des pieces detachees
            $result1 = $xoopsDB->query('SELECT MAX(id) AS id_max  FROM ' . $xoopsDB->prefix('garage_vehicule'));
            while ((list($id_max) = $xoopsDB->fetchRow($result1)) !== false) {
                $id_voiture = $id_max;
            }
        }

        if ($new_proprietaire !== '') {
            //if ($id_proprietaire == 0 && $new_proprietaire != ""){
            //on cree le client dans la table des clients
            $sqlnv = 'INSERT INTO ' . $xoopsDB->prefix('garage_clients') . " (nom, rs) VALUE ('" . $new_proprietaire . "','" . $new_proprietaire_rs . "' )";
            $xoopsDB->queryF($sqlnv) || die('Erreur requete : ' . $sqlnv . '<br>');

            // recup de la valeur de l'autoincrement
            $resultc = $xoopsDB->query('SELECT MAX(id) AS id_max  FROM ' . $xoopsDB->prefix('garage_clients'));
            while ((list($id_max) = $xoopsDB->fetchRow($resultc)) !== false) {
                $id_proprio = $id_max;
            }

            // update de la table vehicule pour l'id_proprietaire nouveau
            $sql = 'UPDATE ' . $xoopsDB->prefix('garage_vehicule') . " SET id_proprietaire=$id_proprio  WHERE id=$id_voiture";
            $xoopsDB->queryF($sql) || die('Erreur requete : ' . $sql . '<br>');
        }

        $sql = sprintf("INSERT INTO %s (id_voiture, kilometrage, date_debut, date_fin, delai, id_inter_recurrente, description, observation, date_devis, date_acceptation, montant, acompte_verse, solde, hmeca_t1, hmeca_t2, hmeca_t3, hcarro_t1, hcarro_t2, hcarro_t3, tmeca_t1, tmeca_t2, tmeca_t3, tcarro_t1, tcarro_t2, tcarro_t3) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                       $xoopsDB->prefix('garage_intervention'), $id_voiture, $kilometrage, $date_debut, $date_fin, $delai, $id_inter_recurrente, $description, $observation, $date_devis, $date_acceptation, $montant, $acompte_verse, $solde, $hmeca_t1, $hmeca_t2, $hmeca_t3, $hcarro_t1, $hcarro_t2,
                       $hcarro_t3, $tmeca_t1, $tmeca_t2, $tmeca_t3, $tcarro_t1, $tcarro_t2, $tcarro_t3);

        $xoopsDB->queryF($sql) || die('Erreur requete : ' . $sql . '<br>');

        // recup de la valeur de l'autoincrement pour appeler la page de creation des pieces detachees
        $result = $xoopsDB->query('SELECT MAX(id) AS id_max  FROM ' . $xoopsDB->prefix('garage_intervention'));
        while ((list($id_max) = $xoopsDB->fetchRow($result)) !== false) {
            $idmax = $id_max;
        }

        redirect_header('inter_pces.php?id_inter=' . $idmax, 2, _MD_INTER_CREATED);
        break;
}

if (empty($op)) {

    //  ------------------------------------------------------------------------ //
    //-- CAS GENERAL - FORMULAIRE DE CREATION
    //  ------------------------------------------------------------------------ //

    global $xoopsDB, $id, $xoopsModule, $xoopsModuleConfig, $xoopsUser;

    $myts = MyTextSanitizer::getInstance();

    $req1                = $xoopsDB->query('SELECT id, immat, id_marque, gamme, modele_version, id_proprietaire FROM ' . $xoopsDB->prefix('garage_vehicule') . ' ORDER BY immat ASC');
    $list_id_vehicule    = array();
    $list_id_vehicule[0] = '---- NA ----';
    while ((list($id_vehic, $immat, $id_marque, $gamme, $modele_version, $id_proprietaire) = $xoopsDB->fetchRow($req1)) !== false) {
        $sql = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_clients') . " WHERE id='%s'", $id_proprietaire);
        $res = $xoopsDB->query($sql) || die('erreur requete :' . $sql . '<br>');

        //                    if ($res) {
        //                        $nbChamps = $xoopsDB->getFieldsNum($res);
        //                        $i         = 0;
        //                        while ($i < $nbChamps) {
        //                            $nom_champs  = mysqli_fetch_field_direct($res, $i)->name;
        //                            $$nom_champs = mysql_result($res, 0, $nom_champs);
        //                            ++$i;
        //                        }
        //                    }
        if ($res) {
            $row = $xoopsDB->fetchArray($res);
            if (false !== $row) {
                foreach ($row as $name => $value) {
                    $$name = $value;
                }
            }
        }

        $sql2 = sprintf('SELECT * FROM ' . $xoopsDB->prefix('garage_marque') . " WHERE id='%s'", $id_marque);
        $res  = $xoopsDB->query($sql2) || die('erreur requete :' . $sql . '<br>');

        while ((list($id_marque, $marque) = $xoopsDB->fetchRow($res)) !== false) {
            $mark = $marque;
        }
        $list_id_vehicule[$id_vehic] = $immat . ' - ' . $mark . ' - ' . $gamme . ' - ' . $modele_version . ' - ' . $civilite . ' ' . $nom . ' ' . $prenom;
    }

    $form = new XoopsThemeForm(_MD_CREATE . ' ' . _MD_INTER_VEHICULE, 'cinter', 'intervention.php?op=create', 'post', true);
    $form->setExtra("enctype='multipart/form-data'"); // imperatif !

    $vehic  = new XoopsFormElementTray(_MD_VEHICULE);
    $tvehic = new XoopsFormSelect('', 'id_voiture');
    $tvehic->addOptionArray($list_id_vehicule);
    $vehic->addElement($tvehic);
    $form->addElement($vehic);

    //
    $info = new XoopsFormElementTray(_MD_VEHICULE_NEW);
    $info->addElement(new XoopsFormText(_MD_VEHICULE_IMMAT, 'new_vehicule', 25, 255));

    $req4 = $xoopsDB->query('SELECT id, nom FROM ' . $xoopsDB->prefix('garage_marque') . ' ORDER BY nom');
    while (($row = $xoopsDB->fetchArray($req4)) !== false) {
        $marques[$row['id']] = $row['nom'];
    }
    $marq = new XoopsFormSelect(_MD_VEHICULE_MARQUE, 'id_marque', null, 1, false);
    $marq->addOptionArray($marques);
    $info->addElement($marq);

    $info->addElement(new XoopsFormText(_MD_VEHICULE_GAMME, 'gamme', 20, 25));
    $info->addElement(new XoopsFormText(_MD_VEHICULE_MODELE_VERSION, 'modele_version', 20, 25));
    $form->addElement($info);

    $nref1 = new XoopsFormElementTray(_MD_CLIENT);

    $req4 = $xoopsDB->query('SELECT id, nom, prenom, cp FROM ' . $xoopsDB->prefix('garage_clients') . ' ORDER BY nom');
    while (($row = $xoopsDB->fetchArray($req4)) !== false) {
        $clients[$row['id']] = $row['nom'] . ' - ' . $row['prenom'] . ' - ' . $row['cp'];
    }
    $cli = new XoopsFormSelect('', 'id_proprietaire', null, 1, false);
    $cli->addOptionArray($clients);
    $cli->setValue($id_proprietaire);
    $nref1->addElement($cli);
    $form->addElement($nref1);

    $nref = new XoopsFormElementTray(_MD_NEW_CLIENT);

    $nref->addElement(new XoopsFormText(_MD_NEW_CLIENT_NAME, 'new_proprietaire', 25, 255));
    $nref->addElement(new XoopsFormText(_MD_NEW_CLIENT_RS, 'new_proprietaire_rs', 25, 255));
    $form->addElement($nref);

    $form->addElement(new XoopsFormText(_MD_INTER_KM, 'kilometrage', 10, 15));

    $form->addElement(new XoopsFormTextArea(_MD_INTER_TAF, 'description', '', 5, 80));

    $form->addElement(new XoopsFormTextDateSelect(_MD_INTER_RECEP, 'date_debut', 15, date('d-m-Y')));
    $form->addElement(new XoopsFormTextDateSelect(_MD_INTER_DELAI, 'delai', 15, date('d-m-Y')));

    $form->addElement(new XoopsFormButton('', 'submit', _MD_CREATE, 'submit'));

    $form->display();
}

require_once XOOPS_ROOT_PATH . '/footer.php';
