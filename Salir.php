<?php
	session_start();

    $Usua = $_SESSION['Usuario'];

    session_destroy();

    ?> 			
     	<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../index.html">
	<?php 		    
?>