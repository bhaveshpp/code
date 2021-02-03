

```
public function lol($lol)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('Simple Text Log'); // Simple Text Log
        $logger->info('AT : '. $lol); // Simple Text Log
        // $this->lol(__FILE__."::".__LINE__);
    }
```