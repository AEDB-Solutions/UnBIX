<?php

session_start();

include("locality_functions.php");


if(isset($_POST['id'])) {
	atualiza_info_on_db();
} else {
	save_info_on_db();
}

echo '<html><head><meta http-equiv="Refresh" content="0;index1.php"></head></html>';

?>
