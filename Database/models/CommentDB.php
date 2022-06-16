<?php
namespace BlogOC\Database\models;

use PDOStatement;
use PDO;

use BlogOC\Database\models\Comment;

class CommentDB
{
    private PDOStatement $statementCreateOne;
    private PDOStatement $statementChecked;
    private PDOStatement $statementDelete;
    private PDOStatement $statementReadOne;
    private PDOStatement $statementReadAll;
    private PDOStatement $statementAllComment;

    public function __construct(private PDO $pdo)
    {
        $this->statementCreateOne = $pdo->prepare('INSERT INTO comment VALUES (
      DEFAULT,
      :id_article,
      DEFAULT,
      :commentaire,
      :author,
      DEFAULT
    )');
        $this->statementChecked = $pdo->prepare(
            'UPDATE Comment
      SET
      checked=1
      WHERE id_comment=:id_comment'
        );
        $this->statementReadOne = $pdo->prepare('SELECT comment.id_comment,comment.date_commentaire, comment.author, article.id fROM comment LEFT JOIN  article on comment.id_article = article.id WHERE comment.id_article=:id');
        $this->statementReadOneComment = $pdo->prepare('SELECT comment.id_comment,comment.date_commentaire, comment.author, article.id fROM comment LEFT JOIN  article on comment.id_article = article.id WHERE comment.id_comment=:id');
        $this->statementReadAll = $pdo->prepare('SELECT comment.date_commentaire, comment.id_comment, comment.author, comment.commentaire, comment.checked FROM comment LEFT JOIN article ON comment.id_article = article.id WHERE comment.id_article =:id ');
        $this->statementDelete = $pdo->prepare('DELETE FROM Comment WHERE id_comment=:id');
    }
    public function fetchComments(string $_id) :array //on type pour + de securité
    {
        $this->statementReadAll->bindValue(':id', $_id);
        $this->statementReadAll->execute();
        $this->statementReadAll->setFetchMode(PDO::FETCH_CLASS, Comment::class);
        return $this->statementReadAll->fetchAll();
    }
   
    public function fetchOne(string $_id) : Comment
    {
        $this->statementReadOne->bindValue(':id_article', $_id);
        $this->statementReadOne->execute();
        $this->statementReadOne->setFetchMode(PDO::FETCH_CLASS, Comment::class);
        return $this->statementReadOne->fetch();
    }
   
    public function delete(string $_id): string
    {
        $this->statementDelete->bindValue(':id', $_id);
        $this->statementDelete->execute();
        return $_id;
    }
    public function createOne($comment): array
    {
        $this->statementCreateOne->bindValue(':id_article', $comment['id_article']);
        $this->statementCreateOne->bindValue(':commentaire', $comment['commentaire']);
        $this->statementCreateOne->bindValue(':author', $comment['author']);
        $this->statementCreateOne->execute();
        return $comment;
    }
    public function checked(string $_id): string
    {
        $this->statementChecked->bindValue(':id_comment', $_id);
        $this->statementChecked->execute();
        return $_id;
    }
}
