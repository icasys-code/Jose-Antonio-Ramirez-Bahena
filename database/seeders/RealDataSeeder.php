<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Brand;
use App\Models\Manufacturer;
use App\Models\Categorie;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Part;
use App\Models\Component;
use App\Models\Warehouse;
use App\Models\Stock;
use App\Models\Vendor;
use App\Models\PriceHistory;
use App\Models\Vehicle;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Image;

class RealDataSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks for seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing tables to prevent unique constraint failures
        DB::table('images')->truncate();
        DB::table('price_histories')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('stocks')->truncate();
        DB::table('warehouses')->truncate();
        DB::table('vendors')->truncate();
        DB::table('part_variant')->truncate();
        DB::table('component_part')->truncate();
        DB::table('parts')->truncate();
        DB::table('components')->truncate();
        DB::table('car_variants')->truncate();
        DB::table('car_models')->truncate();
        DB::table('categories')->truncate();
        DB::table('manufacturers')->truncate();
        DB::table('brands')->truncate();
        DB::table('attributeables')->truncate();
        DB::table('attribute_values')->truncate();
        DB::table('attributes')->truncate();
        DB::table('users')->truncate();
        DB::table('vehicles')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Seed Users
        $admin = User::create([
            'name' => 'Rodrigo Administrador',
            'email' => 'rodrigo.admin@refaccionaria.com',
            'password' => Hash::make('admin12345'),
        ]);

        $cliente1 = User::create([
            'name' => 'Juan Pérez Cliente',
            'email' => 'juan.cliente@gmail.com',
            'password' => Hash::make('cliente12345'),
        ]);

        $cliente2 = User::create([
            'name' => 'Sofía Rodríguez',
            'email' => 'sofia.rodriguez@hotmail.com',
            'password' => Hash::make('sofia54321'),
        ]);

        $cliente3 = User::create([
            'name' => 'Carlos Mendoza',
            'email' => 'carlos.mendoza@yahoo.com',
            'password' => Hash::make('carlos987'),
        ]);

        // 2. Seed Brands (Marcas de Autos)
        $nissan = Brand::create([
            'name' => 'Nissan',
            'slug' => 'nissan',
            'country' => 'Japón',
            'description' => 'Marca líder en ventas de vehículos en México.',
            'website' => 'https://www.nissan.com.mx'
        ]);

        $toyota = Brand::create([
            'name' => 'Toyota',
            'slug' => 'toyota',
            'country' => 'Japón',
            'description' => 'Reconocida por su alta confiabilidad y durabilidad.',
            'website' => 'https://www.toyota.mx'
        ]);

        $vw = Brand::create([
            'name' => 'Volkswagen',
            'slug' => 'volkswagen',
            'country' => 'Alemania',
            'description' => 'Fabricante alemán muy popular por modelos icónicos.',
            'website' => 'https://www.vw.com.mx'
        ]);

        $chevrolet = Brand::create([
            'name' => 'Chevrolet',
            'slug' => 'chevrolet',
            'country' => 'Estados Unidos',
            'description' => 'División de vehículos de General Motors en México.',
            'website' => 'https://www.chevrolet.com.mx'
        ]);

        $honda = Brand::create([
            'name' => 'Honda',
            'slug' => 'honda',
            'country' => 'Japón',
            'description' => 'Ingeniería japonesa de excelencia, famosa por el VTEC.',
            'website' => 'https://www.honda.mx'
        ]);

        $ford = Brand::create([
            'name' => 'Ford',
            'slug' => 'ford',
            'country' => 'Estados Unidos',
            'description' => 'Tradición, potencia y diseño americano.',
            'website' => 'https://www.ford.mx'
        ]);

        $mazda = Brand::create([
            'name' => 'Mazda',
            'slug' => 'mazda',
            'country' => 'Japón',
            'description' => 'Vehículos dinámicos con tecnología SkyActiv y diseño Kodo.',
            'website' => 'https://www.mazda.mx'
        ]);

        $kia = Brand::create([
            'name' => 'Kia',
            'slug' => 'kia',
            'country' => 'Corea del Sur',
            'description' => 'Fabricante coreano de gran crecimiento, excelente garantía.',
            'website' => 'https://www.kia.com'
        ]);

        $bmw = Brand::create([
            'name' => 'BMW',
            'slug' => 'bmw',
            'country' => 'Alemania',
            'description' => 'Vehículos premium de alto rendimiento y placer de conducir.',
            'website' => 'https://www.bmw.com.mx'
        ]);

        // 3. Seed Manufacturers (Fabricantes de Refacciones)
        $bosch = Manufacturer::create([
            'name' => 'Bosch',
            'country' => 'Alemania',
            'description' => 'Líder mundial en tecnología automotriz, inyección y sensores.',
            'website' => 'https://www.boschautoparts.com'
        ]);

        $brembo = Manufacturer::create([
            'name' => 'Brembo',
            'country' => 'Italia',
            'description' => 'Referente mundial en sistemas de frenos de alto rendimiento.',
            'website' => 'https://www.brembo.com'
        ]);

        $ngk = Manufacturer::create([
            'name' => 'NGK',
            'country' => 'Japón',
            'description' => 'Especialista global en bujías de encendido y sensores de oxígeno.',
            'website' => 'https://www.ngksparkplugs.com'
        ]);

        $gonher = Manufacturer::create([
            'name' => 'Gonher',
            'country' => 'México',
            'description' => 'Fabricante mexicano líder en acumuladores y filtros automotrices.',
            'website' => 'https://www.grupogonher.com'
        ]);

        $lth = Manufacturer::create([
            'name' => 'LTH',
            'country' => 'México',
            'description' => 'La marca de acumuladores (baterías) con mayor tradición y ventas en México.',
            'website' => 'https://www.lth.com.mx'
        ]);

        $monroe = Manufacturer::create([
            'name' => 'Monroe',
            'country' => 'Estados Unidos',
            'description' => 'Líder en amortiguadores y componentes de control de suspensión.',
            'website' => 'https://www.monroe.com'
        ]);

        $denso = Manufacturer::create([
            'name' => 'Denso',
            'country' => 'Japón',
            'description' => 'Líder en componentes eléctricos, alternadores y bujías de equipamiento original.',
            'website' => 'https://www.denso.com'
        ]);

        $kyb = Manufacturer::create([
            'name' => 'KYB',
            'country' => 'Japón',
            'description' => 'Uno de los mayores fabricantes mundiales de amortiguadores de equipo original.',
            'website' => 'https://www.kyb.com'
        ]);

        $valeo = Manufacturer::create([
            'name' => 'Valeo',
            'country' => 'Francia',
            'description' => 'Fabricante especializado en clutches, sistemas de embrague y limpiaparabrisas.',
            'website' => 'https://www.valeo.com'
        ]);

        $gates = Manufacturer::create([
            'name' => 'Gates',
            'country' => 'Estados Unidos',
            'description' => 'Líder mundial en bandas de tiempo, mangueras, poleas y termostatos.',
            'website' => 'https://www.gates.com'
        ]);

        $hella = Manufacturer::create([
            'name' => 'Hella',
            'country' => 'Alemania',
            'description' => 'Referente en iluminación, sensores y relevadores eléctricos automotrices.',
            'website' => 'https://www.hella.com'
        ]);

        // 4. Seed Categories (Categorías de Refacciones)
        $motor = Categorie::create([
            'name' => 'Motor y Afinación',
            'slug' => 'motor-y-afinacion',
            'description' => 'Filtros, bujías, bobinas y partes internas del bloque de motor.'
        ]);

        $filtros = Categorie::create([
            'name' => 'Filtros',
            'slug' => 'filtros',
            'parent_id' => $motor->id,
            'description' => 'Filtros de aceite, aire, cabina y combustible.'
        ]);

        $bujias = Categorie::create([
            'name' => 'Bujías y Encendido',
            'slug' => 'bujias-y-encendido',
            'parent_id' => $motor->id,
            'description' => 'Bujías de iridio, cobre, platino y cables de encendido.'
        ]);

        $frenos = Categorie::create([
            'name' => 'Frenos',
            'slug' => 'frenos',
            'description' => 'Balatas, discos de freno, tambores, líquido y mangueras.'
        ]);

        $balatas = Categorie::create([
            'name' => 'Balatas',
            'slug' => 'balatas',
            'parent_id' => $frenos->id,
            'description' => 'Balatas de cerámica, semimetálicas y orgánicas.'
        ]);

        $discos = Categorie::create([
            'name' => 'Discos de Freno',
            'slug' => 'discos-de-freno',
            'parent_id' => $frenos->id,
            'description' => 'Discos de freno ventilados, sólidos e hiperventilados.'
        ]);

        $electrico = Categorie::create([
            'name' => 'Sistema Eléctrico',
            'slug' => 'sistema-electrico',
            'description' => 'Acumuladores (baterías), alternadores, marchas y focos.'
        ]);

        $baterias = Categorie::create([
            'name' => 'Baterías',
            'slug' => 'baterias',
            'parent_id' => $electrico->id,
            'description' => 'Acumuladores de plomo-ácido y AGM para autos.'
        ]);

        $suspension = Categorie::create([
            'name' => 'Suspensión y Dirección',
            'slug' => 'suspension-y-direccion',
            'description' => 'Amortiguadores, resortes, rótulas, terminales y horquillas.'
        ]);

        $amortiguadores = Categorie::create([
            'name' => 'Amortiguadores',
            'slug' => 'amortiguadores',
            'parent_id' => $suspension->id,
            'description' => 'Amortiguadores de gas y líquido delanteros y traseros.'
        ]);

        $embrague = Categorie::create([
            'name' => 'Embrague y Transmisión',
            'slug' => 'embrague-y-transmision',
            'description' => 'Kits de clutch, bombas de collarín, juntas homocinéticas.'
        ]);

        $clutches = Categorie::create([
            'name' => 'Kits de Clutch',
            'slug' => 'kits-de-clutch',
            'parent_id' => $embrague->id,
            'description' => 'Kits de plato, disco y collarín mecánico.'
        ]);

        $enfriamiento = Categorie::create([
            'name' => 'Enfriamiento',
            'slug' => 'enfriamiento',
            'description' => 'Radiadores, bombas de agua, termostatos y anticongelantes.'
        ]);

        $bombas_agua = Categorie::create([
            'name' => 'Bombas de Agua',
            'slug' => 'bombas-de-agua',
            'parent_id' => $enfriamiento->id,
            'description' => 'Bombas de agua mecánicas de alta resistencia y empaques.'
        ]);

        // 5. Seed Car Models (Modelos de Autos)
        $tsuru_m = CarModel::create([
            'brand_id' => $nissan->id,
            'name' => 'Tsuru',
            'slug' => 'nissan-tsuru',
            'year_from' => 1992,
            'year_to' => 2017,
            'description' => 'El auto más económico y popular de la historia en México.'
        ]);

        $sentra_m = CarModel::create([
            'brand_id' => $nissan->id,
            'name' => 'Sentra',
            'slug' => 'nissan-sentra',
            'year_from' => 2000,
            'year_to' => 2024,
            'description' => 'Sedán mediano elegante de Nissan.'
        ]);

        $jetta_m = CarModel::create([
            'brand_id' => $vw->id,
            'name' => 'Jetta',
            'slug' => 'vw-jetta',
            'year_from' => 1999,
            'year_to' => 2024,
            'description' => 'Todo el mundo tiene un Jetta, en la cabeza o en su cochera.'
        ]);

        $aveo_m = CarModel::create([
            'brand_id' => $chevrolet->id,
            'name' => 'Aveo',
            'slug' => 'chevrolet-aveo',
            'year_from' => 2008,
            'year_to' => 2024,
            'description' => 'Sedán subcompacto altamente eficiente.'
        ]);

        $civic_m = CarModel::create([
            'brand_id' => $honda->id,
            'name' => 'Civic',
            'slug' => 'honda-civic',
            'year_from' => 2000,
            'year_to' => 2024,
            'description' => 'Líder en ingeniería, desempeño deportivo y economía de combustible.'
        ]);

        $mustang_m = CarModel::create([
            'brand_id' => $ford->id,
            'name' => 'Mustang',
            'slug' => 'ford-mustang',
            'year_from' => 1999,
            'year_to' => 2024,
            'description' => 'El legendario Pony Car americano.'
        ]);

        $mazda3_m = CarModel::create([
            'brand_id' => $mazda->id,
            'name' => 'Mazda 3',
            'slug' => 'mazda-3',
            'year_from' => 2004,
            'year_to' => 2024,
            'description' => 'Diseño premium Kodo y dinámica SkyActiv divertida de manejar.'
        ]);

        $rio_m = CarModel::create([
            'brand_id' => $kia->id,
            'name' => 'Rio',
            'slug' => 'kia-rio',
            'year_from' => 2012,
            'year_to' => 2024,
            'description' => 'Auto compacto altamente popular y el más vendido de Kia.'
        ]);

        $e90_m = CarModel::create([
            'brand_id' => $bmw->id,
            'name' => 'Serie 3 E90',
            'slug' => 'bmw-serie3-e90',
            'year_from' => 2005,
            'year_to' => 2012,
            'description' => 'El sedán deportivo de BMW de quinta generación.'
        ]);

        // 6. Seed Car Variants (Variantes de Autos)
        $tsuru_v = CarVariant::create([
            'car_model_id' => $tsuru_m->id,
            'name' => 'Tsuru III 1.6L GA16DNE',
            'trim' => 'GSII',
            'engine' => '1.6L de 4 cilindros en línea',
            'transmission' => 'Manual de 5 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'El icónico motor de 16 válvulas GA16DNE.'
        ]);

        $sentra_v = CarVariant::create([
            'car_model_id' => $sentra_m->id,
            'name' => 'Sentra 2.0L MR20DE',
            'trim' => 'Exclusive',
            'engine' => '2.0L de 4 cilindros',
            'transmission' => 'Automática CVT',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'Variante de lujo con motor MR20DE.'
        ]);

        $jetta_v = CarVariant::create([
            'car_model_id' => $jetta_m->id,
            'name' => 'Jetta A4 2.0L APK',
            'trim' => 'Europa / Trendline',
            'engine' => '2.0L de 4 cilindros 8 válvulas',
            'transmission' => 'Manual de 5 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'El clásico motor 2.0L de VW utilizado por generaciones.'
        ]);

        $aveo_v = CarVariant::create([
            'car_model_id' => $aveo_m->id,
            'name' => 'Aveo 1.6L F16D3',
            'trim' => 'LS',
            'engine' => '1.6L E-TEC II',
            'transmission' => 'Manual de 5 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'Motor confiable DOHC de 16 válvulas.'
        ]);

        $civic_v = CarVariant::create([
            'car_model_id' => $civic_m->id,
            'name' => 'Civic 1.8L i-VTEC R18A',
            'trim' => 'EX',
            'engine' => '1.8L i-VTEC SOHC',
            'transmission' => 'Manual de 5 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'La legendaria confiabilidad del motor i-VTEC.'
        ]);

        $mustang_v = CarVariant::create([
            'car_model_id' => $mustang_m->id,
            'name' => 'Mustang GT 5.0L Coyote',
            'trim' => 'GT',
            'engine' => '5.0L V8 Coyote de 435 HP',
            'transmission' => 'Manual de 6 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 2,
            'notes' => 'Motor V8 de alta respuesta sonora y desempeño.'
        ]);

        $mazda3_v = CarVariant::create([
            'car_model_id' => $mazda3_m->id,
            'name' => 'Mazda 3 2.5L SkyActiv-G',
            'trim' => 'i Grand Touring',
            'engine' => '2.5L SkyActiv-G DOHC',
            'transmission' => 'Automática de 6 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'Excelente compresión y respuesta ágil.'
        ]);

        $rio_v = CarVariant::create([
            'car_model_id' => $rio_m->id,
            'name' => 'Kia Rio 1.6L Gamma',
            'trim' => 'LX',
            'engine' => '1.6L Gamma MPI 4 cil',
            'transmission' => 'Manual de 6 velocidades',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'Altamente eficiente para ciudad.'
        ]);

        $bmw_v = CarVariant::create([
            'car_model_id' => $e90_m->id,
            'name' => 'BMW 325i N52',
            'trim' => 'M Sport',
            'engine' => '2.5L de 6 cilindros en línea N52',
            'transmission' => 'Automática Steptronic 6 vel',
            'fuel_type' => 'Gasolina',
            'doors' => 4,
            'notes' => 'Suave motor N52 atmosférico con bloque de magnesio.'
        ]);

        // 7. Seed Attributes
        $material_attr = Attribute::create([
            'name' => 'Material',
            'slug' => 'material',
            'type' => 'string'
        ]);

        $posicion_attr = Attribute::create([
            'name' => 'Posición',
            'slug' => 'posicion',
            'type' => 'string'
        ]);

        $voltaje_attr = Attribute::create([
            'name' => 'Voltaje',
            'slug' => 'voltaje',
            'type' => 'string'
        ]);

        $cca_attr = Attribute::create([
            'name' => 'CCA (Capacidad de Arranque Frío)',
            'slug' => 'cca',
            'type' => 'string'
        ]);

        // 8. Seed Attribute Values
        $iridio_val = AttributeValue::create(['attribute_id' => $material_attr->id, 'value' => 'Iridio']);
        $ceramica_val = AttributeValue::create(['attribute_id' => $material_attr->id, 'value' => 'Cerámica']);
        $semimetal_val = AttributeValue::create(['attribute_id' => $material_attr->id, 'value' => 'Semimetálica']);
        $organico_val = AttributeValue::create(['attribute_id' => $material_attr->id, 'value' => 'Orgánica']);
        
        $delantero_val = AttributeValue::create(['attribute_id' => $posicion_attr->id, 'value' => 'Delantero']);
        $trasero_val = AttributeValue::create(['attribute_id' => $posicion_attr->id, 'value' => 'Trasero']);
        
        $v12_val = AttributeValue::create(['attribute_id' => $voltaje_attr->id, 'value' => '12V']);
        
        $cca650_val = AttributeValue::create(['attribute_id' => $cca_attr->id, 'value' => '650 A', 'unit' => 'CCA']);
        $cca550_val = AttributeValue::create(['attribute_id' => $cca_attr->id, 'value' => '550 A', 'unit' => 'CCA']);
        $cca750_val = AttributeValue::create(['attribute_id' => $cca_attr->id, 'value' => '750 A', 'unit' => 'CCA']);

        // 9. Seed Parts
        $bujia_part = Part::create([
            'sku' => 'NGK-BKR6EIX-11',
            'name' => 'Bujía de Iridio NGK IX',
            'category_id' => $bujias->id,
            'manufacturer_id' => $ngk->id,
            'description' => 'Bujía de alto rendimiento con electrodo de iridio de 0.6mm, mejora la respuesta del acelerador y la economía de combustible.',
            'price' => 195.00,
            'currency' => 'MXN',
            'weight' => 0.045,
            'dimensions' => ['length' => '8.5', 'width' => '2.0', 'height' => '2.0'],
            'stock' => 150,
            'active' => true
        ]);

        $balata_del_part = Part::create([
            'sku' => 'BREM-P56048N',
            'name' => 'Balatas Delanteras de Cerámica Brembo Premium',
            'category_id' => $balatas->id,
            'manufacturer_id' => $brembo->id,
            'description' => 'Kit de balatas de cerámica premium con shims anti-ruido, frenado preciso y nula producción de polvo en rines.',
            'price' => 890.00,
            'currency' => 'MXN',
            'weight' => 1.850,
            'dimensions' => ['length' => '15.0', 'width' => '9.5', 'height' => '6.0'],
            'stock' => 40,
            'active' => true
        ]);

        $balata_tra_part = Part::create([
            'sku' => 'BREM-P85020N',
            'name' => 'Balatas Traseras de Cerámica Brembo Premium',
            'category_id' => $balatas->id,
            'manufacturer_id' => $brembo->id,
            'description' => 'Balatas de cerámica premium traseras para excelente balance de frenado y confort acústico.',
            'price' => 740.00,
            'currency' => 'MXN',
            'weight' => 1.250,
            'dimensions' => ['length' => '12.0', 'width' => '8.0', 'height' => '5.0'],
            'stock' => 30,
            'active' => true
        ]);

        $filtro_gonher_part = Part::create([
            'sku' => 'GONH-GP-46',
            'name' => 'Filtro de Aceite Gonher Premium',
            'category_id' => $filtros->id,
            'manufacturer_id' => $gonher->id,
            'description' => 'Filtro de aceite con papel de alta retención para proteger el motor contra impurezas microscópicas durante 10,000 km.',
            'price' => 98.00,
            'currency' => 'MXN',
            'weight' => 0.310,
            'dimensions' => ['length' => '8.5', 'width' => '7.5', 'height' => '7.5'],
            'stock' => 240,
            'active' => true
        ]);

        $bateria_lth_part = Part::create([
            'sku' => 'LTH-L-34R-550',
            'name' => 'Acumulador / Batería LTH L-34R-550',
            'category_id' => $baterias->id,
            'manufacturer_id' => $lth->id,
            'description' => 'Batería automotriz LTH con tecnología PowerFrame, excelente potencia de arranque en frío y mayor resistencia a la corrosión.',
            'price' => 2340.00,
            'currency' => 'MXN',
            'weight' => 15.600,
            'dimensions' => ['length' => '26.0', 'width' => '17.3', 'height' => '20.2'],
            'stock' => 20,
            'active' => true
        ]);

        $bateria_lth_premium = Part::create([
            'sku' => 'LTH-L-35-650',
            'name' => 'Acumulador / Batería LTH HI-TEC H-35-650',
            'category_id' => $baterias->id,
            'manufacturer_id' => $lth->id,
            'description' => 'Batería LTH Hi-Tec de alta capacidad y desempeño óptimo para autos con alto equipamiento eléctrico.',
            'price' => 2890.00,
            'currency' => 'MXN',
            'weight' => 17.200,
            'dimensions' => ['length' => '24.4', 'width' => '17.5', 'height' => '19.0'],
            'stock' => 15,
            'active' => true
        ]);

        $amortiguador_del_part = Part::create([
            'sku' => 'MON-OES-742023',
            'name' => 'Amortiguador Delantero Monroe OESpectrum Gas',
            'category_id' => $amortiguadores->id,
            'manufacturer_id' => $monroe->id,
            'description' => 'Amortiguador de gas premium con tecnología OESpectrum que brinda control absoluto y elimina balanceos innecesarios en baches.',
            'price' => 1480.00,
            'currency' => 'MXN',
            'weight' => 4.300,
            'dimensions' => ['length' => '48.0', 'width' => '10.0', 'height' => '10.0'],
            'stock' => 24,
            'active' => true
        ]);

        // NEW Refacciones (Expanded Catalog)
        $alternador_denso = Part::create([
            'sku' => 'DEN-ALT-104210',
            'name' => 'Alternador Denso Original 100A',
            'category_id' => $electrico->id,
            'manufacturer_id' => $denso->id,
            'description' => 'Alternador de alto rendimiento Denso, proveedor original de Honda y Toyota. Alta eficiencia eléctrica.',
            'price' => 4150.00,
            'currency' => 'MXN',
            'weight' => 5.600,
            'dimensions' => ['length' => '18.5', 'width' => '15.0', 'height' => '15.0'],
            'stock' => 10,
            'active' => true
        ]);

        $amortiguador_kyb = Part::create([
            'sku' => 'KYB-EXC-339268',
            'name' => 'Amortiguador de Gas KYB Excel-G Delantero',
            'category_id' => $amortiguadores->id,
            'manufacturer_id' => $kyb->id,
            'description' => 'Amortiguador de gas bitubo restaurador del desempeño original del vehículo. Fabricado en Japón.',
            'price' => 1620.00,
            'currency' => 'MXN',
            'weight' => 4.600,
            'dimensions' => ['length' => '52.0', 'width' => '12.0', 'height' => '12.0'],
            'stock' => 32,
            'active' => true
        ]);

        $clutch_valeo = Part::create([
            'sku' => 'VAL-CL-826300',
            'name' => 'Kit de Clutch / Embrague Valeo Premium',
            'category_id' => $clutches->id,
            'manufacturer_id' => $valeo->id,
            'description' => 'Kit completo que incluye plato de presión, disco de clutch y collarín de empuje mecánico. Confort y durabilidad.',
            'price' => 2850.00,
            'currency' => 'MXN',
            'weight' => 6.900,
            'dimensions' => ['length' => '30.0', 'width' => '30.0', 'height' => '8.0'],
            'stock' => 12,
            'active' => true
        ]);

        $banda_gates = Part::create([
            'sku' => 'GAT-TIM-T328',
            'name' => 'Banda de Tiempo Reforzada Gates',
            'category_id' => $motor->id,
            'manufacturer_id' => $gates->id,
            'description' => 'Banda de distribución con perfil de diente original y compuesto de caucho de nitrilo resistente al calor extremo.',
            'price' => 390.00,
            'currency' => 'MXN',
            'weight' => 0.190,
            'dimensions' => ['length' => '25.0', 'width' => '3.0', 'height' => '2.0'],
            'stock' => 80,
            'active' => true
        ]);

        $bomba_gates = Part::create([
            'sku' => 'GAT-WP-42095',
            'name' => 'Bomba de Agua Mecánica Gates Premium',
            'category_id' => $bombas_agua->id,
            'manufacturer_id' => $gates->id,
            'description' => 'Bomba de agua de alta ingeniería que asegura un flujo óptimo de anticongelante y previene calentamientos.',
            'price' => 640.00,
            'currency' => 'MXN',
            'weight' => 1.350,
            'dimensions' => ['length' => '14.0', 'width' => '11.5', 'height' => '10.0'],
            'stock' => 45,
            'active' => true
        ]);

        $faro_hella = Part::create([
            'sku' => 'HEL-H4-VAL',
            'name' => 'Foco Halógeno Hella H4 12V 60/55W',
            'category_id' => $electrico->id,
            'manufacturer_id' => $hella->id,
            'description' => 'Foco de halógeno para faro principal, alta calidad, luz brillante con estándar de seguridad OE.',
            'price' => 85.00,
            'currency' => 'MXN',
            'weight' => 0.035,
            'dimensions' => ['length' => '6.0', 'width' => '4.5', 'height' => '4.5'],
            'stock' => 300,
            'active' => true
        ]);

        // Seed Attributeables (Polymorphic attributes mapping via DB)
        DB::table('attributeables')->insert([
            ['attribute_value_id' => $iridio_val->id, 'attributeable_id' => $bujia_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $ceramica_val->id, 'attributeable_id' => $balata_del_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $ceramica_val->id, 'attributeable_id' => $balata_tra_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $delantero_val->id, 'attributeable_id' => $balata_del_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $trasero_val->id, 'attributeable_id' => $balata_tra_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $v12_val->id, 'attributeable_id' => $bateria_lth_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $v12_val->id, 'attributeable_id' => $bateria_lth_premium->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $cca550_val->id, 'attributeable_id' => $bateria_lth_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $cca650_val->id, 'attributeable_id' => $bateria_lth_premium->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $delantero_val->id, 'attributeable_id' => $amortiguador_del_part->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            
            // New attributes mapping
            ['attribute_value_id' => $delantero_val->id, 'attributeable_id' => $amortiguador_kyb->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $v12_val->id, 'attributeable_id' => $alternador_denso->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()],
            ['attribute_value_id' => $v12_val->id, 'attributeable_id' => $faro_hella->id, 'attributeable_type' => 'App\Models\Part', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 10. Seed Part Variants (Compatibilidad Extendida)
        DB::table('part_variant')->insert([
            // Bujía NGK is compatible with Tsuru, Sentra, Jetta, Aveo, Civic, Mazda 3, Kia Rio
            ['part_id' => $bujia_part->id, 'car_variant_id' => $tsuru_v->id, 'fitment_notes' => 'Calibración recomendada 0.044"', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bujia_part->id, 'car_variant_id' => $sentra_v->id, 'fitment_notes' => 'Calibración de agencia de iridio', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bujia_part->id, 'car_variant_id' => $jetta_v->id, 'fitment_notes' => 'Excelente durabilidad en ciudad', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bujia_part->id, 'car_variant_id' => $aveo_v->id, 'fitment_notes' => 'Calibración estándar E-TEC II', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bujia_part->id, 'car_variant_id' => $civic_v->id, 'fitment_notes' => 'Rendimiento idéntico al original', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bujia_part->id, 'car_variant_id' => $mazda3_v->id, 'fitment_notes' => 'Compatible con inyección directa SkyActiv', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bujia_part->id, 'car_variant_id' => $rio_v->id, 'fitment_notes' => 'Ajuste directo en bobinas Gamma', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Brembo brake pads compatible with Jetta A4 and BMW E90
            ['part_id' => $balata_del_part->id, 'car_variant_id' => $jetta_v->id, 'fitment_notes' => 'Instalar con rectificado de discos previo', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $balata_tra_part->id, 'car_variant_id' => $jetta_v->id, 'fitment_notes' => 'Instalar con sistema de caliper lucas', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $balata_del_part->id, 'car_variant_id' => $bmw_v->id, 'fitment_notes' => 'Frenado premium sin ruidos en discos M Sport', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Oil filter Gonher compatible with Tsuru, Aveo, Kia Rio
            ['part_id' => $filtro_gonher_part->id, 'car_variant_id' => $tsuru_v->id, 'fitment_notes' => 'Cambiar cada 5,000 km junto con aceite mineral 15W40', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $filtro_gonher_part->id, 'car_variant_id' => $aveo_v->id, 'fitment_notes' => 'Recomendado para afinaciones preventivas', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $filtro_gonher_part->id, 'car_variant_id' => $rio_v->id, 'fitment_notes' => 'Roscado exacto de empaque', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // LTH Battery compatible with Tsuru, Aveo, Civic
            ['part_id' => $bateria_lth_part->id, 'car_variant_id' => $tsuru_v->id, 'fitment_notes' => 'Ajuste exacto en bandeja original', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bateria_lth_part->id, 'car_variant_id' => $aveo_v->id, 'fitment_notes' => 'Excelente para climas cálidos', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bateria_lth_part->id, 'car_variant_id' => $civic_v->id, 'fitment_notes' => 'Compatible con terminales positivas derechas', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // LTH Premium compatible with Jetta, Mazda 3
            ['part_id' => $bateria_lth_premium->id, 'car_variant_id' => $jetta_v->id, 'fitment_notes' => 'Soporta luces xenón y equipo de audio', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bateria_lth_premium->id, 'car_variant_id' => $mazda3_v->id, 'fitment_notes' => 'Excelente durabilidad en sistema SkyActiv', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Monroe shocks compatible with Jetta A4
            ['part_id' => $amortiguador_del_part->id, 'car_variant_id' => $jetta_v->id, 'fitment_notes' => 'Se vende por pieza, se sugiere cambiar en pares', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Alternador Denso compatible with Civic and CR-V
            ['part_id' => $alternador_denso->id, 'car_variant_id' => $civic_v->id, 'fitment_notes' => 'Cargador de alternador de alta eficiencia Denso', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Amortiguador KYB compatible with Mazda 3 and Civic
            ['part_id' => $amortiguador_kyb->id, 'car_variant_id' => $mazda3_v->id, 'fitment_notes' => 'KYB Excel-G, suspensión deportiva japonesa original', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $amortiguador_kyb->id, 'car_variant_id' => $civic_v->id, 'fitment_notes' => 'Suaviza el manejo en terracería', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Clutch Valeo compatible with Kia Rio and Aveo
            ['part_id' => $clutch_valeo->id, 'car_variant_id' => $rio_v->id, 'fitment_notes' => 'Cambiar collarín y rectificar volante motriz', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $clutch_valeo->id, 'car_variant_id' => $aveo_v->id, 'fitment_notes' => 'Clutch suave y confortable', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Gates and Hella compatible with Sentra and Tsuru
            ['part_id' => $banda_gates->id, 'car_variant_id' => $aveo_v->id, 'fitment_notes' => 'Cambio obligado cada 60,000 km', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bomba_gates->id, 'car_variant_id' => $tsuru_v->id, 'fitment_notes' => 'Ajuste hermético con junta de silicón RTV', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $faro_hella->id, 'car_variant_id' => $tsuru_v->id, 'fitment_notes' => 'Faro principal H4 alta iluminación', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $faro_hella->id, 'car_variant_id' => $jetta_v->id, 'fitment_notes' => 'Faro principal halógeno de VW', 'direct_fit' => 1, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 11. Seed Components (Combos de Refacciones)
        $tuning_kit = Component::create([
            'name' => 'Kit de Afinación Mayor para Nissan Tsuru III',
            'part_number' => 'KIT-TUN-TSURU3',
            'description' => 'Kit integral que incluye bujías de iridio NGK y filtros Gonher esenciales para restaurar la potencia del motor.'
        ]);

        $front_brake_kit = Component::create([
            'name' => 'Kit de Frenos Premium Brembo Delantero Jetta A4',
            'part_number' => 'KIT-BREM-JETA4',
            'description' => 'Kit de balatas de cerámica Brembo para un frenado superior en ruedas delanteras de VW Jetta.'
        ]);

        $cooling_kit = Component::create([
            'name' => 'Kit de Enfriamiento Preventivo Gates para Tsuru III',
            'part_number' => 'KIT-COOL-TSU3',
            'description' => 'Incluye bomba de agua Gates premium y juntas herméticas.'
        ]);

        // 12. Seed ComponentParts (Relación Componente -> Piezas)
        DB::table('component_part')->insert([
            ['part_id' => $bujia_part->id, 'component_id' => $tuning_kit->id, 'role' => 'Bujía de encendido', 'quantity' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $filtro_gonher_part->id, 'component_id' => $tuning_kit->id, 'role' => 'Filtro de Aceite', 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $balata_del_part->id, 'component_id' => $front_brake_kit->id, 'role' => 'Balatas de fricción', 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['part_id' => $bomba_gates->id, 'component_id' => $cooling_kit->id, 'role' => 'Bomba de agua', 'quantity' => 1, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 13. Seed Warehouses (Almacenes)
        $bodega_general = Warehouse::create([
            'name' => 'Bodega Central Apodaca',
            'code' => 'BOD-APOD',
            'address' => 'Av. Teléfonos 512, Parque Industrial Apodaca',
            'city' => 'Apodaca',
            'state' => 'Nuevo León',
            'country' => 'México',
            'phone' => '8123456789',
        ]);

        $sucursal_centro = Warehouse::create([
            'name' => 'Sucursal Monterrey Centro',
            'code' => 'SUC-CENT',
            'address' => 'Av. Colón 1240, Monterrey Centro',
            'city' => 'Monterrey',
            'state' => 'Nuevo León',
            'country' => 'México',
            'phone' => '8182736450',
        ]);

        $sucursal_coyoacan = Warehouse::create([
            'name' => 'Sucursal CDMX Coyoacán',
            'code' => 'SUC-COYO',
            'address' => 'Av. Miguel Ángel de Quevedo 840, Coyoacán',
            'city' => 'Ciudad de México',
            'state' => 'CDMX',
            'country' => 'México',
            'phone' => '5512345678',
        ]);

        // 14. Seed Stocks (Repartición de inventario por almacén)
        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $bujia_part->id, 'quantity' => 100, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $bujia_part->id, 'quantity' => 30, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_coyoacan->id, 'part_id' => $bujia_part->id, 'quantity' => 20, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $balata_del_part->id, 'quantity' => 25, 'reserved' => 2]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $balata_del_part->id, 'quantity' => 15, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $filtro_gonher_part->id, 'quantity' => 180, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $filtro_gonher_part->id, 'quantity' => 60, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $bateria_lth_part->id, 'quantity' => 12, 'reserved' => 1]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $bateria_lth_part->id, 'quantity' => 8, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $amortiguador_del_part->id, 'quantity' => 16, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_coyoacan->id, 'part_id' => $amortiguador_del_part->id, 'quantity' => 8, 'reserved' => 0]);

        // Stock for New Parts
        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $alternador_denso->id, 'quantity' => 6, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $alternador_denso->id, 'quantity' => 4, 'reserved' => 0]);
        
        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $amortiguador_kyb->id, 'quantity' => 20, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_coyoacan->id, 'part_id' => $amortiguador_kyb->id, 'quantity' => 12, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $clutch_valeo->id, 'quantity' => 8, 'reserved' => 1]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $clutch_valeo->id, 'quantity' => 4, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $banda_gates->id, 'quantity' => 50, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $banda_gates->id, 'quantity' => 30, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $bomba_gates->id, 'quantity' => 30, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_coyoacan->id, 'part_id' => $bomba_gates->id, 'quantity' => 15, 'reserved' => 0]);

        Stock::create(['warehouse_id' => $bodega_general->id, 'part_id' => $faro_hella->id, 'quantity' => 200, 'reserved' => 0]);
        Stock::create(['warehouse_id' => $sucursal_centro->id, 'part_id' => $faro_hella->id, 'quantity' => 100, 'reserved' => 0]);

        // 15. Seed Vendors (Proveedores)
        $prov_norte = Vendor::create([
            'name' => 'Autopartes y Distribuciones del Norte S.A. de C.V.',
            'contact_name' => 'Ernesto Villarreal',
            'email' => 'ernesto@autopartesnorte.com',
            'phone' => '8198765432',
            'address' => 'Parque Industrial Mitras, García, Nuevo León',
            'notes' => 'Proveedor principal de acumuladores LTH y bujías NGK.'
        ]);

        $prov_frenos = Vendor::create([
            'name' => 'Frenos y Embragues Especializados de México',
            'contact_name' => 'Mario Hugo Domínguez',
            'email' => 'mario@frenosmex.com',
            'phone' => '5587654321',
            'address' => 'Col. Industrial, CDMX',
            'notes' => 'Proveedor directo de balatas Brembo y amortiguadores Monroe.'
        ]);

        $prov_asiatico = Vendor::create([
            'name' => 'Importadora de Autopartes de Oriente S.A.',
            'contact_name' => 'Kenji Tanaka',
            'email' => 'sales@orienteautoparts.com',
            'phone' => '5543210987',
            'address' => 'Parque Industrial Tlalnepantla, Estado de México',
            'notes' => 'Proveedor exclusivo de alternadores Denso y amortiguadores KYB.'
        ]);

        // 16. Seed Price History (Historial de variaciones de costos)
        PriceHistory::create([
            'priceable_id' => $bujia_part->id,
            'priceable_type' => 'App\Models\Part',
            'price' => 180.00,
            'currency' => 'MXN',
            'user_id' => $admin->id,
            'effective_at' => now()->subMonths(3)
        ]);

        PriceHistory::create([
            'priceable_id' => $bujia_part->id,
            'priceable_type' => 'App\Models\Part',
            'price' => 195.00,
            'currency' => 'MXN',
            'user_id' => $admin->id,
            'effective_at' => now()
        ]);

        PriceHistory::create([
            'priceable_id' => $balata_del_part->id,
            'priceable_type' => 'App\Models\Part',
            'price' => 890.00,
            'currency' => 'MXN',
            'user_id' => $admin->id,
            'effective_at' => now()->subMonths(1)
        ]);

        PriceHistory::create([
            'priceable_id' => $alternador_denso->id,
            'priceable_type' => 'App\Models\Part',
            'price' => 4150.00,
            'currency' => 'MXN',
            'user_id' => $admin->id,
            'effective_at' => now()
        ]);

        // 17. Seed Vehicles (Vehículos en Inventario / Showroom de Seminuevos)
        $jetta_car = Vehicle::create([
            'car_variant_id' => $jetta_v->id,
            'vin' => '3VWSD59F34M129487',
            'stock_code' => 'US-JET-04',
            'year' => 2004,
            'color' => 'Rojo Tornado',
            'mileage' => 142000,
            'price' => 68500.00,
            'condition' => 'used',
            'description' => 'Volkswagen Jetta A4 en excelentes condiciones mecánicas. Único dueño, llantas nuevas, interiores limpios y motor impecable.'
        ]);

        $tsuru_car = Vehicle::create([
            'car_variant_id' => $tsuru_v->id,
            'vin' => '3N1EB31S1AK093848',
            'stock_code' => 'US-TSU-10',
            'year' => 2010,
            'color' => 'Blanco',
            'mileage' => 210000,
            'price' => 45000.00,
            'condition' => 'used',
            'description' => 'Tsuru III ideal para trabajo de campo diario. Suspension delantera recientemente renovada, listo para trabajar.'
        ]);

        $mustang_car = Vehicle::create([
            'car_variant_id' => $mustang_v->id,
            'vin' => '1FA6P8CF0F5129487',
            'stock_code' => 'US-MUST-15',
            'year' => 2015,
            'color' => 'Gris Magnético',
            'mileage' => 84000,
            'price' => 389000.00,
            'condition' => 'used',
            'description' => 'Ford Mustang GT 5.0L Coyote V8 en impecable estado físico y mecánico. Todos los servicios de agencia, transmisión manual.'
        ]);

        $civic_car = Vehicle::create([
            'car_variant_id' => $civic_v->id,
            'vin' => '1HGFA1F53CL093848',
            'stock_code' => 'US-CIV-12',
            'year' => 2012,
            'color' => 'Plata Cromo',
            'mileage' => 125000,
            'price' => 138000.00,
            'condition' => 'used',
            'description' => 'Honda Civic EX 1.8L i-VTEC en excelentes condiciones. Muy rendidor de combustible, interiores en tela conservados, quemacocos.'
        ]);

        $mazda_car = Vehicle::create([
            'car_variant_id' => $mazda3_v->id,
            'vin' => 'JM1BM1U59J1093848',
            'stock_code' => 'US-MAZ-18',
            'year' => 2018,
            'color' => 'Rojo Brillante',
            'mileage' => 72000,
            'price' => 265000.00,
            'condition' => 'used',
            'description' => 'Mazda 3 i Grand Touring con motor 2.5L y sonido Bose. Único dueño, factura original de agencia, llantas seminuevas.'
        ]);

        // 18. Seed Orders & OrderItems (Órdenes y detalles de venta de prueba)
        $order1 = Order::create([
            'user_id' => $cliente1->id,
            'order_number' => 'PED-2026-0001',
            'status' => 'completed',
            'total' => 4120.00,
            'currency' => 'MXN',
            'shipping_address' => 'Av. Fundidores 240, Col. Lindavista, San Nicolás de los Garza, Nuevo León',
            'notes' => 'Cliente solicita entrega urgente por la tarde.'
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'item_id' => $bateria_lth_part->id,
            'item_type' => 'App\Models\Part',
            'description' => 'Batería LTH L-34R-550',
            'quantity' => 1,
            'unit_price' => 2340.00,
            'total' => 2340.00
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'item_id' => $bujia_part->id,
            'item_type' => 'App\Models\Part',
            'description' => 'Bujía de Iridio NGK IX',
            'quantity' => 4,
            'unit_price' => 195.00,
            'total' => 780.00
        ]);

        // Order 2 (Venta directa de Vehículo seminuevo)
        $order2 = Order::create([
            'user_id' => $cliente1->id,
            'order_number' => 'CAR-2026-0001',
            'status' => 'paid',
            'total' => 68500.00,
            'currency' => 'MXN',
            'shipping_address' => 'Entrega directa en sucursal Monterrey Centro.',
            'notes' => 'Cliente paga de contado mediante transferencia bancaria.'
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'item_id' => $jetta_car->id,
            'item_type' => 'App\Models\Vehicle',
            'description' => 'Volkswagen Jetta A4 Rojo Tornado 2004',
            'quantity' => 1,
            'unit_price' => 68500.00,
            'total' => 68500.00
        ]);

        // Order 3 (New Expanded Order)
        $order3 = Order::create([
            'user_id' => $cliente2->id,
            'order_number' => 'PED-2026-0002',
            'status' => 'shipped',
            'total' => 7738.00,
            'currency' => 'MXN',
            'shipping_address' => 'Calle Reforma 402, Coyoacán, Ciudad de México',
            'notes' => 'Empacar por separado alternador y banda de tiempo.'
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'item_id' => $alternador_denso->id,
            'item_type' => 'App\Models\Part',
            'description' => 'Alternador Denso Original 100A',
            'quantity' => 1,
            'unit_price' => 4150.00,
            'total' => 4150.00
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'item_id' => $clutch_valeo->id,
            'item_type' => 'App\Models\Part',
            'description' => 'Kit de Clutch / Embrague Valeo Premium',
            'quantity' => 1,
            'unit_price' => 2850.00,
            'total' => 2850.00
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'item_id' => $banda_gates->id,
            'item_type' => 'App\Models\Part',
            'description' => 'Banda de Tiempo Reforzada Gates',
            'quantity' => 2,
            'unit_price' => 390.00,
            'total' => 780.00
        ]);

        // 19. Seed Images (Polymorphic Media)
        Image::create([
            'path' => 'images/parts/ngk-iridio.jpg',
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'imageable_id' => $bujia_part->id,
            'imageable_type' => 'App\Models\Part',
            'alt' => 'Bujía NGK de Iridio IX',
            'order' => 1
        ]);

        Image::create([
            'path' => 'images/parts/balatas-brembo.jpg',
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'imageable_id' => $balata_del_part->id,
            'imageable_type' => 'App\Models\Part',
            'alt' => 'Kit de Balatas de Cerámica Brembo',
            'order' => 1
        ]);

        Image::create([
            'path' => 'images/vehicles/jetta-a4-rojo.jpg',
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'imageable_id' => $jetta_car->id,
            'imageable_type' => 'App\Models\Vehicle',
            'alt' => 'VW Jetta A4 Rojo 2004 Lateral',
            'order' => 1
        ]);

        Image::create([
            'path' => 'images/vehicles/mustang-gt-gris.jpg',
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'imageable_id' => $mustang_car->id,
            'imageable_type' => 'App\Models\Vehicle',
            'alt' => 'Ford Mustang GT V8 Gris 2015 Frontal',
            'order' => 1
        ]);

        Image::create([
            'path' => 'images/vehicles/civic-plata.jpg',
            'disk' => 'public',
            'mime_type' => 'image/jpeg',
            'imageable_id' => $civic_car->id,
            'imageable_type' => 'App\Models\Vehicle',
            'alt' => 'Honda Civic EX Plata 2012 Esquina',
            'order' => 1
        ]);
    }
}
