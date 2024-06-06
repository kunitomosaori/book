INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test1', 'test1@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test2', 'test2@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test3', 'test3@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test4', 'test4@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test5', 'test5@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test6', 'test6@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test7', 'test7@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test8', 'test8@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test9', 'test9@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(id,name,email,age,naiyou,indate)VALUES(NULL, 'test10', 'test10@test.jp', 30, 'test', sysdate());
INSERT INTO gs_an_table(name,email,age,naiyou,indate)VALUES('test11', 'test11@test.jp', 30, 'test', sysdate());

INSERT INTO gs_an_table(name,email,age,naiyou,indate)VALUES(:name,:email,:age,:naiyou,sysdate());

SELECT * FROM gs_an_table;
SELECT id,name,indate FROM gs_an_table;

SELECT * FROM gs_an_table WHERE id=1;
SELECT * FROM gs_an_table WHERE id>=1 AND id<=3;
SELECT * FROM gs_an_table WHERE email LIKE '%test1%';

SELECT * FROM gs_an_table ORDER BY indate DESC LIMIT 3;


INSERT INTO gs_bm_table(name,url,comment,indate)VALUES(:name,:url,:comment,sysdate());
