<?php

namespace App\Actions;

use App\Enums\ResultSearchTypeEnum;
use App\Enums\ResultTypeEnum;
use App\Models\Result;
use App\Models\Lorem;
use Lorisleiva\Actions\Concerns\AsAction;

class LoremIndexAction
{
    use AsAction;

    public function handle()
    {
        ResultStoreAction::make()->storeSearch('test');
        $total_row=Lorem::query()->count();
        $results=Result::orderBy('id','desc')->paginate(10);

        $averages=[];
        $averages[]=$this->getAvg(ResultSearchTypeEnum::FIRST);
        $averages[]=$this->getAvg(ResultSearchTypeEnum::LAST);
        $averages[]=$this->getAvg(ResultSearchTypeEnum::LAST_BY_ID);
        return view('lorem',compact('results','total_row','averages'));
    }

    private function getAvg(ResultSearchTypeEnum $resultSearchTypeEnum,ResultTypeEnum $resultTypeEnum=null): array
    {
        $query=Result::where('type',$resultTypeEnum)->where('search_type',$resultSearchTypeEnum);
        return [
            'name'=>$resultSearchTypeEnum->value.($resultTypeEnum?' - '.$resultTypeEnum->value:''),
            'avg'=>$this->roundTime($query->clone()->avg('time')),
            'min'=>$this->roundTime($query->clone()->min('time')),
            'max'=>$this->roundTime($query->clone()->max('time')),
            'count'=>$query->clone()->count(),
            'first_query'=>$query->first()?->query,
        ];
    }

    public function roundTime($number)
    {
        return round($number,4);
    }
}
