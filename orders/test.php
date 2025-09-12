<?php
namespace main;
include 'inc1.php';
include 'inc2.php';
use \inc1\test;
test(1);
\inc2\test(2);

echo __NAMESPACE__;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
