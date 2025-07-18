<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfbfdca4342edac9758e6630a9f6fb84c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitfbfdca4342edac9758e6630a9f6fb84c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfbfdca4342edac9758e6630a9f6fb84c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfbfdca4342edac9758e6630a9f6fb84c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
