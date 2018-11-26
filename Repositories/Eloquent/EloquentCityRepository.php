<?php

namespace Modules\Ilocations\Repositories\Eloquent;

use Modules\Ilocations\Repositories\CityRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCityRepository extends EloquentBaseRepository implements CityRepository
{
  public function index($page, $take, $filter, $include, $fields)
  {
    
    //Initialize Query
    $query = $this->model->query();
    
    /*== FILTER ==*/
    if ($filter) {
      if(isset($filter->country_id))
        $query->where("country_id",$filter->country_id);
      if(isset($filter->province_id))
        $query->where("province_id",$filter->province_id);
    }
  
    /*== RELATIONSHIPS ==*/
      //Include relationships for default
      $includeDefault = [];
      $query->with(array_merge($includeDefault, $include));
    
    
    /*== FIELDS ==*/
      $defaultFields = ["id"];
      $query->select(array_merge($defaultFields, $fields));

    

    
    //Return request with pagination
    if ($page) {
      $take ? true : $take = 12; //If no specific take, query take 12 for default
      
      return $query->paginate($take);
    }
    
    //Return request without pagination
    if (!$page) {
      $take ? $query->take($take) : false; //if request to take a limit
      
      return $query->get()->sortBy('name');
      
    }
    
    
  }

  public  function whereByCountry($id){

      return $this->model->where('country_id',$id)->get();
  }
  
}
