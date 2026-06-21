<?php
// generate-admin-views.php
// Ejecutar desde el root del proyecto: php generate-admin-views.php

$models = [
    'Attribute' => [
        'fields' => ['name', 'slug', 'type'],
        'timestamps' => true,
        'searchable' => 'name',
        'relations' => []
    ],
    'AttributeValue' => [
        'fields' => ['attribute_id', 'value', 'unit'],
        'timestamps' => true,
        'relations' => ['attribute_id' => 'Attribute']
    ],
    'Brand' => [
        'fields' => ['name', 'slug', 'country', 'description', 'website'],
        'timestamps' => true,
        'searchable' => 'name',
        'relations' => []
    ],
    'CarModel' => [
        'fields' => ['brand_id', 'name', 'slug', 'year_from', 'year_to', 'description'],
        'timestamps' => true,
        'relations' => ['brand_id' => 'Brand'],
        'searchable' => 'name',
    ],
    'CarVariant' => [
        'fields' => ['car_model_id', 'name', 'trim', 'engine', 'transmission', 'fuel_type', 'doors', 'notes'],
        'timestamps' => true,
        'relations' => ['car_model_id' => 'CarModel'],
        'searchable' => 'name',
    ],
    'Categorie' => [
        'fields' => ['name', 'slug', 'parent_id', 'description'],
        'timestamps' => true,
        'relations' => ['parent_id' => 'Categorie'],
        'searchable' => 'name',
    ],
    'Component' => [
        'fields' => ['name', 'part_number', 'description'],
        'timestamps' => true,
        'searchable' => 'name',
        'relations' => []
    ],
    'ComponentPart' => [
        'fields' => ['part_id', 'component_id', 'role', 'quantity'],
        'timestamps' => true,
        'relations' => ['part_id' => 'Part', 'component_id' => 'Component']
    ],
    'Image' => [
        'fields' => ['path', 'disk', 'mime_type', 'imageable_id', 'imageable_type', 'alt', 'order'],
        'timestamps' => true,
        'relations' => []
    ],
    'Manufacturer' => [
        'fields' => ['name', 'country', 'description', 'website'],
        'timestamps' => true,
        'searchable' => 'name',
        'relations' => []
    ],
    'Order' => [
        'fields' => ['user_id', 'order_number', 'status', 'total', 'currency', 'shipping_address', 'notes'],
        'timestamps' => true,
        'relations' => ['user_id' => 'User'],
        'searchable' => 'order_number',
    ],
    'OrderItem' => [
        'fields' => ['order_id', 'item_id', 'item_type', 'description', 'quantity', 'unit_price', 'total'],
        'timestamps' => true,
        'relations' => ['order_id' => 'Order']
    ],
    'Part' => [
        'fields' => ['sku', 'name', 'category_id', 'manufacturer_id', 'description', 'price', 'currency', 'weight', 'dimensions', 'stock', 'active'],
        'timestamps' => true,
        'relations' => ['category_id' => 'Categorie', 'manufacturer_id' => 'Manufacturer'],
        'searchable' => 'sku',
    ],
    'PartVariant' => [
        'fields' => ['part_id', 'car_variant_id', 'fitment_notes', 'direct_fit'],
        'timestamps' => true,
        'relations' => ['part_id' => 'Part', 'car_variant_id' => 'CarVariant']
    ],
    'PriceHistory' => [
        'fields' => ['priceable_id', 'priceable_type', 'price', 'currency', 'user_id', 'effective_at'],
        'timestamps' => true,
        'relations' => ['user_id' => 'User']
    ],
    'Stock' => [
        'fields' => ['warehouse_id', 'part_id', 'quantity', 'reserved'],
        'timestamps' => true,
        'relations' => ['warehouse_id' => 'Warehouse', 'part_id' => 'Part']
    ],
    'User' => [
        'fields' => ['name', 'email', 'password'],
        'timestamps' => true,
        'searchable' => 'email',
        'relations' => []
    ],
    'Vehicle' => [
        'fields' => ['car_variant_id', 'vin', 'stock_code', 'year', 'color', 'mileage', 'price', 'condition', 'description'],
        'timestamps' => true,
        'relations' => ['car_variant_id' => 'CarVariant'],
        'searchable' => 'vin',
    ],
    'Vendor' => [
        'fields' => ['name', 'contact_name', 'email', 'phone', 'address', 'notes'],
        'timestamps' => true,
        'searchable' => 'name',
        'relations' => []
    ],
    'Warehouse' => [
        'fields' => ['name', 'code', 'address', 'city', 'state', 'country', 'phone'],
        'timestamps' => true,
        'searchable' => 'name',
        'relations' => []
    ],
];

