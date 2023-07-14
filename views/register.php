<?php

use app\core\form\Form;
use app\models\User;

/** @var $model User */
?>

<h1>Register</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'firstName') ?>
    <?php echo $form->field($model, 'lastName') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'passwordRepeat')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo Form::end() ?>