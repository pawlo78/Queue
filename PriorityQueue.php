<?php

    Class PriorityQueue {

        private $_limit;      
        private $_queue = [];
        private $_flag = FALSE;        
        
        function __construct($limit = 20) {
            $this->_limit = $limit;           
        }
        
        //Add elements to Queue with or without priority
        public function AddToQueue($item, $priority = 0) {
            //If priority is out of range item will be added
            //to the end of the queue (priority = 0)
            if($priority >= count($this->_queue)) {
                $priority = 0;
            }
            //Validation of the priority
            $priority = $this->CheckPriority($priority, "AddToQueue");
            //without priority or (prioriy is 0 and flag FALSE) ADD item 
            //to the end of queue
            if(count($this->_queue) < $this->_limit) {
                //Flag TRUE and priority 0 - move to item in front of queue
                //only in Change Priority
                if(empty($this->_queue) || ($priority == 0 && $this->_flag == FALSE)) {
                    array_push($this->_queue, $item); 
                }   else {
                    //Add item when is priority
                    $this->AddPriorityItem($item, $priority);
                    $this->_flag = FALSE;
                }                
            } else {
                echo "Queue size exceeded - AddToQueue";
                exit;
            }
        }          
        
        //function to add item with priority
        private function AddPriorityItem($item, $priority) {            
            $tempArray = [];
            //check place to put on item
            foreach ($this->_queue as $key => $value) {
                if($key == $priority) {
                    //put on item
                    array_push($tempArray, $item);
                    //change key in others items
                    for ($i=$key; $i < count($this->_queue)  ; $i++) { 
                        array_push($tempArray, $this->_queue[$i]);
                    }
                break;                
                }
                array_push($tempArray, $value);
            }
            $this->_queue = $tempArray;
        }

        //function to change priority
        public function ChangePriority($priorityOld, $priorityNew) {
            $priorityOld = $this->CheckPriority($priorityOld, "ChangePriority");
            $priorityNew = $this->CheckPriority($priorityNew, "ChangePriority");
            //Flag TRUE cause add item in the start queue when priority is 0 
            if($priorityNew == 0) {
                $this->_flag = TRUE;                
            }
            if($priorityOld < count($this->_queue)) {
                //taking item with old priority
                $tempVar = $this->_queue[$priorityOld];
                //removing item with old priority
                array_splice($this->_queue, $priorityOld, 1);
                //adding item with new priority
                $this->AddToQueue($tempVar, $priorityNew);
            } else {
                echo "Error: Priority is out of range ChangePriority";
                exit;
            }
        }

        //function to remove item with or without priority
        public function RemFromQueue($priority = 0) {
            $priority = $this->CheckPriority($priority, "RemFromQueue"); 
            if(!$this->CheckEmpty()) {
                if($priority != 0) {
                    array_splice($this->_queue, $priority, 1);
                } else {
                    array_shift($this->_queue);
                }
            } else {
                echo "The queue is empty - item download error - RemFromQueue";           
                exit;
            }
        }

        //Get queue
        public function GetArrayQueue() : array {
            return $this->_queue;
        }

        //function of validation priority
        private function CheckPriority($priority, $function) {
            if($priority < 0 ) {
                echo "Priority aut of range: {$priority} ({$function})";
                exit;
            }
            if(!is_int($priority)) {
                echo "Priority is not of type integer: {$priority} ({$function})";
                exit;
            }            
            return $priority;
        }

        //Check empty queue
        private function CheckEmpty() : bool {
            if(empty($this->_queue)) {
                return TRUE;
            }
            return FALSE; 
        }
        
    }
    
?>