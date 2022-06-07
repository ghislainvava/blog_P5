<?php
namespace BlogOC\Database\models;

use PDOStatement;
use PDO;

class CommentDB
{
  private PDOStatement $statementCreateOne;
  private PDOStatement $statementUpdateOne;
  private PDOStatement $statementDeleteOne;
  private PDOStatement $statementReadOne;
  private PDOStatement $statementReadAll;
  private PDOStatement $statementReadUserAll;

  function __construct(private PDO $pdo)
  {
    $this->statementCreateOne = $pdo->prepare('INSERT INTO comment VALUES (
      DEFAULT,
      :id_article,
      DEFAULT,
      :commentaire,
      :author
    )');
    $this->statementUpdateOne = $pdo->prepare('
      UPDATE article
      SET
        id_article=:id_article,
        commentaire=:commentaire,
        author=:author
      WHERE id_comment=:id_comment
    ');
    $this->statementReadOne = $pdo->prepare('SELECT comment.id_comment,comment.date_commentaire, comment.author, article.id fROM comment LEFT JOIN  article on comment.id_article = article.id WHERE comment.id_article=:id');
    $this->statementReadAll = $pdo->prepare('SELECT comment.date_commentaire, comment.author, comment.commentaire FROM comment LEFT JOIN article ON comment.id_article = article.id WHERE comment.id_article =:id ');
    $this->statementDeleteOne = $pdo->prepare('DELETE FROM Comment WHERE id=:id');
    $this->statementReadUserAll = $pdo->prepare('SELECT * FROM Comment WHERE author=:authorId'); //a voir pb

  }
  public function fetchArticles(string $id) :array //on type pour + de securité
  {
    $this->statementReadAll->bindValue(':id', $id);
    $this->statementReadAll->execute();
    return $this->statementReadAll->fetchAll();
  }
  public function fetchOne(string $id) : array
  {
    $this->statementReadOne->bindValue(':id_article', $id);
    $this->statementReadOne->execute();
    return $this->statementReadOne->fetch();
  }
  public function deleteOne(string $id): string
  {
    $this->statementDeleteOne->bindValue(':id', $id);
    $this->statementDeleteOne->execute();
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
  public function updateOne($article): array
  {
    $this->statementUpdateOne->bindValue(':title', $article['title']);
    $this->statementUpdateOne->bindValue(':content', $article['content']);
    $this->statementUpdateOne->bindValue(':author', $article['author']);
    $this->statementUpdateOne->bindValue(':image', $article['image']);
    $this->statementUpdateOne->bindValue(':id', $article['id']);
    $this->statementUpdateOne->execute();
    return $article;
  }
  public function fetchUserArticle($authorId) :array
  {
    $this->statementReadUserAll->bindValue(":authorId", $authorId);
    $this->statementReadUserAll->execute();
    return $this->statementReadUserAll->fetchAll();
  }
}
