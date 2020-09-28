<?php
  $result_message = "삭제하지 못했습니다. 관리자에게 문의하세요.";

  if (isset($_POST['id'])) {
    $link = mysqli_connect("localhost", "root", "kimhj0314", "dbp");
    $filtered_id = mysqli_real_escape_string($link, $_POST['id']);
    $query = "
      DELETE FROM book
      WHERE id={$filtered_id}
    ";
    $result = mysqli_query($link, $query);

    if ($result) {
      $result_message = "삭제했습니다.";
    }
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
    <br />
    <button onclick="location.href='index.php'">돌아가기</button>
  </body>
</html>
