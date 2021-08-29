<!DOCTYPE html>
<html lang="pl">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
      >
      <title>Articles modifier</title>
</head>
<body>
<div class="container">

      <article id="notifications" class="row">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </symbol>
                  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                  </symbol>
                  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </symbol>
            </svg>

            <div class="col-12 mt-2">

            <?php if(
                  (isset($_GET['article_add_success']) && $_GET['article_add_success']) ||
                  (isset($_GET['article_modify_success']) && $_GET['article_modify_success']) ||
                  (isset($_GET['author_add_success']) && $_GET['author_add_success'])
            ):?>
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg
                              class="bi flex-shrink-0 me-2"
                              width="24"
                              height="24"
                              role="img"
                              aria-label="Success:"
                        >
                              <use xlink:href="#check-circle-fill"/>
                        </svg>
                        <span>
                              <?php
                              if(isset($_GET['article_add_success']) && $_GET['article_add_success'])
                                    echo 'Dodawanie artykułu powiodło się';
                              elseif(isset($_GET['article_modify_success']) && $_GET['article_modify_success'])
                                    echo 'Modyfikacja artykułu powiodła się';
                              elseif(isset($_GET['author_add_success']) && $_GET['author_add_success'])
                                    echo 'Dodano nowego autora';
                              ?>
                        </span>
                  </div>
            <?php elseif(
                  (isset($_GET['article_add_success']) && !$_GET['article_add_success']) ||
                  (isset($_GET['article_modify_success']) && !$_GET['article_modify_success']) ||
                  (isset($_GET['author_add_success']) && !$_GET['author_add_success'])
            ): ?>

                  <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg
                              class="bi flex-shrink-0 me-2"
                              width="24"
                              height="24"
                              role="img"
                              aria-label="Warning:"
                        >
                              <use xlink:href="#exclamation-triangle-fill"/>
                        </svg>
                        <span>

                              <?php
                              if(isset($_GET['article_add_success']) && !$_GET['article_add_success'])
                                    echo 'Dodawanie artykułu nie powiodło się';
                              elseif(isset($_GET['article_modify_success']) && !$_GET['article_modify_success'])
                                    echo 'Modyfikacja artykułu nie powiodła się';
                              elseif(isset($_GET['author_add_success']) && !$_GET['author_add_success'])
                                    echo 'Dodawanie nowego autora zakończyło się niepowodzeniem';
                              ?>
                        </span>
                  </div>

            <?php endif; ?>

            </div>
      </article>

      <form action="<?php echo __BASE_URI__;?>/add_article" class="row g-3 mb-5" method="post">

            <div class="form-group col-12">
                  <label class="control-label">
                        Tytuł artykułu
                  </label>
                  <div class="input-group">
                        <input type="text" name="title" id="title" class="form-control" required>
                  </div>
            </div>

            <div class="form-group col-12">
                  <label class="control-label">
                        Treść artykułu
                  </label>
                  <div class="input-group">
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10" required></textarea>
                  </div>
            </div>

            <div class="form-group col-md-6">
                  <label class="control-label">
                        Wybierz autora/autorów
                  </label>
                  <div class="input-group">
                        <select
                              name="authors[]"
                              id="authors"
                              class="form-control"
                              cols="30"
                              rows="10"
                              multiple
                              required
                              aria-label="multiple select"
                        >
                              <?php foreach($dbManager->getAllAuthors() as $author):?>
                                    <option value="<?php echo $author['id_author'];?>"><?php echo $author['firstname'] .' '. $author['lastname'];?></option>
                              <?php endforeach;?>
                        </select>
                  </div>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                  <button type="submit" class="btn btn-primary">Dodaj artykuł</button>
            </div>
      </form>

      <form action="<?php echo __BASE_URI__;?>/add_author" class="row g-3 mb-5" method="post">

            <div class="form-group col-4">
                  <label class="control-label">
                        Imię
                  </label>
                  <div class="input-group">
                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                  </div>
            </div>

            <div class="form-group col-4">
                  <label class="control-label">
                        Nazwisko
                  </label>
                  <div class="input-group">
                        <input type="text" name="lastname" id="lastname" class="form-control" required>
                  </div>
            </div>

            <div class="col-md-4 d-flex align-items-end justify-content-left">
                  <button type="submit" class="btn btn-primary">Dodaj autora</button>
            </div>
      </form>

      <div class="row">
      <table class="table mt-5 col-12">
            <thead>
            <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tytuł</th>
                  <th scope="col">Treść</th>
                  <th scope="col">Data dodania</th>
                  <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($dbManager->getAllArticles() as $article):?>

                  <tr>
                        <th scope="row"><?php echo $article['id_article'];?></th>
                        <td><?php echo $article['title'];?></td>
                        <td><?php echo $article['text'];?></td>
                        <td><?php echo $article['date_add'];?></td>
                        <td><a class="btn btn-primary modify-button" data-form_id="<?php echo $article['id_article'];?>">Modyfikuj</a></td>
                  </tr>

                  <tr id='form_modify_<?php echo $article['id_article'];?>' style="display:none;">
                  <td colspan="5">
            <form action="<?php echo __BASE_URI__;?>/modify_article" class="row g-3" method="post">

                  <div class="form-group col-12">
                        <label class="control-label">
                              Tytuł artykułu
                        </label>
                        <div class="input-group">
                              <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-control"
                                    value="<?php echo $article['title'];?>"
                                    required
                              />
                        </div>
                  </div>

                  <div class="form-group col-12">
                        <label class="control-label">
                              Treść artykułu
                        </label>
                        <div class="input-group">
                              <textarea
                                    name="content"
                                    id="content"
                                    class="form-control"
                                    cols="30"
                                    rows="10"
                                    required
                              ><?php echo $article['text'];?></textarea>
                        </div>
                  </div>

                  <div class="form-group col-md-6">
                        <label class="control-label">
                              Wybierz autora/autorów
                        </label>
                        <div class="input-group">

                              <select
                                    name="authors[]"
                                    id="authors"
                                    class="form-control"
                                    cols="30"
                                    rows="10"
                                    multiple
                                    required
                                    aria-label="multiple select"
                              >
                                    <?php foreach($dbManager->getAllAuthors() as $author):?>
                                          <option
                                                value="<?php echo $author['id_author'];?>"
                                                <?php
                                                      $find = array_column(
                                                            $dbManager->getArticleAuthors($article['id_article']),
                                                            'id_author'
                                                      );

                                                      $find = array_search(
                                                            $author['id_author'],
                                                            $find
                                                      );

                                                if(gettype($find) == 'integer'):?>
                                                selected
                                                <?php endif;?>
                                          >
                                                <?php echo $author['firstname'] .' '. $author['lastname'];?>
                                          </option>
                                    <?php endforeach;?>
                              </select>

                        </div>
                  </div>

                  <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <button
                              type="submit"
                              name="submitModifyArticle"
                              value="<?php echo $article['id_article'];?>"
                              class="btn btn-primary"
                        >
                              Modyfikuj artykuł
                        </button>
                  </div>
            </form>
                  </td>
                  </tr>

            <?php endforeach;?>
            </tbody>
      </table>
      </div>
</div>

<script>

      document.querySelectorAll('.modify-button').forEach((elem) => {

            console.log(elem);
            elem.addEventListener('click', (event) => {

                  event.preventDefault();

                  let form = document.getElementById('form_modify_'+ elem.dataset.form_id);

                  if(form.style.display == "none")
                        form.style.display = "table-row";
                  else
                        form.style.display = "none";
            });
      });

</script>

</body>
</html>