<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <br>
    
    <?php $this->view('alerts', $status); ?> 
    <?php $this->view('modal', isset($query) ? $query : '' ); ?> 

    <?php if($action == 'update'): ?>
        <h3> Modifica libro <h3>
    <?php elseif ($action == 'new'): ?>
        <h3> Nuovo libro <h3>
    <?php endif; ?>

    <?php if ($action == 'update' && empty($query)): ?>
        <br><br><h5> Libro non trovato </h5>
    <?php else:
            if ( empty($query) ): 
                $query = [];
            endif;
        ?>


    <form method="POST" action="/add-book" enctype="application/x-www-form-urlencoded" > 
        <input type="hidden" name="key_book" value="<?= array_key_exists('id_libro', $query) ? $query['id_libro'] : '' ?>">
        <input type="hidden" name="key_auth" value="<?= array_key_exists('id_autore', $query) ? $query['id_autore'] : '' ?>">
        
        <div class="btn-group float-right" role="group" aria-label="...">
            <button class="btn btn-primary" type="submit">Salva</button>
            <?php if($action == 'update'): ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">Cancella</button>
            <?php endif; ?>
        </div><br>

        <div class="form-group">
            <label for="autore">Autore</label>
            <input type="text" name="autore" value="<?= array_key_exists('nome_cognome', $query) ? $query['nome_cognome'] : '' ?>" class="form-control" id="autore" aria-describedby="autore" placeholder="Inserisci l'autore" required>
        </div>

        <div class="form-group">
            <label for="titolo">Titolo</label>
            <input type="text" name="titolo" value="<?= array_key_exists('titolo', $query) ? $query['titolo'] : '' ?>" class="form-control" id="titolo" aria-describedby="titolo" placeholder="Inserisci il titolo" required>
        </div>

    </form>
    
    <?php endif; ?>
</div>