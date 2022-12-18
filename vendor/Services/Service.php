<?php

namespace Services;

class Service
{
    static public function arrayCovert(array $array): array
    {
        $resArr = [];

        foreach ($array as $value){
            $resArr[$value->quest_id] = [
                'text'=>$value->qustions,
                'published'=>$value->published,
                'date'=>$value->date,
            ];
        }

        foreach ($array as $value){
            if (!empty($value->answer_id)){
                $resArr[$value->quest_id]['answers'][$value->answer_id] = [
                    'answer'=>$value->answer,
                    'voices'=>$value->voices,
                    'update'=>1,
                ];
            }
        }

        return $resArr;
    }
}