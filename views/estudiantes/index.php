<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD MVC - Estudiantes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/css/estilos.css">
<link rel="stylesheet" href="public/css/header.css">
</head>
<body class="bg-light">
<?php require __DIR__ . '/../layout/menu.php'; ?>

<main class="container py-4">
  <div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Estudiantes</h4>
      <button class="btn btn-primary" onclick="nuevoEstudiante()">+ Nuevo estudiante</button>
    </div>
    <div class="card-body">
      <div id="mensaje"></div>
      <div class="row mb-3">
        <div class="col-md-6">
          <input id="buscar" class="form-control" placeholder=" Buscar por matrícula, nombre o carrera...">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-dark">
            <tr><th>ID</th><th>Matrícula</th><th>Nombre</th><th>Correo</th><th>Carrera</th><th>Sem.</th><th>Acciones</th></tr>
          </thead>
          <tbody id="tablaEstudiantes"></tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="modalEstudiante" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<form id="formEstudiante">
  <div class="modal-header">
    <h5 class="modal-title" id="tituloModal">Nuevo estudiante</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">
    <div id="mensajeFormulario" role="alert" aria-live="polite"></div>
    <input type="hidden" name="id" id="id">
    <div class="row g-3">
      <div class="col-md-4"><label class="form-label">Matrícula *</label><input name="matricula" id="matricula" class="form-control" required></div>
      <div class="col-md-4"><label class="form-label">Nombre *</label><input name="nombre" id="nombre" class="form-control" required></div>
      <div class="col-md-4"><label class="form-label">Apellidos *</label><input name="apellidos" id="apellidos" class="form-control" required></div>
      <div class="col-md-6"><label class="form-label">Correo *</label><input type="email" name="correo" id="correo" class="form-control" required></div>
      <div class="col-md-6"><label class="form-label">Teléfono</label><input name="telefono" id="telefono" class="form-control"></div>
      <div class="col-md-8"><label class="form-label">Carrera *</label><input name="carrera" id="carrera" class="form-control" required></div>
      <div class="col-md-4"><label class="form-label">Semestre *</label><input type="number" min="1" max="12" name="semestre" id="semestre" class="form-control" required></div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button class="btn btn-primary">Guardar</button>
  </div>
</form>
</div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/estudiantes.js?v=2"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
