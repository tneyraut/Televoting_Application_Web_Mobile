<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Liste des questions des élèves</p>
        </div>

        <div data-role="content">
            
            <form action="<?php echo $this->bu('professeur', 'rechercherQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
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
            <form action="<?php echo $this->bu('professeur', 'listeQuestionsEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">
                    Annuler la recherche
                </button>
            </form><br>
            <?php endif; ?>
            
            <form action="<?php echo $this->bu('professeur', 'listeReponsesQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                
                <?php foreach($questionsEleve as $questionEleve): ?>
                <button name="questionEleve" id="btn-resultat" type="submit" class="center" value="<?php echo $questionEleve->question; ?>"><?php echo $questionEleve->question; ?></button>
                <?php endforeach; if(count($questionsEleve) == 0): ?>
                <table>
                    <tr>
                        <th>
                            Aucune question enregistrée
                        </th>
                    </tr>
                </table>
                <?php endif; ?>
                
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeModeAbsenceOuQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>