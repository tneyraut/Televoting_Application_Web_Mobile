<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name . " / " . $questionnaire_name; ?> : Liste des questions</p>
        </div>
        
        <?php if (isset($erreur)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
        <?php endif ?>
        <?php if (isset($success)): ?>
        <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
        <?php endif ?>
        
        <div data-role="content">
            <?php foreach ($questions as $question): ?>
                <form action="<?php echo $this->bu('eleve', 'listeReponses', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name))); ?>" method="post">
                    <button id="btn" type="submit" class="center" name="question_id" value="<?php echo $question->question_id; ?>"><?php echo "Question " . $question->question_id; ?></button>
                </form>
            <?php endforeach;
            if (count($questions) == 0): ?>
                <table>
                    <tr>
                        <th>Vous avez déjà répondu à toutes les questions disponibles de ce questionnaire</th>
                    </tr>
                </table>
            <?php endif; ?>
            <br>
            <form action="<?php echo $this->bu('eleve', 'listeQuestionnaires', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>