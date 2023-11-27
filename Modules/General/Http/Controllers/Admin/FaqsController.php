<?php

namespace Modules\General\Http\Controllers\Admin;
use Modules\General\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\General\Http\Requests\FaqRequest;

use Spatie\Permission\Models\Role;
use Modules\General\Models\Faq;
use Modules\General\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FaqsController extends Controller
{
        use StorageHandle;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'faq_translations.faqs_question' => [request('question'), 'like'],
            'faqs_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Faq::join('faq_translations','faqs.faqs_id','faq_translations.faqs_id')
        ->groupBy('faqs.faqs_id')->sorted();
        

        $searchQuery = $this->searchIndex($query, $searchArray);
        $faqs = $searchQuery->paginate(env('PerPage'));

        return view('general::admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general::admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\FaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faq = Faq::create($request->all());
        return redirect()->route('admin.faqs.index')->with('status', __('general::lang.faqCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Admin  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('general::admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('general::admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Faq\Http\Requests\FaqRequest  $request
     * @param  \Modules\General\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
       
        $faq->update($request->all());
        
        return redirect()->route('admin.faqs.index')->with('status', __('general::lang.faqUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return back()->with('status', __('general::lang.faqDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $faq = Faq::find($id);
        if($faq){
            $faq->faqs_status = $status ;
            $faq->save();
        }
        return response(['msg' =>  __('general::lang.updatedDone')], 200);
    }
}
