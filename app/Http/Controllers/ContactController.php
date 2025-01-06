<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::orderByDesc('updated_at')->get();
        $unreadCount = Contact::where('is_read', 0)->count();
        return view('contact.index', ['contacts' => $contacts] , ['unreadCount' => $unreadCount]);
    }


    public function show(Contact $contact)
    {
        return view('contact.show', ['contact' => $contact]);

    }

    public function edit(Contact $contact)
    {
        return view('contact.edit', ['contact' => $contact]);
    }


    public function update(Request $request ,Contact $contact)
    {
        try {
            $contact->is_read = $request->is_read;
            $contact->save();

            return redirect('/contact')->with('success', 'Contact updated successfully.');
        } catch (\Exception $e) {
            return redirect('/contact/edit', $contact->id)->with('error', $e->getMessage());
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete(); // Delete the contact from the database
            return redirect('contact')->with('error', 'Contact deleted successfully.');
        } catch (\Exception $e) {
            return redirect('contact')->with('warning', $e->getMessage());
        }
    }


    // API Start

    public function createContact(Request $request){
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email= $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->is_read = 0;
            $contact->save();
            return $this->returnSuccess('Contact created successfully.',$contact);
        }catch (\Exception $e){
            return $this->returnError($e->getMessage(), $e->getCode());
        }
    }

    // API Ends

}
