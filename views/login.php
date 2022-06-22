<?php
/** @var $model \app\models\User */
use app\core\form\Form;

?>

<h1> Log in</h1>

<?php $form = Form::begin('', 'post') ?>


    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>


    <button type="submit" class="btn btn-primary">Submit</button>

<?php $form::end() ?>