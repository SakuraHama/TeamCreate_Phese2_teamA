<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

session_start();
try {
    $result = [];
    $pdo = new PDO($dsn, DB_USER, DB_PASS);

    //ユーザIDを取得しておく
    $user_no = $_SESSION['id'];
    // PDOの動作オプションを指定する
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // SQL文の準備と実行
    $cid = filter_input(INPUT_POST, "cid", FILTER_DEFAULT);
    $sno = filter_input(INPUT_POST, "sno", FILTER_DEFAULT);
    $sql = "SELECT * FROM STEP_DETAIL where cid = :cid and sno = :sno";
    $sql2 = "SELECT COUNT(DNO) as CD FROM STEP_DETAIL where cid = :cid and sno = :sno";
    $sql3 = "SELECT count(ACHIEVE) as ACHIEVE FROM ACHIEVEMENT where user_no = :user_no and cid = :cid and sno = :sno and ACHIEVE = true";

    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta->execute();

    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta2->execute();

    $sta3 = $pdo->prepare($sql3);
    $sta3->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta3->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta3->bindParam(':user_no', $user_no, PDO::PARAM_INT);
    $sta3->execute();

    // SQL実行結果の処理
    while ($row = $sta->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }

    $CD = $sta2->fetch(PDO::FETCH_ASSOC);

    $ACHIEVE = $sta3->fetch(PDO::FETCH_ASSOC);

    $percent = $ACHIEVE['ACHIEVE'] / $CD['CD'] * 100;

    // PDOオブジェクトを破棄
    $sta = null;
    $sta2 = null;
    $sta3 = null;
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
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>

<body>
    <header class="bg-primary text-white py-4 shadow position-relative">
        <div class="container">
            <h1 class="h3">詳細画面</h1>
        </div>
        <button onclick="location.href='Logout.php'" class="btn btn-danger w-10 position-absolute end-0 top-0 m-4">
            ログアウト
        </button>
    </header>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white position-relative">
                <h4 class="mb-0">チェックリスト</h4>
                <h4 class="mb-0 position-absolute end-0 top-0 m-2">達成率：<?= $percent ?>%</h4>
            </div>
            <form action="Deta_Update.php" method="POST">
                <div class="p-3">
                    <?php foreach ($result as $r): ?>
                        <div
                            class="m-3">
                            <input type="checkbox" name="items[]" value="<?= $r['DNO'] ?>">
                            <lavel class="h2"><?= $r['DETAIL'] ?></lavel>
                        </div>
                    <?php endforeach; ?>
                    <input type="hidden" name="cid" value="<?= $cid ?>">
                    <input type="hidden" name="sno" value="<?= $sno ?>">
                </div>
                <div class="d-flex justify-content-between mt-4 position-relative">
                    <button type="submit" class="btn btn-primary position-absolute bottom-50 m-2">登録</button>
                    <a href="Step.php?cid=<?=$cid?>" class="btn btn-secondary position-absolute end-0 bottom-50 m-2">
                        戻る
                    </a>
                </div>
            </form>
        </div>
</body>

</html>