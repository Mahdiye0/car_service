<?php

namespace AppTraits;

use MorilogJalaliJalalian;

trait PersianDate{

public function PersianCreatedAt($format = "%d %B %Y")
{
return Jalalian::forge($this->created_at)->format($format);

}
}