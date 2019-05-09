<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if ($status == 'success'): ?>
    <div class="alert alert-success" role="alert">
    Modifica avvenuta con successo
    </div>
<?php elseif ($status == 'error'): ?>
    <div class="alert alert-danger" role="alert">
    Errore durante la modifica
    </div>
<?php endif ?>