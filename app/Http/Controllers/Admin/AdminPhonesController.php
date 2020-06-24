<?php

namespace App\Http\Controllers\Admin;

use App\Phone;
use App\Http\Requests\PhonesCreateRequest;
use App\Http\Requests\PhonesUpdateRequest;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Photo;

class AdminPhonesController extends AdminBaseController
{
    public function index()
    {
        $phones = Phone::with('category', 'nation', 'image')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.books.index', compact('phones'));
    }
    public function create()
    {
        return view('admin.books.create');
    }
    public function store(PhonesCreateRequest $request)
    {
        $input = $request->all();

        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $create_phones = Phone::create($input);
        return redirect('/admin/phones')
            ->with('success_message', 'Phone created successfully');

    }

    public function edit($id)
    {
        $phone = Phone::findOrFail($id);
        return view('admin.books.edit', compact('phone'));

    }
    public function update(PhonesUpdateRequest $request, $id)
    {
        $input = $request->all();

        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $phone = Phone::findOrFail($id);
        $phone->update($input);
        return redirect('/admin/phones')
            ->with('success_message', 'Phone updated successfully');

    }

    public function destroy($id)
    {
        $phone= Phone::findOrFail($id);
        $phone->delete();
        return redirect()->back()->with('alert_message', 'Phone move to trash');
    }

    public function restore($id)
    {
        $trash = Phone::onlyTrashed()->findOrFail($id);
        $trash->restore();
        return redirect()->back()
            ->with('success_message', 'Phone successfully restore from trash');
    }

    public function forceDelete($id)
    {
        $trash_phone = Phone::onlyTrashed()->findOrfail($id);
        if(!is_null($trash_phone->image_id))
        {
            unlink(public_path().'/assets/img/'.$trash_phone->image->file);
        }
        $trash_phone->image->delete();
        $trash_phone->forceDelete();
        return redirect()->back()
            ->with('alert_message', 'Phone deleted permanently');
    }

    public function trashPhones()
    {
        $phones = Phone::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('admin.books.trash-books', compact('phones'));
    }

    public function discountPhones()
    {
        $discount_phones = "All phones with discount";
        $phones = Phone::with('nation', 'category')
            ->orderBy('discount_rate', 'DESC')
            ->where('discount_rate', '>', 0)->get();

        return view('admin.books.index', compact('phones', 'discount_phones'));
    }


}
