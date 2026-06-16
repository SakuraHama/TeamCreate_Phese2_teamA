<?php
require_once __DIR__ . "/def.php";
$dsn = "mysql:host=" .DB_HOST. "; dbname=". DB_NAME. "; charset=" .DB_CHARSET. ";";


$user_name = filter_input(INPUT_POST,"user_name");

$password = filter_input(INPUT_POST,"password");
if(isset($_POST['loginbtn'])){
    try{
    
        $result = [];
        $pdo = new PDO($dsn,DB_USER,DB_PASS);
        // PDOの動作オプションを指定する

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // SQL文の準備と実行

        $sql = "SELECT * FROM user where uname = :user_name";

        $sta = $pdo->prepare($sql);

        $sta ->bindParam(':user_name',$user_name,PDO::PARAM_STR);

        $sta->execute();
        // SQL実行結果の処理
        $result = $sta->fetch(PDO::FETCH_ASSOC);
        $message = "";
        if($user_name != "" && $password != ""){
            if($result != false){
                if(password_verify($password,$result["PASS"])){
                    $message = "認証に成功しました。";
                    header('Location: Category.php');
                }else{
                    $message = "ユーザー名、またはパスワードが違います。";
                }
            }else{
                $message = "ユーザー名、またはパスワードが違います。";
            }
        }else{
            $message = "ユーザー情報を入力してください。";
        }
        // PDOオブジェクトを破棄
        $sta = null;
        $pdo = null;
    }catch(PDOException $e){
        exit("DBエラー".$e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>

<body class="bg-light">

    <div class="class=container mt-5">

        <form action="Login.php" method="POST">

            <div class="card shadow-lg p-4 rounded-4">

                <h1 class="text-center mb-4">

                    ログイン

                </h1>

                <div class="form-check mb-3">

                    <label class="mt-4">ユーザー名</label><br>

                    <input type="text" placeholder="ユーザー名" class="form-control" name="user_name">

                </div>

                <div class="form-check mb-3 position-relative">

                    <label>パスワード</label><br>

                    <input type="password" placeholder="パスワード" class="form-control " name="password" id="pass">

                    <span id="eye" class="position-absolute top-50 end-0 m-1 fa fa-eye-slash"></span>

                </div>
                
                <div class="form-check mb-3 position-relative">

                    <input type="submit" name="loginbtn" value="ログイン" class="position-absolute btn btn-primary w-25">

                </div>

                <p class="text-center mb-4">

                    <?php

                        if(isset($message))echo $message;

                    ?>

                <p>

                <div class="text-center mb-4">

                    <a href="create_account.php">
                        <p>アカウントをお持ちでない方はこちら<p>
                    </a>

                </div>

            </div>

        </form>

    <div>

<script>
    $(function(){
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
</script>
</body>

</html>