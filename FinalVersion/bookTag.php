<?php
    require_once 'Connect.php';
    session_start();
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['HE'])){
        $type = 1;
        $_SESSION['type'] = 1;
        // echo "success1";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['甜寵'])){
        $type = 2;
        $_SESSION['type'] = 2;
        // echo "success2";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['戀愛'])){
        $type = 3;
        $_SESSION['type'] = 3;
        // echo "success3";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['校園'])){
        $type = 4;
        $_SESSION['type'] = 4;
        // echo "success3";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['輕鬆'])){
        $type = 5;
        $_SESSION['type'] = 5;
        // echo "success3";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['甜文'])){
        $type = 6;
        $_SESSION['type'] = 6;
        // echo "success3";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['日常'])){
        $type = 7;
        $_SESSION['type'] = 7;
        // echo "success3";
    }
    else if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['輕小說'])){
        $type = 8;
        $_SESSION['type'] = 8;
        // echo "success3";
    }
    else{
        $type = $_SESSION['type'];
        // $happy_score = $_POST['happy_score'];
        // $sad_score = $_POST['sad_score'];
        // $angry_score = $_POST['angry_score'];
        // echo "success4";
        // echo $happy_score;
        // echo $sad_score;
        // echo $angry_score;
    }
    // echo "success";
    
?>

<?php

$datas = array();
if($type == 1){
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = 'HE'";
}else if($type == 2){ 
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '甜寵'";
}else if($type == 3){ 
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '戀愛'";
}
else if($type == 4){
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '校園'";
}
else if($type == 5){
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '輕鬆'";
}
else if($type == 6){ 
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '甜文'";
}
else if($type == 7){ 
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '日常'";
}
else if($type == 8){
    $sql = "SELECT book_id, book_name, author FROM `books_tags` NATURAL JOIN `information` WHERE tag = '輕小說'";
}

$result = mysqli_query($dbConnection,$sql);

$data_nums = mysqli_num_rows($result); //總資料數
$per = 10; //一頁10筆
$pages = ceil($data_nums/$per); 

//isset -> 檢查資料是否存在
if (isset($_GET["page"])){ //假如$_GET["page"]未設置
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
} else {
    $page=1; //則在此設定起始頁數
}
$start = ($page-1)*$per; //每一頁開始的資料序號
$result = mysqli_query($dbConnection, $sql.' LIMIT '.$start.', '.$per); //每頁取10筆資料

if ($result) {
    if (mysqli_num_rows($result)>0) {  //資料數>0
        while ($row = mysqli_fetch_assoc($result)) { //從query結果中取資料
            $datas[] = $row; //把每筆資料放入datas[]
        }
    }
    // 釋放資料庫查到的記憶體
    mysqli_free_result($result);
}
else {
    echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($dbConnection);
}
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width", initial-scale=1.>
        <title>小說系統</title>
        <link rel="stylesheet" href="header.css"/>
        <link rel="stylesheet" href="booklist.css"/>
        <link rel="stylesheet" href="page.css"/>
        <!-- <script type="text/javascript" src="data.js" ></script> -->
    </head>
    <body>
        <section id="Row1" class="Row1">
            <div id="header" class="header">
                <h1 id="title" class="title"><a href="Novel.php">Novel Recommend</a></h1>
                <a href="wordcloud.html" class="btn">依類型分</a>
                <a href="#" class="btn">問卷填寫</a>
            </div>
        </section>

        

        <section class="list">
            <?php if(!empty($datas)):  //datas[]非空 ?> 
            
            <?php foreach ($datas as $key => $row) : ?>
                <div class="book"> 
                    <u><h3 class="bookname"><?php echo($key +1 ); ?> <?php echo $row['book_name']; ?></h5></u>
                    <div class="id">ID: <span class="book_id"><?php echo $row['book_id']; ?></span></div>
                    <div class="author">作者： <span class="name"><?php echo $row['author']; ?></span></div>
                    <div class="tagcollec">
                    <?php 
                        $id = $row['book_id'];
                        $bookQ = mysqli_query($dbConnection, "SELECT tag FROM `books_tags` NATURAL JOIN `information` WHERE book_id = $id");
                        while($book = mysqli_fetch_assoc($bookQ)){
                            echo '<div class = "tag">
                                #'.$book['tag'].'<br>
                            </div>';
                        }
                    ?>
                </div>
                </div>
            <?php endforeach; ?>
            <?php else:  ?>
            查無資料
            <?php endif; ?>
        </section>

    </body>
    <!-- 代表結束連線 -->
    <?php mysqli_close($dbConnection); ?>
    
</html>


<div class="page-icon">
<?php
    //分頁頁碼
    // echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    }
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>
</div>
