<?php

namespace App\Exports\AdminPanel;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromArray, WithHeadings, WithStyles
{
    protected Collection $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function array(): array
    {
        $products_info = [];
        $i = 0;
        foreach ($this->products as $product) {
            $products_info[$i][] = $product->name;
            $products_info[$i][] = $product->category->name;
            $products_info[$i][] = $product->description;
            $products_info[$i][] = $product->unit_price;
            $products_info[$i][] = $product->height;
            $products_info[$i][] = $product->width;
            $products_info[$i][] = $product->weight;
            $products_info[$i][] = $product->size;
            $products_info[$i][] = $product->status ? 'Active' : 'Inactive';
            $products_info[$i][] = $product->created_at;
            $products_info[$i][] = $product->updated_at;
            $i++;
        }
        // echo '<pre>';
        // print_r($this->products->toArray());
        // exit();
        return $products_info;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Description',
            'Unite Price',
            'Height',
            'Width',
            'Weight',
            'Size',
            'Status',
            'Created At',
            'Updated At'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }
}
