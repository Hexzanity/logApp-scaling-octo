<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb1fd57ece5a2ff53d13ad9def0fd1c4
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fakerphp/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcb1fd57ece5a2ff53d13ad9def0fd1c4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcb1fd57ece5a2ff53d13ad9def0fd1c4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcb1fd57ece5a2ff53d13ad9def0fd1c4::$classMap;

        }, null, ClassLoader::class);
    }
}
