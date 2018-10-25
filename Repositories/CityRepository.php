<?php

namespace Modules\Ilocations\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CityRepository extends BaseRepository
{
    public function whereByCountry($id);

    public function index($page, $take, $filter, $include, $fields);

}