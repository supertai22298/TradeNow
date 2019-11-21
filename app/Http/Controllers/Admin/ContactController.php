<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStarContactRequest;
use App\Http\Requests\MassDestroyContactRequest;
use App\Http\Requests\SendMailContactRequest;
use App\Jobs\SendMailJob;
use App\Models\Contact;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::latest()->paginate(7);
        return view('admins.contacts.inbox', compact('contacts'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function star()
    {
        //
        $contacts = Contact::where('is_star', 1)->latest()->paginate(7);
        return view('admins.contacts.star', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
      $contact->update([
        'read_at' => Carbon::now()->toDateString(),
      ]);
      return view('admins.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
      $contact->delete();
      return \redirect()->route('admin.contacts.index')->with('success', 'Xoá thành công');
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyContactRequest $request) {
      $contacts = Contact::whereIn('id', request('ids'))->delete();
      return back()->with('success', 'Xoá thành công');
  }

    public function changeStar(ChangeStarContactRequest $request)
    {
      $contact = Contact::findOrFail($request->value);
      $contact->is_star = $contact->is_star === 0 ? 1 : 0;
      $contact->save();
      $star = Contact::countStar();
      return response()->json([
          'success' => 'Thành công',
          'star' => $star
      ], 200, []);
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function compose() {
      $emails = Contact::getEmailAndName();
      return view('admins.contacts.compose', compact('emails'));
    }

      /**
     * Send mail
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(SendMailContactRequest $request) {
      $emails = $request->emails ? $request->emails: [];
      array_push($emails, $request->email);

      $emails = $request->is_multiple ? array_merge($emails, Contact::getAllEmail()) : $emails;

      $emails = array_unique($emails);

      $data = [
        'emails' => $emails,
        'subject' => $request->subject,
        'description' => $request->description,
      ];
      try {
        $this->dispatch(new SendMailJob($data));
      } catch (Exception $e) {
        return back()->with('exception', $e->getMessage());
      }
      return back()->with('success', 'Gửi mail thành công');
    }

    public function forward(Contact $contact) {
      $emails = Contact::getEmailAndName();
      return view('admins.contacts.forward', compact('contact', 'emails'));
    }
    public function reply(Contact $contact) {
      $emails = Contact::getEmailAndName();
      return view('admins.contacts.reply', compact('contact', 'emails'));
    }
}
