<?php

namespace LasseHaslev\LaravelSortable\Traits;

/**
 * Trait Sortable
 * @author Lasse S. Haslev
 */
trait Sortable
{

    protected $sortingColumnName = 'order';

    /**
     * Getter for sortingColumnName
     *
     * @return string
     */
    public function getSortingColumnName()
    {
        return $this->sortingColumnName;
    }

    /**
     * Sort object based on the sortingColumnName
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type = 'ASC')
    {
        return $query->orderBy( $this->sortingColumnName, $type );
    }

}
