<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit748f4d1e59ade6c39bc0585ae0ba7743
{
    public static $files = array (
        'f2a936653eca85b8756968fe882e1da7' => __DIR__ . '/../..' . '/inc/Helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'A' => 
        array (
            'Awps\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'Awps\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit748f4d1e59ade6c39bc0585ae0ba7743::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit748f4d1e59ade6c39bc0585ae0ba7743::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}