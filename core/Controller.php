<?php

namespace Core;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

/**
 * Class Controller
 * @package Core
 */
class Controller
{
    protected $loader;


    /**
     * Controller constructor.
     */
    public function __construct()
    {

        $this->loader = new Loader();

    }


    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("Location:$url");

        exit;

    }

    /**
     * @param $view
     * @param array $data
     */
    protected function loadView($view, $data = [])
    {
        $pathsToTemplates = [__DIR__ . '/../app/Views'];
        $pathToCompiledTemplates = __DIR__ . '/../app/Views/compiled';

        // Dependencies
        $filesystem = new Filesystem;
        $eventDispatcher = new Dispatcher(new Container);

        // Create View Factory capable of rendering PHP and Blade templates
        $viewResolver = new EngineResolver;
        $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);
        $viewResolver->register('blade', function () use ($bladeCompiler, $filesystem) {
            return new CompilerEngine($bladeCompiler, $filesystem);
        });

        $viewResolver->register('php', function () {
            return new PhpEngine;
        });

        $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
        $viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);

        echo $viewFactory->make($view, $data)->render();
    }

    /**
     * @return \GUMP
     */
    protected function validator()
    {
        $gump = new \GUMP();
        return $gump;
    }
}
