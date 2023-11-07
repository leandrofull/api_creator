<?php
    namespace App\Controllers;

    require_once "Controller.php";
    require_once RESOURCES_PATH."/ExampleResource.php";

    use App\Request\Request;
    use App\Request\Response;
    use App\Resources\ExampleResource;

    class ExampleController extends Controller {
        public function create(Request $request, Response $response): void {
            if(!$request->body())
                $response->error(400, "Non-existent or invalid JSON!");

            $example = ExampleResource::toCreate($request->body());

            if(!$example->name)
                $response->error(422, "Invalid value or no value for name! Required field.");

            if(!$example->email)
                $response->error(422, "Invalid value or no value for email! Required field.");

            // Check if there is already a resource with the registered email
            // Error 422 for true

            $response->success(201, "Created successfully!");
        }

        public function update(Request $request, Response $response): void {
            if(!ctype_digit($exampleID = $request->params()->id) || $exampleID < 1) 
                $response->error(404, "Not Found!");

            if(!$request->body())
                $response->error(400, "Non-existent or invalid JSON!");

            $example = ExampleResource::toUpdate($request->body());

            if(!$example->name)
                $response->error(422, "Invalid value or no value for name! Required field.");

            // Check if there is already a resource with the registered email
            // Error 422 for false

            $response->success(200, "Updated successfully!");
        }
    }
?>