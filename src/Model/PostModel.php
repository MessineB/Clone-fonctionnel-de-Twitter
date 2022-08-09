<?php

namespace App\Model;

use PDO;
use App\database\Database;

class PostModel{

    protected $id;
    protected $date_ajout;
    protected $title;
    protected $content;
    protected $number_response;
    protected $status;
    protected $pdo;
    protected $likes;

    const TABLE_NAME = 'post';

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getPDO();
    }

    public function findPosts()
    {
        $sql = 'SELECT
                `id`
                ,`date_ajout`
                ,`title`
                ,`content`
                ,`hashtag`
                ,`status`
                FROM ' . self::TABLE_NAME . ' WHERE status=1
                ORDER BY `id` DESC;
        ';
        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }
// recuperer des posts pendant la pagination pour les utilisateurs normaux 
public function findALLPagePosts($debut , $elem_by_page )
{
    $sql = 'SELECT
            p.`id`
            ,p.`date_ajout`
            ,p.`title`
            ,p.`content`
            ,p.`hashtag`
            ,p.`status`
            ,count(c.id) as likes
            FROM ' . self::TABLE_NAME .' AS p
            LEFT JOIN responses AS c 
            ON c.post_id = p.id
            GROUP BY p.id  
            ORDER BY likes DESC ,id DESC LIMIT '.$elem_by_page.' OFFSET '.$debut.' ;
    ';
    //    
    $pdoStatement = $this->pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    return $result;
}
                

///////////////////////////////////////////////////////////////////////////////

// recuperer des posts pendant la pagination pour l'admin 
public function findPagePosts($debut , $elem_by_page )
{
    $sql = 'SELECT
            p.`id`
            ,p.`date_ajout`
            ,p.`title`
            ,p.`content`
            ,p.`hashtag`
            ,p.`status`
            ,count(c.id) as likes
            FROM ' . self::TABLE_NAME .' AS p
            LEFT JOIN responses AS c 
            ON c.post_id = p.id
            WHERE p.status=1
            GROUP BY p.id  
            ORDER BY likes DESC ,`id` DESC LIMIT '.$elem_by_page.' OFFSET '.$debut.' ;
    ';
    //    
    $pdoStatement = $this->pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    return $result;
}

///////////////////////////////////////////////////////////////////////////////
    public function findAllPosts()
    {
        $sql = 'SELECT
                p.`id`
                ,p.`date_ajout`
                ,p.`title`
                ,p.`content`
                ,p.`hashtag`
                ,p.`status`
                ,count(c.id) as likes
                FROM ' . self::TABLE_NAME . ' AS p 
                LEFT JOIN responses AS c 
                ON c.post_id = p.id
                GROUP BY p.id
                ORDER BY likes DESC ,`id` DESC;
        ';
        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }
///////////////////////////////////////////////////////////////////////////////////////////
    public function findPost($id) {
        $sql = 'SELECT * FROM post WHERE id ='.$id.'
        ';
        $pdoStatement = $this->pdo->query($sql);
        $result = $pdoStatement->fetchObject(self::class);
        return $result;
    }
// Fonction de recherche de posts en fonction du contenu et des hashtags pour les utilisateurs
    public function search( $content , $hashtag ) {
        try{
            $sql = "SELECT
            `id`
            ,`date_ajout`
            ,`title`
            ,`content`
            ,`hashtag`
            ,`status`
            FROM post WHERE `content` 
            LIKE :search 
            AND `hashtag`
            LIKE :hashtag
            AND `status` = 1
            ORDER BY `id` DESC;
    ";
    $cont = '%'.$content.'%';
    $hash = '%'.$hashtag.'%';
    $pdoStatement = $this->pdo->prepare($sql);
    $pdoStatement->bindParam(":search",$cont);
    $pdoStatement->bindParam(":hashtag",$hash);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    return $result;
        }
        catch( Exception $error) 
        {dump($error);}
        }
    

        
// Pour l'admin la recherche affiche tout les posts caché ou pas

    public function searchadmin( $content , $hashtag ) {
        try{
            $sql = "SELECT
            `id`
            ,`date_ajout`
            ,`title`
            ,`content`
            ,`hashtag`
            ,`status`
            FROM post WHERE `content` 
            LIKE :search
            AND `hashtag`
            LIKE :hashtag
            ORDER BY `id` DESC;
    ";
    $test = '%'.$content.'%';
    $hash = '%'.$hashtag.'%';
    $pdoStatement = $this->pdo->prepare($sql);
    $pdoStatement->bindParam(":search",$test);
    $pdoStatement->bindParam(":hashtag",$hash);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    return $result;
        }
        catch( Exception $error) 
        {dump($error);}
        }



        /**
     * Get the value of id
     *
     * @return  self
     */ 
        public function getId()
        {
            return $this->id;
        }
    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getDate_ajout()
    {
        return $this->date_ajout;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 

    public function setDate_ajout(String $date_ajout)
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }
      /**
     * Get the value of name
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setTitle(int $title)
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setContent(int $content)
    {
        $this->content = $content;

        return $this;
    }
    public function getHashtag()
    {
        return $this->hashtag;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setHashtag(int $hashtag)
    {
        $this->hashtag = $hashtag;

        return $this;
    }
    public function getNumber_response()
    {
        return $this->number_response;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setNumber_response(int $number_response)
    {
        $this->number_response = $number_response;

        return $this;
    }
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

}
