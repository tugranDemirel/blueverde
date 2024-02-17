<?php

namespace App\Imports\Product;

use App\Enum\Category\CategoryTypeEnum;
use App\Models\Category;
use App\Models\CategoryTag;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\SystemCurrency;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AddProductExcel implements ToCollection, WithStartRow
{

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach( $rows as $row) {
            $categoryName = $row[0];

            /** @var Category $category */
            $category = Category::query()
                ->where('name', 'like', '%'.$categoryName.'%')
                ->first();

            /** @var CategoryTag $tagId */
            $tagId = CategoryTag::query()->first()->id;

            if ($category) {
                $categoryId = $category->id;
            } else {

                /** @var Category $category */
                $categoryId = Category::query()
                    ->create([
                        'name' => $row[0],
                        'parent_id' => 0,
                        'slug' => Str::slug($row[0]),
                        'description' => null,
                        'image' => null,
                        'is_active' => true,
                        'is_feature' => 0,
                        'order' => 0,
                        'type' => CategoryTypeEnum::TR_CATEGORY,
                        'tag_id' => $tagId
                    ])->id;

            }

            $currency = $row[11];
            $currencyId = SystemCurrency::query()
                ->where('code', 'like', '%'.$currency.'%')
                ->first()
                ->id;

            $productTagId = ProductTag::query()->first()->id;


            $typeOne = $row[3] ?? '';
            $typeTwo = $row[2] ?? '';

            Product::query()->create([
                'category_id' => $categoryId,
                'product_tag_id' => $productTagId,
                'name' => $row[1] ?? '-',
                'slug' => Str::slug($row[1]),
                'code' => $row[8] ?? '-',
                'description' => $row[9] ?? '-',
                'price' => $row[10] ?? 1,
                'system_currency_id' => $currencyId,
                'image' => null,
                'type' => $typeOne.','.$typeTwo,
                'product_size' => $row[2],
                'material' => $row[5],
                'color' => $row[6],
                'detail' => $row[7],
            ]);
        }

    }


    public function startRow(): int
    {
        return 2;
    }
}
