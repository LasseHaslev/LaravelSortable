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

    /** @test */
    public function orderDifference( $position ) {
        return $position - $this->order;
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

    /**
     * Increment position by one
     *
     * @return QueryBuilder
     */
    public function scopeIncrementPosition( $query, $object )
    {
        $sortingColumnName = $object->getSortingColumnName();
        return $this->scopeMoveTo( $query, $object, $object->$sortingColumnName +1 );
    }

    /**
     * Decrement position by one
     *
     * @return QueryBuilder
     */
    public function scopeDecrementPosition( $query, $object )
    {
        $sortingColumnName = $object->getSortingColumnName();
        return $this->scopeMoveTo( $query, $object, $object->$sortingColumnName -1 );
    }


    /**
     * Move object to new position
     *
     *
     * @return void
     */
    public function scopeMoveTo( $query, $object, $position )
    {

        $position = $this->clampValue($query, $position);

        $sortingColumnName = $object->getSortingColumnName();
        if ($this->isIncreasingOrder( $object, $position )) {
            $this->incrementOthers($query, $sortingColumnName, $position, $object);
        }
        else {
            $this->decrementOthers($query, $sortingColumnName, $object, $position);
        }


        $object->$sortingColumnName = $position;
        $object->save();

        return $query;

        // $columnName = $this->getSortingColumnName();
        // $this->$columnName = $position;
        // $this->save();
    }

    protected function decrementOthers($query, $sortingColumnName, $object, $position)
    {
        $query->where( $sortingColumnName, '>', $object->order )
            ->where( $sortingColumnName, '<=', $position )
            ->decrement( $sortingColumnName );
        return array($query, $sortingColumnName, $object, $position);
    }

    protected function incrementOthers($query, $sortingColumnName, $position, $object)
    {
        $query->where( $sortingColumnName, '>=', $position )
            ->where( $sortingColumnName, '<', $object->order )
            ->increment( $sortingColumnName );
        return array($query, $sortingColumnName, $position, $object);
    }

    protected function isIncreasingOrder( $object, $position )
    {
        return $object->order > $position;
    }

    protected function clampValue($query, $position)
    {
        $max = $query->count() -1;
        if ( $position <= 0 ) {
            $position = 0;
        }
        else if ( $position >= $max ) {
            $position = $max;
        }
        return $position;
    }


}
