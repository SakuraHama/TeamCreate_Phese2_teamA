<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . DB_CHARSET . ";";

$user_name = filter_input(INPUT_POST, "user_name");

$password = filter_input(INPUT_POST, "password");
$password_check = filter_input(INPUT_POST, "password_check");


if (isset($_POST['createbtn'])) {
    try {

        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        // PDOの動作オプションを指定する

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // SQL文の準備と実行

        // SQL実行結果の処理
        $message = "";
        if ($user_name != "" && $password != "" && $password_check != "") {
            if ($password == $password_check) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO USER (UNAME,PASS) VALUES(:user_name,:password);";
                $sta = $pdo->prepare($sql);

                $sta->bindParam(':user_name', $user_name, PDO::PARAM_STR);
                $sta->bindParam(':password', $password, PDO::PARAM_STR);

                $sta->execute();
                $message = "登録が完了しました。";

                $sql2 = "SELECT LAST_INSERT_ID() as uno;";
                $sta2 = $pdo->prepare($sql2);
                $sta2->execute();

                $uno = $sta2->fetch(PDO::FETCH_ASSOC);

                $cstep_d = [];
                $sql3 = "SELECT cid,sno,COUNT(*) as cs FROM STEP_DETAIL GROUP BY CID,SNO;";
                $sta3 = $pdo->prepare($sql3);
                $sta3->execute();

                while ($row = $sta3->fetchall(PDO::FETCH_ASSOC)) {
                    $cstep_d = $row;
                }

                $sql4 = "INSERT INTO ACHIEVEMENT (CID,SNO,DNO,USER_NO,ACHIEVE) values (:csd_cid,:csd_sno,:i,:uno,0)";

                $sta4 = $pdo->prepare($sql4);
                $sta4->bindParam(":csd_cid", $cid2, PDO::PARAM_STR);
                $sta4->bindParam(":csd_sno", $csd2, PDO::PARAM_STR);
                $sta4->bindParam(":i", $i2, PDO::PARAM_STR);
                $sta4->bindParam(":uno", $uno['uno'], PDO::PARAM_STR);

                foreach ($cstep_d as $csd) {
                    $cid2 = $csd['cid'];
                    $csd2 = $csd['sno'];
                    for ($i = 1; $i <= $csd['cs']; $i += 1) {
                        $i2 = $i;
                        $sta4->execute();
                    }
                }
            } else {
                $message = "パスワードが確認と異なります。";
            }
        } else {
            $message = "ユーザー情報を入力してください。";
        }
        // PDOオブジェクトを破棄
        $sta = null;
        $pdo = null;
    } catch (PDOException $e) {
        exit("DBエラー" . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>アカウント作成画面</title>
</head>

<body class="bg-light">

    <!-- Header -->
    <header class="bg-primary text-white py-4 shadow">
        <div class="container">
            <h1 class="h3">アカウント作成</h1>
        </div>
    </header>
    <div class="container mt-5 card shadow-lg p-4 rounded-4">

        <form action="create_account.php" method="POST">
            <div>

                <div class="form-check mb-3">

                    <label>ユーザー名</label><br>

                    <input type="text" placeholder="ユーザー名を入力" name="user_name" class="form-control">

                </div>

                <div class="form-check mb-3">

                    <label>パスワード</label><br>

                    <input type="password" placeholder="パスワードを入力" name="password" class="form-control">

                </div>

                <div class="form-check mb-3">

                    <label>確認</label><br>

                    <input type="password" placeholder="確認" name="password_check" class="form-control">

                </div>

                <div class="form-check mb-3 position-relative">

                    <input class="position-absolute btn btn-primary w-25" type="submit" name="createbtn" value="作成">

                </div>

                <div class="text-center">

                    <?php

                    if (isset($message)) {
                        echo ($message);
                    }

                    ?>

                </div>

            </div>

        </form>

        <div class="mb-4 position-relative">

            <a href="Login.php"><button class="btn btn-secondary position-absolute end-0">戻る</button></a>

        </div>

    </div>

</body>

</html>