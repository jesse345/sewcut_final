<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcb197fb9b803c050d077ae5f5a811bf6
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitcb197fb9b803c050d077ae5f5a811bf6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcb197fb9b803c050d077ae5f5a811bf6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitcb197fb9b803c050d077ae5f5a811bf6::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
