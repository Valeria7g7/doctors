
<?= $this->extend('main') ?>

<?= $this->section('content') ?>

<h2>Lista de Medicos</h2>
<!--    quiero este boton del otro extremo -->
    <div class="text-end">
<a href="/doctor/create" class="btn btn-primary mb-3 ">
   + Nuevo Médico
</a>
    </div>

<table class="table table-bordered">

    <thead>

        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Especialidad</th>
            <th>Cédula</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody>

    <?php if (empty($doctors)): ?>

        <tr>

            <td colspan="5" class="text-center">No hay médicos registrados.</td>

        </tr>
    

    <?php else: ?>

        <?php foreach ($doctors ?? [] as $doctor): ?>

            <tr>

                <td><?= $doctor['id'] ?></td>

                <td><?= $doctor['full_name'] ?></td>

                <td><?= $doctor['specialty'] ?></td>

                <td><?= $doctor['professional_license'] ?></td>
              
                <td>
                    <a href="/doctor/edit/<?= $doctor['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <button
                        class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        onclick="setDoctorId(<?= $doctor['id'] ?>)">
                        Eliminar
                    </button>
                </td>

            </tr>

        <?php endforeach; ?>

    <?php endif; ?>

    </tbody>

</table>

<div class="modal fade" id="deleteModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Confirmar eliminación
                </h5>
            </div>

            <div class="modal-body">
                ¿Está seguro de que desea eliminar este médico?
            </div>

            <div class="modal-footer">

                <form id="deleteForm" method="post">

                    <input type="hidden"
                           name="_method"
                           value="DELETE">

                    <button type="submit"
                            class="btn btn-danger">
                        Sí, eliminar
                    </button>

                </form>

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancelar
                </button>

            </div>

        </div>

    </div>

</div>

<script>

function setDoctorId(id)
{
    document.getElementById('deleteForm').action =
        '/doctor/' + id;
}

</script>
<?= $this->endSection() ?>
