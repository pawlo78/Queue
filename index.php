<?php

include("PriorityQueue.php");

//Main program
$queue = new PriorityQueue();

//Adding item to the queue with priority
//The first element is the value the second element is the priority
for ($i=0; $i < 5; $i++) { 
    $queue->AddToQueue($i, 0);
}
$queue->AddToQueue(-1,3);
$queue->AddToQueue(33, 33);

//Adding item to the queue without priority (only value)
$queue->AddToQueue(44);
$queue->AddToQueue(55);

//Changing priority item in queue
//The first element is the old priority, the second element is the new priority
$queue->ChangePriority(1,3);
$queue->ChangePriority(2,1);

//Removing item from queue without priority
$queue->RemFromQueue();
$queue->RemFromQueue();

//Removing item from queue with priority
$queue->RemFromQueue(3);
$queue->RemFromQueue(8);

//Getting Array
$array = $queue->GetArrayQueue();

//Showing array
foreach ($array as $key => $value) {
    echo "{$key} : {$value}<BR>";
}

?>