<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Modification d'une réponse</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
            <?php endif ?>
            
            <table>
                <tr>
                    <th><?php echo $question->question; ?></th>
                </tr>
            </table>
                
            <table>
                <tr>
                    <th>
                        Réponse :
                    </th>
                    <td>
                        <?php echo $reponse->reponse; ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Réponse :
                    </th>
                    <td>
                        <?php if($reponse->reponse_correcte == 1): echo "correcte"; else: echo "incorrecte"; endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Question suivante :
                    </th>
                    <td>
                        <?php if($reponse->question_suivante_id == 0): echo "Par défaut"; elseif($reponse->question_suivante_id == -1): echo "Aucune question suivante"; else: echo $reponse->question; endif; ?>
                    </td>
                </tr>
            </table><br>
                
            <form action="<?php echo $this->bu('professeur', 'modificationReponse', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id, 'reponse_id' => $reponse->reponse_id)); ?>" method="post">
                
                <textarea type="text" name="reponse" id="reponse" value="" placeholder="réponse"></textarea>
                
                <label>
                    <?php if($reponse->reponse_correcte == 1): ?>
                    <input type="checkbox" name="reponse_correcte" value="Oui" checked>
                    <?php else: ?>
                    <input type="checkbox" name="reponse_correcte" value="Oui">
                    <?php endif; ?>
                    Réponse correcte
                </label>
                
                <select name="question_suivante" class="selectpicker show-tick form-control">
                    <option><?php if($reponse->question_suivante_id == 0): echo "Par défaut"; elseif($reponse->question_suivante_id == -1): echo "Aucune question suivante"; else: echo $reponse->question; endif;?></option>
                    <?php foreach ($questions as $uneQuestion): ?>
                    <option><?php if($question->question_id != $uneQuestion->question_id && $reponse->question_suivante_id != $uneQuestion->question_id): echo $uneQuestion->question; endif; ?></option>
                    <?php endforeach; if($reponse->question_suivante_id != 0): ?>
                    <option>Par défaut</option>
                    <?php endif; if($reponse->question_suivante_id != -1): ?>
                    <option>Aucune question suivante</option>
                    <?php endif; ?>
                </select>
                
                <br>
                <button id="btn" type="submit" class="center">Valider les modifications</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeReponses', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>