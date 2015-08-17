<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class InventoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
            $item = "POGs";
            $test_inventory = new Inventory($item);

            $test_inventory->save();

            $result = Inventory::getAll();

            $this->assertEquals($test_inventory, $result[0]);
        }

        function test_getAll()
        {
            $item = "POGs";
            $item2 = "Pokemon Cards";
            $test_item = new Inventory($item);
            $test_item->save();
            $test_item2 = new Inventory($item2);
            $test_item2->save();

            $result = Inventory::getAll();

            $this->assertEquals([$test_item, $test_item2], $result);
        }

        function test_deleteAll()
        {
            $item = "POGs";
            $item2 = "Pokemon Cards";
            $test_item = new Inventory($item);
            $test_item->save();
            $test_item2 = new Inventory($item2);
            $test_item2->save();

            Inventory::deleteAll();

            $result = Inventory::getAll();
            $this->assertEquals([], $result);
        }
    }

 ?>
