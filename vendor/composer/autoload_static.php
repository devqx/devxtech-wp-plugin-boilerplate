<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d753f2cf5b2f0a42fa2b6a96e9f8ada
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d753f2cf5b2f0a42fa2b6a96e9f8ada::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d753f2cf5b2f0a42fa2b6a96e9f8ada::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
