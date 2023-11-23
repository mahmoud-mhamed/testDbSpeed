<?php

namespace App\Actions;

use App\Enums\ResultSearchTypeEnum;
use App\Enums\ResultTypeEnum;
use App\Models\Result;
use App\Models\Lorem;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ResultStoreAction
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
        $this->storeFindById(1000000,ResultSearchTypeEnum::FIND);
        $this->storeFindById(1,ResultSearchTypeEnum::FIND_IN_TOP);
        $this->storeFirstRowSpeed();
        $this->storeLastRowSpeed();
        $this->storeNormalLikeOneColumn($key);
        $this->storeIndexLikeOneColumn($key);
        $this->storeIndexLikeTwoColumn($key);
        $this->storeNormalLikeTwoColumn($key);
        $this->storeFullTextColumn($key);
        $this->storeFullTextIndexColumn($key);
    }

    public function getQueryLog($query, ResultSearchTypeEnum $searchTypeEnum=ResultSearchTypeEnum::FIRST,$key=null,$find_id=null)
    {
        DB::connection()->enableQueryLog();
        if ($searchTypeEnum === ResultSearchTypeEnum::FIRST) {
            $r=$query->clone()->first();
            $count=$r?1:0;
        } elseif ($searchTypeEnum === ResultSearchTypeEnum::LAST) {
            $r=$query->clone()->latest('id')->first();
            $count=$r?1:0;
        }elseif ($searchTypeEnum === ResultSearchTypeEnum::FIND) {
            $r=$query->clone()->find($find_id);
            $count=$r?1:0;
        }elseif ($searchTypeEnum === ResultSearchTypeEnum::FIND_IN_TOP) {
            $r=$query->clone()->find($find_id);
            $count=$r?1:0;
        }elseif ($searchTypeEnum === ResultSearchTypeEnum::GET) {
            $r=$query->clone()->get();
            $count=count($r);
        }else{
            dd($searchTypeEnum);
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
        $result['count'] = $count;
        DB::connection()->disableQueryLog();
        if ($key){
            dd($queries);
        }
        return $result;
    }

    private function storeFirstRowSpeed(): void
    {
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type' => ResultSearchTypeEnum::FIRST,
            ...$this->getQueryLog(Lorem::query(), ResultSearchTypeEnum::FIRST)
        ]);
    }
    private function storeFindById($id,ResultSearchTypeEnum $resultSearchTypeEnum): void
    {
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type' => $resultSearchTypeEnum,
            ...$this->getQueryLog(Lorem::query(),  $resultSearchTypeEnum,find_id: $id)
        ]);
    }

    private function storeLastRowSpeed(): void
    {
        $query = Lorem::query()->latest('id');
        Result::query()->create([
            'type' => null,
            'search_key' => null,
            'search_type' => ResultSearchTypeEnum::LAST,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::FIRST)
        ]);
    }
    private function storeNormalLikeOneColumn($key): void
    {
        $query = Lorem::query()->where('title','like',"%$key%");
        Result::query()->create([
            'type' => ResultTypeEnum::NORMAL_LIKE_1_COL,
            'search_key' => $key,
            'search_type' => ResultSearchTypeEnum::GET,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::GET)
        ]);
    }
    private function storeIndexLikeOneColumn($key): void
    {
        $query = Lorem::query()->where('title_index','like',"%$key%");
        Result::query()->create([
            'type' => ResultTypeEnum::INDEX_LIKE_1_COL,
            'search_key' => $key,
            'search_type' => ResultSearchTypeEnum::GET,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::GET)
        ]);
    }
    private function storeNormalLikeTwoColumn($key): void
    {
        $query = Lorem::query()->where('title','like',"%$key%")->orWhere('description','like',"%$key%");
        Result::query()->create([
            'type' => ResultTypeEnum::NORMAL_LIKE_2_COL,
            'search_key' => $key,
            'search_type' => ResultSearchTypeEnum::GET,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::GET)
        ]);
    }
    private function storeIndexLikeTwoColumn($key): void
    {
        $query = Lorem::query()->where('title_index','like',"%$key%")->orWhere('description_index','like',"%$key%");
        Result::query()->create([
            'type' => ResultTypeEnum::INDEX_LIKE_2_COL,
            'search_key' => $key,
            'search_type' => ResultSearchTypeEnum::GET,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::GET)
        ]);
    }
    private function storeFullTextColumn($key): void
    {
        $query = Lorem::query()->whereFullText(["title_full","description_full"],$key);
        Result::query()->create([
            'type' => ResultTypeEnum::FULL_TEXT_2_COL,
            'search_key' => $key,
            'search_type' => ResultSearchTypeEnum::GET,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::GET)
        ]);
    }
    private function storeFullTextIndexColumn($key): void
    {
        $query = Lorem::query()->whereFullText(["title_full_index","description_full_index"],$key);
        Result::query()->create([
            'type' => ResultTypeEnum::FULL_TEXT_INDEX_2_COL,
            'search_key' => $key,
            'search_type' => ResultSearchTypeEnum::GET,
            ...$this->getQueryLog($query, ResultSearchTypeEnum::GET)
        ]);
    }
}
