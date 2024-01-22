
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link rel="stylesheet" href="jr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> 

    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.1/jquery-ui.min.js"></script>

    <script src="index.js" async defer></script>  
  
  

</head>
<body>
<div class="topnav">
    <div class="setoflinks">
       
    <a class="active" href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#resumebuilder">Build Resume </a>
    <a href="#about">About</a>
    <input type="button" value="Post a junior job" class="postJob" id="btnHome" 
        onClick="document.location.href='postjob.php'" />
    </div>
    <div class="searchDiv">
        <input id="inputfield" type="text" placeholder="Search for job ex( Web dev, Data analyst, nft,...)" />
    </div>

   </div>
    <div class="title_top">
        <h2 > Job listings made for <span> Junior </span> only </h2>
    </div>

<?php


    $pdo = new PDO('sqlite:juniorjobs.db');

    $statement = $pdo->query("SELECT * FROM junior");

    $filters= $statement->fetchAll(PDO::FETCH_ASSOC);
    //$l = count($filters);
    
    echo "<div id='cards-container'>";
//NSERT INTO junior (title,companyName,salary, jobDescription, jobCategory, skillTag,country, ) 
    //var_dump($filters);
   
    foreach($filters as $row => $filter){
      
        //echo"<a href='http://127.0.0.1:8000/jobDescribtion.php?id=$filter[idJob]'>";
        echo "<div class='card' >";
        if($filter['imageCompany'] == '' || $filter['imageCompany'] == NULL){
            echo '<img   class="imagecompany" title="'.$filter['imageCompany'].'"  width = 100 height = 100 style="display: none;"/>';
            echo "<p class='text_title'>  ". $filter['title']. "</p>";
            echo "<p class='text_companyName' > ". $filter['companyName']. "</p>";
            echo "<p class='text_companyName'  > Published on : ". $filter['pubDate']. "</p>";    
        } else{
            echo '<img  src="img/'.$filter['imageCompany'].'" class="imagecompany" title="'.$filter['imageCompany'].'"  width = 100 height = 100/>';
            echo "<p class='text_title' style='margin-left: 150px;'>  ". $filter['title']. "</p>";
            echo "<p class='text_companyName' style='margin-left: 150px;'> ". $filter['companyName']. "</p>";
            echo "<p class='text_companyName' style='margin-left: 150px;'> Published on : ". $filter['pubDate']. "</p>";
            echo "<p class='text_companyName' style='margin-left: 150px;>  ". $filter['country']." 👨‍💻 </p>";

            
        }
        
     
        if($filter['country'] == 'Remote'){
            echo "<p class='text_companyName'>  ". $filter['country']." 👨‍💻 </p>";
        } else{
            echo "<p class='text_companyName' style='margin-left: 100px;'>  ". $filter['country']." 📍 </p>";
        }
        
       
        
        //echo "<p class='text_description'> Job description". $filter['jobDescription']."</p>";
        //echo "<p class='text_salary'> Salary ". $filter['salary']."</p>";
        
       
        // echo "<p class='text_category'> Category : <div class='categoryjob'> 
        //         <p class='text_cat'> ". .

        
        //"</p> </div> </p>";
        if($filter['jobCategory'] == '' || $filter['jobCategory'] == NULL){
            echo "<div class='contain-cat-box' style='display:none'>";
            echo "<p class='p_skillTag' >  skills  <div class='categoryjob'> ". $filter['jobCategory']."</div> </p>";
            echo "</div>";
            echo "<a class='apply_button' a href='$filter[link]'> ";
            echo "<div class='forLink'>";
            echo "<p> Apply <p>";
            echo "</div>";

            echo "</a>";

        }else{
            echo "<div class='contain-cat-box'>";
            echo "<p class='p_skillTag' >  skills  <div class='categoryjob'> ". $filter['jobCategory']."</div> </p>";
            echo "</div>";
            echo "<a class='apply_button_else' a href='$filter[link]'> ";
            echo "<div class='forLink_else'>";
            echo "<p> Apply <p>";
            echo "</div>";

            echo "</a>";
        }
      

        
        echo"</a>";
        echo "</div>";
    } 
    echo "</div>";




?>


</html>
