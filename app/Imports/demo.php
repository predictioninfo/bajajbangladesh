<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ManufactureCountry;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductSize;
use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ImportProduct implements ToCollection, WithStartRow, WithHeadingRow
{

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        $warehouses = Warehouse::all();

        Validator::make($rows->toArray(), [
            '*.sku' => 'required',
            '*.name' => 'required',
            '*.product_type' => 'required',
            '*.cost_price' => 'required',
            '*.brand' => 'required',
            '*.category' => 'required',
        ])->validate();

        foreach ($rows as $row) {

            $brand = Brand::where('brand_name', 'like', '%' . $row[7] . '%')->first();
            $category = Category::where('name', 'like', '%' . $row[8] . '%')->first();

            if ($row[9]) {
                $product_size = ProductSize::where('name', 'like', '%' . $row[9] . '%')->first();
                $product_size_id = $product_size->id;
            } else {
                $product_size_id = null;
            }
            if ($row[10]) {
                $product_color = Category::where('name', 'like', '%' . $row[10] . '%')->first();
                $product_color_id = $product_color->id;
            } else {
                $product_color_id = null;
            }
            if ($row[11]) {
                $product_unit = Category::where('name', 'like', '%' . $row[11] . '%')->first();
                $product_unit_id = $product_unit->id;
            } else {
                $product_unit_id = 1;
            }
            if ($row[12]) {
                $manufacture_country = ManufactureCountry::where('name', 'like', '%' . $row[12] . '%')->first();
                $manufacture_country_id = $manufacture_country->id;
            } else {
                $manufacture_country_id = 1;
            }

            $slug = Str::slug($row[1]);

            if ($row[2] == 'Single') {
                $product_type = 1;
            } else {
                $product_type = 2;
            }

            if ($row[5] == 'No') {
                $top_selling = 0;
            } else {
                $top_selling = 1;
            }

            if ($row[6] == 'Single') {
                $group_display_type = 0;
            } else {
                $group_display_type = 1;
            }

            $product = Product::create([
                'sku' => $row[0],
                'name' => $row[1],
                'slug' => $slug,
                'product_type' => $product_type,
                'cost_price' => $row[3],
                'stock_aleart' => $row[4],

                'stock_avilability' => 1,
                'top_selling' => $top_selling,
                'group_display_type' => $group_display_type,
                'product_availability_id' => 1,
                'shipping_type' => 'flat rate',
                'flat_rate_value' => 0,

                'brand_id' => $brand->id,
                'product_size_id' => $product_size_id,
                'product_color_id' => $product_color_id,
                'product_unit_id' => $product_unit_id,
                'manufacture_country_id' => $manufacture_country_id,

                'product_created_date' => date('Y-m-d', strtotime($row[13])),
                'product_exp_date' => date('Y-m-d', strtotime($row[14])),

                'packaging' => $row[15],
                'mfr_part_number' => $row[16],

                'description' => $row[17],
                'short_description' => $row[18],
                'specifications' => $row[19],
                'warning' => $row[20],

                'meta_title' => $row[21],
                'meta_keyword' => $row[22],
                'meta_description' => $row[23],

                'visibility' => 'CatalogSearch',
                'hide_shop' => 0,
                'hide_pos' => 0,
                'publish' => 0,
                'status' => 0,

            ]);

            $product->categories()->attach($category->id);

            foreach ($warehouses as $item) {
                ProductPrice::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $item->id,
                    'price' => 0,
                    'offer_price' => 0,
                    'quantity' => 0,
                    'offer_start_date' => 0,
                    'offer_end_date' => 0,
                    'tier_price_one' => 0,
                    'tier_quantity_one' => 0,
                    'tier_price_two' => 0,
                    'tier_quantity_two' => 0,
                    'tier_price_three' => 0,
                    'tier_quantity_three' => 0,
                ]);
            }
        }
    }
}