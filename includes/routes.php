<?php

$routes = array(
    'signup' => array('controller' => 'user/controllerSignup', 'view' => 'user/viewSignup'),
    'signin' => array('controller' => 'user/controllerSignin', 'view' => 'user/viewSignin'),
    'addPost' => array('controller' => 'post/controllerAddPost', 'view' => 'post/viewAddPost'),
    'myPost' => array('controller' => 'post/controllerMyPost', 'view' => 'post/viewMyPost'),
    'modifyPost' => array('controller' => 'post/controllerModifyPost', 'view' => 'post/viewModifyPost'),
    'post' => array('controller' => 'post/controllerPost', 'view' => 'post/viewPost'),
    'profile' => array('controller' => 'user/controllerProfile', 'view' => 'user/viewProfile')
);