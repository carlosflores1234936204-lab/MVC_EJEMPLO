<?php
class EstudianteController {
    public function __construct(private Estudiante $model) {}

    public function listar(): array {
        return ['success'=>true, 'data'=>$this->model->obtenerTodos($_POST['buscar'] ?? '')];
    }

    public function obtener(int $id): array {
        $data = $this->model->obtenerPorId($id);
        return $data
            ? ['success'=>true,'data'=>$data]
            : ['success'=>false,'message'=>'Estudiante no encontrado'];
    }

    private function validar(array $d): ?string {
        $required = ['matricula','nombre','apellidos','correo','carrera','semestre'];
        foreach ($required as $campo) {
            if (trim($d[$campo] ?? '') === '') return "El campo $campo es obligatorio.";
        }
        if (!filter_var($d['correo'], FILTER_VALIDATE_EMAIL)) return "El correo no es válido.";
        if ((int)$d['semestre'] < 1 || (int)$d['semestre'] > 12) return "El semestre debe estar entre 1 y 12.";
        return null;
    }

    public function guardar(array $d): array {
        if ($error = $this->validar($d)) return ['success'=>false,'message'=>$error];
        try {
            $this->model->insertar($d);
            return ['success'=>true,'message'=>'Estudiante registrado correctamente.'];
        } catch (PDOException $e) {
            return ['success'=>false,'message'=>'No se pudo registrar. Verifica que la matrícula no esté repetida.'];
        }
    }

    public function actualizar(array $d): array {
        if (empty($d['id'])) return ['success'=>false,'message'=>'ID no válido.'];
        if ($error = $this->validar($d)) return ['success'=>false,'message'=>$error];
        try {
            $this->model->actualizar($d);
            return ['success'=>true,'message'=>'Estudiante actualizado correctamente.'];
        } catch (PDOException $e) {
            return ['success'=>false,'message'=>'No se pudo actualizar. Verifica la matrícula.'];
        }
    }

    public function eliminar(int $id): array {
        if ($this->model->eliminar($id)) return ['success'=>true,'message'=>'Estudiante eliminado correctamente.'];
        return ['success'=>false,'message'=>'No se pudo eliminar.'];
    }
}
