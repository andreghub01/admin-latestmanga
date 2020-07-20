<?php

$data['regex'] = "Chapter 285.0";
$data['regex'] = (float) filter_var( $data['regex'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

echo $data['regex'];
