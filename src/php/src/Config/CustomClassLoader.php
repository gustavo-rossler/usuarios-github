<?php

namespace Inklo\Config;

use Pecee\SimpleRouter\ClassLoader\IClassLoader;
use Pecee\SimpleRouter\Exceptions\ClassNotFoundHttpException;
use Psr\Container\ContainerInterface;

class CustomClassLoader implements IClassLoader
{
    protected $container;

    public function __construct()
    {
        // Create our new php-di container
        $this->container = (new \DI\ContainerBuilder())
                    ->useAutowiring(true)
                    ->addDefinitions([
                        \Inklo\Repositories\IGithubUsersRepository::class => function() {
                            return new \Inklo\Repositories\GithubUsersRepository();
                        },
                        \Inklo\Usecases\ISaveUserLocallyUseCase::class => function(ContainerInterface $container) {
                            $repo = $container->get(\Inklo\Repositories\IGithubUsersRepository::class);
                            $fileManager = $container->get(\Inklo\Repositories\IFileManager::class);
                            return new \Inklo\Usecases\SaveUserLocallyUseCase($repo, $fileManager);
                        },
                        \Inklo\Validators\ISaveUserValidator::class => function() {
                            return new \Inklo\Validators\SaveUserValidator();
                        },
                        \Inklo\Repositories\IFileManager::class => function() {
                            return new \Inklo\Repositories\FileManager();
                        },
                    ])
                    ->build();
    }

    /**
     * Load class
     *
     * @param string $class
     * @return object
     * @throws ClassNotFoundHttpException
     */
    public function loadClass(string $class)
    {
        if ($this->container->has($class) === false) {
            throw new ClassNotFoundHttpException($class, null, sprintf('Class "%s" does not exist', $class), 404, null);
        }
        return $this->container->get($class);
    }
    
    /**
     * Called when loading class method
     * @param object $class
     * @param string $method
     * @param array $parameters
     * @return string
     */
    public function loadClassMethod($class, string $method, array $parameters)
    {
        return (string)$this->container->call([$class, $method], $parameters);
    }

    /**
     * Load closure
     *
     * @param Callable $closure
     * @param array $parameters
     * @return string
     */
    public function loadClosure(callable $closure, array $parameters)
    {
        return (string)$this->container->call($closure, $parameters);
    }
}
