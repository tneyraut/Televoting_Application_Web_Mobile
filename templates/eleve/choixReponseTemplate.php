<?php if ($question->temps_imparti > 0): ?>
    <script>
        var temps = <?php echo $question->temps_imparti; ?>;
        document.write(temps);
        $(document).ready(function () {
            var z = setInterval(function () {
                temps--;
            }, 1000);
            var y = setInterval(function () {
                document.getElementById('btn').click();
                clearTimeout(y);
                clearTimeout(z);
            }, <?php echo $question->temps_imparti * 1000; ?>);
        });
    </script>
<?php endif; ?>

<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center"><?php echo $cours_name . " / " . $questionnaire_name; ?></p>
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
                    <th><?php echo $question->question; ?></th>
                </tr>
                <tr>
                    <th><?php if ($question->image != NULL): ?><img class="imageUpload" src="<?php echo $this->bu() . $question->image; ?>"/><?php endif; ?></th>
                </tr>
            </table><br>
            <form action="<?php echo $this->bu('eleve', 'reponseEffectuee', array('cours_name' => str_replace(' ', '_', $cours_name), 'questionnaire_name' => str_replace(' ', '_', $questionnaire_name), 'question_id' => $question->question_id)); ?>" method="post">
                <table>
                    <?php foreach ($reponses as $reponse): ?>
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" name="reponse[]" value="<?php echo $reponse->reponse; ?>"><?php echo $reponse->reponse; ?>
                                </label>
                            </th>
                            <td><?php if ($reponse->image != NULL): ?><img class="imageUpload" src="<?php echo $this->bu() . $reponse->image; ?>"/><?php endif; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table><br>
                <button id="btn" type="submit" class="center">Valider</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
        
    </section>

</body>