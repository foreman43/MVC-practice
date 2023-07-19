<?php
//** @var $model \app\models\User */

use app\core\form\Form;

$form = new Form($model);
$form->formBegin();

$form->field('email', 'email');
$form->field('password', 'password');
$form->submitButton("Login");
$form->formEnd();
?>
<div class="container">
    <p>Don't have an account yet? <a href="/register">Register hire!</a></p>
</div>