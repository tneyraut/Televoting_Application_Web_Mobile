<body>
    
    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Aperçu total</p>
        </div>
        
        <div data-role="content">
            <?php if (count($questions) == 0): ?>
            <strong>
                Ce questionnaire ne comporte aucune question.
            </strong>
            <br>
            <?php else: ?>
            <?php foreach ($questions as $question): $existReponse = false; ?>
            <table>
                <tr>
                    <th>Question : <?php echo $question->question ?></th>
                    <td>Temps imparti : <?php echo $question->temps_imparti." secondes"; ?></td>
                </tr>
                <tr>
                    <th>Reponses :</th>
                </tr>
                <?php foreach ($reponses as $reponse): if($reponse->question_id == $question->question_id): $existReponse = true; ?>
                <tr>
                    <th><?php echo $reponse->reponse; ?></th>
                    <td>Reponse <?php if ($reponse->reponse_correcte == 1): echo "correcte"; else: echo "fausse"; endif; ?></td>
                </tr>

                <?php endif; endforeach; if(!$existReponse): ?>
                <tr>
                    <th>Cette question ne comporte aucune réponse.</th>
                </tr>
                <?php endif; ?>
            </table>
            <br>
            <?php endforeach; ?>
            <?php endif; ?>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>