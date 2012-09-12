I have been playing around with Laravel for the past 2 months and recently developed a complete CMS that includes various features such as

1.  Article Mgt
2. Tag Mgt
3. Comment Mgt
4. Category & Sub Category Mgt
5. Visitor Stats
6. SEO Friendly
7. User Management (Admin/Moderator/Author)
8. Highlight Important Articles

and much more..

Requirements
    PHP 5.3+
    MYSQL 5.5+ (InnoDB)
    Apache 2.2

Before I create a official "Bundle" of it, I would like you guys to test it out and post your feedback/comments or any changes that should be made

Installation Details: 

Installation Details: 
Now on github, https://github.com/akashbedi/PHP-CMS
1. Copy all content of this(code) directly under public_html/phpcms folder of Apache
2. Map Document root to the directory of this folder (in Apache's httpd.conf file):
    eg: DocumentRoot "C:/public_html/phpcms"
3. Import the provided database.sql file within mysql
4. Edit current_directory/application/config/database.php and make the changes, (DBNAME, DBUSRE, DBPASSWORD)
5. Visit http://localhost and view a few demo Articles

Other NOTEs: The database name should be "cms", also make sure you use the right port, I have changed it to 3307 from the default of 3306 for Mysql

Also make sure Tidy extension is enabled, open php.ini configuration file and change

;extension=php_tidy.dll 

to 

extension=php_tidy.dll 

Admin can log in via http://localhost/admin
Credentials : 
#### Username: admin

#### Password: admin

Feel free to contrinue and post your feedback