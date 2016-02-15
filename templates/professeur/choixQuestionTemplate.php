<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name." / ".$questionnaire_name; ?></p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'rechercherQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_question" id="recherche_question" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            
            <?php if (isset($recherche)): ?>
                <form action="<?php echo $this->bu('professeur', 'annulerRechercheQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                    <button id="btn-resultat" type="submit" class="center">
                        Annuler la recherche
                    </button>
                </form><br>
            
            <?php endif; if(count($questions) != 0):
            foreach ($questions as $question): ?>
                <form action="<?php echo $this->bu('professeur', 'listeActionsQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                    <button id="btn" type="submit" class="center" name="question" value="<?php echo $question->question; ?>"><?php echo $question->question; ?></button>
                </form>
            <?php endforeach;
            else: ?>
                <table>
                    <tr>
                        <th>
                            <?php if(isset($recherche)): ?>
                            Aucune question correspond à cette recherche.
                            <?php else: ?>
                            Vous n'avez créé aucune question pour ce questionnaire.
                            <?php endif; ?>
                        </th>
                    </tr>
                </table>
            <?php endif; ?>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'formulaireCreationQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Créer une question</button>
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>