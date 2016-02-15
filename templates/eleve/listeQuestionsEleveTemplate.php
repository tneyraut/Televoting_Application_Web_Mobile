<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Liste des questions des élèves</p>
        </div>

        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('eleve', 'rechercheQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_question_eleve" id="recherche_question_eleve" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            
            <?php if (isset($recherche)): ?>
                <form action="<?php echo $this->bu('eleve', 'listeQuestionsEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                    <button id="btn-resultat" type="submit" class="center">
                        Annuler la recherche
                    </button>
                </form><br>
            
            <?php endif; foreach ($questionsEleve as $questionEleve): ?>
                <form action="<?php echo $this->bu('eleve', 'listeReponsesQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                    
                    <button name="questionEleve" id="btn-question" type="submit" class="center" value="<?php echo $questionEleve->question; ?>">
                        <?php echo $questionEleve->question; ?>
                    </button>
                    
                </form>
            <?php endforeach;
            if (count($questionsEleve) == 0): ?>
                <table>
                    <tr>
                        <th>Aucune question enregistrée</th>
                    </tr>
                </table>
            <?php endif; ?>
            <br>
            <form action="<?php echo $this->bu('eleve', 'poserQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                
                <button id="btn-question-creer" type="submit" class="center">
                    Poser une question
                </button>
                
            </form>
            <br>
            <form action="<?php echo $this->bu('eleve', 'listeCours'); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>