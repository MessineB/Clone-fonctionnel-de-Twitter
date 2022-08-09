<?php

namespace App\Controller;

use App\Model\AddModel;
use App\Model\PostModel;
use App\Model\SearchModel;
use App\Model\ResponsesModel;
use App\Controller\AbstractController;

class PostResponsesController extends AbstractController
{  
   
    public function index()
    {   $postModel = new PostModel();
        $responsesModel = new ResponsesModel();
        $searchs = null;
        $searchcontent = null;
        // Ajout d'un post
        if (isset( $_POST["formadd"])) {
            $title = $_POST["title"];
            $content = $_POST["content"];
            $hashtag = $_POST["hashtag"];
            //var_dump($title);
            $formModel = new AddModel();
            $form = $formModel->createpost($title , $content , $hashtag);      
    } 
        // Recherche d'un post en fonction de son texte
        if (isset($_POST["formsearch"]))  {
            $searchcontent = $_POST["search-content"];
            $searchhashtag = $_POST["search-hashtag"];
            $searchs = $postModel->search($searchcontent,$searchhashtag);
        }

        

        $posts = $postModel->findPosts();
        $responses = $responsesModel->findResponses();
        $pages = $_GET["?p"];
        $elem_by_page = 4;
        $nbrpages = ceil(count($posts)/$elem_by_page);
        $debut = ($pages-1)*$elem_by_page;
        
        $posts_actuel = $postModel->findPagePosts($debut , $elem_by_page);
        // $response = $responsesModel->findRespone($id);   

        $this->render('post.php', [
            'posts' => $posts,
            'responses' => $responses, 
            'posts_actuel' => $posts_actuel, 
            'nbrpages' => $nbrpages,
            'searchs' => $searchs,
            'searchcontent' => $searchcontent,
        ]);
    }
    
}
