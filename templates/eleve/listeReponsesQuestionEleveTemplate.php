<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Question et réponses</p>
        </div>

        <div data-role="content">
            
            <table>
                <tr>
                    <th>
                        <?php echo "Question : " . $question_eleve->question; ?>
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
            </table><br>
            
            <form action="<?php echo $this->bu('eleve', 'listeQuestionsEleve', array('cours_name' => str_replace(' ', '_', $cours->cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>