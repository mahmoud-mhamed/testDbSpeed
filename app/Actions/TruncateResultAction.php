<?php

namespace App\Actions;

use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class TruncateResultAction
{
    use AsAction;

    public function handle()
    {
        DB::table('results')->truncate();
        return back();
    }
}
