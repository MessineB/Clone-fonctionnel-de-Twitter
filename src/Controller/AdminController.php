<?php

namespace App\Controller;

use App\Model\AddModel;
use App\Model\PostModel;
use App\Model\ResponsesModel;
use App\Controller\AbstractController;

class AdminController extends AbstractController
{  
   
    public function index()
    {   
        $searchs = null;
        $searchcontent = null;
        $postModel = new PostModel();
        $responsesModel = new ResponsesModel();
        
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
            $searchs = $postModel->searchadmin($searchcontent,$searchhashtag);
        }

        
       
        $posts = $postModel->findAllPosts();
        //var_dump($posts);
        $responses = $responsesModel->findResponses();
       
        $pages = $_GET["?p"];
        $elem_by_page = 4 ;
        $debut = ($pages-1)*$elem_by_page;
        $nbrpages = ceil(count($posts)/$elem_by_page);
        $posts_actuel = $postModel->findALLPagePosts($debut , $elem_by_page);
       
        $this->render('admin.php', [
            'posts' => $posts,
            'responses' => $responses,
            'posts_actuel' => $posts_actuel,
            'nbrpages' => $nbrpages,
            'searchs' => $searchs,
            'searchcontent' => $searchcontent,
        
        ]);
    }
    
}
