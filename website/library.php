<?php
    session_start();
    if(!isset($_SESSION["account"])){
        header("Location: login.html"); 
        //確保重定向後，後續代碼不會被執行 
        exit;
    }
?>

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
          <a class="nav-link active" href="#">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Borrow</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Manage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Setting</a>
        </li>
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>

    <div id="name_welcome" class="ms-auto link-light">Welcome, DiH</div>
    <u class="ms-auto link-light " id="sign_out">Sign out</u>
  </div>
</nav>


<main class="container">
    
<div class="my-5 p-3 bg-body rounded shadow-sm">
    
    <div class="row mb-3 border-bottom NotBorrowed">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          利用位元向量從產品資料庫有效探勘具約束條件之可篩除項目集(Efficiently Mining Constrained Erasable Itemsets from a Product Database by Bit Vectors)
          </div>
          <div class="book_more">作者:李凱鈞  出版項:[高雄市] : 撰者, 民111[2022]</div>
        </div>
      <div class="col-2 themed-grid-col book_other">尚未借閱</div>
      <div class="col-2 themed-grid-col book_other">
        <button type="button" class="btn btn-primary">借閱</button>
      </div>
    </div>

    <div class="row mb-3 border-bottom Borrowed">
      <div class="col-8 themed-grid-col">
          <div class="book_name">
          應用生成深度網路於類別遞增式學習(Applying Generative Deep Networks to Class-incremental Learning)
          </div>
          <div class="book_more">作者:許悅佳  出版項:[高雄市] : 撰者, 民110[2021]</div>
        </div>
      <div class="col-2 themed-grid-col book_other">已借閱</div>
      <div class="col-2 themed-grid-col book_other">
        <button type="button" class="btn btn-secondary">歸還</button>
      </div>
    </div>
</div>
</main>


    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->
  </body>
</html>
