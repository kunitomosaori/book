<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。

$id = $_GET["id"];

// エラー表示
ini_set("display_errors", 1);
error_reporting(E_ALL);

// 1. DB接続します
include("funcs.php");
$pdo = db_conn();

// 2. データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// 3. データ表示
if ($status == false) {
    sql_error($stmt);
}

// 全データ取得
$values = $stmt->fetch(); // PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

// グラフ1用データを集計
$sql1 = "SELECT book_name, COUNT(comment) AS comment_count FROM gs_bm_table GROUP BY book_name";
$stmt1 = $pdo->prepare($sql1);
$status1 = $stmt1->execute();

if ($status1 == false) {
    $error = $stmt1->errorInfo();
    exit("SQL_ERROR!:" . $error[2]);
}

$chartData = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($chartData, JSON_UNESCAPED_UNICODE);

// 年代別データを集計
$sql2 = "SELECT CASE
                WHEN age BETWEEN 10 AND 19 THEN '10代'
                WHEN age BETWEEN 20 AND 29 THEN '20代'
                WHEN age BETWEEN 30 AND 39 THEN '30代'
                WHEN age BETWEEN 40 AND 49 THEN '40代'
                WHEN age BETWEEN 50 AND 59 THEN '50代'
                WHEN age >= 60 THEN '60代以上'
                ELSE '不明'
            END AS age_group,
            COUNT(*) AS count
        FROM gs_bm_table
        GROUP BY age_group";
$stmt2 = $pdo->prepare($sql2);
$status2 = $stmt2->execute();

if ($status2 == false) {
    $error = $stmt2->errorInfo();
    exit("SQL_ERROR!:" . $error[2]);
}

$ageData = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$ageJson = json_encode($ageData, JSON_UNESCAPED_UNICODE);

// 性別データを集計
$sql3 = "SELECT CASE
                WHEN gender = 'male' THEN '男性'
                WHEN gender = 'female' THEN '女性'
                ELSE '他'
            END AS gender,
            COUNT(*) AS count
        FROM gs_bm_table
        GROUP BY gender";
$stmt3 = $pdo->prepare($sql3);
$status3 = $stmt3->execute();

if ($status3 == false) {
    sql_error($stmt3);
}

$genderData = $stmt3->fetchAll(PDO::FETCH_ASSOC);
usort($genderData, fn($a, $b) => $b['count'] <=> $a['count']);
$genderJson = json_encode($genderData, JSON_UNESCAPED_UNICODE);

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body>

  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid flex items-center justify-center">
        <div class="navbar-header"><a class="navbar-brand" href="data.php">データ一覧</a></div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <form method="post" action="update.php">
  <div class="jumbotron flex items-center justify-center">
      <fieldset>
        <legend>読書メモ 更新</legend>
        <label>名　前　：<input type="text" name="name" value="<?=$values["name"]?>"></label><br>
        <label>性　別　：<select name="gender">
        <option value="male" <?= $values["gender"] == 'male' ? 'selected' : '' ?>>男性</option>
            <option value="female" <?= $values["gender"] == 'female' ? 'selected' : '' ?>>女性</option>
            <option value="none" <?= $values["gender"] == 'none' ? 'selected' : '' ?>>他</option>
        </select></label><br>
        <label>年　齢　：<input type="text" name="age" value="<?=$values["age"]?>"></label><br>
        <label>書籍名　：<input type="text" name="book_name" value="<?=$values["book_name"]?>"></label><br>
        <label>書籍URL：<input type="text"name="url" value="<?=$values["url"]?>"></label><br>
        <label>コメント：<textArea name="comment" rows="4" cols="40"><?=$values["comment"]?></textArea></label><br>
        <input type="hidden" name="id" value="<?=$values["id"]?>">
        <input type="submit" value="送信" class="bg-orange-400 hover:bg-orange-300 px-5 py-2 rounded-md" >
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->


</body>

</html>

