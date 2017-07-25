<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN''http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
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

    <title>Facture n&deg; <{$facture_id}> du <{$facture_date}></title>

    <!-- Sheet Css -->
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<{xoAppUrl xoops.css}>">
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<{xoImgUrl style.css}>">
    <link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="<{xoImgUrl css/style.css}>">

</head>

<body
        <{$facture_impression_directe}>>
<div id="content">
    <table border=1 width=800>
        <th width=10% align="left"><img src="images/logo.jpg"></th>
        <th width=40% align="left"><{$facture_societe}></th>
        <th colspan="2" align="center">Facture n&deg; <{$facture_id}> du <{$facture_date}></th>
        <tr>
            <td class="head" width="10%">Compte client</td>
            <td class="even"><{$facture_compte}></td>
            <td class="head" width="10%">Client</td>
            <td class="even" style="font-weight: bold;"><{$facture_client_rs}></td>
        </tr>
        <tr>
            <td class="head">V&eacute;hicule</td>
            <td class="even"><{$facture_marque}> <{$facture_gamme}> <{$facture_modele}> (Immat : <{$facture_immat}>)
            </td>
            <td class="head"></td>
            <td class="even" style="font-weight: bold;"><{$facture_proprietaire}></td>
        </tr>
        <tr>
            <td class="head">Kilom&egrave;trage</td>
            <td class="even"><{$facture_km}> Kms</td>
            <td class="head"></td>
            <td class="even"><{$facture_adresse}></td>
        </tr>
        <tr>
            <td class="head"></td>
            <td class="even"></td>
            <td class="head"></td>
            <td class="even"><{$facture_cp}> <{$facture_ville}></td>
        </tr>

    </table>
    <br>
    <table border=1 width=800px>
        <tr>
            <th>Travail demand&eacute;</th>
        </tr>
        <tr>
            <td class="even"><{$facture_taf}></td>
        </tr>
    </table>
    <br>
    <table>
        <{if $facture_nb_mod > 0}>
            <th>Temps pass&eacute;</th>
            <th align='right'>Quantit&eacute;</th>
            <th align='right'>Montant brut</th>
            <th align='right'>Remise</th>
            <th align='right'>Montant</th>
            <{if $facture_cumul_modmeca > 0}>
                <tr>
                    <td class="head" width="300px" style="font-weight: bold;">Main d'oeuvre m&eacute;canique</td>
                    <td class="odd" width="50px" align='right'><{$facture_cumul_modmeca}> H</td>
                    <td class="odd" width="50px" align='right'><{$facture_montant_modmeca}> <{$facture_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $facture_remise_meca > 0}><{$facture_remise_meca}> <{$facture_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$facture_montant_net_modmeca}> <{$facture_devise}></td>
                </tr>
            <{/if}>

            <{if $facture_cumul_modcaro > 0}>
                <tr>
                    <td class="head" width="300px" style="font-weight: bold;">Main d'oeuvre carrosserie</td>
                    <td class="odd" width="50px" align='right'><{$facture_cumul_modcaro}> H</td>
                    <td class="odd" width="50px" align='right'><{$facture_montant_modcaro}> <{$facture_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $facture_remise_caro > 0}><{$facture_remise_caro}> <{$facture_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$facture_montant_net_modcaro}> <{$facture_devise}></td>
                </tr>
            <{/if}>
            <tr>
                <td class="odd"><{$facture_observation}></td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <!--
                    <td class="odd" align='right'><b><{$facture_cumul_mod}> H</b></td>
                    <td class="odd" align='right'><b><{$facture_montant_mod}></b> <{$facture_devise}> </td>
                    <td class="odd" align='right'><b><{$facture_remise_mod}></b> <{$facture_devise}> </td>
                    <td class="odd" align='right'><b><{$facture_montant_net_mod}></b> <{$facture_devise}> </td>
            -->
            </tr>
        <{/if}>

        <{if $facture_nb_pieces > 0}>
            <tr>
                <th>Fournitures utilis&eacute;es</th>
                <th align='right'>Quantit&eacute;</th>
                <th align='right'>Prix unitaire</th>
                <th align='right'>Remise</th>
                <th align='right'>Montant</th>
            </tr>
            <{foreach from=$facture_detail_pieces key=myId item=i}>
                <tr>
                    <td class="head" width="300px"><{$i.facture_dp_designation}></td>
                    <td class="odd" width="50px" align='right'><{$i.facture_dp_quantite}></td>
                    <td class="odd" width="50px" align='right'><{$i.facture_dp_tarif_client}> <{$facture_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $facture_dp_remise > 0}><{$i.facture_dp_remise}> <{$facture_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$i.facture_dp_net}> <{$facture_devise}></td>
                </tr>
            <{/foreach}>
        <{/if}>

        <{if $facture_nb_forfait > 0}>
            <tr>
                <th>Forfait</th>
                <th align='right'></th>
                <th align='right'>Tarif</th>
                <th align='right'>Remise</th>
                <th align='right'>Montant</th>
            </tr>
            <{foreach from=$facture_detail_forfaits key=myId item=j}>
                <tr>
                    <td class="head" width="300px"><{$j.facture_forfait_designation}></td>
                    <td class="odd" width="50px" align='right'></td>
                    <td class="odd" width="50px" align='right'><{$j.facture_forfait_montant}> <{$facture_devise}></td>
                    <td class="odd" width="50px"
                        align='right'><{if $facture_forfait_remise > 0}><{$j.facture_forfait_remise}> <{$facture_devise}><{/if}></td>
                    <td class="odd" width="50px" align='right'><{$j.facture_forfait_net}> <{$facture_devise}></td>
                </tr>
            <{/foreach}>
        <{/if}>

        <{if $facture_remise > 0}>
            <tr>
                <td>&nbsp;</td>
                <td class="head" colspan="3"
                <span style="font-weight: bold;">Remise</span></td>
                <td class="odd" align='right' style="font-style: italic;"><{$facture_remise}> <{$facture_devise}></td>
            </tr>
        <{/if}>
        <tr>
            <td>&nbsp;</td>
            <td class="head" colspan="3"
            <span style="font-weight: bold;">Montant HT</span></td>
            <td class="odd" align='right' style="font-style: italic;"><{$facture_montant}> <{$facture_devise}></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="head" colspan="3" style="font-weight: bold;">Montant TVA&nbsp;&nbsp;(<{$facture_tx_tva}>%)</td>
            <td class="odd" align='right' style="font-style: italic;"><{$facture_tva}> <{$facture_devise}></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="head" colspan="3" style="font-weight: bold;">Montant TTC</td>
            <td class="odd" align='right' style="font-weight: bold;"><{$facture_ttc}> <{$facture_devise}></td>
        </tr>
    </table>
    <br><br><br>
    <center>
        <p class="head"><span style="font-style: italic;"><span style="font-size: small;"><{$facture_rs}>
                    - <{$facture_rcs}></span>
                </li></p>
    </center>
</div>
</body>
</html>
