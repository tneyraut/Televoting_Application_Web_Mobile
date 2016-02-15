<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name." : Liste des élèves"; ?></p>
        </div>

        <div data-role="content">
            
            <form action="<?php echo $this->bu('professeur', 'rechercherEleve', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <table>
                    <tr>
                        <th>
                            <input type="text" name="recherche_eleve" id="recherche_eleve" value="" placeholder="entrez votre recherche" />
                        </th>
                        <td>
                            <button id="btn" type="submit" class="center">Rechercher</button>
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php if (isset($recherche)): ?>
            <form action="<?php echo $this->bu('professeur', 'listeEleves', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn-resultat" type="submit" class="center">
                    Annuler la recherche
                </button>
            </form><br>
            <?php endif; ?>
            
            <form action="<?php echo $this->bu('professeur', 'ValidationPresences', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                
                <table>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th><?php echo $user->login; ?></th>
                        <td>
                            <select name="<?php echo $user->user_id; ?>" class="selectpicker show-tick form-control">
                                <option>Présent</option>
                                <option>En retard</option>
                                <option>Absent</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach;
                if (count($users) == 0): ?>
                    <tr>
                        <th>
                            <?php if(isset($recherche)): ?>
                            Aucun élève correspond à cette recherche.
                            <?php else: ?>
                            Aucun élève est enregistré pour ce cours.
                            <?php endif; ?>
                        </th>
                    </tr>
                </table>
                <?php else : ?>
                    
                    <tr>
                        <th>Jour</th>
                        <td>
                            <select name="day" class="selectpicker show-tick form-control">
                                <?php for ($i=1;$i<=31;$i++): ?>
                                <option><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th>Mois</th>
                        <td>
                            <select name="month" class="selectpicker show-tick form-control">
                                <?php for ($i=1;$i<=12;$i++): ?>
                                <option><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th>Année</th>
                        <td>
                            <select name="year" class="selectpicker show-tick form-control">
                                <?php for ($i=2015;$i<=2016;$i++): ?>
                                <option><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                    
                </table>
                <br>
                
                <button id="btn-resultat" type="submit" class="center">Valider les présences</button>
                    
                <?php endif; ?>
                
            </form>
            <br>
            
            <form action="<?php echo $this->bu('professeur', 'retourListeModeAbsenceOuQuestionnaire', array('cours_name' => str_replace(' ', '_', $cours_name))); ?>" method="post">
                <button id="btn" type="submit" class="center">Retour</button>
            </form>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>