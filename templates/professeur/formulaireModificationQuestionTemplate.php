<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Modification d'une question</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
            <?php endif ?>
            
            <table>
                <tr>
                    <th>
                        Question :
                    </th>
                    <td>
                        <?php echo $question->question; ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Temps imparti :
                    </th>
                    <td>
                        <?php echo $question->temps_imparti." secondes"; ?>
                    </td>
                </tr>
            </table><br>
                
            <form action="<?php echo $this->bu('professeur', 'modifierQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <textarea type="text" name="question" id="question" value="" placeholder="question"></textarea>
                
                <input type="text" name="temps_imparti" id="malus" value="" placeholder="temps imparti" />
                <br>
                <button id="btn" type="submit" class="center">Valider les modifications</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActionsQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => str_replace(' ', '_', $question->question_id))); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>