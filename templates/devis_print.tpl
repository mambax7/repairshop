<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
        'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <!-- Title and meta -->
    <meta http-equiv="content-language" content="<{$xoops_langcode}>">
    <meta http-equiv="content-type" content="text/html; charset=<{$xoops_charset}>">
    <meta name="robots" content="<{$xoops_meta_robots}>">
    <meta name="keywords" content="<{$xoops_meta_keywords}>">
    <meta name="description" content="<{$xoops_meta_description}>">
    <meta name="rating" content="<{$xoops_meta_rating}>">
    <meta name="author" content="<{$xoops_meta_author}>">
    <meta name="copyright" content="<{$xoops_meta_copyright}>">
    <meta name="generator" content="XOOPS">
    <title>Devis n&deg; <{$devis_id}> du <{$devis_date}></title>
    <!-- Sheet Css -->
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<{xoAppUrl xoops.css}>">
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<{xoImgUrl style.css}>">
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<{xoImgUrl css/style.css}>">
</head>

<body
        <{$devis_impression_directe}>>
<div id="content">
    <table border=1 width='780px'>
        <th width=10% align="left"><img src="images/logo.jpg"></th>
        <th width=40% align="left"><{$devis_societe}></th>
        <th colspan="2" align="center">Devis n&deg; <{$devis_id}> du <{$devis_date}></th>
        <tr>
            <td class="head" width="10%">Compte client</td>
            <td class="even"><{$devis_compte}></td>
            <td class="head" width="10%">Client</td>
            <td class="even" style="font-weight: bold;"><{$devis_client_rs}></td>
        </tr>
        <tr>
            <td class="head">V&eacute;hicule</td>
            <td class="even"><{$devis_marque}> <{$devis_gamme}> <{$devis_modele}> (Immat : <{$devis_immat}>)</td>
            <td class="head"></td>
            <td class="even" style="font-weight: bold;"><{$devis_proprietaire}></td>
        </tr>
        <tr>
            <td class="head">Kilom&egrave;trage</td>
            <td class="even"><{$devis_km}> Kms</td>
            <td class="head"></td>
            <td class="even"><{$devis_adresse}></td>
        </tr>
        <tr>
            <td class="head"></td>
            <td class="even"></td>
            <td class="head"></td>
            <td class="even"><{$devis_cp}> <{$devis_ville}></td>
        </tr>

    </table>
    <br>
    <table border=1 width=800px>
        <tr>
            <th>Travail demand&eacute;</th>
        </tr>
        <tr>
            <td class="even"><{$devis_taf}></td>
        </tr>
    </table>
    <br>
    <table>
        <{if $devis_nb_mod > 0}>
            <th>Temps pass&eacute;</th>
            <th align='right'>Quantit&eacute;</th>
            <th align='right'>Montant brut</th>
            <th align='right'>Remise</th>
            <th align='right'>Montant</th>
            <{if $devis_cumul_modmeca > 0}>
                <tr>
                    <td class="head" width="300px" style="font-weight: bold;">Main d'oeuvre m&eacute;canique</td>
                    <td class="odd" width="50px" align='right'><{$devis_cumul_modmeca}> H</td>
                    <td class="odd" width="50px" align='right'><{$devis_montant_modmeca}> <{$devis_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $devis_remise_meca > 0}><{$devis_remise_meca}> <{$devis_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$devis_montant_net_modmeca}> <{$devis_devise}></td>
                </tr>
            <{/if}>

            <{if $devis_cumul_modcaro > 0}>
                <tr>
                    <td class="head" width="300px" style="font-weight: bold;">Main d'oeuvre carrosserie</td>
                    <td class="odd" width="50px" align='right'><{$devis_cumul_modcaro}> H</td>
                    <td class="odd" width="50px" align='right'><{$devis_montant_modcaro}> <{$devis_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $devis_remise_caro > 0}><{$devis_remise_caro}> <{$devis_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$devis_montant_net_modcaro}> <{$devis_devise}></td>
                </tr>
            <{/if}>
            <tr>
                <td class="odd"><{$devis_observation}></td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <!--
                    <td class="odd" align='right'><b><{$devis_cumul_mod}> H</b></td>
                    <td class="odd" align='right'><b><{$devis_montant_mod}></b> <{$devis_devise}> </td>
                    <td class="odd" align='right'><b><{$devis_remise_mod}></b> <{$devis_devise}> </td>
                    <td class="odd" align='right'><b><{$devis_montant_net_mod}></b> <{$devis_devise}> </td>
            -->
            </tr>
        <{/if}>

        <{if $devis_nb_pieces > 0}>
            <tr>
                <th>Fournitures utilis&eacute;es</th>
                <th align='right'>Quantit&eacute;</th>
                <th align='right'>Prix unitaire</th>
                <th align='right'>Remise</th>
                <th align='right'>Montant</th>
            </tr>
            <{foreach from=$devis_detail_pieces key=myId item=i}>
                <tr>
                    <td class="head" width="300px"><{$i.devis_dp_designation}></td>
                    <td class="odd" width="50px" align='right'><{$i.devis_dp_quantite}></td>
                    <td class="odd" width="50px" align='right'><{$i.devis_dp_tarif_client}> <{$devis_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $devis_dp_remise > 0}><{$i.devis_dp_remise}> <{$devis_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$i.devis_dp_net}> <{$devis_devise}></td>
                </tr>
            <{/foreach}>
        <{/if}>

        <{if $devis_nb_forfait > 0}>
            <tr>
                <th>Forfait</th>
                <th align='right'></th>
                <th align='right'>Tarif</th>
                <th align='right'>Remise</th>
                <th align='right'>Montant</th>
            </tr>
            <{foreach from=$devis_detail_forfaits key=myId item=j}>
                <tr>
                    <td class="head" width="300px"><{$j.devis_forfait_designation}></td>
                    <td class="odd" width="50px" align='right'></td>
                    <td class="odd" width="50px" align='right'><{$j.devis_forfait_montant}> <{$devis_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $devis_forfait_remise > 0}><{$j.devis_forfait_remise}> <{$devis_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$j.devis_forfait_net}> <{$devis_devise}></td>
                </tr>
            <{/foreach}>
        <{/if}>

        <{if $devis_remise > 0}>
            <tr>
                <td>&nbsp;</td>
                <td class="head" colspan="3"
                <span style="font-weight: bold;">Remise</span></td>
                <td class="odd" align='right' style="font-style: italic;"><{$devis_remise}> <{$devis_devise}></td>
            </tr>
        <{/if}>
        <tr>
            <td>&nbsp;</td>
            <td class="head" colspan="3"
            <span style="font-weight: bold;">Montant HT</span></td>
            <td class="odd" align='right' style="font-style: italic;"><{$devis_montant}> <{$devis_devise}></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="head" colspan="3" style="font-weight: bold;">Montant TVA&nbsp;&nbsp;(<{$devis_tx_tva}>%)</td>
            <td class="odd" align='right' style="font-style: italic;"><{$devis_tva}> <{$devis_devise}></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="head" colspan="3" style="font-weight: bold;">Montant TTC</td>
            <td class="odd" align='right' style="font-weight: bold;"><{$devis_ttc}> <{$devis_devise}></td>
        </tr>
    </table>
    <br><br><br>
    <center>
        <p class="head"><span style="font-style: italic;"><span style="font-size: small;"><{$devis_rs}>
                    - <{$devis_rcs}></span>
                </li></p>
    </center>
</div>
</body>
</html>
