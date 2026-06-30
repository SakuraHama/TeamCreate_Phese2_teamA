<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

try {
    $result = [];
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    // PDOの動作オプションを指定する
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // SQL文の準備と実行
    $cid = filter_input(INPUT_GET, "cid", FILTER_DEFAULT);
    $sno = filter_input(INPUT_GET, "sno", FILTER_DEFAULT);
    $sql = "SELECT * FROM STEP_DETAIL where cid = :cid and sno = :sno";
    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta->execute();
    // SQL実行結果の処理
    while ($row = $sta->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
    // PDOオブジェクトを破棄
    $sta = null;
    $pdo = null;
} catch (PDOException $e) {
    exit("DBエラー" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <h1>詳細画面</h1>
    <p>
        ここに詳細な情報が表示されます。
    </p>

    <div>
        <h2>項目1</h2>
        <input type="checkbox" id="item1" name="items[]" value="">
    </div>

    <div>
        <h2>項目2</h2>
        <input type="checkbox" id="item2" name="items[]" value="">
    </div>

    <div>
        <h2>項目3</h2>
        <input type="checkbox" id="item3" name="items[]" value="">
    </div>

    <div>
        <h2>項目4</h2>
        <input type="checkbox" id="item4" name="items[]" value="">
    </div>

    <div>
        <h2>項目5</h2>
        <input type="checkbox" id="item5" name="items[]" value="">
    </div>

    <a href="Step.php"><button>戻る</button></a>
    <button type="submit">登録</button>

</body>

</html>