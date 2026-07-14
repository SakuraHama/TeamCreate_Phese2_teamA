<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

//ループカウンタ
$i = 0;
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

    //ステップ詳細を取得する
    $sql = "SELECT * FROM STEP_DETAIL where cid = :cid and sno = :sno";

    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta->execute();

    //達成率表示のためにステップの数をカウントする
    $sql2 = "SELECT COUNT(DNO) as CD FROM STEP_DETAIL where cid = :cid and sno = :sno";

    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta2->execute();

    //達成率表示のために達成数をカウントする
    $sql3 = "SELECT count(ACHIEVE) as ACHIEVE FROM ACHIEVEMENT where user_no = :user_no and cid = :cid and sno = :sno and ACHIEVE = true";

    $sta3 = $pdo->prepare($sql3);
    $sta3->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta3->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta3->bindParam(':user_no', $user_no, PDO::PARAM_INT);
    $sta3->execute();

    //チェックボックスを達成非達成を表示する
    $sql4 = "SELECT ACHIEVE FROM ACHIEVEMENT WHERE user_no = :user_no and cid = :cid and sno = :sno";

    $sta4 = $pdo->prepare($sql4);
    $sta4->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta4->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta4->bindParam(':user_no', $user_no, PDO::PARAM_INT);
    $sta4->execute();

    // SQL実行結果の処理
    while ($row = $sta->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }

    $CD = $sta2->fetch(PDO::FETCH_ASSOC);

    $ACHIEVE = $sta3->fetch(PDO::FETCH_ASSOC);

    $percent = $ACHIEVE['ACHIEVE'] / $CD['CD'] * 100;
    $percent = round($percent, 1);

    $tf = $sta4->fetchall(PDO::FETCH_ASSOC);

    // PDOオブジェクトを破棄
    $sta = null;
    $sta2 = null;
    $sta3 = null;
    $sta4 = null;
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
    <link rel="stylesheet" href="css/detail.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>

<body　class="bg-light">
    <header class="bg-white shadow-sm border-bottom py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-list-check text-primary"></i>
                    詳細画面
                </h2>

            </div>

            <button onclick="location.href='Logout.php'"
                class="btn btn-danger w-10 position-absolute end-0 top-0 m-4">
                ログアウト
            </button>
        </div>
    </header>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-white">

                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-bold">
                        <i class="bi bi-check2-square"></i>
                        チェックリスト
                    </h5>

                    <span class="badge bg-success fs-6">
                        <?= $percent ?>%
                    </span>
                </div>

                <div class="progress" style="height:12px;">
                    <div
                        class="progress-bar bg-success"
                        style="width:<?= $percent ?>%">
                    </div>
                </div>

            </div>
            <form action="Deta_Update.php" method="POST">


                <?php foreach ($result as $r): ?>
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">

                            <input
                                class="form-check-input me-3"
                                type="checkbox"
                                name="items[]"
                                value="<?= $r['DNO'] ?>"
                                <?php if ($tf[$i]['ACHIEVE'] == 1) echo "checked"; ?>>

                            <label class="fs-5 mb-0">
                                <?= $r['DETAIL'] ?>
                            </label>

                        </div>
                    </div>
                <?php $i++;
                endforeach; ?>
                
                <input type="hidden" name="cid" value="<?= $cid ?>">
                <input type="hidden" name="sno" value="<?= $sno ?>">
        </div>
        <div class="d-flex justify-content-between mt-4">

            <button class="btn btn-success px-5">
                <i class="bi bi-check-circle"></i>
                登録
            </button>

            <a href="Step.php?cid=<?= $cid ?>" class="btn btn-outline-secondary px-5">
                <i class="bi bi-arrow-left"></i>
                戻る
            </a>

        </div>
        </form>
    </div>
</body>

</html>