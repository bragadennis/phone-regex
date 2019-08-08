<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\CountryList;
use App\Models\Customer;
use App\Enums\CountryPrefix;

class IndexController extends Controller
{
    /**
     * Dictates how many itens should be displayed in the page.
     *
     * @var integer
     */
    private $paginate = 5;

    /**
     * Displays the base view
     *
     * @return View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function refineList(Request $request)
    {
        if( $request->filled('country') )
            $country = CountryList::getInstance( $request->get('country') );
        
        if( $request->filled('status') )
            $status = $request->get('status');

        $customers = Customer::list( $country ?? null, $status ?? null )
                             ->paginate($this->paginate);

        foreach( $customers as $customer ){
            $customer->code    = $customer->code;
            $customer->country = $customer->country;
            $customer->status  = $customer->status;
            $customer->clean_phone = explode(' ', $customer->phone)[1];
        }

        return response(['customers' => $customers], 200);
    }

    public function listPrefixes()
    {
        $prefixes = [];

        foreach(CountryPrefix::toArray() as $country => $prefix)
            $prefixes[] = [
                'country' => ucwords(strtolower($country)),
                'value'   => strtolower($country),
                'key'     => $prefix
            ];

        return response(['countries' => $prefixes], 200);
    }
}
