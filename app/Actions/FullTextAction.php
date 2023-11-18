<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class FullTextAction
{
    use AsAction;

    public function handle()
    {
        return view('full_text');
    }
}
