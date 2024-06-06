<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/output.css" rel="stylesheet">
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
  <form method="post" action="insert.php">
    <div class="jumbotron flex items-center justify-center">
      <fieldset>
        <legend>読書メモ</legend>
        <label>名　前　：<input type="text" name="name"></label><br>
        <label>性　別　：<select name="gender">
          <option value="male">男性</option>
          <option value="female">女性</option>
          <option value="none">他</option>
        </select></label><br>
        <label>年　齢　：<input type="text" name="age"></label><br>
        <label>書籍名　：<input type="text" name="book_name"></label><br>
        <label>書籍URL：<input type="text"name="url"></label><br>
        <label>コメント：<textArea name="comment" rows="4" cols="40"></textArea></label><br>
        <input type="submit" value="送信" class="bg-orange-400 hover:bg-orange-300 px-5 py-2 rounded-md" >
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->


</body>

</html>