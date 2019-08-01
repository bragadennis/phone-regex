<?php

namespace App\Models;

use App\Enums\CountryList;
use App\Enums\CountryNumberRegex;
use Illuminate\Support\Facades\DB;
use App\Enums\CountryPrefix;

class Customer extends BaseModel
{
    protected $table = 'customer';

    ####
    #   Scope Definition Area
    ####

    /**
     * Simple query based on country's code.
     *
     * @param string $country_code
     * @return Scope
     */
    public function scopeByCountry($query, string $country_code)
    {
        return $query->where('phone', 'LIKE', "($country_code)%");
    }

    /**
     * Since unable to perform the query directly in regex, retrieves all results
     *      at scope at the time, iterate over them and compare them with a the 
     *      proposed country's number validation regex. The status tells if the 
     *      included in listed should be the one that match or didn't match.
     *
     * @param string $status
     * @return Scope
     */
    public function scopeByStatus($query, string $status)
    {
        $prev_list = $query->get();
        $status = $status == 'true' ? true : false; 
        $list = [];

        foreach( $prev_list as $item ) 
        {
            $country_code = substr($item->phone, 1, 3);
            $country = CountryPrefix::getInstance($country_code);
            $regex = CountryNumberRegex::getValue($country->key);

            if( preg_match($regex, $item->phone) == $status )
                $list[] = $item->id;
        }
         
        return $query->whereIn('id', $list);
    }


    ####
    #   Static Methods Area
    ####
    
    /**
     * List all the customer that meets the passed criterias, or all if none criteria passed.
     *
     * @param CountryList $country
     * @param string $status
     * @return Customer
     */
    public static function list(CountryList $country = null , string $status = null  )
    {
        $query = new self;
        if( $country )
            $query = $query->byCountry( CountryPrefix::getValue( strtoupper($country->value) ) );

        if( $status)
            $query = $query->byStatus($status);

        dd($query->get());
            
        return $query;
    }
}
