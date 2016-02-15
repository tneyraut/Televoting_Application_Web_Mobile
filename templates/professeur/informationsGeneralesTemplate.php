<body>
    
    <section data-role="page">
        
        <div data-role="header" data-position="fixed">
            <p align="center">Informations générales</p>
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
                    <th>Nom du cours :</th>
                    <td><?php echo $cours_name; ?></td>
                </tr>
                <tr>
                    <th>Nom du questionnaire :</th>
                    <td><?php echo $questionnaire->questionnaire_name; ?></td>
                </tr>
                <tr>
                    <th>Mode examen :</th>
                    <td>
                        <?php if ($questionnaire->mode_examen == 1): echo 'Oui'; else: echo 'Non'; endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Malus actuel :</th>
                    <td>
                        <?php echo $questionnaire->malus; ?>
                    </td>
                </tr>
                <tr>
                    <th>Questionnaire automatique :</th>
                    <td>
                        <?php if ($questionnaire->pause != 1): echo 'Oui'; else: echo 'Non'; endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Questionnaire lancé :</th>
                    <td><?php if($questionnaire->lancee == 1): echo "Oui"; else: echo "Non"; endif; ?></td>
                </tr>
                <tr>
                    <th>Barême note et nombre de bonnes réponses :</th>
                    <td><?php echo "/ ".$bareme; ?></td>
                </tr>
                <tr>
                    <th>Barême nombre de mauvaises réponses :</th>
                    <td><?php echo "/ ".$baremeFautes; ?></td>
                </tr>
            </table><br>
            
            <form action="<?php echo $this->bu('professeur', 'modificationInformationsGeneralesQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire->questionnaire_name))); ?>" method="post">
                <input type="text" name="questionnaire_name" id="questionnaire_name" value="" placeholder="modifier nom du questionnaire" />
                
                <input type="text" name="malus" id="malus" value="" placeholder="modifier malus" />
                
                <label>
                    <input type="checkbox" name="mode_examen" value="<?php if ($questionnaire->mode_examen == 1): echo 'Non'; else: echo 'Oui'; endif; ?>">
                    <?php if ($questionnaire->mode_examen == 1): echo 'Désactiver le mode examen'; else: echo 'Acitiver le mode examen'; endif; ?>
                </label>
                
                <label>
                    <input type="checkbox" name="pause" value="<?php if ($questionnaire->pause != 1): echo 'Non'; else: echo 'Oui'; endif; ?>">
                    <?php if ($questionnaire->pause != 1): echo 'Désactiver le mode automatique'; else: echo 'Activer le mode automatique'; endif; ?>
                </label>
                
                <label>
                    <input type="checkbox" name="lancee" value="<?php if ($questionnaire->lancee == 1): echo 'Non'; else: echo 'Oui'; endif; ?>">
                    <?php if ($questionnaire->lancee == 1): echo 'Arrêter le questionnaire'; else: echo 'Lancer le questionnaire'; endif; ?>
                </label>
                
                <button id="btn" type="submit" class="center">Valider les modifications</button>
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeActions', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire->questionnaire_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>