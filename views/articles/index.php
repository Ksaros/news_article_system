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
            <title>Articles</title>
      </head>
      <body>
            <div class="container">

                  <div class="row">
                        <table class="table mt-5 col-12">
                              <thead>
                                    <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Tytuł</th>
                                          <th scope="col">Treść</th>
                                          <th scope="col">Data dodania</th>
                                    </tr>
                              </thead>
                              <tbody>
                              <?php foreach($dbManager->getAllArticles() as $article):?>

                                    <tr>
                                          <th scope="row"><?php echo $article['id_article'];?></th>
                                          <td><?php echo $article['title'];?></td>
                                          <td><?php echo $article['text'];?></td>
                                          <td><?php echo $article['date_add'];?></td>
                                    </tr>

                              <?php endforeach;?>
                              </tbody>
                        </table>
                  </div>
            </div>
      </body>
</html>