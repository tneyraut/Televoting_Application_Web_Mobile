<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Sélectionné un cours</p>
        </div>

        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('professeur', 'rechercherCours'); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_cours_name" id="recherche_cours_name" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form>
            <br>
            
            <?php if (isset($recherche)): ?>
                <form action="<?php echo $this->bu('professeur', 'listeCours'); ?>" method="post">
                    <button id="btn-resultat" type="submit" class="center">
                        Annuler la recherche
                    </button>
                </form><br>
                
            <?php endif; foreach ($cours as $unCours): ?>
                <form action="<?php echo $this->bu('professeur', 'listeModeAbsenceOuQuestionnaire'); ?>" method="post">
                    <button name="cours_name" id="btn-resultat" type="submit" class="center" value="<?php echo $unCours->cours_name; ?>"><?php echo $unCours->cours_name; ?></button>
                </form>
            <?php endforeach;
            if (count($cours) == 0): ?>
                <table>
                    <tr>
                        <th>
                            <?php if(isset($recherche)): ?>
                            Aucun cours correspond à cette recherche.
                            <?php else: ?>
                            Vous n'avez aucun cours d'enregistré. Pour ajouter un cours, veuillez contacter l'administrateur.
                            <?php endif; ?>
                        </th>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>