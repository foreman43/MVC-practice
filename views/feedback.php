<?php
//** @var $model Feedback */

use app\core\form\Form;
use \app\core\form\Field;

$form = new Form($model);
$form->formBegin();

//$form->field('theme_id', 'number');
$form->select(
    'theme_id',
    [
        1 => 'Theme1',
        2 => 'Theme2'
    ]
);

$form->label("Who do you want to get this feedback?");
$form->field('send_to','radio', Field::VARIANT_CHECK, '1');
$form->field('send_to','radio', Field::VARIANT_CHECK, '2');

$form->field('heading', 'text');
$form->field('text', 'text');

$form->field('response_required', 'checkbox', Field::VARIANT_CHECK);

$form->submitButton("submit", "Send");
$form->submitButton("reset", "Reset");

$form->formEnd();