<?php
    namespace App\Resources;

    interface ResourceInterface {
        public static function toCreate(\stdClass $jsonData): \stdClass;
        public static function toUpdate(\stdClass $jsonData): \stdClass;
        public static function toFindOne(\stdClass $jsonData): \stdClass;
        public static function toFindMany(\stdClass $jsonData): \stdClass;
    }
?>