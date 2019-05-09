<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">

    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancellare il libro ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        Sicuro di voler cancellare il libro?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a class="btn btn-primary" id="mainLink" href="/delete-book/<?= isset($query) ? (array_key_exists('id_libro', $query) ? $query['id_libro'] : '') : '' ?>" role="button">Si</a>
    </div>
    </div>

</div>
</div>