<?php

require_once dirname(__FILE__) .'/include.php';

$request_uri = explode('/', $_SERVER['REQUEST_URI']);

if($request_uri[1] == basename(__DIR__)) {

      define('__BASE_URI__', '/'. basename(__DIR__));

      if($request_uri[2] == "modify") {

            include dirname(__FILE__). '/views/modify/index.php';
      }
      elseif($request_uri[2] == "add_article") {

            if($dbManager->createArticle($_POST['title'], $_POST['content'], $_POST['authors']))
                  header('Location: '. __BASE_URI__ .'/modify/?article_add_success=1');
            else
                  header('Location: '. __BASE_URI__ .'/modify/?article_add_success=0');
      }
      elseif($request_uri[2] == "modify_article") {

            if($dbManager->modifyArticle($_POST['submitModifyArticle'], $_POST['title'], $_POST['content'], $_POST['authors']))
                  header('Location: '. __BASE_URI__ .'/modify/?article_modify_success=1');
            else
                  header('Location: '. __BASE_URI__ .'/modify/?article_modify_success=0');
      }
      elseif($request_uri[2] == "get_articles") {

            include dirname(__FILE__). '/api/index.php';
      }
      else {

            include dirname(__FILE__). '/views/articles/index.php';
      }
}
else {

      define('__BASE_URI__', '/');

      if($request_uri[1] == "modify") {

            include dirname(__FILE__). '/views/modify/index.php';
      }
      elseif($request_uri[1] == "add_article") {

            if($dbManager->createArticle($_POST['title'], $_POST['content'], $_POST['authors']))
                  header('Location: '. __BASE_URI__ .'/modify/?article_add_success=1');
            else
                  header('Location: '. __BASE_URI__ .'/modify/?article_add_success=0');
      }
      elseif($request_uri[1] == "modify_article") {

            if($dbManager->modifyArticle($_POST['submitModifyArticle'], $_POST['title'], $_POST['content'], $_POST['authors']))
                  header('Location: '. __BASE_URI__ .'/modify/?article_modify_success=1');
            else
                  header('Location: '. __BASE_URI__ .'/modify/?article_modify_success=0');
      }
      else {

            include dirname(__FILE__). '/views/articles/index.php';
      }

      include dirname(__FILE__). '/views/articles/index.php';
}