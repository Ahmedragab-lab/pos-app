<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index(Request $request)
    {
        $sections = Section::when($request->search , function($q) use($request){
             return $q->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('sections.index',compact('sections'));
    }


    public function create()
    {
        return view('sections.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:sections,name',
        ]);
        Section::create($request->all());
        session()->flash('Add', 'تم اضافة القسم بنجاح');
        return redirect('sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }


    public function edit(Section $section)
    {
    //    $section = Section::findorFail($id);
       return view('sections.edit',compact('section'));
    }


    public function update(Request $request, Section $section)
    {

        $request->validate([
            'name'=>'required|unique:sections,name',
        ]);
        // $section = Section::findorFail($id);
        $section->update($request->all());
        session()->flash('Add', 'تم تعديل القسم بنجاح');
        return redirect('sections');
    }


    public function destroy(Section $section)
    {
        $section->delete();
        session()->flash('Deleted', 'تم حذف المنتج بنجاح');
        return redirect('sections');
    }
}
