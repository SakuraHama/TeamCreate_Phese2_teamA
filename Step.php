<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

session_start();
    
try {

    $result = [];
    $pdo = new PDO($dsn, DB_USER, DB_PASS);

    // PDOの動作オプションを指定する
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //カテゴリーIDをGETで取得する
    $cid = filter_input(INPUT_GET, "cid", FILTER_DEFAULT);
    
    //ユーザIDを取得しておく
    $user_no = $_SESSION['id'];

    // SQL文の準備と実行

    //カテゴリー内のステップを取得する
    $sql = "SELECT * FROM STEP where cid = :cid";

    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->execute();

    //カテゴリー名を表示するためにカテゴリー名を取得する
    $sql2 = "SELECT CNAME from CATEGORY where cid = :cid";
    
    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->execute();

    //ステップの状態を表示するためにそれぞれのステップ数を取得する
    $sql3 = "select count(*) from achievement where cid = :cid and user_no = :user_no group by sno;";

    $sta3 = $pdo->prepare($sql3);

    //ステップの状態を表示するためにそれぞれのステップから達成数を取得する
    $sql4 = "SELECT";
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
</head>

<body class="bg-light">

    <!-- Header -->
    <header class="bg-primary text-white py-4 shadow position-relative">
        <div class="container">
            <h1 class="h3">ステップ</h1>
        </div>
        <button onclick="location.href='Logout.php'" class="btn btn-danger w-10 position-absolute end-0 top-0 m-4">
            ログアウト
        </button>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><?= $CNAME['CNAME'] ?></h4>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ステップ</th>
                            <th>内容</th>
                            <th>状態</th>
                            <th>詳細</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($result as $r): ?>
                            <form action="Detail.php" method="POST">
                            <tr>
                                <td><?= $r['SNO'] ?></td>
                                <td><?= $r['SNOTE'] ?></td>
                                <td></td>
                                <input type="hidden" name="cid" value="<?= $r['CID'] ?>">
                                <input type="hidden" name="sno" value="<?= $r['SNO'] ?>">
                                <td><button type="submit" class="btn btn-primary">詳細</button></td>
                            </tr>
                            </form>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="Category.php" class="btn btn-secondary">
                        戻る
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>