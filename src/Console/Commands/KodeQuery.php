<?php namespace Rohmadst\Kodegenerator\Console\Commands;

use File;

class KodeQuery extends KodeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kode:query {name} {prefix=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Query Builder (controller, repository).';

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
        if (!$this->confirm('Have you added the script {{kodegenerator}} in the file controller/repository? [y|N]')) {
            return false;
        }

        $name = $this->argument('name');
        $prefix = $this->argument('prefix');

        $prefix = empty($prefix) ? $name : $prefix;

        $ask_function = $this->ask('What is name of method?');
        $ask_table = $this->ask('What is name of table?');
        $ask_field = $this->ask('What field you want to display ? | Split by comma (,) if has more.');
        $is_request = false;
        $is_controller = true;

        if ($this->confirm('Do you want add a Request in method? [y|N]')) {
            $is_request = true;
        }

        if (!$this->confirm('Do you also want to add in the Controller ? [y|N]')) {
            $is_controller = false;
        }

        // Answer
        $join_result = '';
        $name_function = empty($ask_function) ? 'getQuery' : $ask_function;
        $table = empty($ask_table) ? strtolower($name) : $ask_table;

        $field = empty($ask_field) ? '' : $ask_field;
        $field = preg_replace('/\s+/', '', $field);
        $field_split = explode(',', $field);
        $field_result = '';

        for ($i = 0; $i < count($field_split); $i ++) {
            $field_result .= "'" . $field_split[$i] . "',\n";
        }

        $select = empty($ask_field) ? '' : "->select([" . $field_result . "])";

        if (!$this->confirm('Do you want to add join? [y|N]')) {
            goto generate;
        }

        // Process get join
        join:
        $ask_join = $this->ask('Please insert join | Format. {target table}:{table1:index1}:{table2:index2}', null);
        $join = empty($ask_join) ? '' : $ask_join;

        $join = preg_replace('/\s+/', '', $join);
        $join_split = explode(':', $join);
        $target_table = empty($join_split[0]) ? $table : $join_split[0];
        $table1 = empty($join_split[1]) ? 'undefined' : $join_split[1];
        $index1 = empty($join_split[2]) ? 'id' : $join_split[2];
        $table2 = empty($join_split[3]) ? 'undefined' : $join_split[3];
        $index2 = empty($join_split[4]) ? 'id' : $join_split[4];

        $join_result .= "->join('" . $target_table . "', '" . $table1 . "." . $index1 . "', '=', '" . $table2 . "." . $index2 . "')\n";

        if ($this->confirm('Do you want to add a join more ? [y|N]')) {
            goto join;
        }

        generate:
        if ($is_controller == true) {
            $this->kodeGenerateQueryController($name, $prefix, $name_function, $is_request);
        }

        $this->kodeGenerateQueryRepository($name, $table, $select, $join_result, $name_function, $prefix, $is_request);
    }
}
