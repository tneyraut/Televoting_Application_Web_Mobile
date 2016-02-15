<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Question et réponses</p>
        </div>

        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <table>
                <tr>
                    <th>
                        <?php echo $question_eleve->question; ?>
                    </th>
                </tr>
                <?php foreach($reponsesQuestionEleve as $reponse): ?>
                <tr>
                    <th>
                        <?php echo $reponse->reponse; ?>
                    </th>
                </tr>
                <?php endforeach; if(count($reponsesQuestionEleve) == 0): ?>
                <tr>
                    <th>
                        Aucune réponse enregistrée
                    </th>
                </tr>
                <?php endif; ?>
            </table>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'creerReponseQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours->cours_name), 'question_eleve' => str_replace(' ', '_', $question_eleve->question))); ?>" method="post">
                <button id="btn" type="submit" class="center">Ajouter une réponse</button>
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'listeQuestionsEleve', array('cours_name' => str_replace(' ', '_', $cours->cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>