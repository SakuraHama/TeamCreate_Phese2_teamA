<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細画面</title>
</head>
<body>
    
<body>
  <!-- ▼▼ヘッダー▼▼--------------------------------- -->
  <header class="bg-info">
    <div class="text-light ms-5 pt-5 pb-3">
      <h1 class="h6">詳細画面</h1>
      <h2 class="pt-3">step by step</h2>
    </div>
  </header>
  <!-- ▲▲ヘッダー▲▲--------------------------------- -->
 
  <div class="container-field">
    <div class="row border h-75">
      <div class="col-3 border">
        <form action="kadai08_1.php" method="GET" class="mt-5 m-3">
 
          <!-- 検索 -->
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="searchType" id="searchRadio1" value="1"
            onclick="typeCheck();">
            <label class=" form-check-label" for="searchRadio1">1</label>
          </div>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="searchType" id="searchRadio1" value="1"
            onclick="typeCheck();">
            <label class=" form-check-label" for="searchRadio1">2</label>
          </div>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="searchType" id="searchRadio1" value="1"
            onclick="typeCheck();">
            <label class=" form-check-label" for="searchRadio1">3</label>
          </div>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="searchType" id="searchRadio1" value="1"
            onclick="typeCheck();">
            <label class=" form-check-label" for="searchRadio1">4</label>
          </div>
          <div class="form-check form-check-inline mb-3">
            <input class="form-check-input" type="radio" name="searchType" id="searchRadio2" value="2"
            
            onclick="typeCheck();">
            <label class="form-check-label" for="searchRadio2">5</label>
          </div>
 
          <div class="input-group mb-3">
            <span class="input-group-text"></span>
            <input type="text" class="form-control" name="price" id="price" value="">
            <span class="input-group-text"></span>
          </div>
 
          <div class="input-group mb-3">
            <label class="input-group-text mb-3" for="category"></label>
            <select class="form-select mb-3" name="category" id="category">
              <option value="1"
              ></option>
              <option value="2"
              ></option>
              <option value="3"
              ></option>
            </select>
          </div>
 
          <div class="row">
            <div class="pt-5 px-0 d-grid gap-2 d-md-flex justify-content-md-end">
              <input class="btn btn-primary btn-lg" onclick="logout()" type="submit" value="ログアウト">
              <!-- <a class="btn btn-secondary btn-lg" href="category.php"></a> -->
            </div><!-- .p-5 d-grid gap-2 d-md-flex justify-content-md-end -->
          </div><!-- .row -->
 
        </form>
      </div><!-- .col-3 border -->
 
      <div class="col-9 border">
 
        <table class="table table-hover mt-5 form-control-lg">
          <thead class="table-light text-secondary">
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           
            <tr>
              <td></a></td>
              <td></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
 
</body>

</html>
</body>
</html>