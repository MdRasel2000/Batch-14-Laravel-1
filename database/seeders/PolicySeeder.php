<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
          $policy =  [
           [

            'privacy_policy' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'terms_conditions' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'refund_policy' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'payment_policy' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'about_us' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',


           ]


           ];

           Policy::insert( $policy);
    }
}
