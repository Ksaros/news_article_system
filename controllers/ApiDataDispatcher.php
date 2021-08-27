<?php

require_once dirname(__FILE__). "\DataBaseManager.php";

class ApiDataDispatcher {

      public static function getArticleById($id_article) {

            $dbManager = new DataBaseManager(_DB_CONFIG_);
            $article = $dbManager->getArticleById($id_article);
            if($article) {

                  $article = $article[0];
                  $article['authors'] = $dbManager->getAuthorsByArticleId($id_article);

                  return json_encode($article);
            }

            return false;
      }

      public static function getAuthorArticles($id_author) {

            $dbManager = new DataBaseManager(_DB_CONFIG_);
            $author = $dbManager->getAuthorById($id_author);

            if($author) {

                  $author = $author[0];
                  $author['articles'] = $dbManager->getAuthorArticles($id_author);;

                  return json_encode($author);
            }

            return false;
      }
}