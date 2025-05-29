<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            // NIERUCHOMOŚCI NA WYNAJEM
            [
                'country' => 'Polska',
                'region' => 'Wielkopolskie',
                'town' => 'Poznań',
                'postal_code' => '60-101',
                'street' => 'ul. Święty Marcin',
                'building_number' => '12A',
                'apartment_number' => 15,
                'type' => 'Mieszkanie',
                'surface' => 45.50,
                'number_of_rooms' => 2,
                'floor' => 3,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'W pełni umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Mazowieckie',
                'town' => 'Warszawa',
                'postal_code' => '00-001',
                'street' => 'ul. Nowy Świat',
                'building_number' => '25',
                'apartment_number' => 8,
                'type' => 'Mieszkanie',
                'surface' => 38.00,
                'number_of_rooms' => 1,
                'floor' => 2,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Częściowo umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Małopolskie',
                'town' => 'Kraków',
                'postal_code' => '31-001',
                'street' => 'ul. Floriańska',
                'building_number' => '8',
                'apartment_number' => 12,
                'type' => 'Mieszkanie',
                'surface' => 62.75,
                'number_of_rooms' => 3,
                'floor' => 1,
                'technical_condition' => 'Do remontu',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Pomorskie',
                'town' => 'Gdańsk',
                'postal_code' => '80-001',
                'street' => 'ul. Długa',
                'building_number' => '33',
                'apartment_number' => 5,
                'type' => 'Mieszkanie',
                'surface' => 55.25,
                'number_of_rooms' => 2,
                'floor' => 4,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'W pełni umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Dolnośląskie',
                'town' => 'Wrocław',
                'postal_code' => '50-001',
                'street' => 'ul. Rynek',
                'building_number' => '14',
                'apartment_number' => null,
                'type' => 'Lokal użytkowy',
                'surface' => 85.00,
                'number_of_rooms' => 4,
                'floor' => 0,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Śląskie',
                'town' => 'Katowice',
                'postal_code' => '40-001',
                'street' => 'ul. 3 Maja',
                'building_number' => '7B',
                'apartment_number' => 23,
                'type' => 'Mieszkanie',
                'surface' => 72.30,
                'number_of_rooms' => 3,
                'floor' => 5,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Częściowo umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Łódzkie',
                'town' => 'Łódź',
                'postal_code' => '90-001',
                'street' => 'ul. Piotrkowska',
                'building_number' => '156',
                'apartment_number' => 4,
                'type' => 'Mieszkanie',
                'surface' => 48.75,
                'number_of_rooms' => 2,
                'floor' => 2,
                'technical_condition' => 'Do remontu',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Wielkopolskie',
                'town' => 'Poznań',
                'postal_code' => '61-701',
                'street' => 'ul. Grunwaldzka',
                'building_number' => '182',
                'apartment_number' => null,
                'type' => 'Dom',
                'surface' => 120.00,
                'number_of_rooms' => 5,
                'floor' => 0,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'W pełni umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Kujawsko-pomorskie',
                'town' => 'Bydgoszcz',
                'postal_code' => '85-001',
                'street' => 'ul. Gdańska',
                'building_number' => '89',
                'apartment_number' => 17,
                'type' => 'Mieszkanie',
                'surface' => 41.50,
                'number_of_rooms' => 2,
                'floor' => 3,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Częściowo umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Zachodniopomorskie',
                'town' => 'Szczecin',
                'postal_code' => '70-001',
                'street' => 'al. Niepodległości',
                'building_number' => '22',
                'apartment_number' => null,
                'type' => 'Lokal użytkowy',
                'surface' => 95.25,
                'number_of_rooms' => 3,
                'floor' => 1,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Nieumeblowane'
            ],

            // NIERUCHOMOŚCI NA SPRZEDAŻ
            [
                'country' => 'Polska',
                'region' => 'Mazowieckie',
                'town' => 'Warszawa',
                'postal_code' => '02-001',
                'street' => 'ul. Mokotowska',
                'building_number' => '45',
                'apartment_number' => 28,
                'type' => 'Mieszkanie',
                'surface' => 68.50,
                'number_of_rooms' => 3,
                'floor' => 6,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Małopolskie',
                'town' => 'Kraków',
                'postal_code' => '30-001',
                'street' => 'ul. Karmelicka',
                'building_number' => '18C',
                'apartment_number' => null,
                'type' => 'Dom',
                'surface' => 180.00,
                'number_of_rooms' => 6,
                'floor' => 0,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Częściowo umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Wielkopolskie',
                'town' => 'Poznań',
                'postal_code' => '60-201',
                'street' => 'ul. Roosevelta',
                'building_number' => '91',
                'apartment_number' => 14,
                'type' => 'Mieszkanie',
                'surface' => 52.25,
                'number_of_rooms' => 2,
                'floor' => 4,
                'technical_condition' => 'Do remontu',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Pomorskie',
                'town' => 'Gdynia',
                'postal_code' => '81-001',
                'street' => 'ul. Świętojańska',
                'building_number' => '127',
                'apartment_number' => null,
                'type' => 'Dom',
                'surface' => 145.75,
                'number_of_rooms' => 5,
                'floor' => 0,
                'technical_condition' => 'Budynek w stanie surowym',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Dolnośląskie',
                'town' => 'Wrocław',
                'postal_code' => '51-001',
                'street' => 'ul. Świdnicka',
                'building_number' => '65',
                'apartment_number' => 9,
                'type' => 'Mieszkanie',
                'surface' => 78.00,
                'number_of_rooms' => 4,
                'floor' => 2,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'W pełni umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Śląskie',
                'town' => 'Chorzów',
                'postal_code' => '41-500',
                'street' => 'ul. Wolności',
                'building_number' => '34A',
                'apartment_number' => null,
                'type' => 'Dom',
                'surface' => 165.50,
                'number_of_rooms' => 6,
                'floor' => 0,
                'technical_condition' => 'Do kapitalnego remontu',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Lubelskie',
                'town' => 'Lublin',
                'postal_code' => '20-001',
                'street' => 'ul. Krakowskie Przedmieście',
                'building_number' => '78',
                'apartment_number' => 11,
                'type' => 'Mieszkanie',
                'surface' => 43.25,
                'number_of_rooms' => 2,
                'floor' => 1,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Częściowo umeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Podkarpackie',
                'town' => 'Rzeszów',
                'postal_code' => '35-001',
                'street' => 'ul. 3 Maja',
                'building_number' => '15',
                'apartment_number' => null,
                'type' => 'Lokal użytkowy',
                'surface' => 110.00,
                'number_of_rooms' => 5,
                'floor' => 0,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Warmińsko-mazurskie',
                'town' => 'Olsztyn',
                'postal_code' => '10-001',
                'street' => 'ul. Mickiewicza',
                'building_number' => '52',
                'apartment_number' => 7,
                'type' => 'Mieszkanie',
                'surface' => 61.75,
                'number_of_rooms' => 3,
                'floor' => 3,
                'technical_condition' => 'Do remontu',
                'furnishings' => 'Nieumeblowane'
            ],
            [
                'country' => 'Polska',
                'region' => 'Opolskie',
                'town' => 'Opole',
                'postal_code' => '45-001',
                'street' => 'ul. Krakowska',
                'building_number' => '28B',
                'apartment_number' => null,
                'type' => 'Dom',
                'surface' => 195.00,
                'number_of_rooms' => 7,
                'floor' => 0,
                'technical_condition' => 'Gotowy do zamieszkania',
                'furnishings' => 'W pełni umeblowane'
            ]
        ];

        foreach ($properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();
            DB::table('properties')->insert($property);
        }
    }
}
