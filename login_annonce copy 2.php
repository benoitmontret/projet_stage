<?php
include ("login.php");
if ($user): ?>
<head>
<!-- permet la redirection vers le formulaire d'ajout quand on est connecté -->
    <meta http-equiv="refresh" content="0; URL=annonce_form.php" /> 
</head>
<?php endif; ?>
