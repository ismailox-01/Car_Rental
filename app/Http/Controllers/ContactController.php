<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a newly created contact inquiry in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'inquiry_type' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($validated);

        // Notify Admin (Update this email to your real admin email)
        Mail::to('admin@carrental.ma')->send(new ContactInquiry($contact));

        return response()->json([
            'message' => 'Your inquiry has been stored successfully.'
        ]);
    }

    /**
     * Display a listing of messages for the admin.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Mark a message as read.
     */
    public function markAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read.');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message deleted successfully.');
    }
}
