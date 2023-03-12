## 現象

`CliModule` をプロジェクト内に設置して BEAR.Package の `CliModule` をインストールするとコンパイルエラーが発生する

## 再現手順

1. プロジェクトを `composer create-project -n bear/skeleton MyVendor.MyProject` で作成する
2. cli コンテキストでコンパイルできることを `./vendor/bin/bear.compile 'MyVendor\MyProject' cli-api-app ./` で確認する。
3. `MyVendor.MyProject/src/Module/CliModule.php` に BEAR.Package の CliModule を呼び出すだけのモジュールを作成する。
4. cli コンテキストでコンパイルをするとコンパイルエラーが発生する。

### MyVendor.MyProject/src/Module/CliModule.php

```php
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
```

## エラー内容

```text
PHP Fatal error:  Uncaught exception 'Ray\Di\Exception\Unbound' with message 'BEAR\Sunday\Extension\Router\RouterInterface-original'
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name 'original' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Provide/Router/CliRouter.php:49 ($router)
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name '' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/src/Module/App.php:22 ($router)

#0 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#1 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#2 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#3 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#4 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(51): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#5 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#6 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#7 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#8 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#9 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(71): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#10 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Injector.php(62): Ray\Di\Container->getInstance('BEAR\\Sunday\\Ext...', '')
#11 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(78): Ray\Di\Injector->getInstance('BEAR\\Sunday\\Ext...')
#12 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(52): BEAR\Package\Injector\PackageInjector::factory(Object(BEAR\AppMeta\Meta), 'cli-api-app')
#13 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector.php(31): BEAR\Package\Injector\PackageInjector::getInstance(Object(BEAR\AppMeta\Meta), 'cli-api-app', Object(Symfony\Component\Cache\Adapter\FilesystemAdapter))
#14 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Compiler.php(68): BEAR\Package\Injector::getInstance('MyVendor\\MyProj...', 'cli-api-app', '/Users/xxx...')
#15 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/bin/bear.compile.php(14): BEAR\Package\Compiler->__construct('MyVendor\\MyProj...', 'cli-api-app', '/Users/xxx...')
#16 {main}
  thrown in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php on line 57

Fatal error: Uncaught exception 'Ray\Di\Exception\Unbound' with message 'BEAR\Sunday\Extension\Router\RouterInterface-original'
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name 'original' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Provide/Router/CliRouter.php:49 ($router)
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name '' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/src/Module/App.php:22 ($router)

#0 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#1 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#2 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#3 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#4 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(51): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#5 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#6 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#7 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#8 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#9 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(71): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#10 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Injector.php(62): Ray\Di\Container->getInstance('BEAR\\Sunday\\Ext...', '')
#11 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(78): Ray\Di\Injector->getInstance('BEAR\\Sunday\\Ext...')
#12 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(52): BEAR\Package\Injector\PackageInjector::factory(Object(BEAR\AppMeta\Meta), 'cli-api-app')
#13 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector.php(31): BEAR\Package\Injector\PackageInjector::getInstance(Object(BEAR\AppMeta\Meta), 'cli-api-app', Object(Symfony\Component\Cache\Adapter\FilesystemAdapter))
#14 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Compiler.php(68): BEAR\Package\Injector::getInstance('MyVendor\\MyProj...', 'cli-api-app', '/Users/xxx...')
#15 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/bin/bear.compile.php(14): BEAR\Package\Compiler->__construct('MyVendor\\MyProj...', 'cli-api-app', '/Users/xxx...')
#16 {main}
  thrown in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php on line 57
PHP Fatal error:  Uncaught exception 'Ray\Di\Exception\Unbound' with message 'BEAR\Sunday\Extension\Router\RouterInterface-original'
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name 'original' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Provide/Router/CliRouter.php:49 ($router)
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name '' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/src/Module/App.php:22 ($router)

#0 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#1 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#2 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#3 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#4 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(51): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#5 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#6 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#7 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#8 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#9 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(71): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#10 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Injector.php(62): Ray\Di\Container->getInstance('BEAR\\Sunday\\Ext...', '')
#11 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(78): Ray\Di\Injector->getInstance('BEAR\\Sunday\\Ext...')
#12 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(52): BEAR\Package\Injector\PackageInjector::factory(Object(BEAR\AppMeta\Meta), 'cli-api-app')
#13 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector.php(31): BEAR\Package\Injector\PackageInjector::getInstance(Object(BEAR\AppMeta\Meta), 'cli-api-app', Object(Symfony\Component\Cache\Adapter\FilesystemAdapter))
#14 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Compiler.php(68): BEAR\Package\Injector::getInstance('MyVendor\\MyProj...', 'cli-api-app', '/Users/sanokouh...')
#15 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/bin/bear.compile.php(14): BEAR\Package\Compiler->__construct('MyVendor\\MyProj...', 'cli-api-app', '/Users/sanokouh...')
#16 {main}
  thrown in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php on line 57

Fatal error: Uncaught exception 'Ray\Di\Exception\Unbound' with message 'BEAR\Sunday\Extension\Router\RouterInterface-original'
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name 'original' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Provide/Router/CliRouter.php:49 ($router)
- dependency 'BEAR\Sunday\Extension\Router\RouterInterface' with name '' used in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/src/Module/App.php:22 ($router)

#0 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#1 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#2 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#3 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#4 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(51): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#5 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php(36): Ray\Di\Arguments->getParameter(Object(Ray\Di\Container), Object(Ray\Di\Argument))
#6 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/NewInstance.php(51): Ray\Di\Arguments->inject(Object(Ray\Di\Container))
#7 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Dependency.php(75): Ray\Di\NewInstance->__invoke(Object(Ray\Di\Container))
#8 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(111): Ray\Di\Dependency->inject(Object(Ray\Di\Container))
#9 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Container.php(71): Ray\Di\Container->getDependency('BEAR\\Sunday\\Ext...')
#10 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Injector.php(62): Ray\Di\Container->getInstance('BEAR\\Sunday\\Ext...', '')
#11 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(78): Ray\Di\Injector->getInstance('BEAR\\Sunday\\Ext...')
#12 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector/PackageInjector.php(52): BEAR\Package\Injector\PackageInjector::factory(Object(BEAR\AppMeta\Meta), 'cli-api-app')
#13 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Injector.php(31): BEAR\Package\Injector\PackageInjector::getInstance(Object(BEAR\AppMeta\Meta), 'cli-api-app', Object(Symfony\Component\Cache\Adapter\FilesystemAdapter))
#14 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/src/Compiler.php(68): BEAR\Package\Injector::getInstance('MyVendor\\MyProj...', 'cli-api-app', '/Users/sanokouh...')
#15 /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/bear/package/bin/bear.compile.php(14): BEAR\Package\Compiler->__construct('MyVendor\\MyProj...', 'cli-api-app', '/Users/sanokouh...')
#16 {main}
  thrown in /path/to/repository/apple-x-co/bearsunday-cli-compile-error/MyVendor.MyProject/vendor/ray/di/src/di/Arguments.php on line 57
```
