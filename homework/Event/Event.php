<?php

/* 
Object oriented Programming (OOP)
    -it is a way of programming, organizing your data structures.

Class - describes the content and structure of an object
    -used as a theme/template.blueprint for creating an object

Properties - pieces of information about the class, nouns

Methods - actions/activities that we can do on the data stored in the object, verb

Object - is container that holds data, it has properties and methods (tools) that work on the data
    -we can USE an object in our program. We can access/change/delete its contents, etc.

Instantiation - creating a new object based upon a Class. Keyword "new"

Constructor Method - DOES NOT MAKE A NEW OBJECT       DOES NOT!!      NO!!!   NO!!!   NO!!!!!
    it is called when a new object created and us used to define content on new object
    It is often the same name as the class      would expect Event() for this class

    (let today = new Date();     (JavaScript))
*/




    /**This class will define an event object based upon the data from the wdv341_events table
        -change history

     define properties the class will store

     define the constructor method

     define the setters/getters aka accessors/mutators methods
        setters/mutators - set an input into the property of the object.class
        getters/accessors - return the value of a property of an object/class
    
     define processing methods
    */ 
    //constructor method - PHP format
    
    class Event {
        
    function __construct() {
        //        will set default values to properties 
    }
            
        //setters and getters

        function set_events_date($inDate) {
            $this->events_date = $inDate;
        }

        function get_events_date() {
            return $this->events_date;
        }

                function set_events_description($inDesc) {
                    $this->events_description = $inDesc;
                }

                function get_events_description() {
                    return $this->events_description;
                }

                        function set_events_name($inName) {
                                $this->events_name = $inName;
                        }

                        function get_events_name() {
                                return $this->events_name;
                        }

                                function set_events_presenter($preSent) {
                                    $this->events_presenter = $preSent;
                                }

                                function get_events_presenter() {
                                    return $this->events_presenter;
                                }

                                        function set_events_time($inTime) {
                                            $this->events_time = $inTime;
                                        }

                                        function get_events_time() {
                                            return $this->events_time;
                                        }

        //processing method

        //function that will turn our PHP object into a JSON object and return it

        
} // end Events class

?>