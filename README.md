# php
instruction
1. Install Visual Studio Code. The website is https://code.visualstudio.com/ 
2. Install PHP debug ,modify environment variables to build the PHP environment.
3. Install composer.The website is https://getcomposer.org/ 
4. Install mysql , log in with root in Workbench, password set to  root .Then create a database php_project_db, create tables under the database  user (id, nickname, emal, password) , list (list_id, title, comment, Shared, user_id) and  task (task_id, content, complete, list_id).
5. Open the folder PHPPROJECT and import the files.Right-click  phpProject  , open it in terminal mode, and enter the command   php artisan serve
6.Open file routes, open web.php, and view the url,.The login screen is 127.0.0.1:8000/user/login,The registration screen is 127.0.0.1:8000/user/register
