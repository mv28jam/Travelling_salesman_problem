<?php

/*
 *
 */

/**
 * Description of TravellInterface
 * 
 * Travell have to has 
 * points setPoints()
 * and 
 * path go()
 *
 * @author mv28jam <mv28jam@yandex.ru>
 */
interface TravellInterface 
{
    /*
     * @param void
     * @return array result of count
     * counting function
     */
    public function go():array;
    /*
     * @param array $points
     * @return bool
     * set points of way
     */ 
    public function setPoints(array $points):bool;
}
