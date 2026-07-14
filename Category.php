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
    $sql = "SELECT * FROM CATEGORY";
    $sta = $pdo->prepare($sql);
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

    <title>項目選択画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/category.css">
</head>
<body class="white">

    <!-- Paw Background -->
    <img src="images/pawblue.png" class="paw-bg paw-left" alt="">
    <img src="images/pawblue.png" class="paw-bg paw-right" alt="">

    <div class="container mt-5">

        <div class="text-center mb-5">

            <img src="images/logo_transparent.png"
                class="logo-img"
                alt="Life Step">
                <h1 class="text-primary">暮らすてっぷ</h1>
            <p class="text-muted mt-3">
                暮らすてっぷへようこそ！🐾
            </p>

            <h2 class="fw-bold mt-4 h4">
                項目を選択してください
            </h2>

        </div>

        <?php foreach ($result as $r): ?>

            <a href="Step.php?cid=<?=$r['CID']?>"
               class="text-decoration-none">

                <div class="category-card">

                    <div class="d-flex align-items-center">

                        <div class="flex-grow-1">

                            <h4 class="category-title mb-2">
                                <?= htmlspecialchars($r['CNAME']) ?>
                            </h4>

                            <p class="category-desc mb-0">
                                <?= htmlspecialchars($r['CDESC']) ?>
                            </p>

                        </div>

                        <div class="arrow">
                            ➜
                        </div>

                    </div>

                </div>

            </a>

        <?php endforeach; ?>

    </div>

    <button onclick="location.href='Logout.php'"
        class="btn btn-danger w-10 position-absolute end-0 top-0 m-4">
        ログアウト
    </button>

</body>

</html>