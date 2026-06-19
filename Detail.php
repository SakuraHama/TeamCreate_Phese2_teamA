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
    $sno = filter_input(INPUT_GET,"sno",FILTER_DEFAULT);
    echo ($cid);
    echo ($sno);
    $sql = "SELECT * FROM STEP_DETAIL where cid = :cid and sno = :sno";
    $sta = $pdo->prepare($sql);
    $sta ->bindParam(':cid',$cid,PDO::PARAM_STR);
    $sta ->bindParam(':sno',$sno,PDO::PARAM_STR);
    $sta->execute();
    // SQL実行結果の処理
    while($row = $sta->fetch(PDO::FETCH_ASSOC)){
        $result[] = $row;
    }
    var_dump($result);
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
    <title>詳細画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
</head>
</head>

<body>
    <h1>詳細画面</h1>
    <p>
        ここに詳細な情報が表示されます。
    </p>
    <?php foreach($result as $r):?>
    <div>
        <h2><?=$r['DETAIL']?></h2>
        <input type="checkbox" id="item1" name="items[]" value="">
    </div>
    <?php endforeach;?>

    <a href="Step.php"><button>戻る</button></a>
    <button type="submit">登録</button>

</body>

</html>