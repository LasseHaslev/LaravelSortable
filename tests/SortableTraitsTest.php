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
        $this->objectOne = factory( TestObject::class )->create();
    }


    /** @test */
    public function can_setup_model_for_testing() {
        $this->assertInstanceOf( TestObject::class, $this->objectOne );
        $this->assertEquals( 1, $this->objectOne->id );
    }

    /** @test */
    public function has_property_for_what_object_that_should_be_sorted() {
    }

    /** @test */
    public function user_can_change_name_of_column_to_order() {
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

        // $this->objectTwo->moveTo( 0 );
        // $this->assertEquals( -1, $this->objectTwo->orderDifference() );

        // $this->objectTwo->moveTo( 1 );
        // $this->assertEquals( 0, $this->objectTwo->orderDifference() );

        // $this->objectTwo->moveTo( 2 );
        // $this->assertEquals( 1, $this->objectTwo->orderDifference() );

    }

    /** @test */
    public function can_check_if_the_order_has_diverged_from_original() {

        // $this->assertNotTrue( $this->objectTwo->orderDiverged() );

        // $this->objectTwo->moveTo( 0 );
        // $this->assertTrue( $this->objectTwo->orderDiverged() );

    }

    /** @test */
    public function can_move_to_position() {

        // $this->objectOne->moveTo( 2 )
            // ->save();

        // $this->reloadModels();

        // // Check
        // $this->assertEquals( 2, $this->objectOne->order );
        // $this->assertEquals( 0, $this->objectTwo->order );
        // $this->assertEquals( 1, $this->objectThree->order );
        // $this->assertEquals( 3, $this->objectFour->order );

        // $this->objectOne->moveTo( 1 )
            // ->save();
        // $this->reloadModels();

        // // Check
        // $this->assertEquals( 1, $this->objectOne->order );
        // $this->assertEquals( 0, $this->objectTwo->order );
        // $this->assertEquals( 2, $this->objectThree->order );
        // $this->assertEquals( 3, $this->objectFour->order );

    }

    /** @test */
    public function can_increase_positon_by_one() {
        // $this->objectOne->moveUp()
            // ->save();
        // $this->reloadModels();

        // // Check
        // $this->assertEquals( 1, $this->objectOne->order );
        // $this->assertEquals( 0, $this->objectTwo->order );
        // $this->assertEquals( 2, $this->objectThree->order );
        // $this->assertEquals( 3, $this->objectFour->order );
    }

    /** @test */
    public function can_decrease_positon_by_one() {
        // $this->objectTwo->moveDown()
            // ->save();

        // $this->reloadModels();

        // // Check
        // $this->assertEquals( 1, $this->objectOne->order );
        // $this->assertEquals( 0, $this->objectTwo->order );
        // $this->assertEquals( 2, $this->objectThree->order );
        // $this->assertEquals( 3, $this->objectFour->order );
    }

    /** @test */
    public function order_cannot_go_below_zero() {
        // $this->objectOne->moveDown()
            // ->save();

        // $this->reloadModels();
        // $this->assertEquals( 0, $this->objectOne->order );

        // $this->objectTwo->moveTo(-1)
            // ->save();

        // $this->reloadModels();
        // $this->assertEquals( 0, $this->objectTwo->order );
    }

    /** @test */
    public function order_cannot_go_above_max_numbers() {
        // $this->objectFour->moveUp()
            // ->save();

        // $this->reloadModels();
        // $this->assertEquals( 3, $this->objectFour->order );

        // $this->objectTwo->moveTo(10)
            // ->save();

        // $this->reloadModels();
        // $this->assertEquals( 0, $this->objectOne->order );
        // $this->assertEquals( 3, $this->objectTwo->order );
        // $this->assertEquals( 1, $this->objectThree->order );
        // $this->assertEquals( 2, $this->objectFour->order );
    }

    protected function reloadModels() {
        $this->objectOne = $this->objectOne->fresh();
        $this->objectTwo = $this->objectTwo->fresh();
        $this->objectThree = $this->objectThree->fresh();
        $this->objectFour = $this->objectFour->fresh();
        $this->objectFive = $this->objectFive->fresh();
    }

}
