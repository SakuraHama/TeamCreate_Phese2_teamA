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
    $sql = "SELECT * FROM STEP where cid = :cid";
    $sql2 = "SELECT CNAME from CATEGORY where cid = :cid";
    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->execute();
 
    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->execute();
    // SQL実行結果の処理
    while ($row = $sta->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
 
    $CNAME = $sta2->fetch(PDO::FETCH_ASSOC);
 
    // PDOオブジェクトを破棄
    $sta = null;
    $sta2 = null;
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
    <link rel="stylesheet" href="css/step.css">
</head>
 
<body class="">
 
    <div class="container py-5">
 
    <div class="text-end mb-3">
        <a href="Logout.php" class="btn btn-danger rounded-pill px-4">
            ログアウト
        </a>
    </div>
 
    <div class="step-card">
 
        <div class="text-center">
 
            <img src="images/life_steplogo.png"
                 class="logo-img"
                 alt="Life Step">
 
            <h2 class="fw-bold mt-3">
                <?= htmlspecialchars($CNAME['CNAME']) ?>
            </h2>
 
            <p class="text-muted">
                ステップ一覧
            </p>
 
        </div>
 
        <div class="table-responsive mt-4">
 
            <table class="table table-hover align-middle">
 
                <thead class="table-primary">
 
                    <tr>
 
                        <th width="10%">No</th>
 
                        <th>内容</th>
 
                        <th width="15%">状態</th>
 
                        <th width="15%">詳細</th>
 
                    </tr>
 
                </thead>
 
                <tbody>
 
                <?php foreach($result as $r): ?>
 
                    <tr>
 
                        <td>
                            <?= $r['SNO'] ?>
                        </td>
 
                        <td>
                            <?= htmlspecialchars($r['SNOTE']) ?>
                        </td>
 
                        <td>
 
                            <span class="badge bg-secondary">
                                未開始
                            </span>
 
                        </td>
 
                        <td>
 
                            <form action="Detail.php" method="POST">
 
                                <input type="hidden"
                                       name="cid"
                                       value="<?= $r['CID'] ?>">
 
                                <input type="hidden"
                                       name="sno"
                                       value="<?= $r['SNO'] ?>">
 
                                <button
                                    class="btn btn-primary rounded-pill px-4">
 
                                    詳細
 
                                </button>
 
                            </form>
 
                        </td>
 
                    </tr>
 
                <?php endforeach; ?>
 
                </tbody>
 
            </table>
 
        </div>
 
        <div class="text-center mt-4">
 
            <a href="Category.php"
               class="btn btn-outline-secondary rounded-pill px-5">
 
                ← 戻る
 
            </a>
 
        </div>
 
    </div>
 
</div>
 
</body>
 
</html>
 