<?php
// update-controllers.php

$models = [
    'Attribute' => [
        'relations' => [],
        'searchable' => 'name'
    ],
    'AttributeValue' => [
        'relations' => ['attribute_id' => 'Attribute'],
        'searchable' => null
    ],
    'Brand' => [
        'relations' => [],
        'searchable' => 'name'
    ],
    'CarModel' => [
        'relations' => ['brand_id' => 'Brand'],
        'searchable' => 'name'
    ],
    'CarVariant' => [
        'relations' => ['car_model_id' => 'CarModel'],
        'searchable' => 'name'
    ],
    'Categorie' => [
        'relations' => ['parent_id' => 'Categorie'],
        'searchable' => 'name'
    ],
    'Component' => [
        'relations' => [],
        'searchable' => 'name'
    ],
    'ComponentPart' => [
        'relations' => ['part_id' => 'Part', 'component_id' => 'Component'],
        'searchable' => null
    ],
    'Image' => [
        'relations' => [],
        'searchable' => null
    ],
    'Manufacturer' => [
        'relations' => [],
        'searchable' => 'name'
    ],
    'Order' => [
        'relations' => ['user_id' => 'User'],
        'searchable' => 'order_number'
    ],
    'OrderItem' => [
        'relations' => ['order_id' => 'Order'],
        'searchable' => null
    ],
    'Part' => [
        'relations' => ['category_id' => 'Categorie', 'manufacturer_id' => 'Manufacturer'],
        'searchable' => 'sku'
    ],
    'PartVariant' => [
        'relations' => ['part_id' => 'Part', 'car_variant_id' => 'CarVariant'],
        'searchable' => null
    ],
    'PriceHistory' => [
        'relations' => ['user_id' => 'User'],
        'searchable' => null
    ],
    'Stock' => [
        'relations' => ['warehouse_id' => 'Warehouse', 'part_id' => 'Part'],
        'searchable' => null
    ],
    'User' => [
        'relations' => [],
        'searchable' => 'email'
    ],
    'Vehicle' => [
        'relations' => ['car_variant_id' => 'CarVariant'],
        'searchable' => 'vin'
    ],
    'Vendor' => [
        'relations' => [],
        'searchable' => 'name'
    ],
    'Warehouse' => [
        'relations' => [],
        'searchable' => 'name'
    ],
];

function generateController($modelName, $config) {
    $routePrefix = strtolower(str_replace('_', '-', $modelName));
    $plural = $routePrefix . 's';
    $modelClass = "App\\Models\\$modelName";
    $relations = $config['relations'];
    $searchable = $config['searchable'];

    $code = "<?php\n\nnamespace App\\Http\\Controllers;\n\nuse $modelClass;\nuse Illuminate\\Http\\Request;\n";

    $importedModels = [$modelName];
    foreach ($relations as $rel) {
        if (!in_array($rel, $importedModels)) {
            $code .= "use App\\Models\\$rel;\n";
            $importedModels[] = $rel;
        }
    }

    $code .= "\nclass {$modelName}Controller extends Controller\n{\n    public function index(Request \$request)\n    {\n        \$query = {$modelName}::query();\n";

    if ($searchable) {
        $code .= "\n        if (\$request->has('search') && \$request->search) {\n            \$query->where('{$searchable}', 'like', '%' . \$request->search . '%');\n        }\n";
    }

    $code .= "\n        \${$plural} = \$query->paginate(15);\n\n        return view('administrador.{$plural}.index', compact('{$plural}'));\n    }\n\n    public function create()\n    {\n";

    if (!empty($relations)) {
        $compactVars = [];
        foreach ($relations as $field => $rel) {
            $var = strtolower($rel) . 's';
            $code .= "        \${$var} = {$rel}::all();\n";
            $compactVars[] = $var;
        }
        $code .= "\n        return view('administrador.{$plural}.create', compact('" . implode("', '", $compactVars) . "'));\n";
    } else {
        $code .= "        return view('administrador.{$plural}.create');\n";
    }

    $code .= "    }\n\n    public function store(Request \$request)\n    {\n        \$validated = \$request->validate([\n";

    // Add basic validation rules based on relations or name
    if ($searchable) {
        $code .= "            '{$searchable}' => 'required',\n";
    }
    foreach ($relations as $field => $rel) {
        $code .= "            '{$field}' => 'required',\n";
    }
    $code .= "            // Add extra validation rules here\n        ]);\n\n        {$modelName}::create(\$validated);\n\n        return redirect()->route('admin.{$plural}.index')->with('success', '{$modelName} creado exitosamente');\n    }\n\n    public function show({$modelName} \${$routePrefix})\n    {\n        return view('administrador.{$plural}.show', compact('{$routePrefix}'));\n    }\n\n    public function edit({$modelName} \${$routePrefix})\n    {\n";

    if (!empty($relations)) {
        $compactVars = ["'{$routePrefix}'"];
        foreach ($relations as $field => $rel) {
            $var = strtolower($rel) . 's';
            $code .= "        \${$var} = {$rel}::all();\n";
            $compactVars[] = "'{$var}'";
        }
        $code .= "\n        return view('administrador.{$plural}.edit', compact(" . implode(", ", $compactVars) . "));\n";
    } else {
        $code .= "        return view('administrador.{$plural}.edit', compact('{$routePrefix}'));\n";
    }

    $code .= "    }\n\n    public function update(Request \$request, {$modelName} \${$routePrefix})\n    {\n        \$validated = \$request->validate([\n";
    if ($searchable) {
        $code .= "            '{$searchable}' => 'required',\n";
    }
    foreach ($relations as $field => $rel) {
        $code .= "            '{$field}' => 'required',\n";
    }
    $code .= "            // Add extra validation rules here\n        ]);\n\n        \${$routePrefix}->update(\$validated);\n\n        return redirect()->route('admin.{$plural}.index')->with('success', '{$modelName} actualizado exitosamente');\n    }\n\n    public function destroy({$modelName} \${$routePrefix})\n    {\n        \${$routePrefix}->delete();\n\n        return redirect()->route('admin.{$plural}.index')->with('success', '{$modelName} eliminado exitosamente');\n    }\n}\n";

    return $code;
}

foreach ($models as $modelName => $config) {
    $code = generateController($modelName, $config);
    $file = __DIR__ . "/app/Http/Controllers/{$modelName}Controller.php";
    file_put_contents($file, $code);
    echo "Updated {$modelName}Controller\n";
}

echo "All controllers updated successfully!\n";
?>