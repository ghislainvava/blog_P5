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
    public string $id;//ajouter grace à la jointure
}
