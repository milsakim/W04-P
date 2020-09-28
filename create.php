<?php
  $link = mysqli_connect('localhost', 'root', 'kimhj0314', 'dbp');
  $query = "SELECT * FROM writer";
  $result = mysqli_query($link, $query);

  $select_form = '<select name="writer_id">';

  while ($row = mysqli_fetch_array($result)) {
    $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
  }

  $select_form .= '</select>';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Book</title>
  </head>
  <body>
    <h1>Book</h1>
    <form action="process_create.php" method="post">
      <p><label>책 제목
        <input type="text" name="title" placeholder="제목"></label></p>
      <p><label>작가
        <input type="text" name="author" placeholder="작가"></label></p>
      <p><label>줄거리
        <textarea name="summary" placeholder="줄거리"></textarea></label></p>
      <p><label>작성자
        <?=$select_form?></p>
      <p><input type="submit"></p>
    </form>
  </body>
</html>
