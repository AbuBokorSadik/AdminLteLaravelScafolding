<?php

namespace App\Exports\AdminPanel;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryExport implements FromArray, WithHeadings, WithStyles
{
    protected $categories;

    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    public function array(): array
    {
        $categories_info = [];
        $i = 0;
        foreach ($this->categories as $category) {
            $categories_info[$i][] = $category->name;
            $categories_info[$i][] = $category->status ? 'Active' : 'Inactive';
            $categories_info[$i][] = $category->created_at;
            $categories_info[$i][] = $category->updated_at;
            $i++;
        }
        // echo '<pre>';
        // print_r($categories_info);
        // exit();
        return $categories_info;
    }

    public function headings(): array
    {
        return [
            'Name',
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
