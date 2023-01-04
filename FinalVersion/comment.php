<?php
    require_once 'Connect.php';
?>

<?php
    $sql = "SELECT * from TestForComment";
    $result = mysqli_query($dbConnection, $sql);
    $Text = $_POST["Comment"];
    $Num = mysqli_num_rows($result);

    // sql語法存在變數中
    echo $comment;
    $sql = "INSERT INTO  TestForComment (Num, Comment) VALUES ('$Num', '$Text') ";

    $result = mysqli_query($dbConnection,$sql);
    
    // if (mysqli_affected_rows($dbConnection)>0) {
    //     echo "Success";
        
    // }
    // elseif(mysqli_affected_rows($dbConnection)==0) {
    //     echo "無資料新增";
    // }
    // else {
    //     echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($dbConnection);
    // }
    mysqli_close($dbConnection); 
?>

<script> location.href = 'Novel.php';</script>