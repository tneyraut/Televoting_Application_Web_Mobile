<body>

    <section data-role="page">
        <div data-role="header" data-position="fixed">
            <p align="center">Televoting : Application Mobile</p>
        </div>
        
        <div data-role="content">
            
            <?php if (isset($erreur)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $erreur; ?></div>
            <?php endif ?>
            <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
            <?php endif ?>
            
            <form action="<?php echo $this->bu('anonymous', 'login'); ?>" method="post">
                <input type="text" name="login" id="login" value="" placeholder="entrez votre login" />
                <input type="password" name="password" id="password" value="" placeholder="entrez votre password" />
                <button id="btn-valider" type="submit" class="center">Valider</button>
            </form>
        </div>
        
        <div data-role="footer" data-position="fixed"></div>
    </section>
</body>