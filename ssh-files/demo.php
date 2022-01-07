 <head>
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
</head>

<style>
    .show-read-more .more-text{
        display: none;
    }
</style>

<?php
 
  
  
//   $post = ['batch_id'=> "2"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,'https://www.linkedin.com/talent/thirdPartyJobBoards/235ddc32-1bc2-4b8c-a28e-66c5b66ee285');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
  $json = json_encode($xml);
  $arr = json_decode($json,true);
  
  
$temp = array();
foreach($arr as $k=>$v) {
    $temp[$k] = $v;
}

echo "<h1> something is not well here </h1>";

// foreach($temp['job'] as $data){
    
//     echo "<div>";
//     echo "<h3 style='color:green'>" . $data['title'] .  "</h3>" ;
//     // echo "<div class='show-read-more'>";
//     echo "<p>" . $data['description'] .  "</p>" ;
//     // echo "</div>";
//     echo "<br>" ;
//     echo "<button class='btn btn-warning'>";
//     echo "<a target='_blank' href='". $data['url'] ."'> Apply </a>";
//     echo "</button>" ;
//     echo "</div>";
    
// }

?>

<script>
$(document).ready(function(){
    var maxLength = 100;
    $(".show-read-more").each(function(){
        var myStr = $(this).text();
        if($.trim(myStr).length > maxLength){
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function(){
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });
});
</script>