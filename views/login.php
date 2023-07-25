<?php
//** @var $model \app\models\User */

use app\core\form\Form;

echo "<h1>Авторизация</h1>";

$form = new Form($model);
$form->formBegin();

$form->field('email', 'email');
$form->field('password', 'password');
$form->submitButton("submit", "Войти");
$form->formEnd();
?>
<div class="container">
    <p>Ещё не завели аккаунт? Зарегистрируйтесь <a href="/register">здесь</a>!</p>
</div>