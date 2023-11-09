<?php
    namespace App\Controllers;

    require_once "Controller.php";
    require_once RESOURCES_PATH."/ExampleResource.php";
    require_once MODELS_PATH."/Example.php";

    use App\Request\Request;
    use App\Request\Response;
    use App\Resources\ExampleResource;
    use App\Models\Example;

    class ExampleController extends Controller {
        public function get(Request $request, Response $response): void {
            $response->json(["data"=>$request->query()], 200);
        }

        public function create(Request $request, Response $response): void {
            if(!$request->body())
                $response->error(400, "Non-existent or invalid JSON!");

            $example = ExampleResource::toCreate($request->body());

            if(!$example->name)
                $response->error(422, "Invalid value or no value for name! Required field.");

            if(!$example->email)
                $response->error(422, "Invalid value or no value for email! Required field.");

            if(Example::findByEmail($example->email))
                $response->error(422, "There is already a registration with the email provided.");

            $lastInsertId = Example::create($example);

            $response->json(["example_id"=>$lastInsertId], 201);
        }

        public function update(Request $request, Response $response): void {
            if(!ctype_digit($exampleID = $request->params()->id) || $exampleID < 1) 
                $response->error(404, "Not Found!");

            if(!$request->body())
                $response->error(400, "Non-existent or invalid JSON!");

            $example = ExampleResource::toUpdate($request->body());

            if(!$example->name)
                $response->error(422, "Invalid value or no value for name! Required field.");

            if(!Example::findById($exampleID))
                $response->error(404, "Not Found!");

            Example::update($exampleID, $example);

            $response->success(200, "Updated successfully!");
        }
    }
?>