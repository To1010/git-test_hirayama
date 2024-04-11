<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Git・PHP・SQL テスト課題</title>
</head>

<body>
    <section>
        <h2>プロフィール・自己紹介</h2>
        <h3>Hirayama</h3>
        <img src="./img/スクリーンショット 2024-03-06 171748.png" alt="Your Photo">
        <p>ザックリとした状態でごめんなさい(m´・ω・｀)m ｺﾞﾒﾝ…</p>
        <h3>Umeda</h3>
        <img src="./img/umeda.png" alt="umeda Photo">
        <p>梅田綾夏です</p>
    </section>
    <section>
        <h2>お問い合わせフォーム</h2>
        <form action="process_form.php" method="post">
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="email">メールアドレス:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="subject">宛先:</label>
    <select id="subject" name="subject" required>
    <option value="平山さん宛">平山さん宛</option>
        <option value="梅田宛">梅田宛</option>
    </select><br>
    <label for="message">メッセージ:</label><br>
    <textarea id="message" name="message" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="送信">
</form>
    </section>

    <section>
        <h2>今日のコメント</h2>
        <?php
        // DBからコメントを取得して表示する処理
        // データベースへの接続情報
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "git_test";

        // データベースに接続
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 接続を確認
        if ($conn->connect_error) {
            die("接続に失敗しました: " . $conn->connect_error);
        }

        // コメントを取得するクエリ
        $sql = "SELECT name, subject, message FROM comments";

        // クエリを実行して結果を取得
        $result = $conn->query($sql);
        
        // 結果があるかどうかをチェックして表示
        if ($result->num_rows > 0) {
            // データがある場合は表示
            while ($row = $result->fetch_assoc()) {
                echo "Name: " . $row["name"] . "<br>";
                echo "宛先: " . $row["subject"] . "<br>"; // 宛先を表示
                echo "ひとこと: " . $row["message"] . "<br><br>";
            }
        } else {
            echo "コメントはありません";
        }
        
        // データベース接続を閉じる
        $conn->close();
        ?>

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
</body>

</html>
