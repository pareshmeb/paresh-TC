<?php
declare(strict_types=1);
namespace App\Common;
use R;

class SalesDatabase extends R
{
    public function __construct() 
    {
        R::setup( 'pgsql:host=db;dbname=postgres','postgres', 'postgres' );
    }
    
}

