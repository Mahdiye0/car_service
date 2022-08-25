<?php

use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %Y')
{
    return Jalalian::forge($date)->format($format);
}

//===============

function deleteRecord($row, $rout)
{
    $result = DB::transaction(function () use ($row) {
        $row->delete();
        return true;
    });

    if ($result) {
        return redirect()->route($rout)->with('swal-success', 'رکورد مورد نظر با موفقیت حذف شد');
    } else {
        return redirect()->back()->with('swal-error', 'خطا در حذف رکورد');
    }
}
