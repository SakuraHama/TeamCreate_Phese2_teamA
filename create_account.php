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

                //作成されたアカウントのIDを取得する
                $sql2 = "SELECT LAST_INSERT_ID() as uno;";

                $sta2 = $pdo->prepare($sql2);
                $sta2->execute();

                $uno = $sta2->fetch(PDO::FETCH_ASSOC);
                $cstep_d = [];

                //STEP_DETAIL表からそれぞれのカテゴリー、ステップごとのステップの個数を取得する
                $sql3 = "SELECT cid,sno,COUNT(*) as cs FROM STEP_DETAIL GROUP BY CID,SNO;";
                $sta3 = $pdo->prepare($sql3);
                $sta3->execute();

                while ($row = $sta3->fetchall(PDO::FETCH_ASSOC)) {
                    $cstep_d = $row;
                }
                
                //ACHIEVEMENT表にすべてのステップの達成状況がfalseであるデータを挿入
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
        $sta2 = null;
        $sta3 = null;
        $sta4 = null;
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/register.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <title>アカウント作成画面</title>
</head>

<body class="bg-light">

    <!-- Header -->
    <!-- <header class="bg-primary text-white py-4 shadow">
        <div class="container">
            <h1 class="h3">アカウント作成</h1>
        </div>
    </header> -->

    <div class="login-wrapper">

        <div class="login-card">

            <!-- Logo -->
            <div class="logo text-center">

                <img src="images/logo_transparent.png"
                    class="logo-img"
                    alt="Life Step">

                    <h1 class="text-primary h2">暮らすてっぷ</h1>
            </div>

            <form action="create_account.php" method="POST">
                <div class="mb-4">

                    <label class="form-label">ユーザー名</label><br>

                    <input type="text" placeholder="ユーザー名を入力" name="user_name" class="form-control" required>

                </div>

                <div class="mb-4 position-relative">

                    <label class="form-label">パスワード</label><br>

                    <input type="password" placeholder="パスワードを入力" name="password" class="form-control" id="pass" required>

                    <span id="eye" class="position-absolute top-50 end-0 m-1 me-3 mt-2 fa fa-eye-slash"></span>
                </div>

                <div class="mb-4 position-relative">

                    <label class="form-label">確認</label><br>

                    <input type="password" placeholder="確認" name="password_check" class="form-control" id="cpass">

                    <span id="eye2" class="position-absolute top-50 end-0 m-1 me-3 mt-2 fa fa-eye-slash"></span>
                </div>

                <!-- <div class="form-check mb-3 position-relative">

                    <input class="position-absolute btn btn-primary w-25" type="submit" name="createbtn" value="作成">

                </div> -->
                <button type="submit" name="createbtn" class="btn btn-login">　作成</button>

                <div class="text-center">

                    <?php

                    if (isset($message)) {
                        echo ($message);
                    }

                    ?>
                    <a href="Login.php" class="btn btn-register mt-3">戻る</a>

                </div>

            </form>
        </div>  
    </div>

    <script>
        $(function() {
            $('#eye').on('click', function() {
                var pass = $("#pass").attr('type');
                if (pass === "text") {
                    $("#pass").attr('type', 'password');
                    $("#eye").removeClass("fa-eye").addClass('fa-eye-slash');
                } else {
                    $("#pass").attr('type', 'text');
                    $("#eye").removeClass("fa-eye-slash").addClass('fa-eye');
                }
            });
        });
        $(function() {
            $('#eye2').on('click', function() {
                var pass = $("#cpass").attr('type');
                if (pass === "text") {
                    $("#cpass").attr('type', 'password');
                    $("#eye2").removeClass("fa-eye").addClass('fa-eye-slash');
                } else {
                    $("#cpass").attr('type', 'text');
                    $("#eye2").removeClass("fa-eye-slash").addClass('fa-eye');
                }
            });
        });
    </script>
</body>

</html>