<?php
 include_once "../classes/Employee.php";
 $em = new Employee();

 if (isset($_POST['value'])) {
 	$id = $_POST['value'];
 	if(is_numeric($id)){
 		$result = $em->Search_Customer_Mobile_1821($id,'1');
 	}else{
 		$result = $em->Search_Customer_Mobile_1821($id,'1','name');
 	}
 	if ($result) {
 		echo "<div class='autocom'> <ul class='countryList'>";
 		while ($data = $result->fetch(PDO::FETCH_OBJ)) {
 			echo "<li>".$data->name.' (<a>'.$data->phone."</a>)</li>";
 		}
 		echo "</ul></div>";
?>

<script>
$('#s').keyup(function(){
   var valThis = $(this).val().toLowerCase();
    $('.countryList>li').each(function(){
     var text = $(this).text().toLowerCase();
        (text.indexOf(valThis) == 0) ? $(this).show() : $(this).hide();            
   });
});
</script>

<?php } } ?>