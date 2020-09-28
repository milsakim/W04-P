<?php
  $link = mysqli_connect("localhost", "root", "kimhj0314", "dbp");

  $filtered = array(
    'title' => mysqli_real_escape_string($link, $_POST['title']),
    'author' => mysqli_real_escape_string($link, $_POST['author']),
    'summary' => mysqli_real_escape_string($link, $_POST['summary']),
    'writer_id' => mysqli_real_escape_string($link, $_POST['writer_id'])
  );

  $query = "INSERT INTO book
    (title, author, summary, created_date, writer_id)
    VALUES(
    '{$filtered['title']}',
    '{$filtered['author']}',
    '{$filtered['summary']}',
    now(),
    '{$filtered['writer_id']}')
  ";
  $result = mysqli_query($link, $query);
  $result_message = "";

  if($result) {
    $result_message = "저장에 성공했습니다.";
  }
  else {
    $result_message = "저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.";
    error_log(mysqli_error($link));
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BOOK</title>
  </head>
  <body>
    <p><?=$result_message?></p>
    <button onclick="location.href='index.php'">돌아가기</button>
  </body>
</html>
