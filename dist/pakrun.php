<?php

// PAK - OpenCart Extension Packer v0.4.2

require_once '_pak/conf.php';

require_once '_pak/func.php';

require_once '_pak/reqd.php';

/*
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    // error was suppressed with the @-operator
    if (@error_reporting() === 0) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});
*/

$clo = get_clo();
$basename = strtolower(basename(getcwd()));
if (isset($clo[MAKEZIP]) && !is_false($clo[MAKEZIP])) {
    require_once 'pakdef.php';

    $workdir = get_wd($clo[MAKEZIP]);

    if ($workdir) {
        $srcdir = concatpath($workdir, SRCDIR);
        $zipdir = concatpath($workdir, ZIPDIR);

        if (strpos($workdir, ADIR) === 0) {
            $part = explode(DIRECTORY_SEPARATOR, $workdir);
            $basename .= '--'.end($part);

            unset($part);
        }

        define('MODFILE', $basename);

        $zipfile = concatpath($zipdir, $basename.ZIPEXT);

        $mod_code = str_replace('--', '|', $basename);

        define('MODCODE', $mod_code);

        $mod_name = str_replace('|', ' ', $mod_code);
        $mod_name = ucwords($mod_name);
        $mod_name = str_replace(' ', '|', $mod_name);
        $mod_name = str_replace('-', ' ', $mod_name);
        $mod_name = ucwords($mod_name);

        define('MODNAME', $mod_name);

        if (chkdir($srcdir) && chkdir($zipdir)) {
            if (is_file($zipfile)) {
                unlink($zipfile);
            }

            mkzip($srcdir, $zipfile, true);
        } else {
            output('Can not create dir: '.$zipdir, true);
        }
    } else {
        output('There is no directory corresponding to number '.$clo[MAKEZIP], true);
    }
} elseif (isset($clo[MAKEFCL]) || isset($clo[EXTRFCL]) || isset($clo[LISTFCL])) {
    $fclfile = concatpath(FCLDIR, $basename.'.fcl');

    if (isset($clo[MAKEFCL])) {
        chkdir(FCLDIR);

        output(runfcl('make', $fclfile, '-f'.get_fclignore(FCLIGNORE)));
        output(runhideg($fclfile));
    } elseif (isset($clo[EXTRFCL]) || isset($clo[LISTFCL])) {
        if (is_file($fclfile.'.g')) {
            output(runhideg($fclfile.'.g'));

            if (is_file($fclfile)) {
                if (isset($clo[EXTRFCL])) {
                    output(runfcl('extr', $fclfile, '-f'));
                }

                if (isset($clo[LISTFCL])) {
                    output(runfcl('list', $fclfile));
                }
            } else {
                output('file "'.$fclfile.'" is missing!', true);
            }
        } else {
            output('file "'.$fclfile.'.g'.'" is missing!', true);
        }
    }

    if (is_file($fclfile)) {
        unlink($fclfile);
    }
} else {
    include '_pak/help.php';

    output('Numbers:');

    foreach (get_enumerated() as $idx => $name) {
        output('['.$idx.'] - '.$name);
    }
}

exit(0);
