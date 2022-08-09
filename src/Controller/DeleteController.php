<?php

namespace App\Controller;

use App\Model\PostModel;
use App\Model\ResponsesModel;
use App\Model\DeleteModel;
use App\Controller\AbstractController;

class DeleteController extends AbstractController
{  
    public function delete()
    {   $deleteModel = new DeleteModel;
        $id = $_GET['post_id'];
        $delete = $deleteModel->deletepost($id);
        

         header('Location: ?page=admin&?p=1');
    }
}