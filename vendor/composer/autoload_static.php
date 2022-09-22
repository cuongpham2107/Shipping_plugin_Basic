<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite1fc1e6469bf91302aa7b9138f640a62
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite1fc1e6469bf91302aa7b9138f640a62::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite1fc1e6469bf91302aa7b9138f640a62::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite1fc1e6469bf91302aa7b9138f640a62::$classMap;

        }, null, ClassLoader::class);
    }
}
