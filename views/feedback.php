<?php
//** @var $model Feedback */

use app\core\form\Form;
use \app\core\form\Field;

$form = new Form($model);
$form->formBegin();

$themes = $model->getThemes();
$form->select('theme_id', $themes);

$roles = $model->getRoles();
$form->label("Who do you want to get this feedback?");
foreach ($roles as $key => $value) {
    $form->field('send_to','radio', Field::VARIANT_CHECK, $key, $value);
}
/*$form->field('send_to','radio', Field::VARIANT_CHECK, '1');
$form->field('send_to','radio', Field::VARIANT_CHECK, '2');*/

$form->field('heading', 'text');
$form->field('text', 'text');

$form->field('response_required', 'checkbox', Field::VARIANT_CHECK);

$form->submitButton("submit", "Send");
$form->submitButton("reset", "Reset");

$form->formEnd();