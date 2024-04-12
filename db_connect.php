<?php

// データベースの接続情報
$servername = "localhost"; // ホスト名
$username = "root"; // ユーザー名
$password = ""; // パスワード
$dbname = "git_test"; // データベース名


// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続を確認
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}
?>