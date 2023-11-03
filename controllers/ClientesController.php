<?php
    namespace App\Controllers;

    require_once "Controller.php";
    require_once RESOURCES_PATH."/ClienteResource.php";

    use App\Request\Request;
    use App\Request\Response;
    use App\Resources\ClienteResource;

    class ClientesController extends Controller {
        public function create(Request $request, Response $response): void {
            $inputData = ClienteResource::toCreate($request->body());

            var_dump($inputData);
        }
    }
?>