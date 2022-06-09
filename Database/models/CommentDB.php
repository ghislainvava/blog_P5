<?php
namespace BlogOC\Database\models;

use PDOStatement;
use PDO;

class CommentDB
{
  private PDOStatement $statementCreateOne;
  private PDOStatement $statementChecked;
  private PDOStatement $statementDelete;
  private PDOStatement $statementReadOne;
  private PDOStatement $statementReadAll;
  private PDOStatement $statementReadUserAll;
  private PDOStatement $statementReadAllComment;

  function __construct(private PDO $pdo)
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
    $this->statementReadAllComment = $pdo->prepare('SELECT comment.date_commentaire, comment.id_comment, comment.author, comment.commentaire, comment.checked FROM comment LEFT JOIN article ON comment.id_article = article.id');
    $this->statementReadAll = $pdo->prepare('SELECT comment.date_commentaire, comment.id_comment, comment.author, comment.commentaire, comment.checked FROM comment LEFT JOIN article ON comment.id_article = article.id WHERE comment.id_article =:id ');
    $this->statementDelete = $pdo->prepare('DELETE FROM Comment WHERE id_comment=:id');
   

  }
  public function fetchComments(string $id) :array //on type pour + de securité
  {
    $this->statementReadAll->bindValue(':id', $id);
    $this->statementReadAll->execute();
    return $this->statementReadAll->fetchAll();
  }
  public function fetchAllComments($commentDB) :array //on type pour + de securité
  {
    $this->statementReadAllComment->execute();
    return $this->statementReadAllComment->fetchAll();
  }
  public function fetchOne(string $id) : array
  {
    $this->statementReadOne->bindValue(':id_article', $id);
    $this->statementReadOne->execute();
    return $this->statementReadOne->fetch();
  }
  // public function fetchOneArticle(string $id) : array
  // {
  //   $this->statementReadOneComment->bindValue(':id_comment', $id);
  //   $this->statementReadOneComment->execute();
  //   return $this->statementReadOneComment->fetch();
  // }
  public function delete(string $id): string
  {
    $this->statementDelete->bindValue(':id', $id);
    $this->statementDelete->execute();
    return $id;
  }
  public function createOne($comment): array
  {
    $this->statementCreateOne->bindValue(':id_article', $comment['id_article']);
    $this->statementCreateOne->bindValue(':commentaire', $comment['commentaire']);
    $this->statementCreateOne->bindValue(':author', $comment['author']);
    $this->statementCreateOne->execute();
    return $comment;
  }
  public function checked(string $id): string
  {
    $this->statementChecked->bindValue(':id_comment', $id);
    $this->statementChecked->execute();
    return $id;
  }
 
}
