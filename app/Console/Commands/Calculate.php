<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Calculate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:compute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $prime = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
       
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = $this->ask('Input'); //Get Input
        $input = str_replace(' ', '', $input); //Remove Spaces
        $temp = ''; // Temporary Digit Container
        $num = []; // List Digits
        $op = []; // List Operation
        $total = 0; //Total Computation
        $valid = true;
        //Get each characters
        for ($i = 0; $i < strlen($input); $i++) {
            if(is_numeric(substr($input, $i, 1)) || substr($input, $i, 1) == '.'){
                // Set Temporary Digit Container
                $temp .= substr($input, $i, 1);
                // Set Last Digit into array
                if($i == (strlen($input)-1)){
                    $num[] = $temp; 
                }
            }
            else{
                  if(substr($input, $i, 4) == 'sqrt'){
                        $op[] = 'sqrt';
                    }
                    else{
                        $op[] = substr($input, $i, 1);
                    }
                    $num[] = $temp; // Set Digit into array
                    $temp = '';
            }
        }
        if($valid){
          //Operation
           for ($i = 0; $i < count($op); $i++) {
          if($op[$i] == '+'){
            if($i == 0){
                $total = $num[$i] + $num[$i + 1];
            }
            else{
                $total += $num[$i+ 1];
            }
          }
          else if($op[$i] == '-'){
            if($i == 0){
                $total = $num[$i] - $num[$i + 1];
            }
            else{
                $total -= $num[$i+ 1];
            }
          }
          else if($op[$i] == '*'){
            if($i == 0){
                $total = $num[$i] * $num[$i + 1];
            }
            else{
                $total *= $num[$i+ 1];
            }
          }
          else if($op[$i] == '/'){
            if($i == 0){
                $total = $num[$i] / $num[$i + 1];
            }
            else{
                $total /= $num[$i+ 1];
            }
          }
          else if($op[$i] == 'sqrt'){
            //Perfect Square root
            if($i == 0){
                $total = $num[$i];
                $x = 1;
                $y = $total;
                //Get Prime numbers
                for($v = $x; $v < $y + 1; $v++) {
                  $this->primenumber($v);
                }
                //Prime numbers
                for($p = 0; $p < count($this->prime); $p++) {
                   if(($this->prime[$p] * $this->prime[$p]) ==  $total ){
                    $total = $this->prime[$p];
                   }
                }
                // Manual Numbers
                if($total == $num[$i]){
                    for($p = 1; $p <= $total; $p++) {
                  
                        if(($p * $p) ==  $total ){
                         $total = $p;
                        }
                      
                     }
                }

            }
         
          }
        }
        }
        //Result
        $this->info('Result:  '.$total);
    }

    public function primenumber($MyNum) {
        $n = 0;
        if ($MyNum == 2 || $MyNum == 3){
          $this->prime[] = $MyNum;
        } 
        elseif ($MyNum % 6 == 1 || $MyNum % 6 == 5) {
          for($i = 2; $i*$i <= $MyNum; $i++) {
            if($MyNum % $i == 0){
              $n++;
              break;
            }
          }
          
          if ($n == 0){
            $this->prime[] = $MyNum;
          } 
        } 
      }
    
}
