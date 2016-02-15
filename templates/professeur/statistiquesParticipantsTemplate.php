<body>
    
    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Statistiques par participant</p>
        </div>
        
        <div data-role="content">
            
            <form action="<?php echo $this->bu('professeur', 'rechercherParticipantStatistiques', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_participant" id="recherche_participant" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form><br>
            
            <?php if (isset($recherche)): ?>
            <form action="<?php echo $this->bu('professeur', 'annulerRechercheParticipantStatistiques', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">
                    Annuler la recherche
                </button>
            </form><br>
            <?php endif; ?>
            
            <table>
                <?php foreach ($participants as $participant): ?>
                <tr>
                    <th>Prénom.Nom</th>
                    <td><?php echo $participant->login; ?></td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td><?php echo $participant->note; ?></td>
                </tr>
                <tr>
                    <th>Nombre de bonnes réponses</th>
                    <td><?php echo $participant->nombre_de_bonnes_reponses; ?></td>
                </tr>
                <tr>
                    <th>Nombre de fautes</th>
                    <td><?php echo $participant->nombre_de_fautes; ?></td>
                </tr>
                <tr>
                    <th></th>
                </tr>
                <?php endforeach; if (count($participants) == 0): ?>
                <tr>
                    <th>Aucun participant enregistré</th>
                </tr><br>
                <?php endif; ?>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>