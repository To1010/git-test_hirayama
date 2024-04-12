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
        require('db_connect.php'); // Include the file that establishes the database connection

        $currentDate = date("Y-m-d");

        $sql = "SELECT name, subject, message FROM comments WHERE DATE(created_at) < '$currentDate' ORDER BY id DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "宛先: " . $row["subject"] . " 　　";
                echo "Name: " . $row["name"] . "<br>";
                echo "ひとこと: " . $row["message"] . "<br><br>";
            }
        } else {
            echo "過去のコメントはありません";
        }
        ?>
    </section>
    <footer>
    <a href="profile.php">戻る</a>
    </footer>
</body>

</html>







