
<?= $this->extend('main') ?>

<?= $this->section('content') ?>

<h2><?=$mode=='CREATE' ?'Registrar medico':'Actualizar medico' ?></h2>
<form id="medicoForm"  method="post" action="<?=    $mode == 'CREATE' ? '/doctor' : '/doctor/update/' . $doctor['id']        ?>">
     <div class="mb-3">
    <label for="full_name" class="form-label">Nombre Completo:</label>
    <input type="text"   class="form-control" id="full_name" name="full_name" value="<?= old('full_name',$doctor['full_name']??'') ?>" required><br><br>
    </div>
<div class="mb-3">
    <label for="specialty" class="form-label">Especialidad:</label>
    <input type="text" class="form-control" id="specialty" name="specialty" value="<?= old('specialty',$doctor['specialty']??'') ?>" required><br><br>
    </div>
  <div class="mb-3">
    <label for="professional_license" class="form-label">Cédula Profesional:</label>
    <input type="text" maxlength="8" minlength="7" class="form-control" id="professional_license" name="professional_license" value="<?= old('professional_license',$doctor['professional_license']??'') ?>" required><br><br>
</div>
<div class="mb-3">
    <button class="btn btn-primary" type="submit"><?=$mode=='CREATE' ?'Crear':'Actualizar' ?></button>
    <button class="btn btn-secondary" type="button" onclick="window.location.href='/doctor/search'">Cancelar</button>
    </div>
</form>

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