<?php
    namespace App\Models;

    require_once "Database.php";

    abstract class Example extends Database {
        private const ALL_COLUMNS = "name, email, phone";

        public static function create(\stdClass $exampleData): int {
            $sttm = Database::prepare("INSERT INTO examples (name, email, phone) VALUES (:name, :email, :phone)");
            $sttm->bindParam(":name", $exampleData->name, \PDO::PARAM_STR);
            $sttm->bindParam(":email", $exampleData->email, \PDO::PARAM_STR);
            $sttm->bindParam(":phone", $exampleData->phone, \PDO::PARAM_STR);
            return Database::createOrFail($sttm);
        }

        public static function update(int $id, \stdClass $exampleData): bool {
            $sttm = Database::prepare("UPDATE examples SET name=:name, phone=:phone WHERE id = :id");
            $sttm->bindParam(":name", $exampleData->name, \PDO::PARAM_STR);
            $sttm->bindParam(":id", $id, \PDO::PARAM_INT);
            $sttm->bindParam(":phone", $exampleData->phone, \PDO::PARAM_STR);
            return Database::updateOrFail($sttm);
        }

        public static function findByEmail(string $email): \stdClass|false {
            $sttm = Database::prepare("SELECT ".self::ALL_COLUMNS." FROM examples WHERE email = :email LIMIT 1");
            $sttm->bindParam(":email", $email, \PDO::PARAM_STR);
            return Database::findOne($sttm);
        }

        public static function findById(int $id): \stdClass|false {
            $sttm = Database::prepare("SELECT ".self::ALL_COLUMNS." FROM examples WHERE id = :id LIMIT 1");
            $sttm->bindParam(":id", $id, \PDO::PARAM_INT);
            return Database::findOne($sttm);
        }
    }
?>