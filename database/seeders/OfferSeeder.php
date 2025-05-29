<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            // OFERTY WYNAJMU (property_id 1-10)
            [
                'owner_id' => 1, // Zakładając że masz użytkowników o id 1-20
                'property_id' => 1,
                'offer_title' => 'Przytulne mieszkanie 2-pokojowe w centrum Poznania',
                'offer_type' => 'Wynajem',
                'description' => 'Oferuję do wynajmu piękne, w pełni umeblowane mieszkanie w samym sercu Poznania. Mieszkanie składa się z dwóch pokoi, kuchni, łazienki oraz przedpokoju. Idealne dla studentów lub młodych profesjonalistów. W pobliżu znajdują się wszystkie udogodnienia: sklepy, restauracje, komunikacja miejska.',
                'price' => 2500,
                'deposit' => 5000,
                'rent' => 400
            ],
            [
                'owner_id' => 2,
                'property_id' => 2,
                'offer_title' => 'Stylowe kawalerka na Nowym Świecie w Warszawie',
                'offer_type' => 'Wynajem',
                'description' => 'Nowoczesna kawalerka w престижowej lokalizacji przy ul. Nowy Świat. Mieszkanie po remoncie, częściowo umeblowane. Doskonałe połączenie z resztą miasta. Perfect dla osoby pracującej w centrum Warszawy. Cisza i spokój mimo centralnej lokalizacji.',
                'price' => 3200,
                'deposit' => 6400,
                'rent' => 500
            ],
            [
                'owner_id' => 3,
                'property_id' => 3,
                'offer_title' => 'Mieszkanie 3-pokojowe do remontu - Kraków Stare Miasto',
                'offer_type' => 'Wynajem',
                'description' => 'Przestronne mieszkanie 3-pokojowe w zabytkowej kamienicy na Starym Mieście w Krakowie. Mieszkanie wymaga remontu, dlatego cena bardzo atrakcyjna. Idealne dla osób chcących stworzyć swoje wymarzone wnętrze. Niepowtarzalny klimat starego Krakowa.',
                'price' => 2000,
                'deposit' => 4000,
                'rent' => 350
            ],
            [
                'owner_id' => 4,
                'property_id' => 4,
                'offer_title' => 'Komfortowe 2-pokojowe mieszkanie w Gdańsku',
                'offer_type' => 'Wynajem',
                'description' => 'Przepiękne, w pełni wyposażone mieszkanie w centrum Gdańska. Nowo zakupione meble i sprzęty. Mieszkanie bardzo jasne, z widokiem na zabytkową architekturę. Blisko do głównych atrakcji turystycznych i biznesowych. Doskonałe dla pary lub singla.',
                'price' => 2800,
                'deposit' => 5600,
                'rent' => 450
            ],
            [
                'owner_id' => 5,
                'property_id' => 5,
                'offer_title' => 'Lokal użytkowy na Rynku we Wrocławiu',
                'offer_type' => 'Wynajem',
                'description' => 'Wyjątkowy lokal użytkowy w samym centrum Wrocławia, na rynku. Idealny na biuro, galerię sztuki, butik lub restaurację. Wysokie sufity, duże okna, reprezentacyjne wnętrze. Ogromny potencjał biznesowy dzięki lokalizacji w najważniejszym punkcie miasta.',
                'price' => 8500,
                'deposit' => 17000,
                'rent' => 1200
            ],
            [
                'owner_id' => 6,
                'property_id' => 6,
                'offer_title' => 'Nowoczesne mieszkanie 3-pokojowe w Katowicach',
                'offer_type' => 'Wynajem',
                'description' => 'Eleganckie mieszkanie w nowoczesnym budynku z windą. Częściowo umeblowane, z możliwością dokompletowania wyposażenia. Mieszkanie bardzo dobrze rozmieszczone, z dużym salonem i oddzielną kuchnią. Parking w cenie. Blisko centrum handlowego.',
                'price' => 2600,
                'deposit' => 5200,
                'rent' => 400
            ],
            [
                'owner_id' => 7,
                'property_id' => 7,
                'offer_title' => 'Mieszkanie na Piotrkowskiej do remontu - Łódź',
                'offer_type' => 'Wynajem',
                'description' => 'Mieszkanie w sercu Łodzi przy słynnej ul. Piotrkowskiej. Wymaga gruntownego remontu, ale oferuje niesamowite możliwości aranżacyjne. Bardzo atrakcyjna cena ze względu na stan. Idealne dla kreatywnych osób lub inwestorów.',
                'price' => 1800,
                'deposit' => 3600,
                'rent' => 300
            ],
            [
                'owner_id' => 8,
                'property_id' => 8,
                'offer_title' => 'Luksusowy dom z ogrodem - Poznań Grunwaldzka',
                'offer_type' => 'Wynajem',
                'description' => 'Przepiękny, w pełni umeblowany dom jednorodzinny z prywatnym ogrodem. 5 pokoi, nowoczesna kuchnia, 2 łazienki, garaż. Idealny dla rodziny z dziećmi. Spokojne, zielone osiedle, ale z dobrym dojazdem do centrum. Możliwość trzymania zwierząt.',
                'price' => 4500,
                'deposit' => 9000,
                'rent' => 600
            ],
            [
                'owner_id' => 9,
                'property_id' => 9,
                'offer_title' => 'Przytulne 2-pokojowe mieszkanie w Bydgoszczy',
                'offer_type' => 'Wynajem',
                'description' => 'Klimatyczne mieszkanie po częściowym remoncie. Częściowo umeblowane, gotowe do zamieszkania. Bardzo dobra lokalizacja z dostępem do komunikacji miejskiej. Mieszkanie idealne dla pary lub osoby pracującej. W pobliżu parki i tereny rekreacyjne.',
                'price' => 2200,
                'deposit' => 4400,
                'rent' => 350
            ],
            [
                'owner_id' => 10,
                'property_id' => 10,
                'offer_title' => 'Reprezentacyjny lokal biurowy w Szczecinie',
                'offer_type' => 'Wynajem',
                'description' => 'Prestiżowy lokal na biuro przy głównej arterii miasta. Przestronny, jasny, z możliwością aranżacji według własnych potrzeb. Idealne dla kancelarii, biura rachunkowego, agencji nieruchomości. Doskonałe połączenia komunikacyjne, parking dostępny.',
                'price' => 6500,
                'deposit' => 13000,
                'rent' => 800
            ],

            // OFERTY SPRZEDAŻY (property_id 11-20)
            [
                'owner_id' => 11,
                'property_id' => 11,
                'offer_title' => 'Mieszkanie 3-pokojowe na Mokotowie - Warszawa',
                'offer_type' => 'Sprzedaż',
                'description' => 'Bardzo atrakcyjne mieszkanie na prestiżowym Mokotowie. 3 pokoje, duża kuchnia, balkon z widokiem na zieleń. Mieszkanie w doskonałym stanie technicznym, gotowe do zamieszkania od zaraz. Blisko metra, świetna infrastruktura. Inwestycja pewna i dochodowa.',
                'price' => 950000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 12,
                'property_id' => 12,
                'offer_title' => 'Piękny dom z ogrodem - Kraków Karmelicka',
                'offer_type' => 'Sprzedaż',
                'description' => 'Wyjątkowy dom jednorodzinny w znakomitej lokalizacji w Krakowie. 6 pokoi na 180m2, duży ogród, garaż na 2 samochody. Dom w bardzo dobrym stanie, częściowo umeblowany. Idealne dla dużej rodziny. Blisko do centrum, ale w spokojnej okolicy.',
                'price' => 1250000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 13,
                'property_id' => 13,
                'offer_title' => 'Mieszkanie 2-pokojowe do remontu - Poznań Roosevelta',
                'offer_type' => 'Sprzedaż',
                'description' => 'Mieszkanie z dużym potencjałem w bardzo dobrej lokalizacji. Wymaga remontu, ale dzięki temu cena bardzo atrakcyjna. Mieszkanie z balkonem, dużymi oknami. Idealne dla inwestorów lub osób chcących stworzyć mieszkanie według własnych potrzeb.',
                'price' => 420000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 14,
                'property_id' => 14,
                'offer_title' => 'Dom w stanie surowym - Gdynia centrum',
                'offer_type' => 'Sprzedaż',
                'description' => 'Doskonała okazja dla osób szukających domu do wykończenia według własnych potrzeb. Dom w stanie surowym na działce w centrum Gdyni. 5 pokoi, możliwość adaptacji poddasza. Świetna lokalizacja z potencjałem inwestycyjnym.',
                'price' => 780000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 15,
                'property_id' => 15,
                'offer_title' => 'Luksusowe mieszkanie 4-pokojowe - Wrocław centrum',
                'offer_type' => 'Sprzedaż',
                'description' => 'Przepiękne, w pełni wyposażone mieszkanie w centrum Wrocławia. 4 pokoje, 2 łazienki, duży balkon. Mieszkanie po kapitalnym remoncie, z najwyższej jakości materiałami. Idealne dla wymagających klientów. Parking w garażu podziemnym w cenie.',
                'price' => 1150000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 16,
                'property_id' => 16,
                'offer_title' => 'Dom do kapitalnego remontu - Chorzów',
                'offer_type' => 'Sprzedaż',
                'description' => 'Duży dom jednorodzinny na działce 800m2. Wymaga kapitalnego remontu, ale oferuje ogromne możliwości. 6 pokoi, strych do adaptacji, piwnica. Doskonała lokalizacja w spokojnej części Chorzowa. Idealne dla dużej rodziny lub inwestorów.',
                'price' => 650000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 17,
                'property_id' => 17,
                'offer_title' => 'Mieszkanie 2-pokojowe Krakowskie Przedmieście - Lublin',
                'offer_type' => 'Sprzedaż',
                'description' => 'Charming apartment in the heart of Lublin\'s historic district. 2 pokoje w zabytkowej kamienicy przy reprezentacyjnej ulicy. Mieszkanie po remoncie, częściowo umeblowane, gotowe do zamieszkania. Niepowtarzalny klimat i lokalizacja.',
                'price' => 385000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 18,
                'property_id' => 18,
                'offer_title' => 'Lokal użytkowy na sprzedaż - Rzeszów centrum',
                'offer_type' => 'Sprzedaż',
                'description' => 'Excellent commercial space in the center of Rzeszów. 110m2 powierzchni, idealny na biuro, sklep, czy usługi. Lokal po remoncie, w bardzo dobrym stanie technicznym. Wysoki potencjał inwestycyjny, rosnący rynek nieruchomości komercyjnych.',
                'price' => 520000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 19,
                'property_id' => 19,
                'offer_title' => 'Mieszkanie 3-pokojowe do remontu - Olsztyn',
                'offer_type' => 'Sprzedaż',
                'description' => 'Przestronne mieszkanie 3-pokojowe w centrum Olsztyna. Wymaga remontu, ale ma duży potencjał. Mieszkanie jasne, z balkonem, w cichej okolicy. Idealne dla osób ceniących spokój, ale z dostępem do wszystkich udogodnień miejskich.',
                'price' => 310000,
                'deposit' => 0,
                'rent' => 0
            ],
            [
                'owner_id' => 20,
                'property_id' => 20,
                'offer_title' => 'Luksusowy dom z basenem - Opole',
                'offer_type' => 'Sprzedaż',
                'description' => 'Wyjątkowy dom jednorodzinny z basenem i sauną. 7 pokoi na 195m2, ogród krajobrazowy, garaż na 3 samochody. Dom w najwyższym standardzie, w pełni umeblowany z luksusowym wyposażeniem. Dla najbardziej wymagających klientów.',
                'price' => 1680000,
                'deposit' => 0,
                'rent' => 0
            ]
        ];

        foreach ($offers as $offer) {
            $offer['created_at'] = Carbon::now();
            $offer['updated_at'] = Carbon::now();
            DB::table('offers')->insert($offer);
        }
    }
}
