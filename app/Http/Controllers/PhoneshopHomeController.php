<?php

namespace App\Http\Controllers;
use App\Nation;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Phone;
use App\Category;
use Illuminate\Http\Request;

class PhoneshopHomeController extends Controller
{
    public function index()
    {
        # Home page Phones
        $iphones = Phone::with('category')->whereHas('category', function($query) {
            $query->where('slug', 'engineering'); })
            ->take(8)
            ->latestFirst()
            ->get();
        $samsungs = Phone::with('category', 'nation', 'image')
            ->whereHas('category', function ($query){
                $query->where('slug', 'literature'); })
            ->take(4)
            ->latestFirst()
            ->get();
        $discount_phones = Phone::with('category')
            ->where('discount_rate', '>', 0)
            ->orderBy('discount_rate', 'desc')
            ->take(6)
            ->get();
        return view('public.home', compact('iphones', 'discount_phones', 'samsungs'));
    }
    public function allPhones()
    {
        # ComposerServiceProvider load here
        $phones = Phone::with('nation', 'image', 'category')
                    ->orderBy('id', 'DESC')
                    ->search(request('term')) #...Search Query
                    ->paginate(16);
        return view('public.book-page', compact('phones'));
    }
    public function discountPhones()
    {
        # ComposerServiceProvider load here
        $discountTitle = "All discount phones";
        $phones = Phone::with('nation', 'image', 'category')
            ->orderBy('discount_rate', 'DESC')
            ->where('discount_rate', '>', 0)
            ->paginate(16);
        return view('public.book-page', compact('phones', 'discountTitle'));
    }
    /*
     * Phones filter by category
     */
    public function category(Category $category)
    {
        $categoryName = $category->name;
        $phones = $category->phones()
            ->with('category', 'nation', 'image')
            ->orderBy('id','DESC')
            ->paginate(16);
        return view('public.book-page', compact('phones', 'categoryName'));
    }
    /*
     * Phones filter by nation
     */
    public function nation(Nation $nation)
    {
        $nationName = $nation->name;
        $phones = $nation->phones()
            ->with('category', 'nation', 'image')
            ->orderBy('id', 'DESC')
            ->paginate(12);
        return view('public.book-page', compact('phones', 'nationName'));
    }

    public function phoneDetails($id)
    {
        $phone = Phone::findOrFail($id);
        $phone_reviews = $phone->reviews()->latest()->get();
        return view('public.book-details' , compact('phone', 'phone_reviews'));
    }
}
