<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::orderByDesc('updated_at')->get();
        return view('faq.index', ['faqs' => $faqs]);

    }


    public function create()
    {
        return view('faq.create');
    }


    public function store(Request $request)
    {
        try {
            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->active = $request->active;
            $faq->save();

            return redirect('/faq')->with('success', 'Faq created successfully.');
        } catch (\Exception $e) {
            return redirect('/faq/create')->with($e->getMessage());

        }
    }

    public function show(Faq $faq)
    {
        return view('faq.show', ['faq' => $faq]);

    }

    public function edit(Faq $faq)
    {
        return view('faq.edit', ['faq' => $faq]);
    }


    public function update(Request $request ,Faq $faq)
    {
        try {
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->active = $request->active;
            $faq->save();

            return redirect('/faq')->with('success', 'Faq updated successfully.');
        } catch (\Exception $e) {
            return redirect('/faq/edit', $faq->id)->with('error', $e->getMessage());
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete(); // Delete the faq from the database
            return redirect('faq')->with('error', 'Faq deleted successfully.');
        } catch (\Exception $e) {
            return redirect('faq')->with('warning', $e->getMessage());
        }
    }


    // API Start

    public function getFaq(Request $request)
    {
        $faqList = Faq::where('active',1)->get();
        return $this->returnSuccess('faq list', $faqList);
    }

    // API Ends

}
