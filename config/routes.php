<?php
    require_once REQUEST_PATH."/Route.php";

    use App\Request\Response;
    use App\Request\Route;

    Route::get('/example/:id', ['ExampleController', 'get']);

    Route::post('/example', ['ExampleController', 'create']);

    Route::put('/example/:id', ['ExampleController', 'update']);

    Route::default(function(Response $response) {
        $response->error(404, 'Not Found!');
    });
?>