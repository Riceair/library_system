<?php
    session_start();
    // 沒登入
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }

    include("../php/connectDB.php");

    $user_account = $_SESSION["account"];
    $user_name = $_SESSION["name"];

    //確認是否為管理員
    error_reporting(0); //不要顯示沒查到東西
    $manger_query = DBQuery("SELECT * FROM manager WHERE user_account='$user_account'")[0];
    $isManger = FALSE;
    if($manger_query !== NULL){
      $isManger = TRUE;
    }

    
    $mode = "0";
    if(isset($_GET["mode"])){
      $mode = $_GET["mode"];
    }
    $user_inf = ""; //給一預設值
    $book_list_query_str = "SELECT book_category.* FROM book_category"; //給一預設值

    // 搜尋處理 //
    if($mode==="0"){
      $search_str = "";
      if(isset($_GET["search"])){
        $search_str = $_GET["search"];
      }
      $select_category = "-1";
      if(isset($_GET["category"])){
        $select_category = $_GET["category"];
      }

      if($search_str===""){ //沒有下搜尋
        $book_list_query_str = "SELECT book.*, book_category.category
                                FROM book, book_category
                                WHERE book.book_caid=book_category.caid";
      }
      else{ //有下搜尋
        $book_list_query_str = "SELECT book.*, book_category.category
                                FROM book, book_category
                                WHERE book.book_caid=book_category.caid AND (book.book_name like '%$search_str%'
                                      OR book.author like '%$search_str%')";
      }

      if($select_category!=="-1"){ //有限制類別
        $book_list_query_str = $book_list_query_str." AND book.book_caid=".$select_category;
      }
    }
    // Section End //
    // 借閱紀錄查詢 //
    elseif($mode==="1"){
      $book_list_query_str = "SELECT book.*, book_category.category, bid, borrow_date, return_date
                              FROM borrow_list, book, book_category
                              WHERE borrow_list.borrow_account='$user_account' AND borrow_list.book_id=book.book_id AND
                                    book.book_caid=book_category.caid";
    }
    // Section End //
    // 新增內容 //
    elseif($mode==="2"){
      $book_list_query_str = "SELECT book.*, book_category.category
                              FROM book, book_category
                              WHERE book.book_caid=book_category.caid";
    }
    // Section End //
    elseif($mode==="3"){
      $user_inf = DBQuery("SELECT * FROM user WHERE user_account='$user_account'");
    }

    $category_list = DBQueryAll("SELECT * FROM book_category");
    $book_list = DBQueryAll($book_list_query_str);
    $borrowed_list = DBQueryAll("SELECT bid, book_id, borrow_account
                                 FROM borrow_list
                                 WHERE return_date is NULL");
?>

<script> //傳送資料給js
    const isManger = <?php echo json_encode($isManger) ?>;
    const mode = <?php echo json_encode($mode) ?>;
    const user_account = <?php echo json_encode($user_account) ?>;
    const category_list = <?php echo json_encode($category_list) ?>;
    const book_list = <?php echo json_encode($book_list) ?>;
    const borrowed_list = <?php echo json_encode($borrowed_list) ?>;
    const user_inf = <?php echo json_encode($user_inf) ?>;
</script>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Library System</title>

    <link rel="canonical" href="../icon/library.png">

    

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/library.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
  <div class="container-fluid">
    <img class="mb-1" src="../icon/library.png" alt="" width="72" height="57">
    <div class="navbar-brand">Library System</div>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">搜尋書籍</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">借閱紀錄</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hidden" href="#" id="manage_book_btn">管理書籍</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">設定</a>
        </li>
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>

    <div id="name_welcome" class="ms-auto link-light">Welcome, <?php echo $user_name; ?></div>
    <u class="ms-auto link-light " id="sign_out">Sign out</u>
  </div>
</nav>


<main class="container">
    
<div class="my-5 p-3 bg-body rounded shadow-sm" id="book_box">
    <!--                                      Search Mode                                      -->
    <div class="d-flex hidden" id="search_section">
        <!-- 搜尋框 -->
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search_input">
        <!-- 下拉式選單(類別) -->
        <div class="dropdown" id="dropdown_section">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="category_dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                All category
            </button>
            <ul class="dropdown-menu" aria-labelledby="category_dropdownMenu" id="category_dropdown_box">
                <li><a class="dropdown-item">All category</a></li>
            </ul>
        </div>
        <!-- 搜尋按鈕 -->
        <button class="btn btn-success" id="search_btn">Search</button>
    </div>

    <!-- 尚未借閱樣板 -->
    <div class="row mb-3 border-bottom hidden NotBorrowed">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          書名
          </div>
          <div class="book_more">作者:  出版項:[高雄市] : 撰者, 民111[2022] 類別:資料探勘</div>
        </div>
      <div class="col-2 themed-grid-col book_other">尚未借閱</div>
      <div class="col-2 themed-grid-col book_other">
        <button type="button" class="btn btn-primary">借閱</button>
      </div>
    </div>

    <!-- 已借閱樣板 -->
    <div class="row mb-3 border-bottom hidden Borrowed">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          書名
          </div>
          <div class="book_more">作者:  出版項:[高雄市] : 撰者, 民110[2021] 類別:深度學習</div>
        </div>
      <div class="col-2 themed-grid-col book_other">已借閱</div>
      <div class="col-2 themed-grid-col book_other">
        <button type="button" class="btn btn-danger">歸還</button>
      </div>
    </div>

    <!-- 通知歸還樣板 -->
    <div class="row mb-3 border-bottom hidden NotifyReturn">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          書名
          </div>
          <div class="book_more">作者:  出版項:[高雄市] : 撰者, 民110[2021] 類別:深度學習</div>
        </div>
      <div class="col-2 themed-grid-col book_other">已借閱</div>
      <div class="col-2 themed-grid-col book_other">
        <button type="button" class="btn btn-warning">通知歸還</button>
      </div>
    </div>

    <!--                                      Section End                                      -->


    <!--                                      Borrowed Mode                                      -->
    <!-- 借閱紀錄上面的column -->
    <div class="row mb-3 border-bottom hidden" id="BorrowListTitle">
      <div class="col-8 themed-grid-col"></div>
      <div class="col-2 themed-grid-col book_other">借閱時間</div>
      <div class="col-2 themed-grid-col book_other">歸還時間</div>
    </div>

    <!-- 借閱紀錄樣板 -->
    <div class="row mb-3 border-bottom hidden BorrowReturn">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          書名
          </div>
          <div class="book_more">作者:  出版項:[高雄市] : 撰者, 民110[2021] 類別:深度學習</div>
        </div>
      <div class="col-2 themed-grid-col book_other">2022/1/2</div>
      <div class="col-2 themed-grid-col book_other">2022/1/2</div>
    </div>
    <!--                                      Section End                                      -->

    
    <!--                                      Manage Mode                                      -->
    <!-- 管理書籍樣板(刪除) -->
    <div class="row mb-4 border-bottom hidden" id="MangeModeSwitch">
      <div class="col-8 themed-grid-col" id="MangeModeSwithGroup">
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-outline-primary active">新增</button>
          <button type="button" class="btn btn-outline-primary">刪除</button>
        </div>
      </div>
    </div>

    <!-- 新增的書本 -->
        <form class="needs-validation hidden" id="AddBookForm" method="post" action="../php/BookAdd.php">
          <div class="row g-3 mb-5">

            <div class="col-12">
              <label class="form-label">作者</label>
              <input type="text" class="form-control" id="add_author" placeholder="作者名稱" name="author" required>
            </div>

            <div class="col-12">
              <label class="form-label">書名</label>
              <input type="text" class="form-control" id="add_book_name" placeholder="書本名稱" name="book_name" required>
            </div>

            <div class="col-12">
              <label class="form-label">出版項</label>
              <input type="text" class="form-control" id="add_publication" placeholder="[高雄市] : 撰者, 民111[2022]" name="publication_item" required>
            </div>

            <!-- <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com">
            </div> -->
            <div class="col-md-5">
              <label class="form-label">類別</label>
              <select class="form-select" id="add_category" name="caname" required>
                <option value="">Choose...</option>
              </select>
            </div>


          </div>

          <button class="w-100 btn btn-primary btn-lg" type="submit">確認新增</button>
        </form>

    <!-- 刪除的書本 -->
    <div class="row mb-3 border-bottom hidden DeleteBook">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          書名
          </div>
          <div class="book_more">作者:  出版項:[高雄市] : 撰者, 民110[2021] 類別:深度學習</div>
        </div>
      <div class="col-2 themed-grid-col book_other">
        <button type="button" class="btn btn-danger">刪除</button>
      </div>
    </div>
    <!--                                      Section End                                      -->

    <!--                                      Setting Mode                                      -->
    <form class="needs-validation hidden" id="SettingForm" method="post" action="../php/SettingUpdate.php">
        <div class="row g-3 mb-5">

          <div class="col-12">
            <label class="form-label">使用者名稱</label>
            <input type="text" class="form-control" placeholder="使用者名稱" name="user_name" required>
          </div>

          <div class="col-12">
            <label class="form-label">使用者帳號</label>
            <input type="text" class="form-control" placeholder="使用者帳號" name="user_account" readonly="true" required>
          </div>

          <div class="col-12">
            <label class="form-label">使用者密碼</label>
            <input type="password" class="form-control" placeholder="使用者密碼" name="user_pwd" required>
          </div>

          <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="you@example.com" name="user_email" required>
          </div>

          <div class="col-12">
            <label class="form-label">電話</label>
            <input type="text" pattern="\d*" maxlength="10" class="form-control" placeholder="電話" name="user_phone" required>
          </div>


        </div>

        <button class="w-100 btn btn-primary btn-lg" type="submit">修改資料</button>
      </form>
    <!--                                      Section End                                      -->

    <div id="NoData" class="hidden"><h4>No Data</h4></div>
</div>
</main>


    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/library_parm.js"></script>
    <script src="../js/library_search.js"></script>
    <script src="../js/library_borrowed.js"></script>
    <script src="../js/library_manage.js"></script>
    <script src="../js/library_setting.js"></script>
    <script src="../js/library.js"></script>
  </body>
</html>
