const modal = new bootstrap.Modal(document.getElementById('modalEstudiante'));
const form = document.getElementById('formEstudiante');

document.addEventListener('DOMContentLoaded', cargarEstudiantes);
document.getElementById('buscar').addEventListener('input', cargarEstudiantes);

async function peticion(datos) {
    const r = await fetch('index.php', { method: 'POST', body: datos });
    return await r.json();
}

async function cargarEstudiantes() {
    const datos = new FormData();
    datos.append('action', 'listar');
    datos.append('buscar', document.getElementById('buscar').value);
    const respuesta = await peticion(datos);
    const tabla = document.getElementById('tablaEstudiantes');
    tabla.innerHTML = '';

    respuesta.data.forEach(e => {
        tabla.innerHTML += `
        <tr>
          <td>${e.id}</td>
          <td>${e.matricula}</td>
          <td>${e.nombre} ${e.apellidos}</td>
          <td>${e.correo}</td>
          <td>${e.carrera}</td>
          <td><span class="badge bg-secondary">${e.semestre}</span></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick="editar(${e.id})">✏️</button>
            <button class="btn btn-danger btn-sm" onclick="eliminar(${e.id})">🗑️</button>
          </td>
        </tr>`;
    });
}

function nuevoEstudiante() {
    form.reset();
    document.getElementById('mensajeFormulario').replaceChildren();
    document.getElementById('id').value = '';
    document.getElementById('tituloModal').textContent = 'Nuevo estudiante';
    modal.show();
}

async function editar(id) {
    document.getElementById('mensajeFormulario').replaceChildren();
    const datos = new FormData();
    datos.append('action', 'obtener');
    datos.append('id', id);
    const r = await peticion(datos);

    if (!r.success) return mostrarMensaje(r.message, 'danger');

    Object.keys(r.data).forEach(k => {
        const el = document.getElementById(k);
        if (el) el.value = r.data[k];
    });
    document.getElementById('tituloModal').textContent = 'Editar estudiante';
    modal.show();
}

form.addEventListener('submit', async e => {
    e.preventDefault();
    const datos = new FormData(form);
    datos.append('action', document.getElementById('id').value ? 'actualizar' : 'guardar');

    const r = await peticion(datos);
    if (r.success) {
        modal.hide();
        mostrarMensaje(r.message, 'success');
        cargarEstudiantes();
    } else {
        mostrarMensaje(r.message, 'danger', 'mensajeFormulario');
    }
});

async function eliminar(id) {
    if (!confirm('¿Deseas eliminar este estudiante?')) return;
    const datos = new FormData();
    datos.append('action', 'eliminar');
    datos.append('id', id);
    const r = await peticion(datos);
    mostrarMensaje(r.message, r.success ? 'success' : 'danger');
    if (r.success) cargarEstudiantes();
}

function mostrarMensaje(texto, tipo, destino = 'mensaje') {
    document.getElementById(destino).innerHTML =
        `<div class="alert alert-${tipo} alert-dismissible fade show">
          ${texto}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
}
