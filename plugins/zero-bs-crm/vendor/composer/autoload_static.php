<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbd2a8116fd0c5f295efba7993a572d28
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Automattic\\WooCommerce\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Automattic\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/woocommerce/src/WooCommerce',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbd2a8116fd0c5f295efba7993a572d28::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbd2a8116fd0c5f295efba7993a572d28::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbd2a8116fd0c5f295efba7993a572d28::$classMap;

        }, null, ClassLoader::class);
    }
}
