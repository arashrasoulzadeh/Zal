<?php

namespace arashrasoulzadeh\Zal\Commands;

use Illuminate\Console\Command;

class ZalCommand extends Command
{
    public $signature = 'zal';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
