<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\CarVariant;
use App\Models\Vehicle;
use App\Models\Categorie;
use App\Models\Manufacturer;
use App\Models\Part;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Brands
        $toyota = Brand::firstOrCreate(['name' => 'Toyota']);
        $ford = Brand::firstOrCreate(['name' => 'Ford']);
        $chevrolet = Brand::firstOrCreate(['name' => 'Chevrolet']);

        // Create Models
        $camry = CarModel::firstOrCreate(['brand_id' => $toyota->id, 'name' => 'Camry']);
        $f150 = CarModel::firstOrCreate(['brand_id' => $ford->id, 'name' => 'F-150']);
        $silverado = CarModel::firstOrCreate(['brand_id' => $chevrolet->id, 'name' => 'Silverado']);

        // Create Variants
        $camryLE = CarVariant::firstOrCreate(['car_model_id' => $camry->id, 'name' => 'LE']);
        $f150XLT = CarVariant::firstOrCreate(['car_model_id' => $f150->id, 'name' => 'XLT']);
        $silveradoLTZ = CarVariant::firstOrCreate(['car_model_id' => $silverado->id, 'name' => 'LTZ']);

        // Create Vehicles
        $vehicle1 = Vehicle::firstOrCreate([
            'car_variant_id' => $camryLE->id,
            'vin' => 'VIN001',
        ], [
            'year' => 2023,
            'color' => 'Gris',
            'mileage' => 15000,
            'price' => 250000,
            'condition' => 'Excelente',
            'description' => 'Toyota Camry LE 2023 en perfecto estado',
        ]);

        $vehicle2 = Vehicle::firstOrCreate([
            'car_variant_id' => $f150XLT->id,
            'vin' => 'VIN002',
        ], [
            'year' => 2022,
            'color' => 'Negro',
            'mileage' => 35000,
            'price' => 380000,
            'condition' => 'Muy Bueno',
            'description' => 'Ford F-150 XLT 2022 con poco kilometraje',
        ]);

        $vehicle3 = Vehicle::firstOrCreate([
            'car_variant_id' => $silveradoLTZ->id,
            'vin' => 'VIN003',
        ], [
            'year' => 2021,
            'color' => 'Blanco',
            'mileage' => 55000,
            'price' => 320000,
            'condition' => 'Bueno',
            'description' => 'Chevrolet Silverado LTZ 2021',
        ]);

        // Add images to vehicles
        Image::firstOrCreate([
            'imageable_id' => $vehicle1->id,
            'imageable_type' => Vehicle::class,
            'path' => 'https://via.placeholder.com/800x600?text=Toyota+Camry+2023',
            'order' => 1,
        ]);

        Image::firstOrCreate([
            'imageable_id' => $vehicle2->id,
            'imageable_type' => Vehicle::class,
            'path' => 'https://via.placeholder.com/800x600?text=Ford+F150+2022',
            'order' => 1,
        ]);

        Image::firstOrCreate([
            'imageable_id' => $vehicle3->id,
            'imageable_type' => Vehicle::class,
            'path' => 'https://via.placeholder.com/800x600?text=Chevrolet+Silverado+2021',
            'order' => 1,
        ]);

        // Create Categories
        $engines = Categorie::firstOrCreate(['name' => 'Motores']);
        $brakes = Categorie::firstOrCreate(['name' => 'Frenos']);
        $suspension = Categorie::firstOrCreate(['name' => 'Suspensión']);
        $accessories = Categorie::firstOrCreate(['name' => 'Accesorios']);

        // Create Manufacturers
        $bosch = Manufacturer::firstOrCreate(['name' => 'Bosch']);
        $denso = Manufacturer::firstOrCreate(['name' => 'Denso']);
        $genuine = Manufacturer::firstOrCreate(['name' => 'Genuine']);

        // Create Parts
        $part1 = Part::firstOrCreate([
            'sku' => 'MOTOR001',
            'name' => 'Motor de Arranque 12V',
            'category_id' => $engines->id,
            'manufacturer_id' => $bosch->id,
        ], [
            'description' => 'Motor de arranque compatible con Toyota Camry y modelos similares',
            'price' => 1200,
            'stock' => 15,
            'active' => true,
        ]);

        $part2 = Part::firstOrCreate([
            'sku' => 'BRAKE001',
            'name' => 'Pastillas de Freno Premium',
            'category_id' => $brakes->id,
            'manufacturer_id' => $denso->id,
        ], [
            'description' => 'Conjunto de pastillas de freno de cerámica de bajo polvo',
            'price' => 850,
            'stock' => 30,
            'active' => true,
        ]);

        $part3 = Part::firstOrCreate([
            'sku' => 'SUSP001',
            'name' => 'Amortiguador Frontal',
            'category_id' => $suspension->id,
            'manufacturer_id' => $genuine->id,
        ], [
            'description' => 'Amortiguador gas frontal de reemplazo original',
            'price' => 2500,
            'stock' => 10,
            'active' => true,
        ]);

        $part4 = Part::firstOrCreate([
            'sku' => 'ACC001',
            'name' => 'Filtro de Aire de Cabina',
            'category_id' => $accessories->id,
            'manufacturer_id' => $bosch->id,
        ], [
            'description' => 'Filtro HEPA para aire limpio en el interior del vehículo',
            'price' => 350,
            'stock' => 50,
            'active' => true,
        ]);

        // Add images to parts
        Image::firstOrCreate([
            'imageable_id' => $part1->id,
            'imageable_type' => Part::class,
            'path' => 'https://via.placeholder.com/400x300?text=Motor+Arranque',
            'order' => 1,
        ]);

        Image::firstOrCreate([
            'imageable_id' => $part2->id,
            'imageable_type' => Part::class,
            'path' => 'https://via.placeholder.com/400x300?text=Pastillas+Freno',
            'order' => 1,
        ]);

        Image::firstOrCreate([
            'imageable_id' => $part3->id,
            'imageable_type' => Part::class,
            'path' => 'https://via.placeholder.com/400x300?text=Amortiguador',
            'order' => 1,
        ]);

        Image::firstOrCreate([
            'imageable_id' => $part4->id,
            'imageable_type' => Part::class,
            'path' => 'https://via.placeholder.com/400x300?text=Filtro+Aire',
            'order' => 1,
        ]);
    }
}
