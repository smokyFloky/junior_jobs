<form id="htmlForm" action="kw.php" method="post"> 
    Message: <input type="text" name="message" value="Hello HTML" /> 
    Message2: <input type="text" name="message2" value="Test2" /> 
    <input type="submit" value="Echo as HTML" /> 
</form>
<?php 
 echo "<div class='card'>";
echo '<div style="background-color:#ffa; padding:20px">' . $_POST['message'] . '</div>'; 
echo '<div style="background-color:#ffa; padding:20px">' . $_POST['message2'] . '</div>'; 

echo '<input type = "submit" value="sub" />';
echo "</div>";
?>

<div id="htmlExampleTarget"> </div>
</body>

<script>
    $(document).ready(function() { 
    // bind form using ajaxForm 
    $('#htmlForm').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#htmlExampleTarget', 
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('#htmlExampleTarget').fadeIn('slow'); 
        } 
    }); 
});
</script>
$job = $emptyArray[3];
    $company =$emptyArray[4];
    $city = $emptyArray[5]; //can be onsite or remote
    $date= $emptyArray[0];
    $link = $emptyArray[1];
    $desciption= $emptyArray[2];


    $sql = "INSERT INTO test ('jobName', 'companyName', 'city','datePost','link','location','description')  
                    VALUES ('$job', '$company', '$city', '$date', '$link', '$city', '$city' )";

    $stmn = $pdo->prepare($sql);
    $success = $stmn->execute();
    if($success){
        print_r("it is added");
  
    }

