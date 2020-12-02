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
    list := strings.Split(string(input), "\n")
    for _, vs := range list {
        var v int64
        v, _ = strconv.ParseInt(vs, 10, 0)
        fmt.Println(v)
        expected := int64(2020 - v)
        for _, vis := range list {
            var vi int64
            vi, _ = strconv.ParseInt(vis, 10, 0)
            fmt.Println(vi)
            if vi == expected {
                answer := v * vi
                log.Fatalf("Found answer: %i", answer)
            }
        }
    }

}
