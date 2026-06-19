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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
</head>
</head>

<body>
    <!-- Header -->
    <header class="bg-primary text-white py-4 shadow position-relative">
        <div class="container">
            <h1 class="h3">詳細画面</h1>
        </div>
        <button onclick="location.href='Login.php'" class="btn btn-danger w-10 position-absolute end-0 top-0 m-4">
            ログアウト
        </button>
    </header>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">チェックリスト</h4>
            </div>
            <form action="">
                <div class="p-3">
                    <?php foreach ($result as $r): ?>
                        <div
                            class="m-3">
                            <input type="checkbox" id="item1" name="items[]" value="">
                            <lavel class="h2"><?= $r['DETAIL'] ?></lavel>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex justify-content-between mt-4 position-relative">
                    <button type="submit" class="btn btn-primary position-absolute bottom-50 m-2">登録</button>

                    <a href="Step.php?cid=<?= $cid ?>" class="btn btn-secondary position-absolute end-0 bottom-50 m-2">
                        戻る
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>