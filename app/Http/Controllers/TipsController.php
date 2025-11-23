<?php

namespace App\Http\Controllers;

use App\Models\InspectionTips;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    public function add_inspection_tips()
    {
        $tips = InspectionTips::all();
        return view('admin.add_inspection_tips', compact('tips'));
    }

    public function save_inspection_tips(Request $request)
    {
        $tips = new InspectionTips;
        $tips->title = $request->title;
        $tips->content = $request->content;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('thumbnails'), $filename);
            $tips->thumbnail = $filename;
        }

        $tips->save();
        return redirect()->route('manage_inspection_tips', compact('tips'))->with('success', 'Inspection tip added successfully.');
    }

    public function manage_inspection_tips()
    {
        $tips = InspectionTips::all();
        return view('admin.manage_inspection_tips', compact('tips'));
    }

    public function edit_inspection_tips($id)
    {
        $tip = InspectionTips::find($id);
        if (!$tip) {
            return redirect()->back()->with('error', 'Inspection tip not found.');
        }
        return view('admin.edit_inspection_tips', compact('tip'));
    }

    public function delete_inspection_tips($id)
    {
        $tip = InspectionTips::find($id);
        if ($tip) {
            $tip->delete();
            return redirect()->back()->with('success', 'Inspection tip deleted successfully.');
        }
        return redirect()->back()->with('error', 'Inspection tip not found.');
    }

    public function update_inspection_tips(Request $request, $id)
    {
        $tip = InspectionTips::find($id);
        if (!$tip) {
            return redirect()->back()->with('error', 'Inspection tip not found.');
        }

        $tip->title = $request->title;
        $tip->content = $request->content;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('thumbnails'), $filename);
            $tip->thumbnail = $filename;
        }

        $tip->save();
        return redirect()->back()->with('success', 'Inspection tip updated successfully.');
    }

    public function view_inspection_tips()
    {
        $tips = InspectionTips::all();
        return view('home.inspection_tips', compact('tips'));
    }

    public function inspection_tips_details($id)
    {
        $tip = InspectionTips::find($id);
        if (!$tip) {
            return redirect()->back()->with('error', 'Inspection tip not found.');
        }
        return view('home.inspection_tips_details', compact('tip'));
    }

}
