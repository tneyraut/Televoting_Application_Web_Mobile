<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name; ?> : Liste des questionnaires</p>
        </div>
        <div data-role="content">
            <form action="<?php echo $this->bu('eleve', 'rechercherQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_questionnaire_name" id="recherche_questionnaire_name" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            
            <?php if(isset($recherche)): ?>
            
            <form action="<?php echo $this->bu('eleve', 'listeQuestionnaires', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">
                    Annuler la recherche
                </button>
            </form><br>
            
            <?php endif; foreach ($questionnaires as $questionnaire): ?>
                <form action="<?php echo $this->bu('eleve', 'listeQuestions', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                    <button id="btn" type="submit" class="center" name="questionnaire_name" value="<?php echo $questionnaire->questionnaire_name; ?>"><?php echo $questionnaire->questionnaire_name; ?></button>
                </form>
            <?php endforeach;
            if (count($questionnaires) == 0): ?>
                <table>
                    <tr>
                        <th>Aucun questionnaire trouvé</th>
                    </tr>
                </table>
            <?php endif; ?>
            <br>
            <form action="<?php echo $this->bu('eleve', 'listeCours'); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>