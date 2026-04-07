<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        if (!$contact->is_read) {
            $contact->markAsRead();
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Mark contact as read
     */
    public function markAsRead(Contact $contact)
    {
        $contact->markAsRead();

        return redirect()->back()
            ->with('success', 'Contact marked as read.');
    }

    /**
     * Show unread contacts only
     */
    public function unread()
    {
        $contacts = Contact::unread()->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }
}
