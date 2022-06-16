<?php
namespace BlogOC\Database\models;

class Article
{
    public int $_id;
    public string $title;
    public string $image;
    public string $content;
    public int $author;
    public string $date;
    public string $chapo;
    public string $firstname;
    public string $lastname;//ajouter grace à la jointure
}
