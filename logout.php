<?php 
session_start() ; 
if (session_destroy())
{
	echo "<script>window.top.location='sign-in.php'</script>" ;  
}

?>