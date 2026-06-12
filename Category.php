<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>項目選択画面</title>
    <link rel="stylesheet" href="styles/">
</head>

<body>
    <div class="form">
        <h1>項目選択画面</h1>
        <input type="radio" id="disaster" name="category" value="disaster">
            <label for="disaster">災害対策</label>
                <p>防災用品や避難所情報など～</p><br>
        
        <input type="radio" id="location" name="category" value="location">
            <label for="location">住居準備</label>
                <p>部屋探し、契約、住所登録など～</p><br>

        <input type="radio" id="furniture" name="category" value="furniture">
        <label for="furniture">家具準備</label>
            <p>家電購入など～</p><br>

        <div class="form">
            <label for="category">選択した項目:</label>
                <input type="text" id="selectedCategory" name="selectedCategory" readonly>
        </div>
    </div>

    <div>
        <button class="logout" class="card">
            <a href="logout.php"></a>
            ログアウト
        </button>
    </div>

</body>

</html>