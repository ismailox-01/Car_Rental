<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'name' => 'Mohammed V International Airport (CMN)',
                'address' => 'Nouaceur, Casablanca',
                'city' => 'Casablanca',
                'is_active' => true,
            ],
            [
                'name' => 'Casablanca City Center',
                'address' => 'Boulevard d\'Anfa',
                'city' => 'Casablanca',
                'is_active' => true,
            ],
            [
                'name' => 'Marrakech Menara Airport (RAK)',
                'address' => 'Avenue Guemassa, Marrakech',
                'city' => 'Marrakech',
                'is_active' => true,
            ],
            [
                'name' => 'Marrakech - Gueliz',
                'address' => 'Avenue Mohamed V, Marrakech',
                'city' => 'Marrakech',
                'is_active' => true,
            ],
            [
                'name' => 'Tangier Ibn Battuta Airport (TNG)',
                'address' => 'Aéroport de Tanger-Ibn Battouta',
                'city' => 'Tangier',
                'is_active' => true,
            ],
            [
                'name' => 'Tangier City Port',
                'address' => 'Avenue Mohammed VI, Tangier',
                'city' => 'Tangier',
                'is_active' => true,
            ],
            [
                'name' => 'Agadir Al Massira Airport (AGA)',
                'address' => 'Aéroport d\'Agadir-Al Massira',
                'city' => 'Agadir',
                'is_active' => true,
            ],
            [
                'name' => 'Rabat-Salé Airport (RBA)',
                'address' => 'Aéroport de Rabat-Salé',
                'city' => 'Rabat',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
