<?php
    $_ENV["file"] = explode("\n", file_get_contents(APP_PATH."/.env"));

    while($_ENV["vars"] = array_shift($_ENV["file"])) {
        putenv(rtrim($_ENV["vars"]));
    }

    $_ENV["file"] = NULL;
?>