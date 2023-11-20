<?php

namespace App\Actions;

use App\Enums\ResultSearchTypeEnum;
use App\Models\Result;
use App\Models\TestFullText;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchStoreAction
{
    use AsAction;

    public function rules()
    {
        return [
            'search'=>'required|min:1'
        ];
    }
    public function handle(ActionRequest $request)
    {
        $search_key=$request->validated()['search'];
        $this->storeFirstRowSpeed();
        $this->storeLastRowSpeed();
        return redirect()->back();
    }

    public function getQueryLog($query,$get_type='first')
    {
        DB::connection()->enableQueryLog();
        $query->clone()->first();
        $queries = DB::getQueryLog();
        $count_q=count($queries)-1;
        $result=$queries[$count_q];
        $el_query=$queries[$count_q]['query'];
        $replace=[];
        foreach ($queries[$count_q]['bindings'] as $binding) {
            $replace[]='?';
        }
        $result['query']=str_replace($replace,$queries[$count_q]['bindings'],$el_query);
        DB::connection()->disableQueryLog();
        return $result;
    }
    private function storeFirstRowSpeed(): void
    {
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type'=>ResultSearchTypeEnum::FIRST,
            ...$this->getQueryLog(TestFullText::query(),'first')
        ]);
    }
    private function storeLastRowSpeed(): void
    {
        $query=TestFullText::query()->latest();
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type'=>ResultSearchTypeEnum::LAST,
            ...$this->getQueryLog($query,'first')
        ]);
    }
}
