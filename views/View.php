<?php

namespace views;

class View
{
    public function render($tpl, array $pageInfo)
    {
        include ROOT . $tpl;
    }
}