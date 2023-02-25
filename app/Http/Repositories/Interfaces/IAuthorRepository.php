<?php

namespace App\Http\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface IAuthorRepository
{
    public function getAll(): Collection;
    public function getTopAuthorsThatWroteTheMostInTheLastWeek(int $limit): Collection;
}
