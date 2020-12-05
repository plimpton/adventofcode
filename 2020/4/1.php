<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\r\n\r\n", $input);
$list = array_filter($list);

//print_r($list);

$passports = [];
foreach ($list as $key => $val) {
    $val = preg_replace("/\\s+/", ' ', $val);
    $unparsed = explode(' ', $val);
    $unparsed = array_filter($unparsed);

    $passport = [];
    foreach ($unparsed as $item) {
        $itemSplit = explode(':', $item);
        $passport[$itemSplit[0]] = $itemSplit[1];
    }
    $passports[] = $passport;
}

function isCid(string $val) {
    return ('cid' != $val) ? true : false;
}

//print_r($passports);
$numValid = 0;
$requiredKeys = [
    'byr',// (Birth Year) four digits; at least 1920 and at most 2002.
    'iyr',// (Issue Year) four digits; at least 2010 and at most 2020.
    'eyr',// (Expiration Year) four digits; at least 2020 and at most 2030.
    'hgt',// (Height) a number followed by either cm or in:
          //      If cm, the number must be at least 150 and at most 193.
          //      If in, the number must be at least 59 and at most 76.
    'hcl',// (Hair Color) a # followed by exactly six characters 0-9 or a-f.
    'ecl',// (Eye Color) exactly one of: amb blu brn gry grn hzl oth.
    'pid',// (Passport ID) a nine-digit number, including leading zeroes.
    //'cid',// (Country ID)
];
sort($requiredKeys);
foreach ($passports as $passport) {
    $keys = array_keys($passport);
    sort($keys);
    $keys = array_filter($keys, 'isCid');
    $keys = array_values($keys);//reset keys

    print_r($passport);
    //print_r($foundKeys);
    if ($keys == $requiredKeys) {
        //four digits; at least 1920 and at most 2002.
        if ($passport['byr'] < 1920 || $passport['byr'] > 2002) {
            print("byr no match: {$passport['byr']}\n");
            continue;
        }
        //four digits; at least 2010 and at most 2020.
        if ($passport['iyr'] < 2010 || $passport['iyr'] > 2020) {
            print("\niyr no match: {$passport['iyr']}\n");
            continue;
        }
        //'eyr',// (Expiration Year) four digits; at least 2020 and at most 2030.
        if ($passport['eyr'] < 2020 || $passport['eyr'] > 2030) {
            print("\neyr no match: {$passport['eyr']}\n");
            continue;
        }
        //'hgt',// (Height) a number followed by either cm or in:
          //      If cm, the number must be at least 150 and at most 193.
          //      If in, the number must be at least 59 and at most 76.
        if (strpos($passport['hgt'], 'cm') !== false || strpos($passport['hgt'], 'in') !== false) {
            if (strpos($passport['hgt'], 'cm') !== false && $passport['hgt'] >= 150 && $passport['hgt'] <= 193) {
                print("\nValid hgt: {$passport['hgt']}\n");
            } else if (strpos($passport['hgt'], 'in') !== false && $passport['hgt'] >= 59 && $passport['hgt'] <= 76) {
                print("\nValid hgt: {$passport['hgt']}\n");
            } else {
                print("\niyr no match: {$passport['eyr']}\n");
                continue;
            }
        } else {
            print("\niyr no match: {$passport['eyr']}\n");
            continue;
        }
        //'hcl',// (Hair Color) a # followed by exactly six characters 0-9 or a-f.
        if (!preg_match('/#[0-9a-f]{6}/', $passport['hcl'])) {
            print("\nhcl no match: \"{$passport['hcl']}\"\n");
            continue;
        }
        //'ecl',// (Eye Color) exactly one of: amb blu brn gry grn hzl oth.
        if (!in_array($passport['ecl'], ['amb','blu','brn','gry','grn','hzl','oth'])) {
            print("\necl no match: {$passport['ecl']}\n");
            continue;
        }
        //'pid',// (Passport ID) a nine-digit number, including leading zeroes.
        if (!preg_match('/\\d{9}/', $passport['pid'])) {
            print("\npid no match: {$passport['pid']}\n");
            continue;
        }
        $numValid++;
        print("\nVALID\n");
    } else {
        print("\nNOT\n");
    }
}

print("\nNum valid: $numValid\n");
