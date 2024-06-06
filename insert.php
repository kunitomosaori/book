<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$name      = $_POST["name"];
$gender    = $_POST["gender"];
$age       = $_POST["age"];
$book_name = $_POST["book_name"];
$url       = $_POST["url"];
$comment   = $_POST["comment"];


//2. DB接続します
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(name,gender,age,book_name,url,comment,indate)VALUES(:name,:gender,:age,:book_name,:url,:comment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name'     ,$name,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gender'   ,$gender,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age'      ,$age,      PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_name',$book_name,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',      $url,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',  $comment,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
//５．index.phpへリダイレクト
  redirect("index.php");
}
?>
