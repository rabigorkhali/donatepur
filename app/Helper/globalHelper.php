<?php

function calculatePercentageMaxTo100($number, $total)
{
    if ($total != 0) {
        $percentage = ($number / $total) * 100;
        if ($percentage > 100) {
            return 100;
        }
        return $percentage;
    } else {
        return 0;
    }
}

function calculateActualPercentage($number, $total)
{
    if ($total != 0) {
        $percentage = ($number / $total) * 100;
        return $percentage;
    } else {
        return 0;
    }
}

function imageName($filename, $imageType)
{
    $extensionIndex = strrpos($filename, '.');
    $newFilename = substr_replace($filename, $imageType, $extensionIndex, 0);

    return $newFilename;
}

function getDaysDiffByToday($givenDate)
{
    // Create DateTime objects for today and the given date
    $today = new DateTime();
    $date = new DateTime($givenDate);

    // Calculate the difference between the two dates
    $interval = $today->diff($date);

    // Get the number of days from the difference
    $days = $interval->days;

    return $days;
}

function convertToNepaliFormat($number) {
 
    $formattedNumber = number_format($number);
    return $formattedNumber;
}

function giveImageName($imageName,$imagegenerateType)
{
    return  str_replace('.', '-'.$imagegenerateType.'.', $imageName);
}


