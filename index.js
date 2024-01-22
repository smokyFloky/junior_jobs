$(document).ready(function(){
    $("#inputfield").keyup(function(){
        var input = $(this).val();
        //alert(input);
        if(input !="" || input =="" ){
            $.ajax({
                url:"http://127.0.0.1:8000/server.php",
                method:"POST",
                data:{input: input},

                success:function(data){
                    $("#cards-container").html(data);
                }
            })
        }

      
    })

})








// $("#inputfield").autocomplete({
//     source: function(request, response){
//         $.ajax({
//             url:'http://127.0.0.1:8000/server.php',
//             type:'GET',
//             dataType:'json',
//             data:{
//                 term: request.term
//             },
//             success:function(data){
//                 //response( data );
//                 //console.log(data)
//                 var results = $.ui.autocomplete.filter(data, request.term)
//                 response(results)
//                 console.log(results);

//             }
            
          
    
//         })
//     },
//     minLength: 2,
//     onSelect: function( event, ui ) {
//         //event.preventDefault();

//       console.log( "Selected: " + ui.item.title);
//     },
    
//     // focus: function(event, ui) {
//     //     event.preventDefault();
//     //      $('#inputfield').val(ui.item.title);
//     // }

       
    
// })


// $.ajax({
//               url:'http://127.0.0.1:8000/server.php',
//                 type:'GET',
//                 dataType:'json',
//                 success:function(data){
//                     console.log(data)
//                 }
                
//             })

//console.log("what")