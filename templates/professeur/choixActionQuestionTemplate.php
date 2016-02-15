<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $question->question; ?></p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <?php foreach ($actions as $action): ?>
            <form action="<?php echo $this->bu('professeur', 'suiteActionQuestion', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ','_',$questionnaire_name), 'question_id' => str_replace(' ','_',$question->question_id))); ?>" method="post">
                <button id="btn" type="submit" class="center" name="action" value="<?php echo $action; ?>"><?php echo $action; ?></button>
            </form>
            <?php endforeach; ?>
            <br>
            <form action="<?php echo $this->bu('professeur', 'retourListeQuestions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ','_',$questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>