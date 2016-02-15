<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Résultats</p>
        </div>

        <div data-role="content">
            <table>
                <tr>
                    <th><?php echo $cours_name; ?></th>
                </tr>
                <tr>
                    <th><?php echo $questionnaire_name; ?></th>
                </tr>
                <tr><th></th></tr>
                <tr>
                    <th>Vos résultats</th>
                </tr>
                <tr>
                    <th>Note :</th>
                    <td><?php echo $note." / ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Nombre de bonnes réponses :</th>
                    <td><?php echo $nombre_de_bonnes_reponses." / ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Nombre de fautes :</th>
                    <td><?php echo $nombre_de_fautes." / ".$baremeFautes; ?></td>
                </tr>
                <tr><th></th></tr>
                <tr>
                    <th>Résultats généraux</th>
                </tr>
                <tr>
                    <th>Moyenne au questionnaire :</th>
                    <td><?php echo $moyenne." / ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Note maximale obtenue :</th>
                    <td><?php echo $noteMax." / ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Note minimale obtenue :</th>
                    <td><?php echo $noteMin." / ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Nombre moyen de bonnes réponses :</th>
                    <td><?php echo $moyenneBonnesReponses." / ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Nombre moyen de fautes :</th>
                    <td><?php echo $moyenneFautes." / ".$baremeFautes; ?></td>
                </tr>
            </table>
            <br>
            
            <form action="<?php echo $this->bu('eleve', 'listeCours'); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>