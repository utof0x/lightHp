<?php

use app\core\form\Form;
use app\core\form\TextAreaField;
use app\core\View;
use app\models\ContactForm;

/**
 * @var $model ContactForm
 * @var $this View
 */

$this->title = 'Contact';
?>

    <h1>Contact us</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'subject') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo new TextAreaField($model, 'body') ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo Form::end() ?>