<?php

namespace Services;

class Service
{
    static public function arrayCovert(array $array): array
    {
        $resArr = [];
        $resArrAnswer = [];
        foreach ($array as $value){
            $resArr[$value->quest_id] = [
                'text'=>$value->qustions,
                'published'=>$value->published,
                'date'=>$value->date,
            ];
            if (!empty($value->answer_id)){
                $resArrAnswer[$value->quest_id]['answers'][$value->answer_id] = [
                    'answer'=>$value->answer,
                    'voices'=>$value->voices,
                    'update'=>1,
                ];
            }

            $resArr[$value->quest_id]['answers'] = $resArrAnswer[$value->quest_id]['answers'];

        }

//        foreach ($array as $value){
//            if (!empty($value->answer_id)){
//                $resArr[$value->quest_id]['answers'][$value->answer_id] = [
//                    'answer'=>$value->answer,
//                    'voices'=>$value->voices,
//                    'update'=>1,
//                ];
//            }
//        }
//        echo "<pre>".print_r($resArr,1)."</pre>";
//        echo "<pre>".print_r($resArrAnswer,1)."</pre>";
//        exit();
        return $resArr;
    }
}