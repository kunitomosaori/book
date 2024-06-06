<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


//DBConnection
function db_conn(){
    try {
        //Password:MAMP='root',XAMPP=''
        $db_name = "gs_db1";
        $db_id = "root";
        $db_pw = "";
        $db_host = "localhost";
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB_CONECTERROR!:' . $e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQL_ERROR!!:".$error[2]);
    }


//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: $file_name");
    exit();
    }