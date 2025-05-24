<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Models\GenerateKode;
use Carbon\Carbon;

trait Tools
{
    protected function GENERATE_KODE($type, $length = 8, $prefix = '')
    {
        DB::beginTransaction();
        try {
            $result = GenerateKode::where('kode', 'LIKE', $prefix . '%')
                ->where('type', $type)
                ->max('kode');
            $prefixLen = strlen($prefix);
            $subPrefix = substr(trim($result), $prefixLen);
            $NK = $prefix . (str_pad((int)$subPrefix + 1, $length - $prefixLen, "0", STR_PAD_LEFT));

            $newSN = new GenerateKode();
            $newSN->kode = $NK;
            $newSN->type = $type;
            $newSN->save();

            $transStatus = 'true';
        } catch (\Exception $e) {
            $transStatus = 'false';
        }

        if ($transStatus == 'true') {
            DB::commit();
            return $NK;
        } else {
            DB::rollBack();
            return '';
        }

        return $this->setStatusCode($result['status'])->respond($result);
    }
}