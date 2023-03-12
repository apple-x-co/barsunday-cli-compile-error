<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use Ray\Di\AbstractModule;
use BEAR\Package\Context\CliModule as PackageCliModule;

class CliModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->install(new PackageCliModule());
    }
}
