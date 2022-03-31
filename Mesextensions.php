<?php
// class MesExtensions extends Twig\Extension\AbstractExtension {

//     public function getFilters() {
//         return [
//             new Twig\TwigFilter('markdown', [$this, 'markdownParse'])
//         ];
//     }


//     public function markdownParse($value) {

//         // return \Michelf\MarkdownEtra::defaultTransform($value);
//     }

// }


function isLoggedIn()
{
  require_once 'Database.php';
  $sessionId = $_COOKIE['session'] ?? '';
  if ($sessionId) {
    $sessionUserStatement = $pdo->prepare('SELECT * FROM session JOIN user on user.id=session.userid WHERE session.id=?');
    $sessionUserStatement->execute([$sessionId]);
    $user = $sessionUserStatement->fetch();
  }

  return $user ?? false;
}