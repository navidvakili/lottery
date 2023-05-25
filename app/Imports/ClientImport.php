<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientImport implements ToCollection, WithChunkReading, WithStartRow
{
    use RemembersChunkOffset;
    private $group_id;

    public function __construct(string $group_id)
    {
        $this->group_id = $group_id;
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
            $name =  $column[1]??'';

            $user = Client::where('nationalcode', $national_code)
            ->where('group_id', $this->group_id)->first();

            if ($user === null) {
                $user = new Client();
                $user->group_id = $this->group_id;
                $user->name = $name;
                $user->nationalcode = intval($national_code);
                $user->save();
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
