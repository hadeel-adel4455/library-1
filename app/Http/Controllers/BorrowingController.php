<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Borrowing;

class BorrowingController extends Controller
{
    // Display customer's borrowings
    public function borrowings()
    {
        $borrowings = auth()->user()->borrowings;

        return response()->json($borrowings);
    }

    // Borrow a book
    public function borrow(Request $request)
    {
        $data = $request->validate([
            "book_id" => "required|exists:books,id",
            "borrowing_date" => ["required", "date", "after_or_equal:today"],
            "return_date" => ["required", "date", "after:borrowing_date"],
        ]);

        // Check if the book is already borrowed during this period
        $existingBorrowing = DB::table('borrowings')
            ->where('book_id', $data['book_id'])
            ->where('is_returned', false)
            ->where('borrowing_date', '<=', $data['return_date'])
            ->where('return_date', '>=', $data['borrowing_date'])
            ->exists();

        if ($existingBorrowing) {
            return response()->json([
                'message' => 'This book is already borrowed during this period'
            ], 422);
        }

        // Check maximum 3 active borrowings
        $activeBorrowings = auth()->user()->borrowings()
            ->wherePivot('is_returned', false)
            ->count();

        if ($activeBorrowings >= 3) {
            return response()->json([
                'message' => 'You cannot borrow more than 3 books at a time'
            ], 422);
        }

        auth()->user()->borrowings()->attach(
            $data['book_id'],
            [
                'borrowing_date' => $data['borrowing_date'],
                'return_date' => $data['return_date'],
                'is_returned' => false
            ]
        );

        return response()->json([
            'message' => 'borrowings created successfully'
        ]);
    }

    // Delete a borrowing
    public function delete($id)
    {
        auth()->user()->borrowings()->detach($id);

        return response()->json([
            'message' => 'removed'
        ]);
    }

    // Mark a book as returned
    public function markAsReturned(Request $request)
    {
        $request->validate([
            "customer_id" => ["required", "exists:customers,id"],
            "book_id" => ["required", "exists:books,id"]
        ]);

        $customer = Customer::find($request->customer_id);

        $borrowing = $customer->borrowings()
            ->wherePivot("book_id", $request->book_id)
            ->wherePivot("is_returned", false)
            ->first();

        if (!$borrowing) {
            return response()->json([
                "message" => "This customer has no open borrowing for this book"
            ], 404);
        }

        $customer->borrowings()
            ->wherePivot("is_returned", false)
            ->updateExistingPivot($request->book_id, [
                "is_returned" => true,
            ]);

        return response()->json([
            "message" => "Book marked as returned",
            "customer_id" => $customer->id,
            "book_id" => $borrowing->id,
            "borrowing_date" => $borrowing->pivot->borrowing_date,
        ]);
    }

    // Display all borrowings for staff
    public function all(Request $request)
    {
        $borrowings = Borrowing::with(['customer', 'book']);

        if ($request->has('is_returned')) {
            $borrowings->where('is_returned', $request->is_returned);
        }

        return response()->json($borrowings->get());
    }

    // Display overdue borrowings
    public function overdue()
    {
        $borrowings = Borrowing::with(['customer', 'book'])
            ->where('is_returned', false)
            ->whereDate('return_date', '<', today())
            ->get();

        return response()->json($borrowings);
    }
}
