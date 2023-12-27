<?php

// Incluye las clases necesarias
require_once './src/User.php';
require_once './src/UserRepository.php';

// Crea una instancia de UserRepository
$userRepository = new UserRepository();

// Verifica el método de la solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


// Llama a la función correspondiente según el método
switch ($method) {
    case 'POST':
        handlePostRequest($userRepository);
        break;

    case 'GET':
        handleGetRequest($userRepository);
        break;

    case 'PUT':
        handlePutRequest($userRepository);
        break;

    case 'DELETE':
        handleDeleteRequest($userRepository);
        break;

    default:
        // Método no permitido
        http_response_code(405); // Código HTTP 405: Método no permitido
        $response = array('message' => 'Método no permitido');
        echo json_encode($response);

        break;
}

function handlePostRequest($userRepository)
{
    // Obtén los datos enviados por Postman
    $nombre = $_POST['nombre'];
    $correoElectronico = $_POST['correoElectronico'];
    $contrasena = $_POST['contrasena'];

    // Crea un nuevo usuario
    $nuevoUsuario = new User(null, $nombre, $correoElectronico, $contrasena);

    // Guarda el usuario en el repositorio
    $userRepository->guardarUsuario($nuevoUsuario);

    // Puedes devolver una respuesta JSON u otro tipo de respuesta
    $response = array('message' => 'Usuario creado exitosamente');
    echo json_encode($response);
}

function handleGetRequest($userRepository)
{
    // Obtén el ID del usuario de la solicitud GET
    $id = $_GET['id'];

    // Obtén el usuario por ID
    $usuario = $userRepository->obtenerUsuarioPorId($id);

    // Puedes devolver una respuesta JSON u otro tipo de respuesta
    if ($usuario) {
        $response = array('message' => 'Usuario encontrado', 'user' => $usuario);
        echo json_encode($response);
    } else {
        $response = array('message' => 'Usuario no encontrado');
        echo json_encode($response);
    }
}

function handlePutRequest($userRepository)
{
    // Obtén los datos enviados por Postman
    parse_str(file_get_contents("php://input"), $putData);
    $id = $putData['id'];
    $nombre = $putData['nombre'];
    $correoElectronico = $putData['correoElectronico'];
    $contrasena = $putData['contrasena'];

    // Obtén el usuario por ID
    $usuario = $userRepository->obtenerUsuarioPorId($id);

    // Actualiza la información del usuario
    if ($usuario) {
        $usuario->setNombre($nombre);
        $usuario->setCorreoElectronico($correoElectronico);
        $usuario->setContrasena($contrasena);

        // Actualiza el usuario en el repositorio
        $userRepository->actualizarUsuario($usuario);

        // Puedes devolver una respuesta JSON u otro tipo de respuesta
        $response = array('message' => 'Usuario actualizado exitosamente');
        echo json_encode($response);
    } else {
        $response = array('message' => 'Usuario no encontrado');
        echo json_encode($response);
    }
}

function handleDeleteRequest($userRepository)
{
    // Obtén el ID del usuario de la solicitud DELETE
    $id = $_GET['id'];

    // Obtén el usuario por ID
    $usuario = $userRepository->obtenerUsuarioPorId($id);

    // Elimina el usuario del repositorio
    if ($usuario) {
        $userRepository->eliminarUsuario($usuario);

        // Puedes devolver una respuesta JSON u otro tipo de respuesta
        $response = array('message' => 'Usuario eliminado exitosamente');
        echo json_encode($response);
    } else {
        $response = array('message' => 'Usuario no encontrado');
        echo json_encode($response);
    }
}
