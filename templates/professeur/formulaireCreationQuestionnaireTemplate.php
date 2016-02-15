<body>

    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Création d'un questionnaire</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger" role="alert"><?php echo $erreur ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'creationQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <input type="text" name="questionnaire_name" id="questionnaire_name" value="" placeholder="nom du questionnaire" />
                
                <input type="text" name="malus" id="malus" value="" placeholder="malus du questionnaire" />
                
                <label>
                    <input type="checkbox" name="mode_examen" value="Oui">
                    Mode examen
                </label>
                
                <label>
                    <input type="checkbox" name="pause" value="Oui">
                    Automatique
                </label>
                
                <br>
                
                <button id="btn" type="submit" class="center">Créer le questionnaire</button>
            </form><br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeQuestionnaires', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>