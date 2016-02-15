<body>
    
    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Statistiques générales</p>
        </div>
        
        <div data-role="content">
            
            <table>
                <tr>
                    <th>Cours :</th>
                    <td><?php echo $cours_name; ?></td>
                </tr>
                <tr>
                    <th>Questionnaire :</th>
                    <td><?php echo $questionnaire->questionnaire_name; ?></td>
                </tr>
                <tr>
                    <th>Etat :</th>
                    <td><?php if ($questionnaire->lancee == 1): echo "Lancée";
                        else: echo "Non lancée";
                        endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Nombre de participants :</th>
                    <td><?php echo $nombreParticipants; ?></td>
                </tr>
                <tr>
                    <th>Moyenne des Notes :</th>
                    <td><?php echo $moyenneNote; ?></td>
                </tr>
                <tr>
                    <th>Note maximale :</th>
                    <td><?php echo $maxNote; ?></td>
                </tr>
                <tr>
                    <th>Note minimale :</th>
                    <td><?php echo $minNote; ?></td>
                </tr>
                <tr>
                    <th>Nombre moyen de bonnes réponses :</th>
                    <td><?php echo $moyenneNombreBonnesReponses; ?></td>
                </tr>
                <tr>
                    <th>Nombre maximal de bonnes réponses :</th>
                    <td><?php echo $maxNombreBonnesReponses; ?></td>
                </tr>
                <tr>
                    <th>Nombre minimal de bonnes réponses :</th>
                    <td><?php echo $minNombreBonnesReponses; ?></td>
                </tr>
                <tr>
                    <th>Nombre moyen de fautes :</th>
                    <td><?php echo $moyenneNombreFautes; ?></td>
                </tr>
                <tr>
                    <th>Nombre maximal de fautes :</th>
                    <td><?php echo $maxNombreFautes; ?></td>
                </tr>
                <tr>
                    <th>Nombre de minimal de fautes :</th>
                    <td><?php echo $minNombreFautes; ?></td>
                </tr>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire->questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>