function getRelationMethodName($field, $modelName) {
    if ($field === 'brand_id') return 'brand';
    if ($field === 'car_model_id') return 'model';
    if ($field === 'car_variant_id') {
        if ($modelName === 'PartVariant') return 'carVariant';
        return 'variant'; // for Vehicle
    }
    if ($field === 'parent_id') return 'parent';
    if ($field === 'category_id') return 'category';
    if ($field === 'manufacturer_id') return 'manufacturer';
    if ($field === 'part_id') return 'part';
    if ($field === 'user_id') return 'user';
    if ($field === 'warehouse_id') return 'warehouse';
    if ($field === 'order_id') return 'order';
    if ($field === 'component_id') return 'component';
    return null;
}

function getRelationDisplayField($relModel) {
    if ($relModel === 'Order') return 'order_number';
    if ($relModel === 'Part') return 'sku';
    return 'name';
}

function generateIndexView($modelName, $config) {
    $routePrefix = strtolower(str_replace('_', '-', $modelName));
    $plural = $routePrefix . 's';
    $fields = $config['fields'];
    $searchable = $config['searchable'] ?? null;

    $html = "@extends('administrador.plantilla')\n\n@section('title', '$modelName - Panel Admin')\n\n@section('content')\n";
    $html .= "<div class=\"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6\">\n";
    $html .= "    <div>\n        <h1 class=\"text-2xl font-bold text-slate-900 tracking-tight\">$modelName</h1>\n        <p class=\"text-sm text-slate-500 mt-1\">Administre los registros de $modelName en el sistema.</p>\n    </div>\n";
    $html .= "    <a href=\"{{ route('admin.$plural.create') }}\" class=\"inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer\">\n";
    $html .= "        <i data-lucide=\"plus\" class=\"w-4 h-4\"></i> Crear Nuevo\n    </a>\n</div>\n\n";

    $html .= "@if(session('success'))\n";
    $html .= "    <div class=\"mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3 text-emerald-800 text-sm font-medium shadow-sm\">\n";
    $html .= "        <i data-lucide=\"check-circle\" class=\"w-5 h-5 text-emerald-600 flex-shrink-0\"></i>\n";
    $html .= "        <span>{{ session('success') }}</span>\n";
    $html .= "    </div>\n@endif\n\n";

    $html .= "<div class=\"bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden\">\n";

    if ($searchable) {
        $html .= "    <div class=\"p-5 border-b border-slate-100 bg-slate-50/50\">\n";
        $html .= "        <form method=\"GET\" class=\"flex gap-3 max-w-md\">\n";
        $html .= "            <div class=\"relative flex-1\">\n";
        $html .= "                <input type=\"text\" name=\"search\" class=\"w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400 shadow-sm\" placeholder=\"Buscar por $searchable...\" value=\"{{ request('search') }}\">\n";
        $html .= "                <i data-lucide=\"search\" class=\"absolute left-3.5 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-slate-400\"></i>\n";
        $html .= "            </div>\n";
        $html .= "            <button type=\"submit\" class=\"px-4 py-2 bg-slate-800 text-white rounded-xl text-sm font-semibold hover:bg-slate-900 transition-colors shadow-sm cursor-pointer\">Buscar</button>\n";
        $html .= "        </form>\n    </div>\n";
    }

    $html .= "    <div class=\"overflow-x-auto\">\n";
    $html .= "        <table class=\"w-full border-collapse text-left\">\n";
    $html .= "            <thead>\n                <tr class=\"bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold\">\n";

    foreach ($fields as $field) {
        $html .= "                    <th class=\"px-6 py-4 border-b border-slate-100\">" . ucfirst(str_replace('_', ' ', $field)) . "</th>\n";
    }
    $html .= "                    <th class=\"px-6 py-4 border-b border-slate-100 text-right\">Acciones</th>\n                </tr>\n            </thead>\n";
    $html .= "            <tbody class=\"divide-y divide-slate-100\">\n";
    $html .= "                @forelse(\$$plural as \$item)\n                    <tr class=\"hover:bg-slate-50/70 transition-colors\">\n";

    foreach ($fields as $field) {
        if (isset($config['relations'][$field])) {
            $relModel = $config['relations'][$field];
            $relation = getRelationMethodName($field, $modelName);
            $disp = getRelationDisplayField($relModel);
            if ($relation) {
                $html .= "                        <td class=\"px-6 py-4 text-sm text-slate-600\">{{ \$item->$relation ? \$item->$relation->$disp : 'N/A' }}</td>\n";
            } else {
                $html .= "                        <td class=\"px-6 py-4 text-sm text-slate-600\">{{ \$item->$field }}</td>\n";
            }
        } else {
            // format direct fit / active / booleans as badges
            if ($field === 'active' || $field === 'direct_fit') {
                $html .= "                        <td class=\"px-6 py-4 text-sm\">\n                            @if(\$item->$field)\n                                <span class=\"inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100\">\n                                    <span class=\"w-1.5 h-1.5 rounded-full bg-emerald-500\"></span> Activo\n                                </span>\n                            @else\n                                <span class=\"inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-50 text-slate-500 border border-slate-100\">\n                                    <span class=\"w-1.5 h-1.5 rounded-full bg-slate-400\"></span> Inactivo\n                                </span>\n                            @endif\n                        </td>\n";
            } elseif ($field === 'price' || $field === 'total' || $field === 'unit_price') {
                $html .= "                        <td class=\"px-6 py-4 text-sm font-semibold text-slate-900\">\n                            \${{ number_format(\$item->$field, 2) }} {{ \$item->currency ?? 'MXN' }}\n                        </td>\n";
            } elseif ($field === 'dimensions') {
                $html .= "                        <td class=\"px-6 py-4 text-sm text-slate-600\">\n                            @if(is_array(\$item->$field))\n                                {{ \$item->{$field}['length'] ?? '' }} x {{ \$item->{$field}['width'] ?? '' }} x {{ \$item->{$field}['height'] ?? '' }} cm\n                            @else\n                                {{ \$item->$field }}\n                            @endif\n                        </td>\n";
            } else {
                if ($modelName === 'Image' && $field === 'path') {
                    $html .= "                        <td class=\"px-6 py-4 text-sm text-slate-600\">\n                            @if(\$item->path)\n                                <img src=\"{{ asset('storage/' . \$item->path) }}\" class=\"w-16 h-16 object-cover rounded-xl border border-slate-100 shadow-sm\">\n                            @else\n                                <span class=\"text-slate-400\">Sin Imagen</span>\n                            @endif\n                        </td>\n";
                } else {
                    $html .= "                        <td class=\"px-6 py-4 text-sm text-slate-600\">{{ \$item->$field }}</td>\n";
                }
            }
        }
    }

    $html .= "                        <td class=\"px-6 py-4 text-right whitespace-nowrap\">\n";
    $html .= "                            <div class=\"inline-flex items-center gap-1.5\">\n";
    $html .= "                                <a href=\"{{ route('admin.$plural.show', \$item) }}\" class=\"inline-flex items-center gap-1 px-3 py-1.5 text-indigo-600 hover:text-indigo-900 font-semibold text-xs bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors cursor-pointer\"><i data-lucide=\"eye\" class=\"w-3.5 h-3.5\"></i> Ver</a>\n";
    $html .= "                                <a href=\"{{ route('admin.$plural.edit', \$item) }}\" class=\"inline-flex items-center gap-1 px-3 py-1.5 text-amber-600 hover:text-amber-900 font-semibold text-xs bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors cursor-pointer\"><i data-lucide=\"edit\" class=\"w-3.5 h-3.5\"></i> Editar</a>\n";
    $html .= "                                <form method=\"POST\" action=\"{{ route('admin.$plural.destroy', \$item) }}\" class=\"inline\" onsubmit=\"return confirm('¿Estás seguro de eliminar este registro?')\">\n";
    $html .= "                                    @csrf\n                                    @method('DELETE')\n";
    $html .= "                                    <button type=\"submit\" class=\"inline-flex items-center gap-1 px-3 py-1.5 text-rose-600 hover:text-rose-900 font-semibold text-xs bg-rose-50 hover:bg-rose-100 rounded-lg border-0 transition-colors cursor-pointer\"><i data-lucide=\"trash-2\" class=\"w-3.5 h-3.5\"></i> Eliminar</button>\n";
    $html .= "                                </form>\n                            </div>\n                        </td>\n                    </tr>\n";
    $html .= "                @empty\n";
    $html .= "                    <tr>\n";
    $html .= "                        <td colspan=\"" . (count($fields) + 1) . "\" class=\"px-6 py-12 text-center\">\n";
    $html .= "                            <div class=\"flex flex-col items-center justify-center gap-3\">\n";
    $html .= "                                <div class=\"p-3 bg-slate-50 border border-slate-100 text-slate-400 rounded-full\"><i data-lucide=\"inbox\" class=\"w-8 h-8\"></i></div>\n";
    $html .= "                                <p class=\"text-sm font-medium text-slate-500\">No se encontraron registros de $modelName</p>\n";
    $html .= "                            </div>\n                        </td>\n                    </tr>\n";
    $html .= "                @endforelse\n            </tbody>\n        </table>\n    </div>\n";

    $html .= "    @if(\$${plural}->hasPages())\n";
    $html .= "        <div class=\"px-6 py-4 border-t border-slate-100 bg-slate-50/30\">\n";
    $html .= "            {{ \$${plural}->links() }}\n";
    $html .= "        </div>\n    @endif\n";
    $html .= "</div>\n@endsection\n";

    return $html;
}

