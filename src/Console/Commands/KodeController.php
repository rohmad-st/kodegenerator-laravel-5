<?php namespace Rohmadst\Kodegenerator\Console\Commands;

use File;

class KodeController extends KodeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kode:controller {name} {folder=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller. Input ex: Foo then will be FooController.php';

    /**
     * Create a new command instance.
     *
     * AngularComponent constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $prefix = $this->argument('folder');

        $prefix = empty($prefix) ? $name : $prefix;

        $template = file_get_contents(__DIR__ . '/Stubs/controller.stub');

        $template = $this->regexController($template, $name, $prefix);

        $folder = base_path(config('kodegenerator.source.root') . '/Api/' . 'V1/' . $prefix);

        if (!is_dir($folder)) {
            //create folder
            File::makeDirectory($folder, 0775, true);
        }

        //create controller (.php)
        File::put($folder . '/' . $name . 'Controller.php', $template);

        $this->info('Controller created successfully by Kode Generator.');
    }
}
