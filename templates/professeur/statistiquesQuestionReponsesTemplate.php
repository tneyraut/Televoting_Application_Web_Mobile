<body>
    
    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Statistiques</p>
        </div>
        
        <div data-role="content">
            
            <table>
                <tr>
                    <th>Question</th>
                    <td><?php echo $question->question; ?></td>
                </tr>
                <tr>
                    <th>Nombre de bonnes réponses</th>
                    <td><?php echo $nombreBonnesReponsesParticipant; ?></td>
                </tr>
                <tr>
                    <th>Pourcentage de bonnes réponses</th>
                    <td><?php echo ($nombreBonnesReponsesParticipant / $nombreParticipants) * 100; ?></td>
                </tr>
                <tr>
                    <th>Nombre de fautes</th>
                    <td><?php echo $nombreFautesParticipant; ?></td>
                </tr>
            </table><br>
            
            <table>
                <?php foreach ($nombreTypesReponses as $reponse): ?>
                <tr>
                    <th>Réponse</th>
                    <td><?php echo $reponse->reponse; ?></td>
                </tr>
                <tr>
                    <th>Nombre de choix (en %)</th>
                    <td><?php echo ($reponse->resultat / $nombreParticipants) * 100; ?></td>
                </tr>
                <tr>
                    <th></th>
                </tr>
                <?php endforeach; if (count($nombreTypesReponses) == 0): ?>
                <tr>
                    <th>Aucun réponse enregistrée</th>
                </tr><br>
                <?php endif; ?>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActionsQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>
