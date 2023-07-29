<?php

use App\Models\Voyager\Post;
use App\Models\Voyager\Setting;
use App\Models\Voyager\UsefullLink;

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

function imageName($filename, $imageType = '', $size = '100x100', $text = 'Image not found.')
{
    if (!$filename) {
        return 'https://dummyimage.com/' . $size . '&text=' . $text;
    }
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

function getDaysDiffByTwoDate($date1, $date2)
{
    // Create DateTime objects for today and the given date
    $fromDate = new DateTime($date1);
    $toDate = new DateTime($date2);

    // Calculate the difference between the two dates
    $interval = $fromDate->diff($toDate);

    // Get the number of days from the difference
    $days = $interval->days;

    if ($days <= 0) return '0';

    return $days;
}



function giveImageName($imageName, $imagegenerateType)
{
    return  str_replace('.', '-' . $imagegenerateType . '.', $imageName);
}


function numberPriceFormat($input)
{
    $formatted = number_format($input);
    $formatted = 'Rs.' . $formatted;
    return $formatted;
}


function priceToNprFormat($string)
{
    try {
        $string = strrev($string);
        $length = strlen($string);
        $newCharacter = '';
        for ($i = 0; $i < $length; $i++) {
            $character = $string[$i];
            if ($i == 3) {
                $newCharacter = $newCharacter . ',' . $character;
            } else if ($i == 5) {
                $newCharacter = $newCharacter . ',' . $character;
            } else if ($i == 7) {
                $newCharacter = $newCharacter . ',' . $character;
            } else if ($i == 9) {
                $newCharacter = $newCharacter . ',' . $character;
            } else {
                $newCharacter = $newCharacter . $character;
            }
        }
        return 'Rs.' . strrev($newCharacter);
    } catch (Throwable $th) {
        return 0;
    }
}


function replaceSpacesWithDash($inputString)
{
    $result = preg_replace('/\s+/', '-', $inputString);
    return $result;
}

function generateUniqueID()
{
    // Get the current timestamp with microseconds for finer granularity
    $timestamp = microtime(true);

    // Convert the timestamp to a string without decimal point
    $timestampString = str_replace('.', '', (string)$timestamp);

    // Generate a random component (you can use other methods to generate random strings)
    $randomComponent = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);

    // Concatenate the timestamp and random component to form the unique ID
    $uniqueID = $timestampString . $randomComponent;

    return $uniqueID;
}

function getSiteDetails($siteType = 'Site')
{
    $siteDetails = Setting::where('group', $siteType)->get();
    $siteArray = [];
    foreach ($siteDetails as $key => $datumSiteDetails) {
        $siteArray[$datumSiteDetails->key] = $datumSiteDetails->value;
    }
    return $siteArray;
}

function getPostsBlogs($limit = '5')
{
    $posts = Post::where('status', 'published')->orderby('created_at', 'desc')->limit($limit)->get();
    return $posts;
}


function usefullLinks($limit='5')
{
    $usefulLinks = UsefullLink::orderby('created_at', 'desc')->limit($limit)->get();
    return $usefulLinks;
}
