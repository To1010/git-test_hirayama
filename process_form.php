<?php
// データベースの接続情報
$servername = "localhost"; // ホスト名
$username = "root"; // ユーザー名
$password = ""; // パスワード
$dbname = "git_test"; // データベース名

// フォームからのデータを取得
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続を確認
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// データを挿入するクエリ
$sql = "INSERT INTO comments (name, email, message, created_at) VALUES ('$name', '$email', '$message', NOW())";

// クエリを実行して結果をチェック
if ($conn->query($sql) === TRUE) {
    echo "データが正常に挿入されました";
} else {
    echo "エラー: " . $sql . "<br>" . $conn->error;
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

        <a href="profile.php">プロフィール画面に戻る</a>
    </section>
</body>

</html>
