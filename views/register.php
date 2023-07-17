<?php
use app\core\form\Form;
$form = new Form($model);
$form->formBegin();

$form->field('email', 'email');
$form->field('password', 'password');
$form->field('confirmPassword', 'password');
$form->submitButton("Register");
$form->formEnd();
?>