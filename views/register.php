<?php
/** @var $model \app\models\User */

use app\core\form\Form;

echo "<h1>Регистрация</h1>";

$form = new Form($model);
$form->formBegin();

$form->field('email', 'email');
$form->field('password', 'password');
$form->field('confirmPassword', 'password');
$form->submitButton("submit", "Регистрация");
$form->formEnd();
?>