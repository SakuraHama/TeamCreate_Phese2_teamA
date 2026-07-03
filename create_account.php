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

                $sql2 = "SELECT LAST_INSERT_ID();";
                $sta2 = $pdo->prepare($sql2);
                $sta2->execute();

                $uno = $sta2->fetch(PDO::FETCH_ASSOC);

                $sql3 = "SELECT COUNT(DNO) FROM STEP_DETAIL GROUP BY CID;";
                $sta3 = $pdo->prepare($sql3);
                $sta3->execute();
                $csteps[] = $sta3->fetchall(PDO::FETCH_ASSOC);
                foreach ($csteps as $step) {
                    for ($i = 0; $i < $step; $i += 1) {
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/register.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
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

                <img src="images/life_steplogo.png"
                    class="logo-img"
                    alt="Life Step">

            </div>

            <form action="create_account.php" method="POST">
                <div class="mb-4">

                    <label class="form-label">ユーザー名</label><br>

                    <input type="text" placeholder="ユーザー名を入力" name="user_name" class="form-control" required>

                </div>

                <div class="mb-4">

                    <label class="form-label">パスワード</label><br>

                    <input type="password" placeholder="パスワードを入力" name="password" class="form-control" required>

                </div>

                <div class="mb-4">

                    <label class="form-label">確認</label><br>

                    <input type="password" placeholder="確認" name="password_check" class="form-control">

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

</body>

</html>