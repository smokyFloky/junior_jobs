<?php
$xml = simplexml_load_file("rss-indeed.xml") or die("CANT LOAD XML");
$pdo = new PDO('sqlite:juniorjobs.db');

$data = json_decode($xml);
foreach($xml as $record){
    $xml = $xml-> channel;
    echo $xml;
    $array = $xml->item[1]->title." | ";
    echo gettype($array);
    
    
    for($i=0; $i<count($xml->item);$i++){
        $array = $xml->item[$i]->title." / ".$xml->item[$i]->pubDate." / ".$xml->item[$i]->link." / ".$xml->item[$i]->description;
        $str = explode(" | ", $array);
        //print_r($str);
        
        $k = explode(" / ",$str[0]);

        //
         ($k);
        $l = explode(" - ",$k[0]);
        //print_r ("i start here ");
        //print_r ($l);
        // $o = explode(" - ",$l[0]);
        // print_r ("i start here ");
        // print_r ($o);
        print_r ("im here too ");
        $result = array_merge((array)$k, (array)$l);
        array_shift($result);
        print_r($result);
        //print_r(sizeof($result));
        $job = $result[3];
        $company =$result[4];
        $city = $result[5]; //can be onsite or remote
        $date= $result[0];
        $link = $result[1];
        $desciption= $result[2];
        

        $sql = "INSERT INTO junior ('title', 'companyName','jobDescription' ,'country','pubDate','link')  
        VALUES ('$job', '$company', '$desciption' ,'$city', '$date', '$link' )";
        
        $stmn = $pdo->prepare($sql);
        $success = $stmn->execute();
        if($success){
           print_r("it is added");
          
         }

    


    
        
      
       
 
    }
//     $a = array('Junior Software Developer - Prescient Edge Federal - McLean, VA', ' Fri, 24 Feb 2023 10:48:15 GMT','https://www.indeed.com/viewjob?t=Junior+Software+Developer&c=Prescient+Edge+Federal&l=McLean,+VA&jk=e59ba73253158ed7&rtk=1hje5oe9d2e1a000&from=rss');
//     //print_r ($a[0]);
//     print_r($a[1]);
 //                                                       ************************************************************                      
//     $str = explode(" - ", $a[0]);                     |************ THIS BLOC OF CODE FOR ONE ITEM ****************|
//     print_r($str);
//     $job = $str[0];
//     $company =$str[1];
//     $city = $str[2];
//     $date= $a[1];
//     $link = $a[2];
//   // 
 


    
}

//$data_dummy = $xml->channel->item[0]->title; // An array with two elements


?>