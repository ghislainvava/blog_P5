<?php
namespace BlogOC\Database\Models;

class Article
{
    public string $title;
    public string $image;
    public string $content;
    public int $author;
    public string $date;
    public string $chapo;
    public string $firstname;
    public string $lastname;//ajouter grace à la jointure
}
