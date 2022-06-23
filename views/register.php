<?php

/** @var $model \app\models\User */

use Safarmurod\PhpMvcCore\form\Form;

?>

<h1>Create an account</h1>

<?php $form = Form::begin('', 'post') ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'lastname') ?>
        </div>
    </div>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <?= $form->field($model, 'passwordConfirm')->passwordField() ?>

<button type="submit" class="btn btn-primary">Submit</button>

<?php $form::end() ?>
