<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
    
    <?php $this->view('alerts', $status); ?> 
    <?php $this->view('modal', $query); ?> 

<form class="form-inline" method="POST" action="search" enctype="application/x-www-form-urlencoded">
  <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

<br>
<?php if ( empty($query) ): ?>
  <h4> Nessun risultato trovato </h4>
<?php else: ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Autore</th>
      <th scope="col">Titolo</th>
      <th scope="col">Funzioni</th>
    </tr>
  </thead>
  <tbody>
    <?php $counter = 1; ?>
    <?php foreach ($query as $row): ?> 
    <tr>
      <th scope="row"><?= $counter++ ?></th>
      <td><?= $row->nome_cognome ?></td>
      <td><?= $row->titolo ?></td>
      <td>  
        <div class="btn-group" role="group" aria-label="Btns">
          <a class="btn btn-primary" href="/get-book/<?= $row->id_libro ?>" role="button">Modifica</a>
          <button type="button" class="btn btn-secondary deleteButton" data-key="/delete-book/<?= $row->id_libro ?>" data-toggle="modal" data-target="#deleteModal">Cancella</button>
        </div>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php endif ?>