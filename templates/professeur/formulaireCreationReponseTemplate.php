<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Création d'une réponse</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'creationReponse', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                
                <textarea type="text" name="reponse" id="question" value="" placeholder="réponse"></textarea>
                
                <label>
                    <input type="checkbox" name="reponse_correcte" value="Oui">
                    Réponse correcte
                </label>
                
                <select name="question_suivante" class="selectpicker show-tick form-control">
                    <option>Par défaut</option>
                    <option>Aucune question suivante</option>
                    <?php foreach ($questions as $uneQuestion): if($question->question_id != $uneQuestion->question_id): ?>
                    <option><?php echo $uneQuestion->question; ?></option>
                    <?php  endif; endforeach; ?>
                </select>
                
                <button id="btn" type="submit" class="center">Créer la réponse</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeReponses', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>