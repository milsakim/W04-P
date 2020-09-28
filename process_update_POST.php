<?php
  if (isset($_POST['id'])) {
    $link = mysqli_connect("localhost", "root", "kimhj0314", "dbp");
    $query = "
      UPDATE book
      SET
        title=\"{$_POST['title']}\",
        author='{$_POST['author']}',
        summary='{$_POST['summary']}'
      WHERE id='{$_POST['id']}'
    ";
    $result = mysqli_query($link, $query);

    $alert_message = "";

    if ($result) {
      $alert_message = "업데이트에 성공했습니다!";
    }
    else {
      $alert_message = "업데이트에 실패했습니다. 관리자에게 문의하세요.";
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
    <p><?=$alert_message?></p>
    <br />
    <button onclick="location.href='index.php'">돌아가기</button>
  </body>
</html>
