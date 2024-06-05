<?php

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
require_once 'Fruit.php';
require_once 'FruitDAO.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware(); 
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, array $args) {

    $response->getBody()->write('Olá mundo');
    return $response;
});


$app->get('/alunos', function (Request $request, Response $response, array $args) {

    $alunos = [
        '1' => 'Ravel',
        '2' => 'Daniel Rocha Galvão',
        '3' => 'João, já entregou o exercício?'
    ];

    $response->getBody()->write(json_encode($alunos));
    return $response->withHeader("Content-type", "application/json");
});

$app->get("/alunos/{id}", function (Request $request, Response $response, array $args){
    $alunos = [
        '1' => 'Ravel',
        '2' => 'Daniel Rocha Galvão',
        '3' => 'João, já entregou o exercício?'
    ];
    $idAluno = $args['id'];

    $aluno = [$idAluno => $alunos[$idAluno]];
    $response->getBody()->write(json_encode($aluno));
    return $response->withHeader('Content-type','application/json');
});


$app->get('/fruits', function (Request $request, Response $response, array $args) {

    $fruitsDAO = new FruitDAO();
    $fruits = $fruitsDAO->read();
    $response->getBody()->write(json_encode($fruits));
    return $response->withHeader('Content-type', 'application/json');
});


$app->post('/fruits', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $fruit = new Fruit($data['nome'],$data['quantidade']);
    $fruitDAO = new FruitDAO();
    $fruitDAO->create($fruit);
    return  $response->withStatus(201);
});

$app->put('/fruits/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $data = $request->getParsedBody();
    $fruit = new Fruit($data['nome'],$data['quantidade']);
    $fruit->setId($id);
    $fruitDAO = new FruitDAO();
    $fruitDAO->update($fruit);
    return  $response->withStatus(200);
});

$app->delete('/fruits/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $fruitDAO = new FruitDAO();
    $fruitDAO->delete($id);
    return  $response->withStatus(200);
});



$app->run();