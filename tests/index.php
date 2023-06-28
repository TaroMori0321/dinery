<?php

declare(strict_types=1);

use Haikara\DiForklift\Attributes\Inject;
use Haikara\DiForklift\Container;

require_once __DIR__ . '/../vendor/autoload.php';

class ClassA {
    public function __construct(protected ClassB $class_b) {
    }
}

class ClassB {
    public function __construct(
        #[Inject(ClassC::class)]
        protected ClassCInterface $class_c,
        protected ClassD $class_d
    ) {
    }
}

class ClassC implements ClassCInterface{
    public function __construct() {
    }
}

class ClassD {
}

interface ClassCInterface {
}

$container = New Container;

$container->add(ClassD::class);
var_dump($container->has(ClassD::class));

var_dump(spl_object_id($container->get(ClassA::class)) === spl_object_id($container->get(ClassA::class)));