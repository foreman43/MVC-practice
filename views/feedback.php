<?php
//** @var $model Feedback */

use app\core\form\Form;
use \app\core\form\Field;

echo "<h1>Обратная связь</h1>";

$form = new Form($model);
$form->formBegin();

$themes = $model->getThemes();
$form->select('theme_id', $themes);

$roles = $model->getRoles("name != 'Пользователь'");
$form->label("Кто должен получить ваш отзыв?");
foreach ($roles as $key => $value) {
    $form->field('send_to','radio', Field::VARIANT_CHECK, $key, $value);
}

$form->field('heading', 'text');
$form->field('text', 'text');

$form->field('response_required', 'checkbox', Field::VARIANT_CHECK);

$form->submitButton("submit", "Отправить");
$form->submitButton("reset", "Сброс");

$form->formEnd();