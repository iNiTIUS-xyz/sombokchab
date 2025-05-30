<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5d25d862fa96cb3b3cb62310519cfd5b
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Chat\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Chat\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5d25d862fa96cb3b3cb62310519cfd5b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5d25d862fa96cb3b3cb62310519cfd5b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5d25d862fa96cb3b3cb62310519cfd5b::$classMap;

        }, null, ClassLoader::class);
    }
}
