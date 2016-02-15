<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Créer une nouvelle réponse</p>
        </div>

        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'creationReponseQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name), 'question_eleve' => str_replace(' ', '_', $question_eleve))); ?>" method="post">
                
                <table>
                    <tr>
                        <th>
                            <?php echo $question_eleve; ?>
                        </th>
                    </tr>
                </table>
                
                <textarea type="text" name="reponseQuestionEleve" id="reponseQuestionEleve" value="" placeholder="entrez votre réponse"></textarea>
                
                <button id="btn" type="submit" class="center">Valider</button>
                
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeReponsesQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionEleve' => str_replace(' ', '_', $question_eleve))); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>