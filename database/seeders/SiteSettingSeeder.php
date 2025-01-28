<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [

                        [
                            
                            'phone' => '01633406443',
                            'email' => 'ctgmdraselislam@gmail.com',
                            'address' => 'Textile,Bayezid,Chittagong',
                            'facebook' => 'https://www.facebook.com/',
                            'twitter' => 'https://x.com',
                            'instagram' => 'https://www.instagram.com/mdraselaliaoo/',
                            'youtube' => 'https://www.youtube.com/@MechanicalCAD-2020',
                            'logo' => 'logo.png',
                            'banner' => 'banner.png',
                            
                        ]
                   ];

                   SiteSettings::insert($settings);
    }
}
