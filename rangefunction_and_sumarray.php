
<?php

    /*
        This is a snippet routine containing two functions:

        (1) A fucntion that creates a range of numbers (including both 
            the starting and the ending numbers).
        (2) A function that sums up the numbers in an array of numbers.

    */


    // create a range of numbers using our defRange function. 
    // Scroll down the page for the function block.

    $myRangeNum = defRange(2,56) ;
    
    // let's output our result on the screen 
    for ($i=0; $i < count($myRangeNum); $i++ ){
        echo "Element " . $i+1 . " is " . $myRangeNum[$i] . "<br> ";
    }

    /* option 2 to view the range elements with a built-in function "foreach"

      foreach ($myRangeNum as $currentNum ){
         echo "$currentNum <br>";
       }
     */

    // use the function sumArray to add all numbers in the array above.

     echo "<br> The sum of your array is ", sumArray($myRangeNum) ;



     function defRange( $numStart, $numEnd, $step = 1) {
        
        /*  This function creates a range of number and has three arguments 
            Argument 1: numStart is the starting number
            Argument 2: numEnd is the ending number (may not be necessarily be 
                        included in the range depending on the step-size -> Argument 3 )
            Argument 3: step (a positive number) is the increment or decrement rate. 
                        This argument is optional and has a default value 1
        */
        if ($step <= 0) {
            
            exit("Error: the step cannot be zero or negative. <br> Try Again!");
        }

        $counter = 0 ; // to use for array index
        $arrayContainer = array() ; // declare an empty array to save numbers
        if ( $numStart > $numEnd ){
            // this block takes care of situation where the ending number is smaller 
        
        
            while( $numStart >= $numEnd ){
                
                $arrayContainer[$counter] = $numStart ; // stack in the numnbers into the array
                
                $numStart -= $step ;
                $counter++ ;

                }
        } else {

            while( $numStart <= $numEnd ){
                
                $arrayContainer[$counter] = $numStart ; // stack in the numnbers into the array
                
                $numStart += $step ;
                $counter++ ;
                
            }
        }
        
        return  $arrayContainer ; // returns the array with the range numbers
        
    }


     function sumArray( $arrayInput ) {

        //  This function adds all the numbers in the argument array -> arrayInput

            $sumValue = 0; // initialise a variable to zero. It stores the added numbers
        for ( $i = 0; $i < count($arrayInput); $i++ ) {
            $sumValue += $arrayInput[$i] ;
        }

        return $sumValue ; // return the sum of all array elements

     }


   
?>