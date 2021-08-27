<?php

class DataBaseManager {

      private $database_host;
      private $database_name;
      private $database_user;
      private $database_password;

      public function __construct($config) {

            $this->database_host = $config['database_host'];
            $this->database_name = $config['database_name'];
            $this->database_user = $config['database_user'];
            $this->database_password = $config['database_password'];
      }

      public function getAllAuthors() {

            $sql = 'SELECT id_author, firstname, lastname FROM authors';

            return $this->getQueryData($sql);
      }

      public function getAllArticles() {

            $sql = 'SELECT id_article, title, `text`, date_add FROM articles';

            return $this->getQueryData($sql);
      }

      public function getArticleAuthors($id_article) {

            $sql = 'SELECT id_author FROM article_authors WHERE id_article ='. $id_article;

            return $this->getQueryData($sql);
      }

      public function isArticleAuthors($id_article, $id_author) {

            $sql = 'SELECT id_article_author
                  FROM article_authors
                  WHERE id_article = '. $id_article .'
                  AND id_author = '. $id_author;

            return $this->getQueryData($sql);
      }

      public function getArticleById($id_article) {

            $sql = 'SELECT title, `text`, date_add FROM articles WHERE id_article ='. $id_article;

            return $this->getQueryData($sql);
      }

      public function getAuthorsByArticleId($id_article) {

            $sql = 'SELECT b.`firstname`, b.`lastname`, a.`date_upd`
                  FROM article_authors a
                  LEFT JOIN authors b
                  ON(a.`id_author` = b.`id_author`)
                  WHERE a.`id_article` = '. $id_article;

            return $this->getQueryData($sql);
      }

      public function createArticle($title, $content, $authors) {

            $sql = 'INSERT INTO articles (`title`, `text`, `date_add`) VALUES(?, ?, ?)';
            $id_article = $this->setQueryData($sql, [$title, $content, date('Y-m-d H:i:s')]);
            $res = true;

            if(($res &= (bool)$id_article)) {

                  foreach($authors as $id_author) {

                        $sql = 'INSERT INTO article_authors (id_article, id_author, date_upd) VALUES(?,?,?)';

                        $res &= (bool)$this->setQueryData($sql, [$id_article, $id_author, date('Y-m-d H:i:s')]);
                  }
            }

            return $res;
      }

      public function modifyArticle($id_article, $title, $content, $authors) {

            $sql = 'UPDATE articles SET title = ?, `text` = ? WHERE id_article = '. $id_article;
            $this->setQueryData($sql, [$title, $content]);
            $res = true;

            if(($res &= (bool)$id_article)) {

                  $sql = 'DELETE FROM `article_authors` WHERE id_article = ?';
                  $this->setQueryData($sql, [$id_article]);

                  foreach($authors as $id_author) {

                        $sql = 'INSERT INTO article_authors (id_article, id_author, date_upd) VALUES(?,?,?)';
                        $res &= (bool)$this->setQueryData($sql, [$id_article, $id_author, date('Y-m-d H:i:s')]);
                  }
            }

            return $res;
      }

      protected function getQueryData(string $query, array $data = []) {

            $request = $this->connectDB()->prepare($query);
            $request->execute($data);
            $res = $request->fetchAll();

            $request = null;

            return $res;
      }

      protected function setQueryData(string $query, array $data = []) {

            $request = $this->connectDB();
            $request->prepare($query)->execute($data);
            $res = $request;

            if($res)
                  $res = $request->lastInsertId();
            $request = null;

            return $res;
      }

      protected function connectDB() {

            $pdo = new PDO(
                  'mysql:host='. $this->database_host .';dbname='. $this->database_name,
                  $this->database_user,
                  $this->database_password,
            );

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
      }
}