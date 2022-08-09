<?php

namespace App\Controller;

use App\Model\PostModel;
use App\Model\ResponsesModel;
use App\Model\ModifModel;
use App\Controller\AbstractController;

class ModifController extends AbstractController
{  
    public function modif()
    {   $modifModel = new ModifModel;
        $id = $_GET['post_id'];
        $modif = $modifModel->modifpost($id);
        

         header('Location: ?page=admin&?p=1');
    }
}