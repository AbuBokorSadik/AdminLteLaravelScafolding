<?php

namespace App\Exports\AdminPanel;

use Maatwebsite\Excel\Concerns\FromArray;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MerchantUserExport implements FromArray, WithHeadings, WithStyles
{
    protected $merchants;

    public function __construct($merchants)
    {
        $this->merchants = $merchants;
    }

    public function array(): array
    {
        $merchants_info = [];
        $i = 0;
        foreach ($this->merchants as $merchant) {
            $merchants_info[$i][] = $merchant->name;
            $merchants_info[$i][] = $merchant->mobile;
            $merchants_info[$i][] = $merchant->address;
            $merchants_info[$i][] = $merchant->status ? 'Active' : 'Inactive';
            $merchants_info[$i][] = $merchant->created_at;
            $merchants_info[$i][] = $merchant->updated_at;
            $i++;
        }
        // echo '<pre>';
        // print_r($merchants_info);
        // exit();
        return $merchants_info;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Mobile',
            'Address',
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
