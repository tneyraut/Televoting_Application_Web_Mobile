<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name; ?> : Gestion des questionnaires</p>
        </div>
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'rechercherQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_questionnaire_name" id="recherche_questionnaire_name" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            
            <?php if (isset($recherche)): ?>
                <form action="<?php echo $this->bu('professeur', 'listeQuestionnaires', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                    <button id="btn-resultat" type="submit" class="center">
                        Annuler la recherche
                    </button>
                </form><br>
            
            <?php endif; if(count($questionnaires) != 0): foreach ($questionnaires as $questionnaire): ?>
                <form action="<?php echo $this->bu('professeur', 'listeActions', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                    <button id="btn" type="submit" class="center" name="questionnaire_name" value="<?php echo $questionnaire->questionnaire_name; ?>"><?php echo $questionnaire->questionnaire_name; ?></button>
                </form>
            <?php endforeach; endif;
            if(count($questionnaires) == 0): ?>
                <table>
                    <tr>
                        <th>
                            <?php if(isset($recherche)): ?>
                            Aucun questionnaire correspond à cette recherche.
                            <?php else: ?>
                            Vous n'avez créé aucun questionnaire pour ce cours.
                            <?php endif; ?>
                        </th>
                    </tr>
                </table>
            <?php endif; ?>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'formulaireCreationQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Créer un questionnaire</button>
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeModeAbsenceOuQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>