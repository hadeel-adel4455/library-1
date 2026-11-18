<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::all();

        return view('borrowings.index', compact('borrowings'));
    }

    public function apiIndex()
    {
        return response()->json(Borrowing::all());
    }
}