<?php

$post = $_POST;

include('../models/' . $post['data_class'] . '.php');

$class = new $post['data_class'];

return $class->$post['data_method']();