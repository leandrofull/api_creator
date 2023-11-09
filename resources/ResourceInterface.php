<?php
    namespace App\Resources;

    interface ResourceInterface {
        public static function toCreate(\stdClass $data): \stdClass;
        public static function toUpdate(\stdClass $data): \stdClass;
        public static function toFind(\stdClass $data): \stdClass;
    }
?>