function generateCreateView($modelName, $config) {
    $routePrefix = strtolower(str_replace('_', '-', $modelName));
    $plural = $routePrefix . 's';
    $fields = $config['fields'];

    $html = "@extends('administrador.plantilla')\n\n@section('title', 'Crear $modelName - Panel Admin')\n\n@section('content')\n";
    $html .= "<div class=\"flex items-center justify-between gap-4 mb-6\">\n";
    $html .= "    <div>\n        <h1 class=\"text-2xl font-bold text-slate-900 tracking-tight\">Crear $modelName</h1>\n        <p class=\"text-sm text-slate-500 mt-1\">Añada un nuevo registro a la base de datos.</p>\n    </div>\n";
    $html .= "    <a href=\"{{ route('admin.$plural.index') }}\" class=\"inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer\">\n";
    $html .= "        <i data-lucide=\"arrow-left\" class=\"w-4 h-4\"></i> Volver\n    </a>\n</div>\n\n";

    $html .= "@if(\$errors->any())\n";
    $html .= "    <div class=\"mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm font-medium shadow-sm\">\n";
    $html .= "        <div class=\"flex items-center gap-2 font-bold mb-2\">\n            <i data-lucide=\"alert-triangle\" class=\"w-5 h-5 text-rose-600\"></i> Por favor corrige los siguientes errores:\n        </div>\n";
    $html .= "        <ul class=\"list-disc list-inside space-y-1 ml-2 font-normal\">\n            @foreach(\$errors->all() as \$error)\n                <li>{{ \$error }}</li>\n            @endforeach\n        </ul>\n    </div>\n@endif\n\n";

    $html .= "<div class=\"bg-white border border-slate-100 shadow-sm rounded-2xl p-6 md:p-8\">\n";
    $enctype = ($modelName === 'Image') ? ' enctype="multipart/form-data"' : '';
    $html .= "    <form method=\"POST\" action=\"{{ route('admin.$plural.store') }}\"$enctype>\n        @csrf\n";
    $html .= "        <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-8\">\n";

    foreach ($fields as $field) {
        if ($modelName === 'Image' && ($field === 'disk' || $field === 'mime_type')) {
            continue;
        }

        if ($modelName === 'Image' && $field === 'path') {
            $html .= "            <div>\n                <label for=\"image\" class=\"block text-sm font-semibold text-slate-700 mb-2\">Imagen (Archivo)</label>\n";
            $html .= "                <input type=\"file\" name=\"image\" id=\"image\" class=\"w-full px-4 py-2 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100\" required>\n";
            $html .= "            </div>\n";
            continue;
        }

        $label = ucfirst(str_replace('_', ' ', $field));
        $type = 'text';
        if (strpos($field, 'email') !== false) $type = 'email';
        if (strpos($field, 'password') !== false) $type = 'password';
        if (strpos($field, 'price') !== false || strpos($field, 'total') !== false || $field === 'unit_price') $type = 'number';
        if (strpos($field, 'quantity') !== false || $field === 'stock' || $field === 'capacity') $type = 'number';
        if ($field === 'active' || $field === 'direct_fit') $type = 'checkbox';

        if (isset($config['relations'][$field])) {
            $relModel = $config['relations'][$field];
            $relationPlural = strtolower($relModel) . 's';
            $disp = getRelationDisplayField($relModel);
            $requiredAttr = (in_array($field, ['attribute_id', 'brand_id', 'car_model_id', 'category_id', 'component_id', 'manufacturer_id', 'order_id', 'part_id', 'user_id', 'warehouse_id', 'car_variant_id']) ? 'required' : '');

            $html .= "            <div>\n                <label for=\"$field\" class=\"block text-sm font-semibold text-slate-700 mb-2\">$label</label>\n";
            $html .= "                <select name=\"$field\" id=\"$field\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all\" $requiredAttr>\n";
            $html .= "                    <option value=\"\">Seleccionar...</option>\n";
            $html .= "                    @foreach(\$$relationPlural as \$rel)\n";
            $html .= "                        <option value=\"{{ \$rel->id }}\" {{ old('$field') == \$rel->id ? 'selected' : '' }}>{{ \$rel->$disp ?? \$rel->id }}</option>\n";
            $html .= "                    @endforeach\n                </select>\n            </div>\n";
        } elseif ($type === 'checkbox') {
            $html .= "            <div class=\"flex items-center mt-8\">\n";
            $html .= "                <label class=\"relative flex items-center cursor-pointer\">\n";
            $html .= "                    <input type=\"checkbox\" name=\"$field\" id=\"$field\" value=\"1\" class=\"sr-only peer\" {{ old('$field') ? 'checked' : '' }}>\n";
            $html .= "                    <div class=\"w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-500/10 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600\"></div>\n";
            $html .= "                    <span class=\"ml-3 text-sm font-semibold text-slate-700\">$label</span>\n";
            $html .= "                </label>\n            </div>\n";
        } else {
            $requiredAttr = (in_array($field, ['name', 'email', 'sku', 'order_number', 'vin']) ? 'required' : '');
            $stepAttr = ($type === 'number' ? 'step="any"' : '');

            if ($field === 'dimensions') {
                $html .= "            <div>\n                <label class=\"block text-sm font-semibold text-slate-700 mb-2\">Dimensiones (Largo x Ancho x Alto - cm)</label>\n                <div class=\"grid grid-cols-3 gap-3\">\n                    <input type=\"number\" step=\"any\" name=\"dimensions[length]\" value=\"{{ old('dimensions.length') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Largo\">\n                    <input type=\"number\" step=\"any\" name=\"dimensions[width]\" value=\"{{ old('dimensions.width') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Ancho\">\n                    <input type=\"number\" step=\"any\" name=\"dimensions[height]\" value=\"{{ old('dimensions.height') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Alto\">\n                </div>\n            </div>\n";
            } else {
                $html .= "            <div>\n                <label for=\"$field\" class=\"block text-sm font-semibold text-slate-700 mb-2\">$label</label>\n";
                if ($field === 'description' || $field === 'notes' || $field === 'address' || $field === 'fitment_notes') {
                    $html .= "                <textarea name=\"$field\" id=\"$field\" rows=\"3\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Ingrese $label...\">{{ old('$field') }}</textarea>\n";
                } else {
                    $html .= "                <input type=\"$type\" name=\"$field\" id=\"$field\" value=\"{{ old('$field') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" $requiredAttr $stepAttr placeholder=\"Ingrese $label...\">\n";
                }
                $html .= "            </div>\n";
            }
        }
    }

    $html .= "        </div>\n";
    $html .= "        <div class=\"flex items-center justify-end gap-3 pt-6 border-t border-slate-100\">\n";
    $html .= "            <a href=\"{{ route('admin.$plural.index') }}\" class=\"px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer\">Cancelar</a>\n";
    $html .= "            <button type=\"submit\" class=\"px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer\"><i data-lucide=\"save\" class=\"w-4 h-4 inline-block mr-1.5 -mt-0.5\"></i> Crear</button>\n";
    $html .= "        </div>\n    </form>\n</div>\n@endsection\n";

    return $html;
}

