<?php

declare(strict_types=1);

namespace Modules\Auth\Actions;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Auth\Models\User;
use Modules\Common\DTOs\DatatableDTO;
use Modules\Common\Support\Datatable;

final readonly class FetchUsersList
{
    public function handle(DatatableDTO $dto): LengthAwarePaginator|Collection
    {
        $query = User::query();
        $query = Datatable::applyFilter($query, $dto, ['email', 'name']);
        $query = Datatable::applySort($query, $dto);

        return Datatable::applyPagination($query, $dto);
    }
}