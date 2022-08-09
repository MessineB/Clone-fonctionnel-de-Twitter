
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/style.css" rel="stylesheet">
    <link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Affichage d'un post </title>
</head>
<body style="background-color: lightgray;">
<nav class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="?page=admin&?p=1">Admin</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="?page=post&?p=1">Articles</a>
      </nav>
</nav>

        <div class="card mb-4 rounded-3 shadow-sm post">
        <div class="media">
<img width="60px" height="60px" class="comm-img rounded" src="https://avatars.dicebear.com/api/avataaars/<?=$random = random_int( 1 , 99999)?>.svg?background=%230000ff" alt="avatar de l'utilisateur">
  <div class="media-body">
    <h5 class="mt-0"><?= $post_find->getTitle() ?></h5>
    <?= $post_find->getContent() ?>
    <h3 class="espace-com"> <u> Espace commentaire : </u></h3>
    <?php for ($comment_number=0 ;  $comment_number < count($post_responses) ; $comment_number++ ) { ?>
    <div class="media mt-3">
      <img width="60px" height="60px" class="comm-img rounded" src="https://avatars.dicebear.com/api/avataaars/<?=$random = random_int( 1 , 99999)?>.svg?background=%230000ff" alt="avatar de l'utilisateur">
      <div class="media-body">
        <?=  $post_responses[$comment_number]->getMessage();  ?>
      </div>
      <p>Commentaire ajouté le : <?=  $post_responses[$comment_number]->getDate_ajout();  ?> </p>
    </div>
    <?php } ?>
    
  </div>
  
</div>
        <div class="form-div">
        <form method="post">
        <input  class="form-label" type="text" name="message" placeholder="Message du commentaire"> 
        <input  class="form-label" type="submit" name="submit" placeholder ="Envoyé commentaire">
        </form>
        </div>

</body>
</html>