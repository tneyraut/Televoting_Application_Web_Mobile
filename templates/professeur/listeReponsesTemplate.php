<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Liste des réponses</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <table>
                <tr>
                    <th><?php echo $question->question; ?></th>
                </tr>
            </table><br>
            
            <?php if(count($reponses) != 0):
            foreach ($reponses as $reponse): ?>
            <form action="<?php echo $this->bu('professeur', 'modifierReponse', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <table>
                    <tr>
                        <th><?php echo $reponse->reponse; ?></th>
                    </tr>
                    <tr>
                        <th>Réponse <?php if ($reponse->reponse_correcte == 1): echo "correcte"; else: echo "incorrecte"; endif; ?></th>
                    </tr>
                </table>
                <button id="btn" type="submit" class="center" name="reponse_id" value="<?php echo $reponse->reponse_id; ?>">Modifier cette réponse</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'supprimerReponse', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center" name="reponse_id" value="<?php echo $reponse->reponse_id; ?>">Supprimer cette réponse</button>
            </form>
            <br>
            <?php endforeach;
            else: ?>
                <table>
                    <tr>
                        <th>Vous n'avez créé aucune réponse pour cette question.</th>
                    </tr>
                </table>
            <?php endif; ?>
            
            <form action="<?php echo $this->bu('professeur', 'creerReponse', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Créer une réponse</button>
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActionsQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>