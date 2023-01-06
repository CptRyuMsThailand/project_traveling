<?php
require("./../connection/connect.php");

$dateNow = "2022-10-16";

$sql = "SELECT * FROM table_event LEFT JOIN table_place ON ev_ref_place_id = pl_id WHERE Date(?) BETWEEN ev_date_beg AND ev_date_end";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$dateNow);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC) );


?>