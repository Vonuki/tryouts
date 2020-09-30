<?php
/**
* Complex number 
*/
class Complex {
  
  //Parts of complex number
  private $real;
  private $img;
  
  //constructor
  public function __construct (int $real, int $img){
    $this->real = $real;
    $this->img = $img;
  }
  
  //Summing
  public static function sum (Complex $z1, Complex $z2):Complex{
    $z3 = new Complex(0,0);
    $z3->real = $z1->real + $z2->real;
    $z3->img = $z1->img + $z2->img;
    return $z3;
  }
  
  //Subtraction
  public static function subtr (Complex $z1, Complex $z2): Complex{
    $z3 = new Complex(0,0);
    $z3->real = $z1->real - $z2->real;
    $z3->img = $z1->img - $z2->img;
    return $z3;
  }
  
  //Multiplication
  public static function mult (Complex $z1, Complex $z2): Complex{
    $z3 = new Complex(0,0);
    $z3->real = $z1->real*$z2->real - $z1->img*$z2->img;
    $z3->img = $z1->real * $z2->img + $z1->img * $z2->real;
    return $z3;
  }
  
  //Division
  public static function div (Complex $z1, Complex $z2): Complex{
    $z3 = new Complex(0,0);
    $z3->real = ($z1->real*$z2->real + $z1->img*$z2->img)/($z2->real*$z2->real + $z2->img*$z2->img);
    $z3->img = ($z1->img * $z2->real - $z1->real * $z2->img)/($z2->real*$z2->real + $z2->img*$z2->img);;
    return $z3;
  }

  //Make string format
  public function format(): string {
    switch ($this->img <=> 0){
      case 0: $img_str = ""; break;
      case -1: $img_str = $this->img."i";break;
      case 1: $img_str = "+".$this->img."i";break;
      
    }
    return $this->real . $img_str;
  }
  
}

$z1 = new Complex(10,2);
echo "z1 = ".$z1->format(); echo "<br>";
$z2 = new Complex(2,1);
echo "z2 = ".$z2->format(); echo "<br>";
echo "sum = ".Complex::sum($z1,$z2)->format(); 
echo "<br>";
echo "sub = ".Complex::subtr($z1,$z2)->format(); 
echo "<br>";
echo "mult = ".Complex::mult($z1,$z2)->format();
echo "<br>";
echo "div = ".Complex::div($z1,$z2)->format();
?>
