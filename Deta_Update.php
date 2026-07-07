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

    $sql = "SELECT ACHIEVE FROM ACHIEVEMENT WHERE CID = :cid and SNO = :sno and DNO = :dno and USER_NO = :user_no;";
    $sta = $pdo->prepare($sql);
    $sta->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta->bindParam(':dno', $d, PDO::PARAM_STR);
    $sta->bindParam(':user_no', $user_no, PDO::PARAM_STR);

    $result = [];

    foreach($dno as $i){
        $d = $i;
        $sta->execute();
        $result = $sta->fetchall(PDO::FETCH_ASSOC);
    }

    var_dump($result);
    $sql2 = "";
    foreach ($result as $r) {
        if ($r['ACHIEVE'] == 0) {
            $sql2 = "UPDATE ACHIEVEMENT SET ACHIEVE = true WHERE CID = :cid and SNO = :sno and DNO = :dno and USER_NO = :user_no;";
        } else {
            $sql2 = "UPDATE ACHIEVEMENT SET ACHIEVE = false WHERE CID = :cid and SNO = :sno and DNO = :dno and USER_NO = :user_no;";
        }
    }
    $sta2 = $pdo->prepare($sql2);
    $sta2->bindParam(':cid', $cid, PDO::PARAM_STR);
    $sta2->bindParam(':sno', $sno, PDO::PARAM_STR);
    $sta2->bindParam(':dno', $d, PDO::PARAM_STR);
    $sta2->bindParam(':user_no', $user_no, PDO::PARAM_STR);
    foreach ($dno as $i) {
        $d = $i;
        $sta2->execute();
    }
    // PDOオブジェクトを破棄
    $sta = null;
    $pdo = null;

    //header('Location: Detail.php', true, 307);
    exit;
} catch (PDOException $e) {
    exit("DBエラー" . $e->getMessage());
}
