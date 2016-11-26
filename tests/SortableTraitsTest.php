<?php

/**
 * Class SortableTraitsTest
 * @author Lasse S. Haslev
 */
class SortableTraitsTest extends TestCase
{
    /**
     * @var mixed
     */
    protected $objectOne;
    protected $objectTwo;
    protected $objectThree;
    protected $objectFour;
    protected $objectFive;


    /**
     * Setup for all tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->objectOne = factory( TestObject::class )->create( [ 'order'=>0 ] );
        $this->objectTwo = factory( TestObject::class )->create([ 'order'=>1 ]);
        $this->objectThree = factory( TestObject::class )->create([ 'order'=>2 ]);
        $this->objectFour = factory( TestObject::class )->create([ 'order'=>3 ]);
        $this->objectFive = factory( TestObject::class )->create([ 'order'=>4 ]);
    }


    /** @test */
    public function can_setup_model_for_testing() {
        $this->assertInstanceOf( TestObject::class, $this->objectOne );
        $this->assertEquals( 1, $this->objectOne->id );
    }

    /** @test */
    public function has_property_for_what_object_that_should_be_sorted() {
        $this->assertEquals( 'order', $this->objectOne->getSortingColumnName() );
    }

    /** @test */
    public function user_can_change_name_of_column_to_order() {
        $otherSortingColumnNameObject = CustomSortingColumnNameClass::create();
        $this->assertEquals( 'position', $otherSortingColumnNameObject->getSortingColumnName() );
    }

    /** @test */
    public function can_get_collection_of_objects_sorted_by_sorting_column_name() {
        $isSorted = true;
        $lastOrder = 0;
        $objects = TestObject::sorted()->get()->each( function ($model) use ( &$isSorted, &$lastOrder )
        {

            if ($model->order < $lastOrder) {
                $isSorted = false;
                return false;
            }

            $lastOrder = $model->order;

        } );
        $this->assertEquals( true, $isSorted, 'The sorted scope without parameters does not sort to increasing order' );
    }

    /** @test */
    public function can_get_collection_of_objects_sorted_backwards_by_adding_what_sorting_type() {
        $isSorted = true;
        $lastOrder = 10;
        $objects = TestObject::sorted( 'DESC' )->get()->each( function ($model) use ( &$isSorted, &$lastOrder )
        {

            if ($model->order > $lastOrder) {
                $isSorted = false;
                return false;
            }

            $lastOrder = $model->order;

        } );
        $this->assertEquals( true, $isSorted, 'The sorted scope without parameters does not sort to decreasing order' );
    }

    /** @test */
    public function is_setting_order_when_creating_new_object_object() {
        // $this->assertEquals( 0, $this->objectOne->order );
        // $this->assertEquals( 1, $this->objectTwo->order );
        // $this->assertEquals( 2, $this->objectThree->order );
        // $this->assertEquals( 3, $this->objectFour->order );
    }

    /** @test */
    public function can_get_order_diferenceial() {

        $this->objectTwo->order = 1;
        $this->objectTwo->save();

        $this->assertEquals( -1, $this->objectTwo->orderDifference( 0 ) );

        $this->assertEquals( 0, $this->objectTwo->orderDifference( 1 ) );

        $this->assertEquals( 1, $this->objectTwo->orderDifference( 2 ) );

    }

    /** @test */
    public function can_move_to_position() {
        $moveToPosition = 0;
        TestObject::moveTo( $this->objectTwo, $moveToPosition );
        $this->assertEquals( $moveToPosition, $this->objectTwo->order );
    }

    /** @test */
    public function is_changing_all_other_in_between_position_when_decreasing() {
        $moveToPosition = 0;
        TestObject::moveTo( $this->objectThree, $moveToPosition );

        $this->reloadModels();

        $this->assertEquals( 1, $this->objectOne->order );
        $this->assertEquals( 2, $this->objectTwo->order );
        $this->assertEquals( 0, $this->objectThree->order );
        $this->assertEquals( 3, $this->objectFour->order );
        $this->assertEquals( 4, $this->objectFive->order );
    }

    /** @test */
    // public function is_changing_all_other_in_between_position_when_increasing() {
        // $moveToPosition = 3;
        // TestObject::moveTo( $this->objectThree, $moveToPosition );

        // $this->reloadModels();

        // $this->assertEquals( 0, $this->objectOne->order );
        // $this->assertEquals( 1, $this->objectTwo->order );
        // $this->assertEquals( 3, $this->objectThree->order );
        // $this->assertEquals( 2, $this->objectFour->order );
        // $this->assertEquals( 4, $this->objectFive->order );
    // }

    /** @test */
    public function can_increase_positon_by_one() {
    }

    /** @test */
    public function can_decrease_positon_by_one() {
    }

    /** @test */
    public function order_cannot_go_below_zero() {
    }

    /** @test */
    public function order_cannot_go_above_max_numbers() {
    }

    protected function reloadModels() {
        $this->objectOne = $this->objectOne->fresh();
        $this->objectTwo = $this->objectTwo->fresh();
        $this->objectThree = $this->objectThree->fresh();
        $this->objectFour = $this->objectFour->fresh();
        $this->objectFive = $this->objectFive->fresh();
    }

}
