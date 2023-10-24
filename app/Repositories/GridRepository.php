<?php

namespace App\Repositories;

use App\Interfaces\GridInterface;
use Illuminate\Support\Collection;
use App\Models\Grid;

class GridRepository implements GridInterface
{
    protected Grid $grid;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    public function getGridsByClientId($clientId): Collection
    {
        return Grid::where('client_id', $clientId)->get();
    }
}
