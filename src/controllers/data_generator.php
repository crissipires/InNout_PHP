<?php

Database::executeSQL('DELETE FROM working_hours');
// Database::executeSQL('DELETE FROM users WHERE id > 5');

echo isBefore(date('Y-m-1'), date('Y-m-2'));

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate) {
    $regularDayTemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '16:00:00',
        'worked_time' => DAILY_TIME
    ];

    $extraHourDaytemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '16:00:00',
        'worked_time' => DAILY_TIME + 3600
    ];

    $lazyDaytemplate = [
        'time1' => '08:00:00',
        'time2' => '12:00:00',
        'time3' => '13:00:00',
        'time4' => '16:00:00',
        'worked_time' => DAILY_TIME - 1800
    ];

    $value = rand(0,100);
    if($value <= $regularRate){
        return $regularDayTemplate;
    } elseif($value <= $regularRate + $extraRate) {
        return $extraHourDaytemplate;
    } else {
        return $lazyDaytemplate;
    }
}


function populateWorkingHours($userId, $initialDate, $regularDate, $extraRate, $lazyRate){
    $currentDate = $initialDate;
    $today = new DateTime();
    $columns =['user_id' => $userId, 'work_date' => $currentDate];

    while(isBefore($currentDate,$today)){
        if(!isWeekend($currentDate)){
            $template = getDayTemplateByOdds($regularDate, $extraRate, $lazyRate);
            $columns = array_merge($columns, $template);
            $workingHours = new WorkingHours($columns);
            $workingHours->insert();
        }
        $currentDate = getNextDay($currentDate)->format('Y-m-d');
        $columns['work_date'] = $currentDate;
    } 
}

populateWorkingHours(1,date('Y-m-1'),70,20,10);

