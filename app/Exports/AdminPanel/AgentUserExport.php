<?php

namespace App\Exports\AdminPanel;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AgentUserExport implements FromArray, WithHeadings, WithStyles
{
    protected $agents;

    public function __construct($agents)
    {
        $this->agents = $agents;
    }

    public function array(): array
    {
        $agents_info = [];
        $i = 0;
        foreach ($this->agents as $agent) {
            $agents_info[$i][] = $agent->name;
            $agents_info[$i][] = $agent->mobile;
            $agents_info[$i][] = $agent->address;
            $agents_info[$i][] = $agent->status ? 'Active' : 'Inactive';
            $agents_info[$i][] = $agent->created_at;
            $agents_info[$i][] = $agent->updated_at;
            $i++;
        }
        // echo '<pre>';
        // print_r($agents_info);
        // exit();
        return $agents_info;
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
