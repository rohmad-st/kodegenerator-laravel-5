<?php namespace Rohmadst\Kodegenerator\Console\Commands;

use File;

class KodeCommand extends Kode
{

    /**
     * Generate migrate
     *
     * @param $namespace
     * @param $table
     * @param $fields
     */
    public function kodeGenerateMigrate($namespace, $table, $fields)
    {
        // get file templates
        $migrate = file_get_contents(__DIR__ . '/Stubs/migrate.stub');

        // replace character
        $migrate = $this->regexMigrate($migrate, $namespace, $table, $fields);

        // location path file
        $folder_migrate = base_path(config('kodegenerator.source.root_migrate'));

        if (!is_dir($folder_migrate)) {
            //create folder
            File::makeDirectory($folder_migrate, 0775, true);
        }

        // file
        $migrate_name = date('Y_m_d_His') . '_create_table_' . $table;
        $file_migrate = $folder_migrate . '/' . $migrate_name . '.php';

        // create file
        File::put($file_migrate, $migrate);

        // Info
        $this->info('Migrate: ' . $file_migrate . ' created successfully.');
    }

    /**
     * Generate controller
     *
     * @param $namespace
     * @param $prefix
     */
    public function kodeGenerateController($namespace, $prefix)
    {
        // get file templates
        $controller = file_get_contents(__DIR__ . '/Stubs/controller.stub');

        $controller = $this->regexController($controller, $namespace, $prefix);

        // location path file
        $folder_controller = base_path(config('kodegenerator.source.root_controller') . '/Api/' . config('kodegenerator.source.api_version') . '/' . $prefix);

        if (!is_dir($folder_controller)) {
            //create folder
            File::makeDirectory($folder_controller, 0775, true);
        }

        // file
        $file_controller = $folder_controller . '/' . $namespace . 'Controller.php';

        // create file
        File::put($file_controller, $controller);

        // Info
        $this->info('Controller: ' . $file_controller . ' created successfully.');
    }

    /**
     * Generate repository
     *
     * @param $namespace
     * @param $table
     * @param $fields
     * @param $prefix
     * @param $search
     */
    public function kodeGenerateRepository($namespace, $table, $fields, $prefix, $search)
    {
        // get file templates
        $repository = file_get_contents(__DIR__ . '/Stubs/repository.stub');

        // replace character
        $repository = $this->regexRepository($repository, $namespace, $table, $fields, $prefix, $search);

        // location path file
        $folder_repository = base_path(config('kodegenerator.source.root_repository') . '/' . $prefix);

        if (!is_dir($folder_repository)) {
            //create folder
            File::makeDirectory($folder_repository, 0775, true);
        }

        // file
        $file_repository = $folder_repository . '/' . $namespace . 'Repository.php';

        // create file
        File::put($file_repository, $repository);

        // Info
        $this->info('Repository: ' . $file_repository . ' created successfully.');
    }

    /**
     * Generate model
     *
     * @param $namespace
     * @param $table
     * @param $fields
     * @param $prefix
     */
    public function kodeGenerateModel($namespace, $table, $fields, $prefix)
    {
        // get file templates
        $model = file_get_contents(__DIR__ . '/Stubs/model.stub');

        // replace character
        $model = $this->regexModel($model, $namespace, $table, $fields, $prefix);

        // location path file
        $folder_model = base_path(config('kodegenerator.source.root_model') . '/' . $prefix);

        if (!is_dir($folder_model)) {
            //create folder
            File::makeDirectory($folder_model, 0775, true);
        }

        // file
        $file_model = $folder_model . '/' . $namespace . '.php';

        // create file
        File::put($file_model, $model);

        // Info
        $this->info('Model: ' . $file_model . ' created successfully.');
    }

    /**
     * Generate form request
     *
     * @param $namespace
     * @param $rules
     * @param $attr
     * @param $input
     * @param $prefix
     * @param $validation
     */
    public function kodeGenerateRequest($namespace, $rules, $attr, $input, $prefix, $validation)
    {
        // get file templates
        $request = file_get_contents(__DIR__ . '/Stubs/request.stub');

        // replace character
        $request = $this->regexRequest($request, $namespace, $rules, $attr, $input, $prefix, $validation);

        // location path file
        $folder_request = base_path(config('kodegenerator.source.root_request') . '/' . $prefix);

        if (!is_dir($folder_request)) {
            //create folder
            File::makeDirectory($folder_request, 0775, true);
        }

        // file
        $file_request = $folder_request . '/' . $namespace . 'FormRequest.php';

        // create file
        File::put($file_request, $request);

        // Info
        $this->info('Request: ' . $file_request . ' created successfully.');
    }

    /**
     * Generate method in controller
     *
     * @param         $namespace
     * @param         $prefix
     * @param         $name_function
     * @param boolean $is_request
     */
    public function kodeGenerateQueryController($namespace, $prefix, $name_function, $is_request = false)
    {

        // location path file
        $folder_controller = base_path(config('kodegenerator.source.root_controller') . '/Api/' . config('kodegenerator.source.api_version') . '/' . $prefix);

        if (!is_dir($folder_controller)) {
            //create folder
            File::makeDirectory($folder_controller, 0775, true);
        }

        // file
        $file_controller = $folder_controller . '/' . $namespace . 'Controller.php';

        // get file templates
        $controller = file_get_contents($file_controller);
        $controller_new = file_get_contents(__DIR__ . '/Stubs/query_controller.stub');

        $controller_new = $this->regexQueryController($controller_new, $namespace, $name_function, $is_request);

        // last of result
        $controller = preg_replace(['/{{kodegenerator}}/'], [$controller_new], $controller);

        // update file
        File::put($file_controller, $controller);

        // Info
        $this->info('Controller: ' . $file_controller . ' updated successfully.');
    }

    /**
     * Generate method query builder in repository
     *
     * @param         $namespace
     * @param         $table
     * @param         $select
     * @param         $join
     * @param         $name_function
     * @param         $prefix
     * @param boolean $is_request
     */
    public function kodeGenerateQueryRepository($namespace, $table, $select, $join, $name_function, $prefix, $is_request = false)
    {
        // location path file
        $folder_repository = base_path(config('kodegenerator.source.root_repository') . '/' . $prefix);

        if (!is_dir($folder_repository)) {
            //create folder
            File::makeDirectory($folder_repository, 0775, true);
        }

        // file
        $file_repository = $folder_repository . '/' . $namespace . 'Repository.php';

        // get file templates
        $repository = file_get_contents($file_repository);
        $repository_new = file_get_contents(__DIR__ . '/Stubs/query_repository.stub');

        // replace character
        $repository_new = $this->regexQueryRepository($repository_new, $namespace, $table, $select, $join, $name_function, $is_request);

        // last of result
        $repository = preg_replace(['/{{kodegenerator}}/'], [$repository_new], $repository);

        // create file
        File::put($file_repository, $repository);

        // Info
        $this->info('Repository: ' . $file_repository . ' updated successfully.');
    }

}
