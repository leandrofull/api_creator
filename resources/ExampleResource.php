<?php
    namespace App\Resources;

    require_once "ResourceInterface.php";

    class ExampleResource implements ResourceInterface {
        public static function toCreate(\stdClass $jsonData): \stdClass {
            $example = self::toUpdate($jsonData);

            if(!isset($jsonData->email)) $example->email = false;
            else {
                $example->email = strtolower(trim($jsonData->email));
                $example->email = filter_var($example->email, FILTER_VALIDATE_EMAIL);
            }

            return $example;
        }

        public static function toUpdate(\stdClass $jsonData): \stdClass {
            $example = new \stdClass();

            if(!isset($jsonData->name)) $example->name = false;
            else {
                $example->name = preg_replace("/[^A-Z\ ]/", "", strtoupper($jsonData->name));
                $example->name = preg_replace("/\s{2,}/", " ", trim($example->name));

                if ( (mb_strlen($example->name, 'UTF-8') < 3) || 
                     (mb_strlen($example->name, 'UTF-8') > 70) )
                        $example->name = false;
            }

            if(!isset($jsonData->phone)) $example->phone = "";
            else {
                $example->phone = preg_replace("/[^0-9]/", "", $jsonData->phone);

                if ( (strlen($example->phone) < 10) || 
                     (strlen($example->phone) > 11) )
                        $example->phone = "";
                else $example->phone = "+55".$example->phone;
            }

            return $example;
        }

        public static function toFind(\stdClass $jsonData): \stdClass {
            return $jsonData;
        }
    }
?>