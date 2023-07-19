<?php
//** @var $model Feedback */

use app\core\form\Form;

$form = new Form($model);
$form->formBegin();

$form->field('theme_id', 'number');
$form->field('user_id', 'number');
$form->field('for_admins', 'radio');
$form->field('for_managers', 'radio');
$form->field('response_required', 'checkbox');
$form->field('heading', 'text');
$form->field('text', 'text');

$form->submitButton('Send');

$form->formEnd();