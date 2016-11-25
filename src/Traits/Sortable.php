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
}
