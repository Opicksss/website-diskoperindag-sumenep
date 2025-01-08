<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Contact::whereNotNull('send')->where('is_visible', true)->select('message', 'send')->latest()->limit(5)->get();
        return view('user.contact.index', compact('faqs'));
    }

    public function detail()
    {
        $faqs = Contact::whereNotNull('send')->where('is_visible', true)->select('message', 'send')->latest()->paginate(15); // Menampilkan 5 item per halaman
        return view('user.contact.detail', compact('faqs'));
    }

    public function admin(Request $request)
    {
        $search = $request->Search;
        $contacts = Contact::query()
            ->where(function ($query) use ($search) {
                $query
                    ->where('contacts.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.subject', 'LIKE', '%' . $search . '%')
                    ->orWhere('contacts.message', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('contacts.created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.contact.index', compact('contacts'));
    }

    public function toggleVisibility(Contact $contact)
    {
        try {
            $contact->is_visible = !$contact->is_visible;
            $contact->save();

            return redirect()->back()->with('success', 'Status Pesan berhasil diubah!');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat menyimpan
            return redirect()->back()->with('error', 'Gagal mengubah status pesan. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            Contact::create($validatedData);
            return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan Anda. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('admin.contact.detail', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);
        $replyMessage = $request->input('reply_message');
        try {
            Mail::to($contact->email)->send(new ContactReplyMail($contact, $replyMessage));

            $contact->send = $replyMessage;
            $contact->save();

            return redirect()->back()->with('contact.index')->with('success', 'Balasan berhasil dikirim.');
        } catch (Exception $e) {
            return redirect()->back()->with('contact.index')->with('error', 'Gagal mengirim balasan: ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            return redirect('/contactadmin')->with('success', 'Pesan Berhasil Dihapus!');
        } catch (\Exception $e) {
            return redirect('/contactadmin')->with('error', 'Terjadi kesalahan saat menghapus Pesan. Silakan coba lagi.');
        }
    }
}
