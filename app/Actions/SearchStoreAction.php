<?php

namespace App\Actions;

use App\Enums\ResultSearchTypeEnum;
use App\Models\Result;
use App\Models\Lorem;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchStoreAction
{
    use AsAction;

    public function rules()
    {
        return [
            'search' => 'required|min:1'
        ];
    }

    public function handle(ActionRequest $request)
    {
        $search_key = $request->validated()['search'];
        $this->storeSearch($search_key);
        return redirect()->back();
    }

    public function storeSearch($key): void
    {
        $this->storeFirstRowSpeed();
        $this->storeLastRowSpeed();
        $this->storeLastByIdRowSpeed();
    }

    public function getQueryLog($query, $get_type = 'first')
    {
        DB::connection()->enableQueryLog();
        if ($get_type === 'first') {
            $query->clone()->first();
        } elseif ($get_type === 'last') {
            $query->clone()->latest()->first();
        }else{
            dd($get_type);
        }
        $queries = DB::getQueryLog();
        $count_q = count($queries) - 1;
        $result = $queries[$count_q];
        $el_query = $queries[$count_q]['query'];
        $replace = [];
        foreach ($queries[$count_q]['bindings'] as $binding) {
            $replace[] = '?';
        }
        $result['query'] = str_replace($replace, $queries[$count_q]['bindings'], $el_query);
        DB::connection()->disableQueryLog();
        return $result;
    }

    private function storeFirstRowSpeed(): void
    {
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type' => ResultSearchTypeEnum::FIRST,
            ...$this->getQueryLog(Lorem::query(), 'first')
        ]);
    }

    private function storeLastRowSpeed(): void
    {
        $query = Lorem::query()->latest();
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type' => ResultSearchTypeEnum::LAST,
            ...$this->getQueryLog($query, 'first')
        ]);
    }
    private function storeLastByIdRowSpeed(): void
    {
        $query = Lorem::query()->orderByDesc('id');
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type' => ResultSearchTypeEnum::LAST_BY_ID,
            ...$this->getQueryLog($query, 'first')
        ]);
    }
}
