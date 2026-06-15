<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h2>Lista de Medicos</h2>
    <div class="text-end">
        <a href="<?= site_url('doctor/create') ?>" class="btn btn-primary mb-3 ">
            + Nuevo Médico
        </a>
    </div>

    <form action="<?= site_url('doctor/search') ?>" method="get" class="mb-3">
        <div class="input-group mb-3">
            <input
                type="text"
                name="query"
                class="form-control"
                placeholder="Buscar Doctor por ID, Nombre, Especialidad o Cédula">
            <button type="button" class="btn btn-danger"
                onclick="document.querySelector('input[name=\'query\']').value=''; window.location='<?= site_url('doctor/search') ?>'">
                X
            </button>
            <button type="submit" class="btn btn-primary">
                Buscar
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered w-100">

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

                <?php if (empty($doctors) || $doctors == null): ?>

                    <tr>

                        <td colspan="5" class="text-center">No se encontraron registros.</td>

                    </tr>


                <?php else: ?>

                    <?php foreach ($doctors ?? [] as $doctor): ?>

                        <tr>

                            <td><?= $doctor['id'] ?></td>

                            <td><?= $doctor['full_name'] ?></td>

                            <td><?= $doctor['specialty'] ?></td>

                            <td class="<?= strlen($doctor['professional_license']) == 8 ? 'bg-success' : 'bg-warning' ?>">
                                <?= ($doctor['professional_license']) ?>
                            </td>

                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="<?= site_url('doctor/edit/' . $doctor['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <button
                                        class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="setDoctorId(<?= $doctor['id'] ?>)">
                                        Eliminar
                                    </button>
                                </div>

                            </td>


                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>
    </div>

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
</div>
<script>
    function setDoctorId(id) {
        document.getElementById('deleteForm').action =
            '<?= site_url('doctor') ?>/' + id;
    }
</script>
<?= $this->endSection() ?>