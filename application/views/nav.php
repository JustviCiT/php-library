<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">PHP biblioteca</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php if($nav_active == 'search'): ?> active <?php endif; ?>">
        <a class="nav-link" href="/library">Cerca Libro <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php if($nav_active == 'new'): ?> active <?php endif; ?>">
        <a class="nav-link" href="/new-book">Nuovo Libro</a>
      </li>
    </ul>
  </div>
</nav>