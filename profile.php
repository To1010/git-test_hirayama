<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Git・PHP・SQL テスト課題</title>
</head>

<body>
    <h1>Git・SQL・PHP test</h1>
    <section class="profile">
        <h2>プロフィール</h2>
        <div class="profile-content">
            <div class="p-1">
                <h3>Hirayama</h3>
                <p>長崎県在住のナマケモノです<br>日向ぼっこしたい (・ω・)ノ</p>
            </div>
            <div class="p-2">
                <img src="./img/スクリーンショット 2024-03-06 171748.png" alt="Your Photo">
            </div>
        </div>
    </section>
    <section class="profile">
        <h2>プロフィール</h2>
        <div class="profile-content">
            <div class="p-1">
                <h3>Umeda</h3>
                <p>梅田綾夏です</p>
            </div>
            <div class="p-2">
                <img src="./img/umeda.png" alt="umeda Photo">
            </div>
        </div>
    </section>

    <section>
        <h2>お問い合わせフォーム</h2>
        <div class="form">
            <form action="process_form.php" method="post">
                <label for="subject">To: </label>
                <select id="subject" name="subject" required>
                    <option value="平山さんへ">平山さんへ</option>
                    <option value="梅田へ">梅田へ</option>
                </select><br>
                <label for="name">From: </label>
                <input type="text" id="name" name="name" placeholder="Name" required><br>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="xxx@xxxxx" required><br>
                <label for="message">Message:　　　　</label><br>
                <textarea id="message" name="message" rows="4" cols="50" placeholder="ひと言どうぞ"required></textarea><br>
                <input type="submit" value="送信">
            </form>
        </div>
    </section>

    <section>
        <h2>今日のコメント</h2>
        <?php
        // DBからコメントを取得して表示する処理
        require('db_connect.php'); // データベースへの接続情報を含むファイルを読み込む

        $currentDate = date("Y-m-d"); // 今日の日付を取得
        $sql = "SELECT name, subject, message, created_at FROM comments WHERE DATE(created_at) = '$currentDate' ORDER BY id DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "To: " . $row["subject"] . "　　";
                echo "From: " . $row["name"] . "　　　　　　　　　";
                echo "Time: " . date("H時i分", strtotime($row["created_at"])) . "<br>";
                $message = $row["message"];
                $wrapped_message = wordwrap($message, 50, "<br>", true);
                echo "ひとこと : " . $wrapped_message . "<br>";

            }
        } else {
            echo "今日のコメントはありません";
        }
        // データベース接続を閉じる
        $conn->close();
        ?>
    </section>

    <?php
    $nameErr = $emailErr = $messageErr = "";
    $name = $email = $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "名前は必須です";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "メールアドレスは必須です";
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["message"])) {
            $messageErr = "メッセージは必須です";
        } else {
            $message = test_input($_POST["message"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    </section>
    <div class="footer">
        <a href="prior_comments.php" class="button">昨日までのコメントを表示する</a>
    </div>
</body>

</html>