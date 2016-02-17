<?php namespace Rohmadst\Kodegenerator\Console\Commands;

use File;

class KodeResource extends KodeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kode:resource {name} {prefix=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new full resource CRUD (migrate, controller, repository, model, request).';

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
        $prefix = $this->argument('prefix');

        $prefix = empty($prefix) ? $name : $prefix;

        $ask_table = $this->ask('What is name of table?');
        $ask_field = $this->ask('What is your fields? | Split by comma (,) if has more.');

        // Answer
        $table = empty($ask_table) ? strtolower($name) : $ask_table;
        $ask_field = preg_replace('/\s+/', '', $ask_field);
        $field_list = explode(',', $ask_field);

        $fields_migrate = '';
        $fields_repository = '';
        $fields_model = '';

        // for variable in request form
        $fields_rules = '';
        $fields_attr = '';
        $fields_input = '';
        $field_validate = '';

        $field_search = ''; // for search by value in repository
        for ($i = 0; $i < count($field_list); $i ++) {
            $field_split = explode(':', $field_list[$i]);
            $field_name = empty($field_split[0]) ? 'noname' : $field_split[0]; // field
            $field_type = empty($field_split[1]) ? 'string' : $field_split[1]; // type
            $field_optional = empty($field_split[2]) ? '' : '->' . $field_split[2]; // optional. ex: default(0)

            $fields_migrate .= "\$table->" . $field_type . "('" . $field_name . "')" . $field_optional . ";\n";
            $field_search = '';
            if ($i == 0) {
                $field_search = $field_name;
            }

            $fields_repository .= "'" . $field_name . "' => \$data['" . $field_name . "'],\n";
            $fields_model .= "'" . $field_name . "',\n";

            $status = 'required';
            switch ($field_type) {
                case 'string' :
                    $status = 'required|max:255';
                    break;
                case 'integer':
                    $status = 'required|integer|max:10000000000';
                    break;
                case 'double':
                    $status = 'required|numeric|max:10000000000';
                    break;
                case 'smallInteger':
                    $status = 'required|integer|max:10';
                    break;
                case 'boolean':
                    $status = 'required|boolean';
                    break;
            }

            // for request
            $reg_patterns = ['/_id/', '/_/'];
            $reg_replace = ['', ' '];
            $nm = preg_replace($reg_patterns, $reg_replace, $field_name);
            $nm_attr = ucwords(strtolower($nm));
            $fields_rules .= "'" . $field_name . "' => '" . $status . "',\n";
            $fields_attr .= "'" . $field_name . "' => '" . $nm_attr . "',\n";
            $fields_input .= "'" . $field_name . "',\n";
            $field_validate .= "'" . $field_name . "' => \$message->first('" . $field_name . "'),\n";

        }

        // generate request
        $this->kodeGenerateMigrate($name, $table, $fields_migrate); //migrate
        $this->kodeGenerateController($name, $prefix); //controller
        $this->kodeGenerateRepository($name, $table, $fields_repository, $prefix, $field_search); //repository
        $this->kodeGenerateModel($name, $table, $fields_model, $prefix); // model
        $this->kodeGenerateRequest($name, $fields_rules, $fields_attr, $fields_input, $prefix, $field_validate); // request
    }
}
