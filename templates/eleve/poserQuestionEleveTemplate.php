<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Poser une nouvelle question</p>
        </div>

        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('eleve', 'ajouterQuestionEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                
                <textarea type="text" name="questionEleve" id="questionEleve" value="" placeholder="entrez votre question"></textarea>
                
                <button id="btn-question-creer" type="submit" class="center">Valider</button>
                
            </form>
            
            <form action="<?php echo $this->bu('eleve', 'listeQuestionsEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Annuler</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>