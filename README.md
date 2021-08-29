Kacper Głodowski News Article System

PL
Uruchomienie:

      1. Należy stworzyć bazę danych na lokalnym serwerze
      i zaimportować do niej plik "news_article_system.sql" znajdujący się w folderze config.

      2. W folderze config w pliku "db_config.php" należy podać dane logowania do bazy danych.

Używanie programu:

      1. Aby modyfikować/dodawać artykuły oraz dodawać autorów, wystarczy wejść w podstronę "/modify".
      2. API:
            a. Pobieranie artykułu przez podanie id - należy wejść na podstronę "get_articles"
            wraz z podaniem parametru art_id np. /get_articles/?art_id=1
            b. Pobieranie wszystkich artykułów danego autora - należy wejść na podstronę "get_articles"
            wraz z podaniem parametru author_id np. /get_articles/?author_id=1
            c. Zdobądź 3 najlepszych autorów, którzy napisali najwięcej artykułów w zeszłym tygodniu - należy wejść na podstronę "get_articles"
            wraz z podaniem parametru get_best_authors np. /get_articles/?get_best_authors

            Jeżeli nie będzie danych do wyświetlenia serwer zwróci błąd 406.

      3. Wejście na stronę bez podania podstrony spowoduje wyświetlenie listy istniejących artykułów.

EN
Activation:

      1. Create a database on a local server
      and import the "news_article_system.sql" file in the config folder into it.

      2. In the config folder, in the "db_config.php" file, you should provide the database login details.

Using the program:

      1. To modify / add articles and add authors, just go to the "/ modify" subpage.
      2. API:
            a. Downloading the article by specifying id - go to the "get_articles" subpage
            with an art_id parameter, e.g. / get_articles /? art_id = 1
            b. Downloading all articles by a given author - go to the "get_articles" subpage
            together with the author_id parameter, e.g. / get_articles /? author_id = 1
            c. Get the top 3 authors who wrote the most articles last week - go to the "get_articles" subpage
            with a get_best_authors parameter, e.g. / get_articles /? get_best_authors

            If there is no data to display, the server will return a 406 error.

      3. Entering the website without specifying a subpage will display a list of existing articles.