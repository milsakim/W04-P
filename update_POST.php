<?php
  $link = mysqli_connect("localhost", "root", "kimhj0314", "dbp");
  $query = "SELECT * FROM book";
  $result = mysqli_query($link, $query);

  $list = "";

  while ($row = mysqli_fetch_array($result)) {
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $updating_book = array(
    'title' => 'No title',
    'author' => 'No author',
    'summary' => 'No summary'
  );

  if(isset($_POST['id'])) {
    $filtered_id = mysqli_real_escape_string($link, $_POST['id']);
    $query = "SELECT * FROM book WHERE id={$filtered_id}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $updating_book = array(
      'title' => $row['title'],
      'author' => $row['author'],
      'summary' => $row['summary']
    );
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
    ul { list-style-type: none; }
    </style>
  </head>
  <body>
    <h1><a href="index.php">읽은 책 목록</a></h1>
    <ol>
      <?=$list?>
    </ol>
    <form method="post" action="process_update_POST.php">
      <fieldset>
        <legend>책 정보</legend>
        <ul>
          <input type="hidden" name="id" value="<?=$filtered_id?>">
          <li>
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="<?=$updating_book['title']?>">
          </li>
          <li>
            <label for="author">작가</label>
            <input type="text" id="author" name="author" value="<?=$updating_book['author']?>">
          </li>
          <li>
            <label for="summary">줄거리</label>
            <textarea id="summary" name="summary"><?=$updating_book['summary']?></textarea>
          </li>
          <li>
            <input type="submit" value="Update">
            <input type="button" value="Cancel" onclick="location.href='index.php'">
          </li>
        </ul>
      </fieldset>
    </form>
  </body>
</html>
