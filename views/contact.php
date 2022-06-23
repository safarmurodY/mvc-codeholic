<?php

use app\core\form\Form;

/** @var $this \app\core\View */
/** @var $model \app\models\ContactForm */

$this->title = 'Contact'
?>

<h1>Contact US</h1>


<?php $form = Form::begin('', 'post') ?>


<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'email') ?>
<?= new \app\core\form\TextAreaField($model, 'body') ?>


    <button type="submit" class="btn btn-primary">Submit</button>

<?php $form::end() ?>