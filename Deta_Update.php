<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

session_start();
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS);

    //ユーザIDを取得しておく
    $user_no = $_SESSION['id'];
    // PDOの動作オプションを指定する
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // SQL文の準備と実行
    $cid = filter_input(INPUT_POST, "cid", FILTER_DEFAULT);
    $sno = filter_input(INPUT_POST, "sno", FILTER_DEFAULT);
    $dno = $_POST['items'];
    
    foreach($dno as $i){
        $sql = "INSERT INTO Achievement (CID,SNO,DNO,USER_NO,ACHIEVE) VALUES (:cid,:sno,:dno,:user_no,1)";
        $sta = $pdo->prepare($sql);
        $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
        $sta->bindParam(':sno', $sno, PDO::PARAM_STR);
        $sta->bindParam(':dno',$i,PDO::PARAM_STR);
        $sta->bindParam(':user_no', $user_no, PDO::PARAM_STR);
        $sta->execute();
    }
    // PDOオブジェクトを破棄
    $sta = null;
    $pdo = null;

    header('Location: Detail.php', true, 307);
    exit;
} catch (PDOException $e) {
    exit("DBエラー" . $e->getMessage());
}

?>