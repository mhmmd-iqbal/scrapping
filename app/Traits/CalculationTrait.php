<?php 

namespace App\Traits;

use App\Models\DataTraining;

trait CalculationTrait{
    public static function accurationTest()
    {
        $dataTrainings = new DataTraining();
        // $BrandSizeModel = $dataTrainings
        //     ->ofSize(true)
        //     ->ofBrand(true)
        //     ->ofModel(true)
        //     ->get();

        // $BrandModel = $dataTrainings
        //     ->ofSize(false)
        //     ->ofBrand(true)
        //     ->ofModel(true)
        //     ->get();

        // $SizeModel = $dataTrainings
        //     ->ofSize(true)
        //     ->ofBrand(false)
        //     ->ofModel(true)
        //     ->get();
            
        // $BrandSize = $dataTrainings
        //     ->ofSize(true)
        //     ->ofBrand(true)
        //     ->ofModel(false)
        //     ->get();

        $allData = $dataTrainings->get();
        $result = [
            'all'  => [
                'TF'    => 0,
                'TT'    => 0
            ],
            'part'  => [
                'TF'    => 0,
                'TT'    => 0
            ],
            'single'  => [
                'TF'    => 0,
                'TT'    => 0
            ],
        ];

        foreach ($allData as $key => $data) {
            if(
                $data['size'] &&
                $data['brand'] &&
                $data['model']
            ) {
                !self::checkModel($data['title']) ? 
                $result['all']['TF'] ++ : 
                $result['all']['TT'] ++; 
            }

            else if(
                ($data['size'] && $data['brand']) ||
                ($data['size'] && $data['model']) ||
                ($data['brand'] && $data['model'])
            ) {
                !self::checkModel($data['title']) ? 
                $result['part']['TF'] ++ : 
                $result['part']['TT'] ++;
            }

            else if (
                $data['size'] ||
                $data['brand'] ||
                $data['model']
            ) {
                !self::checkModel($data['title']) ? 
                $result['single']['TF'] ++ : 
                $result['single']['TT'] ++;
            }
        }

        return $result;
    }

    public static function checkModel($title)
    {
        if (preg_match('/[A-Za-z]/', $title) && preg_match('/[0-9]/', $title)) {
            if(strlen($title) < 3) {
                return false;
            }

            return true;
        }
    }

    
}