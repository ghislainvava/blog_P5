<?php
namespace BlogOC\Database\Models;

use PDOStatement;
use PDO;
use BlogOC\Database\Models\Article;

class ArticleDB
{
    private PDOStatement $statementCreateOne;
    private PDOStatement $statementUpdateOne;
    private PDOStatement $statementDeleteOne;
    private PDOStatement $statementReadOne;
    private PDOStatement $statementReadAll;
    private PDOStatement $statementReadUserAll;

    public function __construct(private PDO $pdo)
    {
        $this->statementCreateOne = $pdo->prepare('
      INSERT INTO article (
        title,
        image,
        content,
        author,
        chapo
      ) VALUES (   
        :title,
        :image,
        :content,
        :author,
        :chapo
      )
    ');
        
        $this->statementUpdateOne = $pdo->prepare('
      UPDATE article
      SET
        title=:title,
        content=:content,
        author=:author,
        date=:date,
        chapo=:chapo
      WHERE id=:id
    ');
        $this->statementReadOne = $pdo->prepare('SELECT article.*, user.firstname, user.lastname FROM article LEFT JOIN user ON article.author = user.id WHERE article.id=:id');
        $this->statementReadAll = $pdo->prepare('SELECT article.*, user.firstname, user.lastname FROM article LEFT JOIN user ON article.author = user.id');
        $this->statementDeleteOne = $pdo->prepare('DELETE FROM article WHERE id=:id');
        $this->statementReadUserAll = $pdo->prepare('SELECT * FROM article WHERE author=:authorId');
    }
    public function fetchAll(): array  //on type pour + de securité
    {
        $this->statementReadAll->execute();
        $this->statementReadAll->setFetchMode(PDO::FETCH_CLASS, Article::class);
        return $this->statementReadAll->fetchAll();
    }
    public function fetchOne(string $_id): Article
    {
        $this->statementReadOne->bindValue(':id', $_id);
        $this->statementReadOne->execute();
        $this->statementReadOne->setFetchMode(PDO::FETCH_CLASS, Article::class);
        return $this->statementReadOne->fetch();
    }
    public function deleteOne(string $_id): string
    {
        $this->statementDeleteOne->bindValue(':id', $_id);
        $this->statementDeleteOne->execute();
        return $_id;
    }
    public function createOne($article): Article
    {
        $this->statementCreateOne->bindValue(':title', $article['title']);
        $this->statementCreateOne->bindValue(':content', $article['content']);
        $this->statementCreateOne->bindValue(':author', $article['author']);
        $this->statementCreateOne->bindValue(':image', $article['image']);
        $this->statementCreateOne->bindValue(':chapo', $article['chapo']);
        $this->statementCreateOne->execute();
        return $this->fetchOne($this->pdo->lastInsertId());
    }
    public function updateOne($article): Article
    {
        $date = date('d-m-y h:i:s');
        $this->statementUpdateOne->bindValue(':title', $article->title);
        $this->statementUpdateOne->bindValue(':content', $article->content);
        $this->statementUpdateOne->bindValue(':author', $article->author);
        $this->statementUpdateOne->bindValue(':date', $date);
        $this->statementUpdateOne->bindValue(':chapo', $article->chapo);
        $this->statementUpdateOne->bindValue(':id', $article->id);
        $this->statementUpdateOne->execute();
        return $article;
    }
    public function fetchUserArticle($authorId): array
    {
        $this->statementReadUserAll->bindValue(":authorId", $authorId);
        $this->statementReadUserAll->execute();
        return $this->statementReadUserAll->fetchAll();
    }
}
