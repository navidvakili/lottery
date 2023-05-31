<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\LotteryMember;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LotteryImport implements ToCollection, WithChunkReading, WithStartRow
{
    use RemembersChunkOffset;

    public function __construct(private int $group_id, private int $lottery_id, private string $title)
    {
        $this->group_id = $group_id;
        $this->lottery_id = $lottery_id;
        $this->title = $title;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $columns)
    {
        $chunkOffset = $this->getChunkOffset();

        foreach ($columns as $k => $column) {
            $national_code = $column[0];
            $name =  $column[1] ?? '';
            $mobile =  $column[2] ?? '';
            $vahed =  $column[3];

            $user = Client::where('nationalcode', $national_code)
                ->where('group_id', $this->group_id)->first();

            if ($user === null) {
                $user = new Client();
                $user->group_id = $this->group_id;
                $user->name = $name;
                $user->nationalcode = intval($national_code);
                $user->mobile = intval($mobile);
                $user->save();
            }

            $lottery = LotteryMember::where('lottery_id', $this->lottery_id)
                ->where('client_id', $user->id)
                ->first();

            if ($lottery == null) {
                LotteryMember::create(['lottery_id' => $this->lottery_id, 'client_id' => $user->id, 'vahed' => $vahed]);
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
