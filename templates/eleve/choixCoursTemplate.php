<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Sélectionné un cours</p>
        </div>

        <div data-role="content">
            
            <form action="<?php echo $this->bu('eleve', 'rechercherCours'); ?>" method="post">
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
                <form action="<?php echo $this->bu('eleve', 'listeCours'); ?>" method="post">
                    <button id="btn-resultat" type="submit" class="center">
                        Annuler la recherche
                    </button>
                </form><br>
            <?php endif; foreach ($cours as $unCours): ?>
                <form action="<?php echo $this->bu('eleve', 'choixMode'); ?>" method="post">
                    
                    <button name="cours_name" id="btn-resultat" type="submit" class="center" value="<?php echo $unCours->cours_name; ?>">
                        <?php echo $unCours->cours_name; ?>
                    </button>
                    
                </form>
            <?php endforeach;
            if (count($cours) == 0): ?>
                <table>
                    <tr>
                        <th>Aucun cours disponible</th>
                    </tr>
                </table>
            <?php endif; ?>
            
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>
    
</body>