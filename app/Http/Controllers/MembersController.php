<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    public function index(){
        $members = Member::select('members.name', 'members.code')
        ->leftJoin('loans', 'loans.loaner_id', '=', 'members.id')
        ->groupBy('members.name', 'members.code')
        ->selectRaw('
            SUM(CASE
                WHEN loans.status = "0" THEN 1
                ELSE 0
            END) as numberOfBorrowedBooks
        ')
        ->get();
        return $members;
    }
}
