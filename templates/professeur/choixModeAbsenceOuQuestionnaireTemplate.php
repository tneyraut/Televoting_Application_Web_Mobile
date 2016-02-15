<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name; ?></p>
        </div>

        <div data-role="content">
            
            <form action="<?php echo $this->bu('professeur', 'listeQuestionnaires', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">Liste des questionnaires</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'listeEleves', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">Liste des élèves</button>
            </form>
            
            <form action="<?php echo $this->bu('professeur', 'listeQuestionsEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">Liste des questions des élèves</button>
            </form>
            
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'listeCours'); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>