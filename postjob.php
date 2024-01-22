<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="pj.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/zkzdcrrk598sfvu12dqqlkmuevhqphk2tlw5oakl0iea00rf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    
</head>
<body>
    <?php
        $pdo = new PDO('sqlite:juniorjobs.db');

        $statement = $pdo->query("SELECT * FROM Tags");

        $filters= $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement_extraTags= $pdo->query("SELECT * FROM ExtraTags");
        $filters_exTags= $statement_extraTags->fetchAll(PDO::FETCH_ASSOC);
    ?>

<div class="header"> <a class="text-head"> Junior Jobs </a></div>
<div class="rightsidebar">sidebar </div>


        <div class="main">
            <div class="card">
            <div class="formContain">
            <?php
            if(!isset($_POST['submit'])){
            ?>

            <form  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <label for="title">Job Title</label> </br>
                <span> Example: “Junior Front End Developer".   Titles must describe one position. </span>
               
                <input type="text" id="ftitle" name="title" placeholder="Job Title">
                
                <div class="forCompany">
                <label for="cname"> Company Name </label></br>
                <span> Enter your company or organization’s name. </span>
                <input type="text" id="cname" name="companyName" placeholder="Company Name..">
                </div>
              
                <div class="forSalary">
                    <label for="salary"> Salary </label></br>
                    <span> Please choose a range of salary </span>
                      
                      <select id="ex-dropdown-input" name="salary" autocomplete="off" placeholder="Salary">
                          <option>$10,000 - $24,999</option>
                          <option>$50,000 - $74,999</option>
                          <option> $75,000 - $99,999</option>
                          <option> $100,000 or More </option>
                      </select>
                </div>
                


                <!-- <label for="jdesc">Job description</label> -->
                <!-- <input type="text" id="jdesc" name="jobDescription" placeholder="Job Description"> -->
                <div class="forJobDesc">
                <label for="jdescription"> Describe the job </label></br>
                <span> Please describe the job </span>
                <textarea id="mytextarea" name="jobDescription" style="marginTop: 50px;">Describe the job please </textarea>
                </div>
               

                
                <div class="jobCategory">
                <label for="jcategory">Main Tag</label> </br>
                <span> This will show the main skill you're looking for.   </span>
                <select id="jcategory" name="jobCategory">
                     <?php 
                    foreach ($filters as $row){
                    echo '<option value="' . $row['jobCategory'] . '">' . $row['jobCategory'] . '</option>';
                     }
                    ?>
                </select>
                </div>            
            <div class="more-skills">
            <label for="morecategory">Other tags & skills</label> </br>
            <span> This section is to dail the job's position , it helps increase visiblity and fast research </span></br>
            <select id="select-tags" multiple data-placeholder="Extags Tags, Programming Languages, Skills" name= "skillTag[]" >
		    
			<<option value="senior">
            <?php 
                    foreach ($filters_exTags as $row){
                    echo '<option value="' . $row['skillTag'] . '">' . $row['skillTag'] . '</option>';
                     }
                    ?>

		    
            </select>
            </div>
            <div class="country-continents">

                <label for="country">Country</label></br>
                <span> This job is restricted only for a country, region,etc . e.g you looking for developers from USA or Canada </span>
                    <select id="country" name="country" multiple data-placeholder="Hire emloyees from ..." name= "skillTag[]" >
                        <option value="ww">Wolrd Wide  </option>
                        <option value="australia">Australia  </option>
                        <option value="canada">Asia</option>
                        <option value="usa">USA</option>
                    </select>
            </div>

            <h2> Company's logo (jpg, png, jpeg)</h2>
                <div class="logo-box">
                
                <p> 💾 Upload </p>  
                <input autocomplete="off" type="file" name="image" class="input_company_logo" accept=" .jpg, .png, .jpeg">
                 
                </div>
                <input type="submit" value="submit" name="submit">
                <input type="button" value="preview" onclick='preview(this.form)'>

            </form>
        <?php
            } else{
                try {

                    $f= $_POST["image"];
                    echo $f;
                    $fileName = $_FILES["image"]["name"];
                    $fileSize = $_FILES['image']['size'];
                    $fileTmpName = $_FILES['image']['tmp_name'];
                    
                    $validImageExtension = ['jpg', 'jpeg', 'png'];
                    $imageExtension = explode('.', ''.$fileName);
                    $imageExtension = strtolower(end($imageExtension));
                    if(!in_array($imageExtension, $validImageExtension)){
                        echo "error";
                    }  
                    if($fileSize < 5000000){
                        $newimageName = uniqid();
                        $newimageName = '.' . $imageExtension;
                        $FileDestination = 'img/'.$newimageName;


                        move_uploaded_file($fileTmpName, $FileDestination );

                        $skillTag = $_POST['skillTag'];
                        $skillTag = '<div class="skilljob" >' . implode('</div><div class="skilljob">', $skillTag). "</div>";
    
                        
    
                        $pdo = new PDO('sqlite:juniorjobs.db');
                        $sql = "INSERT INTO junior (title,companyName,salary, jobDescription, jobCategory, country, skillTag, imageCompany) 
                                VALUES (:title, :companyName,:salary, :jobDescription, :jobCategory, :country, ('{$skillTag}'), '$newimageName'  )";
                        //$sql = "INSERT INTO test (title ) VALUES (:title)";
                        // $sql = "INSERT INTO junior (title,companyName,Salary, description,category, jobtype, country) 
                        //         VALUES (:jobtitle, :coname,:salary ,:jdesc ,:jobcategory,:jobtype ,:country)";
                         $stmn = $pdo->prepare($sql);
    
                         $title = filter_input(INPUT_POST, 'title'); 
                         $stmn->bindValue(':title', $title, PDO::PARAM_STR);
    
                         $companyName = filter_input(INPUT_POST, 'companyName'); 
                         $stmn->bindParam(':companyName', $companyName, PDO::PARAM_STR);
    
                        $salary = filter_input(INPUT_POST, 'salary'); 
                        $stmn->bindParam(':salary', $salary, PDO::PARAM_INT);
    
                        $jobDescription = filter_input(INPUT_POST, 'jobDescription'); 
                        $stmn->bindParam(':jobDescription', $jobDescription, PDO::PARAM_STR);
    
                        $jobCategory = filter_input(INPUT_POST, 'jobCategory'); 
                        $stmn->bindParam(':jobCategory', $jobCategory, PDO::PARAM_STR);
    
                        //  $jobtype = filter_input(INPUT_POST, 'jobtype'); 
                        //  $stmn->bindParam(':jobtype', $jobtype, PDO::PARAM_STR);
                        // $skillTag = filter_input(INPUT_POST, 'skillTag'); 
                        // $stmn->bindParam(':skillTag', $skillTag, PDO::PARAM_STR);
    
                        $country = filter_input(INPUT_POST, 'country'); 
                        $stmn->bindParam(':country', $country, PDO::PARAM_STR);
    
    
                        
                         $success = $stmn->execute();
    
                         if ($success) {
                            echo "place added ";
                            
                         }
                         else{
                            echo "somehing wrong";
                         }
                        
    
                        }
                }
                
                catch (PDOException $e) {
                    print "we had error" . $e->getMessage() . "<br/>";
                    die();
                }
                // if (isset($_POST['companyName'])){
                //     $comp = $_POST['companyName'];
                //     echo $comp;
                //     $sql = ("UPDATE ExtraTags SET companyName= '$comp' WHERE skillTag= 'Senior' ");
                //     $stmn = $pdo->prepare($sql);
                //     $stmn->execute();
                //     print_r($sql);

                // }
               
            }

           
        
        ?>

            </div>
          
            </div>
            <!-- <div class="card">
               
            </div> -->
          
        </div>   