function generateEditView($modelName, $config) {
    $routePrefix = strtolower(str_replace('_', '-', $modelName));
    $plural = $routePrefix . 's';
    $fields = $config['fields'];

    $html = "@extends('administrador.plantilla')\n\n@section('title', 'Editar $modelName - Panel Admin')\n\n@section('content')\n";
    $html .= "<div class=\"flex items-center justify-between gap-4 mb-6\">\n";
    $html .= "    <div>\n        <h1 class=\"text-2xl font-bold text-slate-900 tracking-tight\">Editar $modelName</h1>\n        <p class=\"text-sm text-slate-500 mt-1\">Modifique los campos correspondientes del registro.</p>\n    </div>\n";
    $html .= "    <a href=\"{{ route('admin.$plural.index') }}\" class=\"inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer\">\n";
    $html .= "        <i data-lucide=\"arrow-left\" class=\"w-4 h-4\"></i> Volver\n    </a>\n</div>\n\n";

    $html .= "@if(\$errors->any())\n";
    $html .= "    <div class=\"mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm font-medium shadow-sm\">\n";
    $html .= "        <div class=\"flex items-center gap-2 font-bold mb-2\">\n            <i data-lucide=\"alert-triangle\" class=\"w-5 h-5 text-rose-600\"></i> Por favor corrige los siguientes errores:\n        </div>\n";
    $html .= "        <ul class=\"list-disc list-inside space-y-1 ml-2 font-normal\">\n            @foreach(\$errors->all() as \$error)\n                <li>{{ \$error }}</li>\n            @endforeach\n        </ul>\n    </div>\n@endif\n\n";

    $html .= "<div class=\"bg-white border border-slate-100 shadow-sm rounded-2xl p-6 md:p-8\">\n";
    $enctype = ($modelName === 'Image') ? ' enctype="multipart/form-data"' : '';
    $html .= "    <form method=\"POST\" action=\"{{ route('admin.$plural.update', \$${routePrefix}) }}\"$enctype>\n        @csrf\n        @method('PUT')\n";
    $html .= "        <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-8\">\n";

    foreach ($fields as $field) {
        if ($modelName === 'Image' && ($field === 'disk' || $field === 'mime_type')) {
            continue;
        }

        if ($modelName === 'Image' && $field === 'path') {
            $html .= "            <div>\n                <label for=\"image\" class=\"block text-sm font-semibold text-slate-700 mb-2\">Reemplazar Imagen (Archivo)</label>\n";
            $html .= "                @if(\$${routePrefix}->path)\n";
            $html .= "                    <div class=\"mb-3\">\n";
            $html .= "                        <img src=\"{{ asset('storage/' . \$${routePrefix}->path) }}\" class=\"w-32 h-32 object-cover rounded-xl border shadow-sm\">\n";
            $html .= "                    </div>\n";
            $html .= "                @endif\n";
            $html .= "                <input type=\"file\" name=\"image\" id=\"image\" class=\"w-full px-4 py-2 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100\">\n";
            $html .= "            </div>\n";
            continue;
        }

        $label = ucfirst(str_replace('_', ' ', $field));
        $type = 'text';
        if (strpos($field, 'email') !== false) $type = 'email';
        if (strpos($field, 'password') !== false) $type = 'password';
        if (strpos($field, 'price') !== false || strpos($field, 'total') !== false || $field === 'unit_price') $type = 'number';
        if (strpos($field, 'quantity') !== false || $field === 'stock' || $field === 'capacity') $type = 'number';
        if ($field === 'active' || $field === 'direct_fit') $type = 'checkbox';

        if (isset($config['relations'][$field])) {
            $relModel = $config['relations'][$field];
            $relationPlural = strtolower($relModel) . 's';
            $disp = getRelationDisplayField($relModel);
            $requiredAttr = (in_array($field, ['attribute_id', 'brand_id', 'car_model_id', 'category_id', 'component_id', 'manufacturer_id', 'order_id', 'part_id', 'user_id', 'warehouse_id', 'car_variant_id']) ? 'required' : '');

            $html .= "            <div>\n                <label for=\"$field\" class=\"block text-sm font-semibold text-slate-700 mb-2\">$label</label>\n";
            $html .= "                <select name=\"$field\" id=\"$field\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all\" $requiredAttr>\n";
            $html .= "                    <option value=\"\">Seleccionar...</option>\n";
            $html .= "                    @foreach(\$$relationPlural as \$rel)\n";
            $html .= "                        <option value=\"{{ \$rel->id }}\" {{ old('$field', \$${routePrefix}->$field) == \$rel->id ? 'selected' : '' }}>{{ \$rel->$disp ?? \$rel->id }}</option>\n";
            $html .= "                    @endforeach\n                </select>\n            </div>\n";
        } elseif ($type === 'checkbox') {
            $html .= "            <div class=\"flex items-center mt-8\">\n";
            $html .= "                <label class=\"relative flex items-center cursor-pointer\">\n";
            $html .= "                    <input type=\"checkbox\" name=\"$field\" id=\"$field\" value=\"1\" class=\"sr-only peer\" {{ old('$field', \$${routePrefix}->$field) ? 'checked' : '' }}>\n";
            $html .= "                    <div class=\"w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-500/10 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600\"></div>\n";
            $html .= "                    <span class=\"ml-3 text-sm font-semibold text-slate-700\">$label</span>\n";
            $html .= "                </label>\n            </div>\n";
        } else {
            $requiredAttr = (in_array($field, ['name', 'email', 'sku', 'order_number', 'vin']) ? 'required' : '');
            $stepAttr = ($type === 'number' ? 'step="any"' : '');

            if ($field === 'dimensions') {
                $html .= "            <div>\n                <label class=\"block text-sm font-semibold text-slate-700 mb-2\">Dimensiones (Largo x Ancho x Alto - cm)</label>\n                <div class=\"grid grid-cols-3 gap-3\">\n                    <input type=\"number\" step=\"any\" name=\"dimensions[length]\" value=\"{{ old('dimensions.length', \$${routePrefix}->dimensions['length'] ?? '') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Largo\">\n                    <input type=\"number\" step=\"any\" name=\"dimensions[width]\" value=\"{{ old('dimensions.width', \$${routePrefix}->dimensions['width'] ?? '') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Ancho\">\n                    <input type=\"number\" step=\"any\" name=\"dimensions[height]\" value=\"{{ old('dimensions.height', \$${routePrefix}->dimensions['height'] ?? '') }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" placeholder=\"Alto\">\n                </div>\n            </div>\n";
            } else {
                $html .= "            <div>\n                <label for=\"$field\" class=\"block text-sm font-semibold text-slate-700 mb-2\">$label</label>\n";
                if ($field === 'description' || $field === 'notes' || $field === 'address' || $field === 'fitment_notes') {
                    $html .= "                <textarea name=\"$field\" id=\"$field\" rows=\"3\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\">{{ old('$field', \$${routePrefix}->$field) }}</textarea>\n";
                } else {
                    $html .= "                <input type=\"$type\" name=\"$field\" id=\"$field\" value=\"{{ old('$field', \$${routePrefix}->$field) }}\" class=\"w-full px-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all placeholder:text-slate-400\" $requiredAttr $stepAttr>\n";
                }
                $html .= "            </div>\n";
            }
        }
    }

    $html .= "        </div>\n";
    $html .= "        <div class=\"flex items-center justify-end gap-3 pt-6 border-t border-slate-100\">\n";
    $html .= "            <a href=\"{{ route('admin.$plural.index') }}\" class=\"px-5 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer\">Cancelar</a>\n";
    $html .= "            <button type=\"submit\" class=\"px-6 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 active:bg-indigo-800 transition-all shadow-sm shadow-indigo-600/10 cursor-pointer\"><i data-lucide=\"save\" class=\"w-4 h-4 inline-block mr-1.5 -mt-0.5\"></i> Guardar Cambios</button>\n";
    $html .= "        </div>\n    </form>\n</div>\n@endsection\n";

    return $html;
}

