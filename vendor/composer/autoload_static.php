<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b1184fcf6fd7440bbd2521e89d43f10
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b1184fcf6fd7440bbd2521e89d43f10::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b1184fcf6fd7440bbd2521e89d43f10::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2b1184fcf6fd7440bbd2521e89d43f10::$classMap;

        }, null, ClassLoader::class);
    }
}
