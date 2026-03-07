<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Afghanistan', 'code' => 'AF'],
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Greece', 'code' => 'GR'],
            ['name' => 'Hungary', 'code' => 'HU'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Iran', 'code' => 'IR'],
            ['name' => 'Iraq', 'code' => 'IQ'],
            ['name' => 'Ireland', 'code' => 'IE'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'Jordan', 'code' => 'JO'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'Malaysia', 'code' => 'MY'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Morocco', 'code' => 'MA'],
            ['name' => 'Nepal', 'code' => 'NP'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'Norway', 'code' => 'NO'],
            ['name' => 'Oman', 'code' => 'OM'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Philippines', 'code' => 'PH'],
            ['name' => 'Poland', 'code' => 'PL'],
            ['name' => 'Portugal', 'code' => 'PT'],
            ['name' => 'Qatar', 'code' => 'QA'],
            ['name' => 'Romania', 'code' => 'RO'],
            ['name' => 'Russia', 'code' => 'RU'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'Singapore', 'code' => 'SG'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'South Korea', 'code' => 'KR'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Sri Lanka', 'code' => 'LK'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Thailand', 'code' => 'TH'],
            ['name' => 'Turkey', 'code' => 'TR'],
            ['name' => 'Ukraine', 'code' => 'UA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'Vietnam', 'code' => 'VN'],
        ];

        DB::table('countries')->insert($countries);
    }
}
