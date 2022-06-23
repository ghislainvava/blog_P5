<?php
namespace BlogOC\Database\Models;

class Comment
{
    public int $id_comment;
    public int $id_article;
    public string $date_commentaire;
    public string $commentaire;
    public int $author;
    public string $checked;
    public string $_id;//ajouter grace à la jointure
    public string $firstname;
    public string $lastname;
}
