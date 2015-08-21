<?php
use \Event\Emitter;

class Transport extends Emitter
{
    public $readyState = 'opening';
    public $req = null;
    public $res = null;
    public function noop()
    {
 
    } 

    public function onRequest($req)
    {
        $this->req = $req;
    }
    
    public function close($fn)
    {
        $this->readyState = 'closing';
        $fn = $fn ? $fn : array($this, 'noop');
        $this->doClose($fn);
    }

    public function onError($msg, $desc)
    {
        if ($this->listeners('error')) 
        {
            $err = array(
                'type' => 'TransportError',
                'description' => $desc,
            );
            $this->emit('error', $err);
        } 
        else 
        {
            echo("ignored transport error $msg $desc\n");
        }
    }

    public function onPacket($packet)
    {
        $this->emit('packet', $packet);
    }

    public function onData($data)
    {
        $this->onPacket(Parser::decodePacket($data));
    }
    
    public function onClose() 
    {
        $this->readyState = 'closed';
        $this->emit('close');
    }
}