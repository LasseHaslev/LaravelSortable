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
    protected $object;


    /**
     * Setup for all tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->object = factory( TestObject::class )->create();
    }


    /** @test */
    public function can_setup_model_for_testing() {
        $this->assertInstanceOf( TestObject::class, $this->object );
        $this->assertEquals( 1, $this->object->id );
    }
}
