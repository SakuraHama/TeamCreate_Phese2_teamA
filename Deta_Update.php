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

    //選択された項目が達成か非達成か判定するための情報を取得する
    $sql = "SELECT * FROM ACHIEVEMENT WHERE CID = :cid and SNO = :sno and DNO = :dno and USER_NO = :user_no;";
    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta->bindParam(':dno', $d, PDO::PARAM_STR);
    $sta->bindParam(':user_no', $user_no, PDO::PARAM_STR);

    $result = [];

    foreach ($dno as $i) {
        $d = $i;
        $sta->execute();
        foreach ($sta->fetchall(PDO::FETCH_ASSOC) as $s) {
            $result[] = $s;
        }
    }

    $tf = 1;
    //達成状況を変更するためのアップデート文を用意
    $sql2 = "UPDATE ACHIEVEMENT SET ACHIEVE = :tf WHERE CID = :cid and SNO = :sno and DNO = :dno and USER_NO = :user_no;";

    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':tf',$tf,PDO::PARAM_STR);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta2->bindParam(':dno', $d, PDO::PARAM_STR);
    $sta2->bindParam(':user_no', $user_no, PDO::PARAM_STR);
    
    foreach ($result as $r) {
        $d = $r['DNO'];
        //非達成状態であればtrueに変更するため、達成状態であればfalseに、　$tfの値を分岐する
        if ($r['ACHIEVE'] == 0) {
            $tf = 1;
        } else {
            $tf = 0;
        }
        $sta2->execute();
    }
    // PDOオブジェクトを破棄
    $sta = null;
    $sta2 = null;
    $pdo = null;

    header('Location: Detail.php', true, 307);
    exit;
} catch (PDOException $e) {
    exit("DBエラー" . $e->getMessage());
}
