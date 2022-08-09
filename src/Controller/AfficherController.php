<?php

namespace App\Controller;

use App\Model\PostModel;
use App\Model\ResponsesModel;
use App\Model\AfficherModel;
use App\Controller\AbstractController;

class AfficherController extends AbstractController
{  
    public function affiche()
    {   $afficheModel = new AfficherModel;
        $id = $_GET['post_id'];
        $affiche = $afficheModel->affichepost($id);       
         header('Location: ?page=admin&?p=1');
    }
}