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
        $total_row = Lorem::query()->count();
        $results = Result::orderBy('id', 'desc')->paginate(10);

        $averages = [];
        $averages[] = $this->getAvg(ResultSearchTypeEnum::FIRST);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::LAST);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::FIND);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::FIND_IN_TOP);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::NORMAL_LIKE_1COL);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::INDEX_LIKE_1COL);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::FULL_TEXT_1COL);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::FULL_TEXT_1_COL_INDEX);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::NORMAL_LIKE_2COL);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::INDEX_LIKE_2COL);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::FULL_TEXT_2COL);
        $averages[] = $this->getAvg(ResultSearchTypeEnum::GET, ResultTypeEnum::FULL_TEXT_INDEX_2COL);
        return view('lorem', compact('results', 'total_row', 'averages'));
    }

    private function getAvg(ResultSearchTypeEnum $resultSearchTypeEnum, ResultTypeEnum $resultTypeEnum = null): array
    {
        $class='bg-white';
        if (in_array($resultTypeEnum,[
            ResultTypeEnum::FULL_TEXT_1COL,ResultTypeEnum::FULL_TEXT_1_COL_INDEX,
            ResultTypeEnum::FULL_TEXT_2COL,ResultTypeEnum::FULL_TEXT_INDEX_2COL
        ])){
            $class='bg-amber-100 ';
        }
        $query = Result::where('type', $resultTypeEnum)->where('search_type', $resultSearchTypeEnum);
        return [
            'name' => $resultSearchTypeEnum->value . ($resultTypeEnum ? ' - ' . $resultTypeEnum->value : ''),
            'avg' => $this->roundTime($query->clone()->avg('time')),
            'min' => $this->roundTime($query->clone()->min('time')),
            'max' => $this->roundTime($query->clone()->max('time')),
            'avg_count' => round($query->clone()->avg('count')),
            'count' => $query->clone()->count(),
            'first_query' => $query->first()?->query,
            'resultSearchTypeEnum' => $resultSearchTypeEnum,
            'resultTypeEnum' => $resultTypeEnum,
            'class'=>$class,
        ];
    }

    public function roundTime($number)
    {
        return round($number, 4);
    }
}
