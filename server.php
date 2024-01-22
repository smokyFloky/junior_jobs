
        <?php
       // 
    $l=0;
    $pdo = new PDO('sqlite:juniorjobs.db');
    
        //echo $result;
        // $rows = $result->rowCount();

        // echo $rows;
        //$filters= $result->fetchAll(PDO::FETCH_ASSOC);
        if(isset($_POST['input'])){

        $input = $_POST['input'];
        //echo $input;
        //$query = "SELECT * FROM junior WHERE title LIKE '{$input}'";
        $statement = $pdo->query("SELECT * FROM junior WHERE title LIKE '%{$input}%'");
        //echo $result;
       
        $filters= $statement->fetchAll(PDO::FETCH_ASSOC);
        $l = count($filters);
        //echo $l;
        if($l>0){
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
        }
        }

    
    // if(isset($_POST['input'])){
    //     $input = $_POST['input'];
    //     echo $input;
    //     //$query = "SELECT * FROM junior WHERE title LIKE '{$input}'";
    //     $result = $pdo->query("SELECT * FROM junior WHERE title = '" . $input ."'");
    //     //echo $result;
    //     $rows = $result->rowCount();

    //     echo $rows;

    //     $result = $pdo->$query;
    //     if($rows>0){
    //         while($row = $result -> fetch(PDO::FETCH_ASSOC)){
    //         echo "<p class='text_title'>  ". $row['title']."</p>";
    //         echo "<p class='text_companyName'> ". $row['companyName']."</p>";
    //         }
    //     }else{
    //         echo "fail";
    //     }
    // }

    //$statement = $pdo->query("SELECT  title, companyName, country FROM junior");

    //$filters= $statement->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($filters);
    
    // $json_array = array();
    // while($row = $statement -> fetch(PDO::FETCH_ASSOC)){
    //     $json_array[]= $row['title'];

    // }
    //header('Content-type: application/json');
    
    //json_encode($json_array);
    //echo json_encode($json_array);
    
// $data = ["name" => "John Doe", "age" => 25];
// header('Content-Type: application/json');
// echo json_encode($data);


    

?>
        
 

