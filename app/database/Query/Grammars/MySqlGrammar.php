<?php

namespace App\Database\Query\Grammars;

use Illuminate\Database\Query\Grammars\MySqlGrammar as BaseMySqlGrammar;

class MySqlGrammar extends BaseMySqlGrammar
{
    public function compileThreadsConnected()
    {
        return "select variable_value as `Value` from INFORMATION_SCHEMA.SESSION_STATUS where variable_name = 'Threads_connected'";
    }
}