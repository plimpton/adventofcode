package main

import (
    "fmt"
    "log"
    "io/ioutil"
    "strings"
    "strconv"
)

func main() {
    input, err := ioutil.ReadFile("input.txt")
    if err != nil {
        log.Fatal(err)
    }
    list := strings.Split(string(input), "\r\n")
    for _, vs := range list {
        var v int
        v, err = strconv.Atoi(vs)
        if err != nil {
            log.Fatalf("Error parsing string to int: '%s' - %s", vs, err)
        }
        fmt.Println(v)
        expected := 2020 - v
        for _, vis := range list {
            var vi int
            vi, _ = strconv.Atoi(vis)
            fmt.Println(vi)
            if vi == expected {
                answer := v * vi
                log.Fatalf("Found answer: %i", answer)
            }
        }
    }

}
