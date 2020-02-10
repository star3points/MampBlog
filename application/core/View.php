<?php

namespace application\core;

class View {

    public function render($template, $content) { // add data
        require $template;
    }
}