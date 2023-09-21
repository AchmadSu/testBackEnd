<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Books;
use App\Models\Loans;
use App\Models\Member;
use App\Models\Returns;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function create(Request $request) {
        $errorMessage = '';
        $member_id = $request->member_id;
        $book_id = $request->book_id;
        $checkLoans = Loans::where('loaner_id', $member_id)->where('status', '0')->get();
        $countLoans = $checkLoans->count();

        if($countLoans > 1) {
            $errorMessage = "Data peminjaman melampaui batas!";
        }

        $checkBooks = Books::find($book_id);
        if($checkBooks->stock == 0) {
            $errorMessage = "Stok buku tidak tersedia!";
        }
        
        $checkMembers =
        Returns::
            where('loaner_id', $member_id)
            ->where('status', '1')
            ->get();
        $dateReturn = $checkMembers->pluck('date')->first();
        if($dateReturn) {
            $dateReturn = Carbon::createFromFormat('Y-m-d', $dateReturn)->addDays(3);
            if($dateReturn > Carbon::now()) {
                $errorMessage = "Member sedang terkena penalti!";
            }
        }

        if ($errorMessage != null) {
            return response($errorMessage, 403)->header('Content-Type', 'text/plain');
        }
        
        $date = date("d/m/Y");
        $inv = rand(1000, 9999);
        $strInv = "$inv";
        $code = "INV-".$date."-LOANS-".$strInv;
        $status = "0";
        $due_date = Carbon::now()->addDays(7);
        
        $loanArray = array(
            "code" => $code,
            "loaner_id" => $member_id,
            "book_id" => $book_id,
            "status" => $status,
            "date" => Carbon::now(),
            "due_date" => $due_date,
        );
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Loans::create($loanArray);
        $books = Books::find($book_id);
        $books->stock = ($books->stock)-1;
        $books->save();
        return response('Buku berhasil dipinjam', 200)->header('Content-Type', 'text/plain');
    }
}
