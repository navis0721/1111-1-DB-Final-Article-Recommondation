<?php
    // 載入db.php來連結資料庫
    require_once 'Connect.php';
?>

<?php
    $sql = "SELECT * from feedback";
    $result = mysqli_query($dbConnection, $sql);

    $ID = mysqli_num_rows($result);
    $book_id = $_POST["book_id"];
    $happy = $_POST["happy"];
    $sad = $_POST["sad"];
    $angry = $_POST["angry"];
    $comment = $_POST["c"];

    // sql語法存在變數中
    $sql = "INSERT INTO  feedback (ID, book_id, comment, happy, sad, angry) VALUES ('$ID', '$book_id' , '$comment', '$happy', '$sad', '$angry') ";
    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    $result = mysqli_query($dbConnection,$sql);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($dbConnection)>0) {
    // 如果有一筆以上代表有更新
    // mysqli_insert_id可以抓到第一筆的id
        $new_id= mysqli_insert_id ($dbConnection);
    }
    elseif(mysqli_affected_rows($dbConnection)==0) {
        echo "無資料新增";
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($dbConnection);
    }  
?>
<?php //把新的一筆回饋加入這本書的心情指數參考
    $book_id = $_POST["book_id"];
    $sql1 = "SELECT * from initial_indicators where `book_id`= $book_id";
    $sql2 = "SELECT * from feedback where `book_id`= $book_id";
    $result1 = mysqli_query($dbConnection,$sql1);
    $result2 = mysqli_query($dbConnection,$sql2);

    $sum=0;
    while ($row = mysqli_fetch_assoc($result2)) {
        $datas[] = $row;
    }
    $happy_ttl = 0;
    $sad_ttl = 0;
    $angry_ttl = 0;
    mysqli_free_result($result2);
    foreach ($datas as $key => $row){
        $happy_ttl += $row['happy'];
        $sad_ttl += $row['sad'];
        $angry_ttl += $row['angry'];
        $sum += 1;
    }

//換算各項心情指數，使其維持三項心情指數總和為100
    $happy_final = $happy_ttl/$sum;
    $sad_final = $sad_ttl/$sum;
    $angry_final = $angry_ttl/$sum;
    $ttl = $happy_final+$sad_final+$angry_final;
    $happy_final = $happy_final/$ttl*100;
    $sad_final = $sad_final/$ttl*100;
    $angry_final = $angry_final/$ttl*100;

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $datas1[] = $row1;
    }
    foreach ($datas1 as $key => $row1){
        $happy_ori = $row1['happy'];
        $sad_ori = $row1['sad'];
        $angry_ori = $row1['angry'];
    }//回饋和原先的指數依照不同比重，算出新的心情指數
    $happy_update = $happy_final*0.01+$happy_ori*0.99;
    $sad_update = $sad_final*0.01+$sad_ori*0.99;
    $angry_update = $angry_final*0.01+$angry_ori*0.99;

    $sql2 = "UPDATE  indicators SET happy = '$happy_update',sad = '$sad_update', angry = '$angry_update' WHERE book_id=$book_id";
    $result2 = mysqli_query($dbConnection,$sql2);
    
    mysqli_close($dbConnection); 
?>
<?php
echo "<script>alert('已送出！感謝您的填寫'); location.href = 'survey.html';</script>";
?>