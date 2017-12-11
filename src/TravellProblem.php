<?php

/**
 * Description of TravellProblem
 * 
 * Travelling salesman problem
 * Nearest Neighbour algorithm
 * 
 * Count variants
 * -earth
 * -flat
 *
 * @author mv28jam <mv28jam@yandex.ru>
 */
class TravellProblem implements TravellInterface 
{
    //meter
    const EARTH_RADIUS = 6372795;
    //array of points
    protected $points = [];//;
    //count like flat
    protected $countFlat = false;
    //delim points name
    protected $delimiter = '/';
    /*
     * way array of points to go
     * dist array od distance len =  len(way)-2
     */
    protected $way = [];
    protected $dist = [];
    
    /*
     * @param void
     * @return this
     */
    public function init(): TravellProblem 
    {
        $this->way = [];
        $this->dist = [];
        return $this;
    }
    
    /*
     * @param void
     * @return array final result
     */
    public function go():array
    {
        //goto first element
        reset($this->points);
        //count
        $this->nextSearch($this->points, key($this->points));
        //
        return [implode($this->delimiter, $this->way), array_sum($this->dist)];   
    }
    
    /*
     * @param string $delim
     * @return array final result
     */
    public function getResultAsIs():array
    {      
        return [$this->way, $this->dist];
    }
    
    /*
     * @param array $dots 
     * @param mixed $start start key in array
     * @return void
     * @throws Exception from this->checkLen
     */
    protected function nextSearch(array $dots, $start):void
    {
        //check for min len
        if($this->checkLen($dots)){
            //dist array
            $dists = [];
            //empty way  =  start of
            if(empty($this->way)){
                $this->way[] = $start;
            }
            //goto count
            foreach($dots as $key => $val){
                if($key !== $start){ 
                    $dists[$key] = $this->distFlat($dots[$start], $val);
                }
            }
            //sort to find closest
            asort($dists);
            //next closest point
            $next = key($dists);
            //save point of way
            $this->way[] = $next;
            $this->dist[] = $dists[$next];
            //delete included dots
            unset($dots[$start]);
            //if 2 or more variants recursive
            //if no goto first point
            if(count($dots) > 1){
                $this->nextSearch($dots, $next);
            }else{
                $this->way[] = key($this->points);
                $this->dist[] = $this->distFlat(reset($this->points),reset($dots));    
            }
        }
        //
    }
    
    /*
     * @param array $a dots coord
     * @param array $b dots coord
     * @return float
     * proxy function 
     */
    protected function dist(array $a, array $b):float
    {
        if($this->countFlat){
            return $this->distFlat($a, $b);
        }else{
            return $this->distEarth($a, $b);
        }     
    }
    
    /*
     * @param array $a dots coord
     * @param array $b dots coord
     * @return float 
     */
    public function distFlat(array $a, array $b):float
    {
        return sqrt(pow(abs($a[0] - $b[0]), 2) + pow(abs($a[1] - $b[1]), 2));      
    }

    /*
     * @param array $a dots coord
     * @param array $b dots coord
     * @author Михаил Кобзарев <mikhail@kobzarev.com>
     * @return float
     */
    function distEarth (array $a, array $b):float 
    {
        $φA = $a[0]; 
        $λA = $a[1]; 
        $φB = $b[0]; 
        $λB = $b[1];
        $lat1  =  $φA * M_PI / 180;
        $lat2  =  $φB * M_PI / 180;
        $long1  =  $λA * M_PI / 180;
        $long2  =  $λB * M_PI / 180;
        $cl1  =  cos($lat1);
        $cl2  =  cos($lat2);
        $sl1  =  sin($lat1);
        $sl2  =  sin($lat2);
        $delta  =  $long2 - $long1;
        $cdelta  =  cos($delta);
        $sdelta  =  sin($delta);
        $y  =  sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
        $x  =  $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;
        $ad  =  atan2($y, $x);
        $dist  =  $ad * TravellProblem::EARTH_RADIUS;
        return $dist;
    }
    
    /*
     * @param void 
     * @param array $dots
     * @return bool true expected
     * @throws Exception 
     */
    protected function checkLen(array $dots):bool
    {
        if(count($dots) < 2){
            throw new Exception('Can not count - less then 2 points');  
        }
        return true;
    }
    
    /*
     * @param array $points
     * @return bool 
     * @throws Exception from this->checkLen
     */
    public function setPoints(array $points):bool
    {
        if($this->checkLen($points)){
            $this->points = $points;
            return true;
        }
        return false;
    }
    
    /*
     * @param string $delim
     * @return bool 
     */
    public function setDelim(string $delim):bool
    {
        if(!empty($delim)){
            $this->delimiter = $delim;
            return true;
        }
        return false;
    }
    
    /*
     * @param void
     * @return bool 
     */
    public function setCountEarth():bool
    {
        $this->countFlat = false;
        return true;
    }
    
    /*
     * @param void
     * @return bool 
     */
    public function setCountFlat():bool
    {
        $this->countFlat = true;
        return true;
    } 
}
