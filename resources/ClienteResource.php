<?php
    namespace App\Resources;

    require_once "ResourceInterface.php";

    class ClienteResource implements ResourceInterface {
        public static function toCreate(\stdClass $jsonData): \stdClass {
            return $jsonData;
        }

        public static function toUpdate(\stdClass $jsonData): \stdClass {
            return $jsonData;
        }

        public static function toFindOne(\stdClass $jsonData): \stdClass {
            return $jsonData;
        }

        public static function toFindMany(\stdClass $jsonData): \stdClass {
            return $jsonData;
        }
    }
?>