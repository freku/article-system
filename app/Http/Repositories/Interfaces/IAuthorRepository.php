<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IAuthorRepository
{
    public function getTopAuthorsThatWroteTheMostInTheLastWeek(int $limit): Collection;
}
