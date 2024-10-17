<?php

namespace App\Imports;

use App\Models\PunchInOut;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\User;

class AttendanceImport implements ToModel, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $userData = User::where('emp_id', $row[0])->first();

        if($userData) {

            $punchInOut = new PunchInOut();

            $punchInOut->user_id = $userData->id;
            $punchInOut->date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]);
            $punchInOut->punch_in = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]);
            $punchInOut->punch_in_lat = '22.3188337';
            $punchInOut->punch_in_long = '73.1674962';
            $punchInOut->punch_out = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]);
            $punchInOut->punch_out_lat = '22.3188337';
            $punchInOut->punch_out_long = '73.1674962';
            $punchInOut->punch_in_out_status = 0;

            $punchInOut->save();
        }
    }

    /**
     * Chunk size for reading
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000; // process 1000 rows at a time
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
