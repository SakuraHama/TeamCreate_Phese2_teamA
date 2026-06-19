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
    $cid = filter_input(INPUT_GET,"cid",FILTER_DEFAULT);
    $sql = "SELECT * FROM STEP where cid = :cid";
    $sta = $pdo->prepare($sql);
    $sta ->bindParam(':cid',$cid,PDO::PARAM_STR);
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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-light">

    <!-- Header -->
    <header class="bg-primary text-white py-4 shadow">
        <div class="container">
            <h1 class="h3">ステップ画面</h1>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header bg-info text-white">
                <h4 class="mb-0">災害対策</h4>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ステップ</th>
                            <th>内容</th>
                            <th>状態</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($result as $r):?>
                        <tr>
                            <td><?=$r['SNO']?></td>
                            <td><?=$r['SNOTE']?></td>
                            <td></td>
                            <td><a href="Detail.php?cid=<?=$r['CID']?>&sno=<?=$r['SNO']?>"><button>詳細</button></a></td>
                        </tr>
                        <?php endforeach?>
                        <!-- <tr>
                            <td>2</td>
                            <td>避難所を確認する</td>
                            <td>未完了</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>緊急連絡先を登録する</td>
                            <td>未完了</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>非常食を備蓄する</td>
                            <td>未完了</td>
                        </tr> -->
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-4">
                    <a href="Category.php" class="btn btn-secondary">
                        戻る
                    </a>

                    <a href="Login.php" class="btn btn-danger">
                        ログアウト
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>
</html>