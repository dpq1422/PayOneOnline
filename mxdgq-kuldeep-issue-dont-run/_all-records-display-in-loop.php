<?php 
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);

header( 'Content-type: text/html; charset=utf-8' );


    //if (ob_get_level() == 0) ob_start();
    for ($i = 1; $i<=10; $i++){

        echo "<br> Line $i";
        echo str_pad('',16384);

        ob_flush();
        flush();
        usleep(200000);
    }

    //echo "Done.";

   // ob_end_flush();

?>