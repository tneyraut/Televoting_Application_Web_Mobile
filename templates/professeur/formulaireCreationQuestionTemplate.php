<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Création d'une question</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'creationQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                
                <textarea type="text" name="question" id="question" value="" placeholder="question"></textarea>
                
                <input type="text" name="temps_imparti" id="malus" value="" placeholder="temps imparti">
                
                <br>
                
                <button id="btn" type="submit" class="center">Créer la question</button>
            </form><br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeQuestions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>