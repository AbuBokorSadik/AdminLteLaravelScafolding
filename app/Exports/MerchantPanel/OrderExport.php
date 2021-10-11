<?php

namespace App\Exports\MerchantPanel;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromArray, WithHeadings, WithStyles
{
    protected Collection $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function array(): array
    {
        $orders_info = [];
        $i = 0;
        foreach ($this->orders as $order) {
            $orders_info[$i][] = $order->order_id;
            $orders_info[$i][] = $order->orderAssignment->assignedTo->name;
            $orders_info[$i][] = $order->contact_name;
            $orders_info[$i][] = $order->contact_email;
            $orders_info[$i][] = $order->contact_mobile;
            $orders_info[$i][] = $order->address;
            $orders_info[$i][] = $order->orderType->type;
            $orders_info[$i][] = $order->orderAssignment->orderStatus->status;
            $orders_info[$i][] = $order->amount;
            $orders_info[$i][] = $order->collected_amount;
            $orders_info[$i][] = $order->deadline;
            $orders_info[$i][] = $order->created_at;
            $orders_info[$i][] = $order->updated_at;
            $i++;
        }
        // echo '<pre>';
        // print_r($this->orders->toArray());
        // exit();
        return $orders_info;
    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Seller',
            'Contact Name',
            'Contact Email',
            'Contact Mobile',
            'Contact Address',
            'Order Type',
            'Order Status',
            'Amount',
            'Collected Amount',
            'Deadline',
            'Created At',
            'Updated At'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }
}
