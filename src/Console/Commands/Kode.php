<?php namespace Rohmadst\Kodegenerator\Console\Commands;

use Illuminate\Console\Command;

class Kode extends Command
{
    /**
     * Replace character in templates migrate
     *
     * @param $str
     * @param $namespace
     * @param $table
     * @param $fields
     *
     * @return mixed
     */
    public function regexMigrate($str, $namespace, $table, $fields)
    {
        $patterns = ['/{{namespace}}/', '/{{var_table}}/', '/{{var_field}}/'];
        $replacements = [$namespace, $table, $fields];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * Replace character in templates controller
     *
     * @param $str
     * @param $namespace
     * @param $prefix
     *
     * @return mixed
     */
    public function regexController($str, $namespace, $prefix)
    {
        $patterns = ['/{{namespace}}/', '/{{var_namespace}}/', '/{{prefix}}/'];
        $replacements = [$namespace, lcfirst($namespace), $prefix];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * Replace character in templates repository
     *
     * @param $str
     * @param $namespace
     * @param $table
     * @param $fields
     * @param $prefix
     * @param $search
     *
     * @return mixed
     */
    public function regexRepository($str, $namespace, $table, $fields, $prefix, $search)
    {
        $patterns = ['/{{namespace}}/', '/{{var_namespace}}/', '/{{var_comment}}/', '/{{var_tags}}/', '/{{var_field}}/', '/{{prefix}}/', '/{{var_search}}/'];
        $replacements = [$namespace, lcfirst($namespace), $namespace, preg_replace('/_/', '-', $table), $fields, $prefix, $search];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * Replace character in templates model
     *
     * @param $str
     * @param $namespace
     * @param $table
     * @param $fields
     * @param $prefix
     *
     * @return mixed
     */
    public function regexModel($str, $namespace, $table, $fields, $prefix)
    {
        $patterns = ['/{{namespace}}/', '/{{var_namespace}}/', '/{{var_comment}}/', '/{{var_tags}}/', '/{{var_table}}/', '/{{var_fillable}}/', '/{{prefix}}/'];

        $replacements = [$namespace, lcfirst($namespace), $namespace, preg_replace('/_/', '-', $table), $table, $fields, $prefix];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * Replace character in templates request
     *
     * @param $str
     * @param $namespace
     * @param $rules
     * @param $attr
     * @param $input
     * @param $prefix
     * @param $validation
     *
     * @return mixed
     */
    public function regexRequest($str, $namespace, $rules, $attr, $input, $prefix, $validation)
    {
        $patterns = ['/{{namespace}}/', '/{{var_rules}}/', '/{{var_attributes}}/', '/{{var_input}}/', '/{{prefix}}/', '/{{var_validation}}/'];

        $replacements = [$namespace, $rules, $attr, $input, $prefix, $validation];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }
}
