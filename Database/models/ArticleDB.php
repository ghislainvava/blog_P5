
<?php

require './Database/security.php';
require './Database/Database.php';

class ArticleDB
{
  private PDOStatement $statementCreateOne;
  private PDOStatement $statementUpdateOne;
  private PDOStatement $statementDeleteOne;
  private PDOStatement $statementReadOne;
  private PDOStatement $statementReadAll;


  function __construct(private PDO $pdo)
  {
    $this->statementCreateOne = $pdo->prepare('
      INSERT INTO article (
        title,
        author,
        content,
        image
      ) VALUES (
        :title,
        :author,
        :content,
        :image
      )
    ');
    $this->statementUpdateOne = $pdo->prepare('
      UPDATE article
      SET
        title=:title,
        author=:author,
        content=:content,
        image=:image
      WHERE id=:id
    ');
    $this->statementReadOne = $pdo->prepare('SELECT * FROM article WHERE id=:id');
    $this->statementReadAll = $pdo->prepare('SELECT * FROM article');
    $this->statementDeleteOne = $pdo->prepare('DELETE FROM article WHERE id=:id');
  }


  public function fetchAll()
  {
    $this->statementReadAll->execute();
    return $this->statementReadAll->fetchAll();
  }

  public function fetchOne(string $id)
  {
    $this->statementReadOne->bindValue(':id', $id);
    $this->statementReadOne->execute();
    return $this->statementReadOne->fetch();
  }

  public function deleteOne(string $id)
  {
    $this->statementDeleteOne->bindValue(':id', $id);
    $this->statementDeleteOne->execute();
    return $id;
  }

  public function createOne($article)
  {
    $this->statementCreateOne->bindValue(':title', $article['title']);
    $this->statementCreateOne->bindValue(':content', $article['content']);
    $this->statementCreateOne->bindValue(':author', $article['author']);
    $this->statementCreateOne->bindValue(':image', $article['image']);
    $this->statementCreateOne->execute();
    return $this->fetchOne($this->pdo->lastInsertId());
  }

  public function updateOne($article)
  {
    $this->statementUpdateOne->bindValue(':title', $article['title']);
    $this->statementUpdateOne->bindValue(':content', $article['content']);
    $this->statementUpdateOne->bindValue(':author', $article['author']);
    $this->statementUpdateOne->bindValue(':image', $article['image']);
    $this->statementUpdateOne->bindValue(':id', $article['id']);
    $this->statementUpdateOne->execute();
    return $article;
  }
}


return new ArticleDB($pdo);