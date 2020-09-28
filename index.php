<?php
    $link = mysqli_connect("localhost", "root", "kimhj0314", "dbp");
    $query = "SELECT * FROM book";
    $result = mysqli_query($link, $query);
    $list = "";
    $list_2 = "";

    while ($row = mysqli_fetch_array($result)) {
      $list = $list."<li><a href=\"index.php?id={$row["id"]}\">{$row["title"]}</a></li>";
      $list_2 = $list_2."
        <li>
          <input type=\"hidden\" name=\"id\" value=\"{$row['id']}\">
          {$row['title']}
          <input type=\"submit\" value=\"설명보기\">
        </li>
      ";
    }

    $article = array(
      'title' => '어서오세요',
      'author' => '',
      'summary' => '책을 선택하세요.',
      'writer_name' => ''
    );

    $update_link = "";
    $delete_link = "";

    $writer = '';

    if (isset($_GET['id'])) {
      $id_of_selected_item = mysqli_real_escape_string($link, $_GET['id']);

      $query = "SELECT * FROM book LEFT JOIN writer ON book.writer_id = writer.id WHERE book.id = {$id_of_selected_item}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);

      $article['title'] = htmlspecialchars($row['title']);
      $article['author'] = htmlspecialchars($row['author']);
      $article['summary'] = htmlspecialchars($row['summary']);
      $article['writer_name'] = htmlspecialchars($row['name']);

      $update_link = "
        <form method=\"post\" action=\"update_POST.php\">
          <input type=\"hidden\" name=\"id\" value=\"{$id_of_selected_item}\">
          <input type=\"submit\" value=\"수정하기\">
        </form>
      ";
      $delete_link = "
        <form method=\"post\" action=\"process_delete_POST.php\">
          <input type=\"hidden\" name=\"id\" value=\"{$id_of_selected_item}\">
          <input type=\"submit\" value=\"삭제하기\">
        </form>
      ";

      $writer = "<p>by {$article['writer_name']}</p>";
    }

    if (isset($_POST['id'])) {
      $id_of_selected_item = $_POST['id'];
      echo $id_of_selected_item;
      $query = "SELECT * FROM book WHERE id={$id_of_selected_item}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
        'title'=>$row["title"],
        'author'=>$row["author"],
        'summary'=>$row["summary"]
      );
      $update_link = "
        <form method=\"post\" action=\"update_POST.php\">
          <input type=\"hidden\" name=\"id\" value=\"{$id_of_selected_item}\">
          <input type=\"submit\" value=\"수정하기\">
        </form>
      ";
      $delete_link = "
        <form method=\"post\" action=\"process_delete_POST.php\">
          <input type=\"hidden\" name=\"id\" value=\"{$id_of_selected_item}\">
          <input type=\"submit\" value=\"삭제하기\">
        </form>
      ";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BOOK</title>
    <style>
    p {
      color: orange;
      font-style: italic;
    }
    form {
      display: inline;
    }
    </style>
  </head>
  <body>
    <body>
      <h1><a href="index.php">읽은 책 목록</a></h1>
      <a href="writer.php">작성자</a>
      <ol>
        <!--
        <form method="post" action="index.php">
          <?=$list_2?>
        </form>
      -->
        <?=$list?>
      </ol>
      <button onclick="location.href='create.php'">책 추가하기</button>
      <br />
      <br />
      <fieldset>
        <legend>책 정보</legend>
        <h2><<?=$article["title"]?>></h2>
        <p><?=$article["author"]?></p>
        <p><?=$article["summary"]?></p>
        <?=$writer?>
        <?=$update_link?>
        <?=$delete_link?>
      </fieldset>
    </body>
  </body>
</html>
