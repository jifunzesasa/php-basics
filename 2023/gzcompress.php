<?php

const MAXIMUM_COMPRESSION_LEVEL = 9;

// https://www.php.net/manual/en/function.gzcompress.php

$poemText = <<<POEM
The woods are lovely, dark and deep,

But I have promises to keep,

And miles to go before I sleep,

And miles to go before I sleep.

POEM;


// The level of compression. Can be given as 0 for no compression up to 9 for maximum compression.
// If -1 is used, the default compression of the zlib library is used which is 6.
$level = MAXIMUM_COMPRESSION_LEVEL;

$compressed = gzcompress($poemText, $level);


if ($compressed === false) {
    echo "The compression failed.";
} else {
    echo "The compression succeeded.";
    echo $compressed;
}
