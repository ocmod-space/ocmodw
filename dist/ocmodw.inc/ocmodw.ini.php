<?php

declare(strict_types=1);

define('MAKEZIP', 'z'); // -z[0|1|2..N] - create zip. N - number of module(0) or addons(1..).
define('VSUFFIX', 'v');  // -v[3|4] - print help.
define('GETHELP', 'h'); // -h - print help.
define('MAKEFCL', 'a'); // -a - make encrypted .fcl-archive.
define('EXTRFCL', 'x'); // -x - extract files from fcl-archive.
define('LISTFCL', 'l'); // -l - list of files in fcl-archive.
define('DIRPATH', 'd'); // -d<path> - path to working directory with the `pakdef.php` file.
