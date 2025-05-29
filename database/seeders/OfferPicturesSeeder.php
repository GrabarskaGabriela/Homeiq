<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class OfferPicturesSeeder extends Seeder
{
    public function run(): void
    {
        if (!Storage::disk('public')->exists('offer_pictures')) {
            Storage::disk('public')->makeDirectory('offer_pictures');
        }

        $unsplashUrls = [
            1 => [
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800',
                'https://images.unsplash.com/photo-1556909114-4bb7ba2967c1?w=800'
            ],
            2 => [
                'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800',
                'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800',
                'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
                'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=800'
            ],
            3 => [
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800'
            ],
            4 => [
                'https://images.unsplash.com/photo-1555636222-cae831e670b3?w=800',
                'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?w=800',
                'https://images.unsplash.com/photo-1571624436279-b272aff752b5?w=800'
            ],
            5 => [
                'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800',
                'https://images.unsplash.com/photo-1497366412874-3415097a27e7?w=800'
            ],
            6 => [
                'https://images.unsplash.com/photo-1564078516393-cf04bd966897?w=800',
                'https://images.unsplash.com/photo-1505691938895-1758d7feb511?w=800',
                'https://images.unsplash.com/photo-1540518614846-7eded47fa409?w=800',
                'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800'
            ],
            7 => [
                'https://images.unsplash.com/photo-1480074568708-e7b720bb3f09?w=800',
                'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800',
                'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800'
            ],
            8 => [
                'https://images.unsplash.com/photo-1565623833408-d77e39b88af6?w=800',
                'https://images.unsplash.com/photo-1567767292278-a4f21aa2d36e?w=800'
            ],
            9 => [
                'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800',
                'https://images.unsplash.com/photo-1581858726788-75bc0f6a4d14?w=800',
                'https://images.unsplash.com/photo-1562663474-6cbb3eaa4d14?w=800'
            ],
            10 => [
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800',
                'https://images.unsplash.com/photo-1542744173-05336fcc7ad4?w=800'
            ],
            // Oferty na sprzedaż (11-20)
            11 => [
                'https://images.unsplash.com/photo-1518780664697-55e3ad937233?w=800',
                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800',
                'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800',
                'https://images.unsplash.com/photo-1472224371017-08207f84aaae?w=800'
            ],
            12 => [
                'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800',
                'https://images.unsplash.com/photo-1588880331179-bc9b93a8cb5e?w=800',
                'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800'
            ],
            13 => [
                'https://images.unsplash.com/photo-1565623833408-d77e39b88af6?w=800',
                'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800'
            ],
            14 => [
                'https://images.unsplash.com/photo-1507089947368-19c1da9775ae?w=800',
                'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800',
                'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800',
                'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800',
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800'
            ],
            15 => [
                'https://images.unsplash.com/photo-1516455590571-18256e5bb9ff?w=800',
                'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800'
            ],
            16 => [
                'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
                'https://images.unsplash.com/photo-1591088398332-8a7791972843?w=800',
                'https://images.unsplash.com/photo-1600047509358-9dc75507daeb?w=800'
            ],
            17 => [
                'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?w=800',
                'https://images.unsplash.com/photo-1571624436279-b272aff752b5?w=800',
                'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800'
            ],
            18 => [
                'https://images.unsplash.com/photo-1540518614846-7eded47fa409?w=800',
                'https://images.unsplash.com/photo-1505691938895-1758d7feb511?w=800',
                'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=800',
                'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800'
            ],
            19 => [
                'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800',
                'https://images.unsplash.com/photo-1497366412874-3415097a27e7?w=800',
                'https://images.unsplash.com/photo-1542744173-05336fcc7ad4?w=800'
            ],
            20 => [
                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800',
                'https://images.unsplash.com/photo-1556909114-4bb7ba2967c1?w=800'
            ]
        ];

        $pictures = [];
        $now = now();

        foreach ($unsplashUrls as $offerId => $urls) {
            foreach ($urls as $index => $url) {
                try {
                    $response = Http::timeout(30)->get($url);

                    if ($response->successful()) {
                        $filename = "offer_{$offerId}_" . ($index + 1) . '_' . time() . '.jpg';
                        $path = "offer_pictures/{$filename}";

                        Storage::disk('public')->put($path, $response->body());
                        $pictures[] = [
                            'offer_id' => $offerId,
                            'path' => $path,
                            'created_at' => $now,
                            'updated_at' => $now
                        ];

                        $this->command->info("Pobrano zdjęcie dla oferty {$offerId}: {$filename}");
                    }
                } catch (\Exception $e) {
                    $this->command->warn("Nie udało się pobrać zdjęcia dla oferty {$offerId}: " . $e->getMessage());
                    $pictures[] = [
                        'offer_id' => $offerId,
                        'path' => $url,
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                }
            }
        }
        if (!empty($pictures)) {
            DB::table('offer_pictures')->insert($pictures);
            $this->command->info('Dodano ' . count($pictures) . ' zdjęć do bazy danych.');
        }
    }
}
