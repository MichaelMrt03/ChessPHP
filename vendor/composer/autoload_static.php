<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ded4e9d8b12ea1d1c3295d5663ea0cc
{
    public static $files = array (
        '9b38cf48e83f5d8f60375221cd213eee' => __DIR__ . '/..' . '/phpstan/phpstan/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Chessphp\\Chess\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Chessphp\\Chess\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6ded4e9d8b12ea1d1c3295d5663ea0cc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6ded4e9d8b12ea1d1c3295d5663ea0cc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6ded4e9d8b12ea1d1c3295d5663ea0cc::$classMap;

        }, null, ClassLoader::class);
    }
}