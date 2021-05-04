# BrightRedForum
an image board reddit crossover 
Currently needs a test database 
Currenlty needs a Threads table 

MariaDB [test]> describe Threads ; 
+-------------+-----------------+------+-----+---------------------+-------------------------------+
| Field       | Type            | Null | Key | Default             | Extra                         |
+-------------+-----------------+------+-----+---------------------+-------------------------------+
| id          | int(6) unsigned | NO   | PRI | NULL                | auto_increment                |
| Title       | varchar(30)     | NO   |     | NULL                |                               |
| Users       | varchar(50)     | YES  |     | NULL                |                               |
| Thread_date | timestamp       | NO   |     | current_timestamp() | on update current_timestamp() |
| ThreadBody  | varchar(5000)   | YES  |     | NULL                |                               |
| filename    | varchar(50)     | YES  |     | NULL                |                               |
| lastid      | int(11)         | YES  |     | NULL                |                               |
| thumbnail   | varchar(100)    | YES  |     | NULL                |                               |
| downvotes   | varchar(30)     | YES  |     | NULL                |                               |
| url         | varchar(150)    | YES  |     | NULL                |                               |
+-------------+-----------------+------+-----+---------------------+-------------------------------+
10 rows in set (0.002 sec)

and a Posts table 
MariaDB [test]> describe Posts;
+---------------+-----------------+------+-----+---------------------+-------------------------------+
| Field         | Type            | Null | Key | Default             | Extra                         |
+---------------+-----------------+------+-----+---------------------+-------------------------------+
| id            | int(6) unsigned | NO   | PRI | NULL                | auto_increment                |
| User          | varchar(30)     | NO   |     | NULL                |                               |
| PostTimeStamp | timestamp       | NO   |     | current_timestamp() | on update current_timestamp() |
| CommentText   | varchar(8000)   | YES  |     | NULL                |                               |
| IDOfThread    | int(11)         | YES  |     | NULL                |                               |
| Upvotes       | int(11)         | NO   |     | 0                   |                               |
| ParentId      | int(11)         | YES  |     | NULL                |                               |
+---------------+-----------------+------+-----+---------------------+-------------------------------+
7 rows in set (0.001 sec)
