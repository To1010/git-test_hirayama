<link rel="stylesheet" href="./css/style.css">

<?php
require('db_connect.php'); // データベースへの接続情報を含むファイルを読み込む

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからのデータを取得
    $name = isset($_POST['name']) ? $_POST['name'] : ''; // isset関数を使用してキーが存在するか確認し、存在する場合に値を取得する
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : ''; // isset関数を使用してキーが存在するか確認し、存在する場合に値を取得する
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    
    // データを挿入するクエリ
    $sql = "INSERT INTO comments (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())";

    // プリペアドステートメントを作成
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("エラー: " . $conn->error);
    }

    // パラメータをバインドしてクエリを実行
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    $result = $stmt->execute();
    if ($result) {
        echo "";
    } else {
        echo "エラー: " . $stmt->error;
    }

    // ステートメントをクローズ
    $stmt->close();
}

// データベース接続を閉じる
$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Git・PHP・SQL テスト課題</title>
</head>

<body>
    <section>
        <img src="img/22780470.jpg" width="500" height="500">

        <div class="footer">
        <a href="profile.php" class="button">戻る</a>
        </div>
    </section>
</body>

</html>