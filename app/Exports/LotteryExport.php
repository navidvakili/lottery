<?php

namespace App\Exports;

use App\Models\LotteryMember;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LotteryExport implements FromArray, WithHeadings
{
    use Exportable;

    public function __construct(public int $id)
    {
        $this->id = $id;
    }

    public function array(): array
    {
        $output = [];
        $registred = LotteryMember::where('lottery_id', $this->id)
            ->orderBy('updated_at', 'desc')->get();

        foreach ($registred as $row) {
            $output[] = [
                trim($row->client->nationalcode),
                trim($row->client->name),
                trim($row->client->mobile),
                $row->vahed,
            ];
        }

        return $output;
    }

    public function headings(): array
    {
        return [
            "شماره ملی",
            "نام و نام خانوادگی",
            "شماره موبایل",
            "شماره واحد",
        ];
    }
}
