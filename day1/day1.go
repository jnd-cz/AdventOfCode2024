package main

import (
    "bufio"
    "fmt"
    "log"
    "os"
    "sort"
    "strconv"
    "strings"
)

func main() {
    // Open the file
    file, err := os.Open("day1-input.txt")
    if err != nil {
        log.Fatal(err)
    }
    defer file.Close()

    var numbersA []int
    var numbersB []int

    // Create a scanner to read line by line
    scanner := bufio.NewScanner(file)
    for scanner.Scan() {
        line := scanner.Text()
        parts := strings.Fields(line) // split by whitespace
        if len(parts) != 2 {
            // Handle unexpected format
            log.Fatal("expected two numbers per line")
        }

        // Convert the strings to integers
        a, errA := strconv.Atoi(parts[0])
        b, errB := strconv.Atoi(parts[1])
        if errA != nil || errB != nil {
            log.Fatal("invalid number in input")
        }

        // Append to slices
        numbersA = append(numbersA, a)
        numbersB = append(numbersB, b)
    }

    if err := scanner.Err(); err != nil {
        log.Fatal(err)
    }

    //subtask 2, count how many times number from column A appears in column B
    //go through the numbersB, create frequency map
    //then go through numbersA, add up the corresponding element times occurence in the map
    frequencyMapB := make(map[int]int)
    for i := 0; i < len(numbersB); i++ {
        frequencyMapB[numbersB[i]]++  //map defaults to zero on unused elements s we can just increment it anyway
    }
    task2counter := 0
    for i := 0; i < len(numbersA); i++ {
        task2counter += frequencyMapB[numbersA[i]] * numbersA[i]  //map defaults to zero on unused elements s we can just increment it anyway
    }
    
    fmt.Println("Result for subtask 2:", task2counter)
    
    // Now we have two slices of numbers
    // Sort them
    sort.Ints(numbersA)
    sort.Ints(numbersB)

    // Calculate the sum of differences
    // Make sure you understand how you want to handle the subtraction:
    // If the problem says "subtract the difference of those numbers" and
    // you've sorted both sets of numbers from lowest to highest, then presumably:
    // difference[i] = numbersB[i] - numbersA[i] (or vice versa).
    // For now, let's assume it's numbersB[i] - numbersA[i].

    total := 0
    for i := 0; i < len(numbersA); i++ {
        var diff int
        if numbersB[i] > numbersA[i] {
            diff = numbersB[i] - numbersA[i]
        } else {
            diff = numbersA[i] - numbersB[i]
        }
        total += diff
    }

    fmt.Println("Result for subtask 1:", total)
    

}
