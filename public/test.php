<?php
trait A{
    public function auth(){
        return 'no';
    }
}

class B{
    use A;

    public function auth()
    {
        return 'aaaa';
    }
}
$b = new B();
echo $b->auth();