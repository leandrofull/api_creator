<?php
    require_once REQUEST_PATH."/Route.php";

    use App\Request\Response;
    use App\Request\Route;

    Route::post('/clientes/:id', ['ClientesController', 'create']);

    Route::default(function(Response $response) {
        $response->error(404, 'Not Found!');
    });
?>