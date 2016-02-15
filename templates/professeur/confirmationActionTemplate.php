<body>
    
    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Confirmation : <?php echo $action; ?></p>
        </div>
        
        <div data-role="content">
            
            <?php if(isset($reponse)): ?>
            
            <table>
                <tr>
                    <th>Voulez vous vraiment <?php echo $action; ?> cette réponse (<?php echo $reponse->reponse; ?>) ?</th>
                </tr>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'executerSuppressionReponse', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question_id, 'reponse_id' => $reponse->reponse_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Oui</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeReponses', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
            
            <?php else: if(isset($question)): ?>
            
            <table>
                <tr>
                    <th>Voulez vous vraiment <?php echo $action; ?> cette question (<?php echo $question->question; ?>) ?</th>
                </tr>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'executerSuppressionQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Oui</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActionsQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
            
            <?php else: ?>
            
            <table>
                <tr>
                    <th>Voulez vous vraiment <?php echo $action; ?> ce questionnaire (<?php echo $questionnaire_name; ?>) ?</th>
                </tr>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'executionAction', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'action' => $action)); ?>" method="post">
                <button id="btn" type="submit" class="center">Oui</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
            
            <?php endif; endif; ?>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>