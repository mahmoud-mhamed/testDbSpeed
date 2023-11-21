<?php

namespace App\Actions;

use App\Models\Result;
use Lorisleiva\Actions\Concerns\AsAction;

class TruncateResultAction
{
    use AsAction;

    public function handle()
    {
        Result::truncate();
        return back();
    }
}
