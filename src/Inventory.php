<?php

    class Inventory
    {
        private $item;

        function __construct($item)
        {
            $this->item = $item;
        }

        function getItem()
        {
            return $this->item;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO list (item) VALUES ('{$this->getItem()}');");
        }

        static function getAll()
        {
            $returned_inventory = $GLOBALS['DB']->query("SELECT * FROM list;");
            $inventory = array();
            foreach($returned_inventory as $item) {
                $thing = $item['item'];
                $new_inventory = new Inventory($thing);
                array_push($inventory, $new_inventory);
            }
            return $inventory;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM list;");
        }

        static function find($search_item)
        {
            $found_item = NULL;
            $inventory = Inventory::getAll();
            foreach($inventory as $item){
                $item_name = $item->getItem();
                if($item_name == $search_item){
                    $found_item = $item;
                }
            }
            return $found_item;
        }

    }
 ?>
