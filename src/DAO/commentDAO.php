<?php


namespace MyMovies\DAO;


use MyMovies\Domain\Comment;


class CommentDAO extends DAO 

{
 public function save(Comment $comment) {
        $commentData = array(
            'Cat_id' => $comment->getArticle()->getId(),
            
            'com_content' => $comment->getContent()
            );

        if ($comment->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('t_comment', $commentData, array('com_id' => $comment->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('t_comment', $commentData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $comment->setId($id);
        }
 }
    /**

     * @var \MyMovies\DAO\ArticleDAO

     */

    private $articleDAO;


    /**

     * @var \MyMovies\DAO\UserDAO

    


    /**

     * Return a list of all comments for an article, sorted by date (most recent last).

     *

     * @param integer $articleId The article id.

     *

     * @return array A list of all comments for the article.

     */

    public function findAllByArticle($articleId) {

        // The associated article is retrieved only once

        $article = $this->articleDAO->find($articleId);


        // Cat_id is not selected by the SQL query

        // The article won't be retrieved during domain objet construction

        $sql = "select com_id, com_content, usr_id from t_comment where Cat_id=? order by com_id";

        $result = $this->getDb()->fetchAll($sql, array($articleId));


        // Convert query result to an array of domain objects

        $comments = array();

        foreach ($result as $row) {

            $comId = $row['com_id'];

            $comment = $this->buildDomainObject($row);

            // The associated article is defined for the constructed comment

            $comment->setArticle($article);

            $comments[$comId] = $comment;

        }

        return $comments;

    }


    /**

     * Creates an Comment object based on a DB row.

     *

     * @param array $row The DB row containing Comment data.

     * @return \MyMovies\Domain\Comment

     */

    protected function buildDomainObject($row) {

        $comment = new Comment();

        $comment->setId($row['com_id']);

        $comment->setContent($row['com_content']);


        if (array_key_exists('Cat_id', $row)) {

            // Find and set the associated article

            $articleId = $row['Cat_id'];

            $article = $this->articleDAO->find($articleId);

            $comment->setArticle($article);

        }

    
        

        return $comment;
        
        

    }

}
