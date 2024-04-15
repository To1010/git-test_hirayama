<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>prior_comments</title>
</head>

<body>
    <h1>昨日までのコメント</h1>
    <section>
        <?php
        require('db_connect.php'); // データベースへの接続情報を含むファイルを読み込む

        $currentDate = date("Y-m-d");

        $sql = "SELECT name, subject, message, created_at FROM comments WHERE DATE(created_at) < '$currentDate' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "To: " . $row["subject"] . "　　";
                echo "From: " . $row["name"] . "　　　　　　　　　";
                echo "Date: " . date("m月d日 H時i分", strtotime($row["created_at"])) . "<br>";
                $message = $row["message"];
                $wrapped_message = wordwrap($message, 50, "<br>", true);
                echo "ひとこと : " . $wrapped_message . "<br>";
            }
        } else {
            echo "過去のコメントはありません";
        }
        ?>
    </section>
    <div class="footer">
        <a href="profile.php" class="button">戻る</a>
    </div>
</body>

</html>
