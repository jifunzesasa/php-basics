<?php

const MAXIMUM_COMPRESSION_LEVEL = 9;

// https://www.php.net/manual/en/function.gzcompress.php

$poemText = <<<POEM
The woods are lovely, dark and deep,

But I have promises to keep,

And miles to go before I sleep,

And miles to go before I sleep.

POEM;



$level = MAXIMUM_COMPRESSION_LEVEL;

$compressed = gzcompress($poemText, $level);


echo $compressed;
