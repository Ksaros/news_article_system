Struktura danych
      1. Jednostka wiadomości z co najmniej polami tytułu, tekstu i daty utworzenia.
      2. Jednostka autora wiadomości z co najmniej polem na nazwisko.
      3. Artykuły mogą mieć wielu autorów
Punkty końcowe API
      1. Pobierz artykuł od jakiegoś id
      2. Pobierz wszystkie artykuły dla danego autora
      3. Zdobądź 3 najlepszych autorów, którzy napisali najwięcej artykułów w zeszłym tygodniu.
Wymagania:
      1. Powinieneś dołączyć plik README ze wszystkim, co musimy wiedzieć, jak uruchomić i "używać" swojego projekt.
      2. Wszystkie niezbędne początkowe operacje na bazie danych (takie jak tworzenie tabel, wstawianie urządzeń itp.) powinny:
            w razie potrzeby zrobić w jednym pliku .sql
      3. Formularz HTML powinien umożliwiać przynajmniej dodawanie/edycję artykułów. Lista autorów może być zakodowana na sztywno do bazy danych.
Poradnik:
      1. Nie przemyśl tego! :)
      2. Żadne ramy nie są wymagane, ale możesz użyć jednego, jeśli masz na to ochotę.
      3. Zwróć uwagę na jakość kodu, formatowanie, konwencje itp.\

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