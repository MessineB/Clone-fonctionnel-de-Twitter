<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/style.css" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Liste des postes Twitter </title>
</head>
<body style="background-color: lightgray;">
<nav class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="?page=admin&?p=1">Admin</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="?page=post&?p=1">Articles</a>
      </nav>
</nav>
<!-- Ajout Post -->
    <form method="post">
        <div class="card mb-4 rounded-3 shadow-sm post">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" placeholder="Nom du post" class="form-control">
            <label for="content" class="form-label">Contenu de l'article</label> 
            <input id="content" type="text" name="content" placeholder="Contenu du post" class="form-control form"> 
            <label for="Hashtag" class="form-label">Hashtag</label>
            <input id="Hashtag" type="text" name="hashtag" placeholder="#Hashtag" class="form-control">
            <input name="formadd" type="submit" value="Ajouter un post"> 
            </div> 
    </form>
    <!-- Pagination  -->
    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
  <?php for ($i=1;$i<= $nbrpages; $i++) : ?>
    <li class="page-item"><a class="page-link" href='?page=post&?p=<?php echo$i ?>'> <?php echo"$i" ?></a></li>
    <?php endfor ?>
  </ul>
</nav>
    <!-- Pagination -->
    <!-- Recherche en fonction du contenu --> 
    <form method="post">
        <div class="card mb-4 rounded-3 shadow-sm post">
        <h2> Recherche d'article </h2>
            <label for="content-search" class="form-label">Contenu de l'article</label> 
            <input id="content-search" type="text" name="search-content" placeholder="Contenu du post" class="form-control form">
            <label for="hashtag-search" class="form-label">Hashtag de l'article</label> 
            <input id="hashtag-search" type="text" name="search-hashtag" placeholder="Hashtag du post" class="form-control form">  
            <input name="formsearch" type="submit" value="Rechercher un post"> 
            </div> 
    </form>

    <!-- POSTS --> 
    <!-- Si l'utilisateur fait une recherche alors la recherche s'affiche -->
    <?php if (isset($searchs)) {
      
      echo('<div class="d-flex post"> <h2> Vous avez rechercher '.$searchcontent.' ,voici les resultats : </h2> </div>'  );
      if ((empty($searchs))) {
        echo('<div class="d-flex post"> <h1> Aucun post ne correspond a votre recherche desolé :( </h1> </div>');
      }
      foreach($searchs as $search) :?> 
        <div class="d-flex post">
  <aside class="flex-shrink-0 image">
    <h3> Image de l'utilisateur </h3>
    <img class="avatar rounded" src="https://avatars.dicebear.com/api/avataaars/<?=$random = random_int( 1 , 99999)?>.svg?background=%230000ff" alt="avatar de l'utilisateur">
    </aside>
  <div class="flex-grow-1 ms-3">
  <a href="?page=status&post_id=<?= $search->getId() ?>" ?> 
  <h1 class="display-5 fw-bold"><?= $search->getTitle() ?></h1></a>
  <p class="lead mb-4"><?= $search->getContent() ?>
  <h5>Ajouté le : <?= $search->getDate_ajout() ?> </h5>
  </div>
</div>
    <?php endforeach ;  }
    
// Si searchs est null 

    if (!isset($searchs)) :
    foreach($posts_actuel as $post_actuel) :?> 
        <div class="d-flex post">
  <aside class="flex-shrink-0 image">
    <h3> Image de l'utilisateur </h3>
    <img class="avatar rounded" src="https://avatars.dicebear.com/api/avataaars/<?=$random = random_int( 1 , 99999)?>.svg?background=%230000ff" alt="avatar de l'utilisateur">
    </aside>
  <div class="flex-grow-1 ms-3">
  <a href="?page=status&post_id=<?= $post_actuel->getId() ?>" ?> 
  <h1 class="display-5 fw-bold"><?= $post_actuel->getTitle() ?></h1></a>
  <p class="lead mb-4"><?= $post_actuel->getContent() ?>
  <h5>Ajouté le : <?= $post_actuel->getDate_ajout() ?> </h5>
  </div>
</div>
    <?php endforeach 
    ;endif?>
   
        
</body>
</html>