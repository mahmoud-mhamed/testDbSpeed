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
        /*$key = 'Provident';*/
        /*dd(
            Lorem::query()
                ->whereFullText(["title_full", "description_full"], $key)
                ->select('title_full','description_full')
                ->get(),
            Lorem::query()
                ->whereFullText(["title_full_one"], $key)
                ->select('title_full')
                ->get(),
            Lorem::query()
                ->whereFullText(["title_full_index"], $key)
                ->select('title_full_index')
                ->get(),
            Lorem::query()
                ->where('title', 'like', "%$key%")->orWhere('description', 'like', "%$key%")
                ->get(),
            Lorem::query()
                ->where('title', 'like', "%$key%")
                ->get(),
        );*/
//        ResultStoreAction::make()->storeSearch('Provident');
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
        ];
    }

    public function roundTime($number)
    {
        return round($number, 4);
    }
}
