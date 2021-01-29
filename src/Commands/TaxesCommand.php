<?php

namespace Tipoff\Taxes\Commands;

use Illuminate\Console\Command;

class TaxesCommand extends Command
{
    public $signature = 'taxes';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
