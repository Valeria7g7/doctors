<?php

/** @var string $mode */
/** @var array|null $doctor */
?>
<?= $this->extend('main') ?>

<?= $this->section('content') ?>

<?php if ($doctor): ?>
    <div class="card text-center w-50 mx-auto">
        <div class="card-body">
            <h5 class="card-title mb-4">Gafete</h5>

            <?php if (isset($doctor['profile_url']) &&  !empty($doctor['profile_url'])): ?>
                <img src="<?= esc($doctor['profile_url']) ?>">
            <?php else: ?>
                <i class="bi bi-person-circle fs-1"></i>
            <?php endif; ?>


            <h6 class="card-subtitle mb-2 text-body-primary text-success fw-bold fs-5"> <?= esc($doctor['full_name']) ?></h6>

            <h6 class="card-subtitle mb-2 text-body-secondary"> <?= esc($doctor['specialty']) ?></h6>

            <span class="badge text-bg-primary">
                <?= esc($doctor['professional_license']) ?>
            </span>

        </div>
    </div>
<?php endif; ?>
<div class="container justify-content-center ">
    <h2><?= $mode == 'CREATE' ? 'Registrar medico' : 'Actualizar medico' ?></h2>

    <div class="card w-100 col-md-6 col-lg-5 shadow-sm">

        <div class="card-body">
            <form id="medicoForm" method="post" action="<?= site_url(($mode == 'UPDATE'  && $doctor) ? 'doctor/update/' . $doctor['id'] : 'doctor') ?>">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Nombre Completo:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?= old('full_name', $doctor['full_name'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="specialty" class="form-label">Especialidad:</label>
                    <input type="text" class="form-control" id="specialty" name="specialty" value="<?= old('specialty', $doctor['specialty'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="professional_license" class="form-label">Cédula Profesional:</label>
                    <input type="text" maxlength="8" minlength="7" class="form-control" id="professional_license" name="professional_license" value="<?= old('professional_license', $doctor['professional_license'] ?? '') ?>" required>
                </div>
                <div class=" d-flex justify-content-end mb-3 ">
                    <button class="btn btn-primary" type="submit"><?= ($mode == 'UPDATE' && $doctor) ? 'Actualizar' : 'Crear' ?></button>

                    <button class="btn btn-secondary" type="button" onclick="window.location.href='<?= site_url('doctor/search') ?>'">Cancelar</button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->get('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>