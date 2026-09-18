<?php
declare(strict_types=1);

/**
 * Front controller (punto de entrada unico del MVC).
 * - Peticiones con "action" (POST/GET) -> responde JSON.
 * - Cualquier otra peticion -> renderiza la vista.
 */

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/estudiante.php';
require_once __DIR__ . '/controllers/EstudiantesController.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action !== null) {
    header('Content-Type: application/json; charset=utf-8');

    try {
        $db = (new Database())->getConnection();
        $controller = new EstudianteController(new Estudiante($db));

        $respuesta = match ($action) {
            'listar'     => $controller->listar(),
            'obtener'    => $controller->obtener((int) ($_POST['id'] ?? $_GET['id'] ?? 0)),
            'guardar'    => $controller->guardar($_POST),
            'actualizar' => $controller->actualizar($_POST),
            'eliminar'   => $controller->eliminar((int) ($_POST['id'] ?? 0)),
            default      => ['success' => false, 'message' => 'Accion no valida.'],
        };
    } catch (Throwable $e) {
        http_response_code(500);
        $respuesta = ['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()];
    }

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    exit;
}

require __DIR__ . '/views/estudiantes/index.php';
