<?php
require("./connection/connect.php");
$res = $conn->query("SELECT * FROM table_event");

$arr = $res->fetch_all(MYSQLI_ASSOC);
print_r(json_encode($arr));


?>
<script defer>
navigator.geolocation.getCurrentPosition(
	(position)=>{
		console.log(position.coords.latitude);
		console.log(position.coords.longitude);
	}


);


</script>