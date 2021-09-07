<?php

/**
 * odblokowanie zabezpieczenia CORS dla wszystkich domen
 */
header("Access-Control-Allow-Origin: *");

if (
      isset($_GET['art_id']) ||
      isset($_GET['author_id']) ||
      isset($_GET['get_best_authors'])
) {

      require_once dirname(__DIR__). "/controllers/ApiDataDispatcher.php";
}
else {

      http_response_code(406);
      return false;
}

if (isset($_GET['art_id']) && $_GET['art_id'] > 0) {

      $data = ApiDataDispatcher::getArticleById($_GET['art_id']);

      if($data) {

            // set response code - 200 OK
            http_response_code(200);

            echo $data;
      }

      http_response_code(406);
      return;
}
elseif(isset($_GET['author_id']) && $_GET['author_id']) {

      $data = ApiDataDispatcher::getAuthorArticles($_GET['author_id']);

      if($data) {

            // set response code - 200 OK
            http_response_code(200);

            echo $data;
      }

      http_response_code(406);
      return;
}
elseif(isset($_GET['get_best_authors'])) {

      $data = ApiDataDispatcher::getBestAuthorsWithArticles();

      if($data) {

            // set response code - 200 OK
            http_response_code(200);

            echo $data;
      }

      http_response_code(406);
      return;
}
else {

      http_response_code(406);
      return;
}