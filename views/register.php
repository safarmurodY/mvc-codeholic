<?php

/** @var $model \app\models\RegisterModel */

use app\core\form\Form;
?>

<h1>Create an account</h1>

<?php $form = Form::begin('', 'post') ?>
    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <?= $form->field($model, 'passwordConfirm')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php $form::end() ?>