</body>

<script>
    // $(document).ready(function(){
    //    $('#submit').click(function(){
    //       $.ajax({
    //             url: '1.php',
    //             data: {finish_product: $('#finish_product').val()},
    //             success: function (result) {
    //                 alert(result)
    //             }
    //         });
    //    });
    // });

    // new TomSelect("#select-tags",{
	// 	plugins: ['remove_button'],
	// 	create: true,
	// 	onItemAdd:function(){
	// 		this.setTextboxValue('');
	// 		this.refreshOptions();
	// 	},
	// 	render:{
	// 		option:function(data,escape){
	// 			return '<div class="d-flex"><span>' + escape(data.value) + '</span><span class="ms-auto text-muted">' + escape(data.date) + '</span></div>';
	// 		},
	// 		item:function(data,escape){
	// 			return '<div>' + escape(data.value) + '</div>';
	// 		}
	// 	}
	// });
    new TomSelect('#select-tags',{
	plugins: {
		remove_button:{
			title:'Remove this item',
		}
	},
	persist: false,
	create: true,
	
    });

    new TomSelect('#country',{
	plugins: {
		remove_button:{
			title:'Remove this item',
		}
	},
	persist: false,
	create: true,
	
    });

tinymce.init({
  selector: '#mytextarea',
  height: 500,
  menubar: false,
 

  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | link',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
new TomSelect('#ex-dropdown-input',{
	plugins: ['dropdown'],
});


	
</script>

</html>




