<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

session_start();
//ユーザIDを取得しておく
$user_no = $_SESSION['id'];
if($user_no == null){
    session_destroy();//セッションを破壊
    header('Location: Login.php');
}
//ループカウンタ
$i = 0;
try {

    $result = [];
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    // PDOの動作オプションを指定する
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cid = filter_input(INPUT_GET, "cid", FILTER_DEFAULT);
    // SQL文の準備と実行

    //ステップを表示するためにSTEP表の要素を取得する
    $sql = "SELECT * FROM STEP where cid = :cid";

    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->execute();

    //カテゴリー名を表示するため、カテゴリー名を取得する
    $sql2 = "SELECT CNAME from CATEGORY where cid = :cid";

    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->execute();

    //それぞれのステップの詳細数を表示するための情報を取得する
    $sql3 = "SELECT COUNT(*) AS COUNT_STEP FROM STEP_DETAIL WHERE CID = :cid GROUP BY CID,SNO;";

    $sta3 = $pdo->prepare($sql3);
    $sta3->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta3->execute();

    //それぞれのステップの達成数を表示するための情報を取得する
    $sql4 = "SELECT COUNT(CASE WHEN ACHIEVE = 1 THEN 1 END) AS COUNT_ACHIEVE FROM ACHIEVEMENT WHERE USER_NO = :user_no AND CID = :cid GROUP BY CID,SNO;";

    $sta4 = $pdo->prepare($sql4);
    $sta4->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta4->bindParam(':user_no', $user_no, PDO::PARAM_STR);
    $sta4->execute();

    // SQL実行結果の処理
    while ($row = $sta->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }

    $CNAME = $sta2->fetch(PDO::FETCH_ASSOC);

    $count_step = $sta3->fetchAll(PDO::FETCH_ASSOC);

    $count_achieve = $sta4->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="css/step.css">
</head>

<body class="">

    <div class="container py-5">

        <div class="text-end mb-3">
            <a href="Logout.php" class="btn btn-danger px-4">
                ログアウト
            </a>
        </div>

        <div class="step-card">

            <div class="text-center">

                <img src="images/logo_transparent.png"
                    class="logo-img"
                    alt="Life Step"
                    >

                <h1 class="text-primary h2">暮らすてっぷ</h1>
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

                        <?php foreach ($result as $r): ?>

                            <tr>

                                <td>
                                    <?= $r['SNO'] ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($r['SNOTE']) ?>
                                </td>

                                <td>


                                    <?php if ($count_achieve[$i]['COUNT_ACHIEVE'] == 0) {
                                        echo ('<span class="badge bg-secondary">');
                                        echo ('未開始');
                                        echo ('</span>');
                                    } elseif ($count_achieve[$i]['COUNT_ACHIEVE'] == $count_step[$i]['COUNT_STEP']) {
                                        echo ('<span class="badge bg-primary">');
                                        echo ('COMPLETE');
                                        echo ('</span>');
                                    } else {
                                        echo ('<span class="badge bg-secondary">');
                                        echo ($count_achieve[$i]['COUNT_ACHIEVE'] . "/" . $count_step[$i]['COUNT_STEP']);
                                        echo ('</span>');
                                    }
                                    ?>


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

                        <?php
                            $i++;
                        endforeach;
                        ?>

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