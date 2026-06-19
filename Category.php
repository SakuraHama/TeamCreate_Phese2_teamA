<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" .DB_HOST. "; dbname=". DB_NAME. "; charset=" .DB_CHARSET. ";";

try{

    $result = [];
    $pdo = new PDO($dsn,DB_USER,DB_PASS);
    // PDOの動作オプションを指定する
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // SQL文の準備と実行
    $sql = "SELECT * FROM CATEGORY";
    $sta = $pdo->prepare($sql);
    $sta->execute();
    // SQL実行結果の処理
    while($row = $sta->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }
    // PDOオブジェクトを破棄
    $sta = null;
    $pdo = null;
}catch(PDOException $e){
    exit("DBエラー".$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>項目選択画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow-lg p-4 rounded-4">

            <h1 class="text-center mb-4">
                項目選択画面
            </h1>

            <!-- 災害対策 -->
            <?php foreach($result as $r):?>
                <div class="form-check mb-3">
                    <a class="btn btn-primary" href="Step.php?cid=<?=$r['CID']?>"><?=$r['CNAME']?></a>
                    
                    <p class="text-muted ms-4">
                    <?=$r['CDESC']?>
                    </p>

                </div>
            <?php endforeach; ?>

            <!-- Logout Button -->
            <button onclick="location.href='Login.php'" class="btn btn-danger w-100">
                ログアウト
            </button>

        </div>

    </div>

</body>

</html>