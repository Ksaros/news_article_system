<?php

/**
 * Class with methods to manage database
 */
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

            $sql = 'SELECT id_author FROM article_authors WHERE id_article = ?';

            return $this->getQueryData($sql, [$id_article]);
      }

      public function isArticleAuthors($id_article, $id_author) {

            $sql = 'SELECT id_article_author
                  FROM article_authors
                  WHERE id_article = ?
                  AND id_author = ?'
            ;

            return $this->getQueryData($sql, [$id_article, $id_author]);
      }

      public function getArticleById($id_article) {

            $sql = 'SELECT title, `text`, date_add FROM articles WHERE id_article = ?';

            return $this->getQueryData($sql, [$id_article]);
      }

      public function getAuthorById($id_author) {

            $sql = 'SELECT firstname, lastname FROM authors WHERE id_author = ?';

            return $this->getQueryData($sql, [$id_author]);
      }

      public function getAuthorsByArticleId($id_article) {

            $sql = 'SELECT b.`firstname`, b.`lastname`, a.`date_upd`
                  FROM article_authors a
                  LEFT JOIN authors b
                  ON(a.`id_author` = b.`id_author`)
                  WHERE a.`id_article` = ?';

            return $this->getQueryData($sql, [$id_article]);
      }

      public function getAuthorArticles($id_author) {

            $sql = 'SELECT a.`title`, a.`text`, b.`date_upd`
            FROM articles a
            LEFT JOIN article_authors b
            ON(a.`id_article` = b.`id_article`)
            WHERE b.`id_author` = ?';

            return $this->getQueryData($sql, [$id_author]);
      }

      public function getBestAuthorsWithArticles() {

            $sql = 'SELECT COUNT(b.`id_article`) as articles_count, a.`id_author`
                  FROM `article_authors` a
                  LEFT JOIN articles b
                        ON(a.`id_article` = b.`id_article`)
                  WHERE date_upd
                        BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY)
                        AND NOW()
                  GROUP BY a.`id_author`
                  ORDER BY articles_count DESC
                  LIMIT 3'
            ;

            $authors = array();

            foreach($this->getQueryData($sql) as $key => $author) {

                  $authors[$key] = $this->getAuthorById($author['id_author'])[0];
                  $authors[$key]['articles'] = $this->getAuthorArticles($author['id_author']);
            }

            return $authors;
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

            $sql = 'UPDATE articles SET title = ?, `text` = ? WHERE id_article = ?';
            $this->setQueryData($sql, [$title, $content, $id_article]);
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

      public function addAuthor($firstname, $lastname) {

            $sql = 'INSERT INTO authors (`firstname`, `lastname`) VALUES(?, ?)';
            $id_author = $this->setQueryData($sql, [$firstname, $lastname]);
            $res = true;

            $res &= (bool)$id_author;

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