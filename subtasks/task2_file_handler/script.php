<?php
	$homepage = file_get_contents('example_file.txt');
	echo $homepage;
	
    file_put_contents("example_file2.txt", $homepage);

?> 