function generateShowView($modelName, $config) {
    $routePrefix = strtolower(str_replace('_', '-', $modelName));
    $plural = $routePrefix . 's';
    $fields = $config['fields'];

    $html = "@extends('administrador.plantilla')\n\n@section('title', 'Ver $modelName - Panel Admin')\n\n@section('content')\n";
    $html .= "<div class=\"flex items-center justify-between gap-4 mb-6\">\n";
    $html .= "    <div>\n        <h1 class=\"text-2xl font-bold text-slate-900 tracking-tight\">Detalle de $modelName</h1>\n        <p class=\"text-sm text-slate-500 mt-1\">Consulte la información completa de este registro.</p>\n    </div>\n";
    $html .= "    <div class=\"inline-flex items-center gap-2\">\n";
    $html .= "        <a href=\"{{ route('admin.$plural.index') }}\" class=\"inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 focus:ring-4 focus:ring-slate-100 transition-all cursor-pointer\">\n";
    $html .= "            <i data-lucide=\"arrow-left\" class=\"w-4 h-4\"></i> Volver\n        </a>\n";
    $html .= "        <a href=\"{{ route('admin.$plural.edit', \$${routePrefix}) }}\" class=\"inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-all cursor-pointer\">\n";
    $html .= "            <i data-lucide=\"edit\" class=\"w-4 h-4\"></i> Editar\n        </a>\n";
    $html .= "    </div>\n</div>\n\n";

    $html .= "<div class=\"bg-white border border-slate-100 shadow-sm rounded-2xl overflow-hidden\">\n";
    $html .= "    <div class=\"p-6 md:p-8\">\n";
    $html .= "        <dl class=\"grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6\">\n";

    foreach ($fields as $field) {
        $label = ucfirst(str_replace('_', ' ', $field));
        if (isset($config['relations'][$field])) {
            $relModel = $config['relations'][$field];
            $relation = getRelationMethodName($field, $modelName);
            $disp = getRelationDisplayField($relModel);
            if ($relation) {
                $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-semibold text-slate-800\">{{ \$${routePrefix}->$relation ? \$${routePrefix}->$relation->$disp : 'N/A' }}</dd>\n            </div>\n";
            } else {
                $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-semibold text-slate-800\">{{ \$${routePrefix}->$field }}</dd>\n            </div>\n";
            }
        } else {
            if ($field === 'active' || $field === 'direct_fit') {
                $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-semibold text-slate-800\">\n                    @if(\$${routePrefix}->$field)\n                        <span class=\"inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100\">\n                            <span class=\"w-1.5 h-1.5 rounded-full bg-emerald-500\"></span> Activo\n                        </span>\n                    @else\n                        <span class=\"inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-50 text-slate-500 border border-slate-100\">\n                            <span class=\"w-1.5 h-1.5 rounded-full bg-slate-400\"></span> Inactivo\n                        </span>\n                    @endif\n                </dd>\n            </div>\n";
            } elseif ($field === 'price' || $field === 'total' || $field === 'unit_price') {
                $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-bold text-indigo-600\">\n                    \${{ number_format(\$${routePrefix}->$field, 2) }} {{ \$${routePrefix}->currency ?? 'MXN' }}\n                </dd>\n            </div>\n";
            } elseif ($field === 'dimensions') {
                $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-semibold text-slate-800\">\n                    @if(is_array(\$${routePrefix}->$field))\n                        {{ \$${routePrefix}->{$field}['length'] ?? '' }} x {{ \$${routePrefix}->{$field}['width'] ?? '' }} x {{ \$${routePrefix}->{$field}['height'] ?? '' }} cm\n                    @else\n                        {{ \$${routePrefix}->$field }}\n                    @endif\n                </dd>\n            </div>\n";
            } else {
                if ($modelName === 'Image' && $field === 'path') {
                    $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-semibold text-slate-800\">\n                    @if(\$${routePrefix}->$field)\n                        <div class=\"mt-2\">\n                            <img src=\"{{ asset('storage/' . \$${routePrefix}->$field) }}\" class=\"max-w-xs h-auto object-cover rounded-2xl border border-slate-100 shadow-md\">\n                        </div>\n                    @else\n                        <span class=\"text-slate-400\">Sin Imagen</span>\n                    @endif\n                </dd>\n            </div>\n";
                } else {
                    $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">$label</dt>\n                <dd class=\"text-sm font-medium text-slate-800\">{{ \$${routePrefix}->$field }}</dd>\n            </div>\n";
                }
            }
        }
    }

    if ($config['timestamps']) {
        $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">Creado</dt>\n                <dd class=\"text-sm font-medium text-slate-600\">{{ \$${routePrefix}->created_at ? \$${routePrefix}->created_at->format('d/m/Y H:i') : 'N/A' }}</dd>\n            </div>\n";
        $html .= "            <div class=\"border-b border-slate-50 pb-4\">\n                <dt class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">Última Actualización</dt>\n                <dd class=\"text-sm font-medium text-slate-600\">{{ \$${routePrefix}->updated_at ? \$${routePrefix}->updated_at->format('d/m/Y H:i') : 'N/A' }}</dd>\n            </div>\n";
    }

    $html .= "        </dl>\n    </div>\n";
    $html .= "</div>\n@endsection\n";

    return $html;
}

foreach ($models as $modelName => $config) {
    $routePrefix = strtolower(str_replace('_', '-', $modelName));
    $dir = __DIR__ . "/resources/views/administrador/$routePrefix" . "s";
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    file_put_contents("$dir/index.blade.php", generateIndexView($modelName, $config));
    file_put_contents("$dir/create.blade.php", generateCreateView($modelName, $config));
    file_put_contents("$dir/edit.blade.php", generateEditView($modelName, $config));
    file_put_contents("$dir/show.blade.php", generateShowView($modelName, $config));

    echo "Generated premium views for $modelName\n";
}

echo "All admin views generated successfully!\n";
?>