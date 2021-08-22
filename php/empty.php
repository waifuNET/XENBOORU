<?php

$dirs = array(
	"./src/",
	"./src/full/",
	"./src/low/",
	"./src/imagick/"
);

foreach ($dirs as &$value) {
	if(!is_dir($value)){
		mkdir($value, 0755);
	}
}

?>