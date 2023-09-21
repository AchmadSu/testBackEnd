<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Books;
use App\Models\Loans;
use App\Models\Returns;
use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    public function create(Request $request) {
        $message = '';
        $errorMessage = '';
        $member_id = $request->member_id;
        $loan_id = $request->loan_id;
        
        $checkLoans =
        Loans::find($loan_id);

        if($checkLoans->loaner_id != $member_id) {
            $errorMessage = "Data member tidak sesuai untuk peminjaman ini!";
        }

        $dueDate = Carbon::createFromFormat('Y-m-d', $checkLoans->due_date);
        $isLate = false;
        
        if($dueDate < Carbon::now()) {
            $isLate = true;
            $message = "Note: Anda terkena penalti!";
        }

        if ($errorMessage != null) {
            return response($errorMessage, 403)->header('Content-Type', 'text/plain');
        }
        
        $date = date("d/m/Y");
        $inv = rand(1000, 9999);
        $strInv = "$inv";
        $code = "INV-".$date."-RETURNS-".$strInv;
        $status = "0";
        $book_id = $checkLoans->book_id;
        
        if ($isLate) {
            $status = "1";
        }

        $returnArray = array(
            "code" => $code,
            "loaner_id" => $member_id,
            "book_id" => $book_id,
            "status" => $status,
            "date" => Carbon::now()
        );
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Returns::create($returnArray);
        $checkLoans->status = "1";
        $checkLoans->save();
        $books = Books::find($book_id);
        $books->stock = ($books->stock)+1;
        $books->save();
        return response('Buku berhasil dikembalikan. '.$message, 200)->header('Content-Type', 'text/plain');
    }
}
