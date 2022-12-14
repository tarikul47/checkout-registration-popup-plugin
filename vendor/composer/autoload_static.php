<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf5ffbc53f2fe904ff871e1729fb4ded8
{
    public static $files = array (
        'ddf90fed89c08bb0f4b6c8c42654185f' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wecoder\\Registration\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wecoder\\Registration\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf5ffbc53f2fe904ff871e1729fb4ded8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf5ffbc53f2fe904ff871e1729fb4ded8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf5ffbc53f2fe904ff871e1729fb4ded8::$classMap;

        }, null, ClassLoader::class);
    }
}
