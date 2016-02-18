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

    /**
     * Replace character in templates query controller
     *
     * @param         $str
     * @param         $namespace
     * @param         $name_function
     * @param boolean $is_request
     *
     * @return mixed
     */
    public function regexQueryController($str, $namespace, $name_function, $is_request = false)
    {
        $request = '';
        $param_request = '';
        $var_request = '';
        if ($is_request == true) {
            $request = "Request \$request";
            $param_request = "@param\tRequest \$request";
            $var_request = "\$request->all()";
        }

        $patterns = ['/{{param_request}}/', '/{{name_function}}/', '/{{request}}/', '/{{var_namespace}}/', '/{{var_request}}/'];
        $replacements = [$param_request, $name_function, $request, lcfirst($namespace), $var_request];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }

    /**
     * Replace character in templates repository
     *
     * @param         $str
     * @param         $namespace
     * @param         $table
     * @param         $select
     * @param         $join
     * @param         $name_function
     * @param boolean $is_request
     *
     * @return mixed
     */
    public function regexQueryRepository($str, $namespace, $table, $select, $join, $name_function, $is_request = false)
    {
        $request = '';
        $param_request = '';
        $var_request = '';
        if ($is_request == true) {
            $request = "Request \$request";
            $param_request = "@param\tRequest \$request";
            $var_request = "\$request->all()";
        }

        $patterns = [
            '/{{namespace}}/',
            '/{{param_request}}/',
            '/{{var_table}}/',
            '/{{var_select}}/',
            '/{{var_join}}/',
            '/{{name_function}}/',
            '/{{request}}/',
            '/{{var_namespace}}/',
            '/{{var_request}}/',
            '/{{var_tags}}/',
            '/{{tags_function}}/'
        ];

        $replacements = [
            $namespace,
            $param_request,
            $table,
            $select,
            $join,
            $name_function,
            $request,
            lcfirst($namespace),
            $var_request,
            preg_replace('/_/', '-', $table),
            strtolower($name_function)
        ];

        // add string text
        return preg_replace($patterns, $replacements, $str);
    }

}
