<?php
class Estudiante {
    public function __construct(private PDO $db) {}

    public function obtenerTodos(string $buscar = ''): array {
        if ($buscar !== '') {
            $sql = "SELECT * FROM estudiantes
                    WHERE matricula LIKE :buscar OR nombre LIKE :buscar
                    OR apellidos LIKE :buscar OR carrera LIKE :buscar
                    ORDER BY id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['buscar' => "%$buscar%"]);
        } else {
            $stmt = $this->db->query("SELECT * FROM estudiantes ORDER BY id DESC");
        }
        return $stmt->fetchAll();
    }

    
    public function obtenerPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM estudiantes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function insertar(array $d): bool {
        $sql = "INSERT INTO estudiantes
                (matricula,nombre,apellidos,correo,telefono,carrera,semestre)
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $d['matricula'], $d['nombre'], $d['apellidos'], $d['correo'],
            $d['telefono'], $d['carrera'], $d['semestre']
        ]);
    }

    public function actualizar(array $d): bool {
        $sql = "UPDATE estudiantes SET matricula=?, nombre=?, apellidos=?,
                correo=?, telefono=?, carrera=?, semestre=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $d['matricula'], $d['nombre'], $d['apellidos'], $d['correo'],
            $d['telefono'], $d['carrera'], $d['semestre'], $d['id']
        ]);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM estudiantes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
